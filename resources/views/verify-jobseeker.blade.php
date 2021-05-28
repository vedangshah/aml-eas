<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Document</title>
    <style>
        canvas {
            position: absolute;
        }
        #show-recording {
            position: relative;
        }
        #capturedPhoto {
            visibility: hidden;
        }
        #capturedVideo {
            visibility: hidden;
        }
    </style>
</head>
<body>
    <div class="row mt-3">
        <div class="col">
            <button class='float-right' id="start" >Start Recording</button>
        </div>
        <div class="col">
            <button id="stop" >Stop Recording</button>
        </div>
    </div>
    <h1 class="mt-4 text-center">Recording...</h1>
    <div class="row mt-4">
        <div class="col">
            <div class="d-flex justify-content-center">
                <video id="show-recording" width="720" height="560" ></video>
            </div>
        </div>
    </div>

    <canvas id="capturedPhoto"></canvas>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('js/face-api.min.js') }}"></script>
    <script>

        $(document).ready(function() {
            $('#show-recording').parents('.row').first().after(`
                <h1 class="mt-3 text-center">Recorded Video</h1>
                <div class="mt-3 row">
                    <div class="col">
                        <div class="d-flex justify-content-center">
                            <video id="capturedVideo" controls></video>
                        </div>
                    </div>
                </div>
            `);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            var video = document.querySelector('#show-recording');
            var recordedVideo;
            var mediaRecorder;
            var videoRecordingStarted = false;
            var chunks = [];

            Promise.all([
                faceapi.nets.tinyFaceDetector.loadFromUri("{{ asset('js/models') }}"),
                faceapi.nets.faceLandmark68Net.loadFromUri("{{ asset('js/models') }}"),
                faceapi.nets.faceLandmark68Net.loadFromUri("{{ asset('js/models') }}"),
                faceapi.nets.faceExpressionNet.loadFromUri("{{ asset('js/models') }}"),
            ]).then(
                function() {
                    var constraintObj = {
                        audio : false,
                        video : {
                            facingMode: 'user'
                        }
                    };
                    navigator.mediaDevices.getUserMedia(constraintObj)
                    .then(function(mediaStreamObj) {
                        if ("srcObject" in video) {
                            video.srcObject = mediaStreamObj;
                        } else {
                            video.src = window.URL.createObjectURL(medeaStreamObj);
                        }

                        video.onloadedmetadata = function(ev) {
                            video.play();
                            mediaRecorder.start();
                        }
                        
                        var start = document.getElementById('start');
                        var stop = document.getElementById('stop');
                        mediaRecorder = new MediaRecorder(mediaStreamObj);

                        start.addEventListener('click', function(e) {
                            video.play();
                            mediaRecorder.start();
                        });

                        /* stop.addEventListener('click', function(e) {
                            video.pause();
                            mediaRecorder.stop();
                            
                            $('#show-recording').parents('.row').first().after(`
                                <h1 class="mt-3 text-center">Recorded Video</h1>
                                <div class="mt-3 row">
                                    <div class="col">
                                        <div class="d-flex justify-content-center">
                                            <video id="capturedVideo" controls></video>
                                        </div>
                                    </div>
                                </div>
                            `);
                        }); */

                        mediaRecorder.ondataavailable = function(e) {

                            var chunk = e.data;
                            // capture(e.data, );
                            // window.location.href = window.URL.createObjectURL(img);
                            chunks.push(chunk);
                        };

                        /* mediaRecorder.onstop = function(e) {
                            recordedVideo = new Blob(chunks, {'type' : 'video/mp4'});
                            chunks = [];
                            var vidSave = document.getElementById('capturedVideo');
                            var videoURL = window.URL.createObjectURL(recordedVideo);
                            vidSave.src = videoURL;
                        }; */
                         

                        mediaRecorder.onstop = function(e) {
                            console.log('media recorder stopped');
                            recordedVideo = new Blob(chunks, {'type' : 'video/mp4'});
                            chunks = [];
                            var vidSave = document.getElementById('capturedVideo');
                            var videoURL = window.URL.createObjectURL(recordedVideo);
                            vidSave.src = videoURL;
                        };
                    })
                    .catch(function(err) {
                        console.log(err.name, err.message)
                    });

                }
            );

            video.addEventListener('play', function () {
                var canvas = faceapi.createCanvasFromMedia(video);
                // canvas.insertAfter(video);

                video.parentElement.append(canvas);
                var displaySize = {width: video.width, height: video.height};

                setInterval(async () => {
                    var detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceExpressions()

                    var resizedDetections = faceapi.resizeResults(detections, displaySize);
                    canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
                    faceapi.draw.drawDetections(canvas, resizedDetections);
                }, 100);

                var photoSentCount = 0;
                var avgSimilarityArray = [];
                var sendPhotoInterval = setInterval(async () => {
                    console.log("photoSentCount: "+photoSentCount);
                    let canvas = document.getElementById('capturedPhoto');

                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    canvas.getContext('2d').drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
                    var photo = canvas.toDataURL();
                    var data = new FormData();
                    data.append('photo', photo);
                    if (photoSentCount < 5) { // should be 5
                        $.ajax({
                            type: "post",
                            url: "{{ route('recognizeUser') }}",
                            data: data,
                            contentType: false,
                            processData: false,
                            success: function(result) {
                                photoSentCount += 1;
                                console.log(result);
                                avgSimilarityArray.push(parseFloat(result.result))
                            },
                            error: function(jqXHR, exception) {
                                console.log('Unexpected Event Occured. Could not recognize.');
                            }
                        });
                    } else {
                        console.log('IN ELSE');
                        console.log("avgSimilarityArray");
                        console.log(avgSimilarityArray);
                        avgSimilarity = avgSimilarityArray.reduce( function (total, num) {
                            return total + num;
                        });
                        console.log("avgSimilarity: "+avgSimilarity);
                        console.log("photoSentCount: "+photoSentCount);
                        avgSimilarity = (avgSimilarity / photoSentCount);
                        console.log("avgSimilarity: "+avgSimilarity);
                        if (mediaRecorder.state != 'inactive') {
                            video.pause();
                            mediaRecorder.stop();
                        }
                        if (avgSimilarity < 0.20) {
                            if (recordedVideo) {
                                var alertAfterRecognitionProcess = function () {
                                    Swal.fire({
                                        icon: "success",
                                        title: 'Congrats !',
                                        text: 'You are recognized!',
                                        onClose: function() {
                                            console.log('PROFILE PICTURE RECOGNIZED');
                                            window.location.href = "{{ route('examStart', request()->examId) }}"
                                        }
                                    });
                                }

                                /* var data = new FormData();
                                data.append('examId', "{{ request()->examId }}");
                                
                                data.append('video', recordedVideo);
                                console.log('data');
                                console.log(recordedVideo);
                                $.ajax({
                                    type: "post",
                                    url: "{{ route('uploadVideo') }}",
                                    data: data,
                                    contentType: false,
                                    processData: false,
                                    success: function(result) {
                                        Swal.fire({
                                            icon: "success",
                                            title: 'Congrats !',
                                            text: 'Video Uploaded Successfully!',
                                        });
                                    },
                                    error: function(jqXHR, exception) {
                                        Swal.fire({
                                            icon: "error",
                                            title: 'Oops...',
                                            text: 'Internal Server Error !',
                                        });
                                    }
                                }); */
                                // clearInterval(sendPhotoInterval);
                            }

                        } else {
                            console.log('ESTIMATION IS HIGHER THAN .30');
                            var alertAfterRecognitionProcess = function () {
                                Swal.fire({
                                    icon: "error",
                                    title: 'Oops !',
                                    text: 'Your face does not match with the profile picture you have uploaded !',
                                    onClose: function() {
                                        console.log('PROFILE PICTURE NOT RECOGNIZED');
                                        window.location.href = "{{ route('upexam').'?page=exam-enrolled-user' }}"
                                    }
                                });
                            }
                            // clearInterval(sendPhotoInterval);
                        }
                        if (recordedVideo) {

                            console.log('VIDEO RECORDED');
                            var data = new FormData();
                            data.append('examId', "{{ request()->examId }}");
                            
                            data.append('video', recordedVideo);
                            data.append('accuracy', avgSimilarity);

                            console.log('data');
                            console.log(recordedVideo);
                            $.ajax({
                                type: "post",
                                url: "{{ route('uploadVideo') }}",
                                data: data,
                                contentType: false,
                                processData: false,
                                success: function(result) {
                                    console.log()
                                    alertAfterRecognitionProcess();
                                },
                                error: function(jqXHR, exception) {
                                    Swal.fire({
                                        icon: "error",
                                        title: 'Oops...',
                                        text: 'Internal Server Error !',
                                    });
                                }
                            });
                            clearInterval(sendPhotoInterval);
                        }

                    }

                }, 3000);
            });



            /* $(document).on('click', '#uploadVideo', function (e) {
                
                var data = new FormData();
                data.append('video', recordedVideo);
                $.ajax({
                    type: "post",
                    url: "{{ route('uploadVideo') }}",
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        Swal.fire({
                            icon: "success",
                            title: 'Congrats !',
                            text: 'Video Uploaded Successfully!',
                        });
                    },
                    error: function(jqXHR, exception) {
                        Swal.fire({
                            icon: "error",
                            title: 'Oops...',
                            text: 'Internal Server Error !',
                        });
                    }
                })
            }); */
        });
    </script>
</body>
</html>
