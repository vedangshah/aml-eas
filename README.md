# Record Video

## Setup:
1. Clone project
2. Run command ```composer install```
3. Run command ```php artisan key:generate```
4. Import below mentioned modules for python
    cv2 <br/>
    scipy <br/>
    imutils <br/>
    opencv-contrib-python <br/>
    Pillow <br/>
    Flask-RESTful==0.3.9 <br/>
    uuid <br/>
    base64 <br/>
5. Run ```php artisan migrate:fresh --seed``` to migrate all the tables and fill all the required data in the tables
Create two folders "targetImages" and "originalPhotos" inside the FaceRecognition-master directory
6. Open FaceRecognition-master directory-> run command ```python find_similarities.py```
7. Back to laravel project -> Run command ```php artisan serve```

