from flask import Flask
from flask_restful import Resource, Api, reqparse
import base64
import uuid

import os, sys
import cv2
import time
import scipy
import numpy as np
import urllib

from scipy import spatial

from face_extraction import FaceExtraction
from face_embedding import FaceEmbedding

import argparse

app = Flask(__name__)

parser = reqparse.RequestParser()
@app.route('/', methods = ['POST'])
def similarities():
    parser.add_argument("targetImage")
    parser.add_argument("originalPhoto")
    parser.add_argument("originalPhotoExtension")

    args = parser.parse_args()


    # idImage = url_to_image("http://127.0.0.1:8000/profile-photos/" + args['originalPhoto'])
    idImage = base64.b64decode(args['originalPhoto'])
    decoded_image = base64.b64decode(args['targetImage'])

    # for target image
    unique_filename_target = str(uuid.uuid4()) + '.png'
    with open('targetImages\\' + unique_filename_target, 'wb') as f:
        f.write(decoded_image)

    #for original image
    unique_filename_original = str(uuid.uuid4()) + '.' + args['originalPhotoExtension']
    with open('originalPhotos\\' + unique_filename_original, 'wb') as f:
        f.write(idImage)

    result = main(unique_filename_target, unique_filename_original)

    if result:
        return (str(result), 200)
    else:
        return ("Internal server error.", 500)


# def url_to_image(url):
#     print(url)
#     resp=urllib.request.urlopen(url)
#     image=np.asarray(bytearray (resp.read()), dtype="uint8")
#     image=cv2.imdecode(image, cv2.IMREAD_COLOR)
#     return image



# idImage = url_to_image("http://127.0.0.1:8000/profile-photos/Robert_Downey_Jr.jpg")
modelPath = 'face_detection_model\\'
embeddingModel = 'face_embedding_model\openface_nn4.small2.v1.t7'
out_dir = 'output'

def main(img, idImage):
    selfieImage = cv2.imread('targetImages\\' + img)
    idImage = cv2.imread('originalPhotos\\' + idImage)
    # os.remove('targetImages\\' + img)
    # os.remove('originalPhotos\\' + idImage)
    # Get feature vector for ID image
    detect = FaceExtraction(idImage, modelPath)
    faces = detect.detect_face()
    if (len(faces) < 1):
        print("More than 1 faces detected in the ID image\nPlease provide another ID!!!")
        return False
    else:
        cv2.imwrite(out_dir + 'A001.png', faces[0])
        faceEmbeddingVec = FaceEmbedding(faces[0], embeddingModel)
        embeddingVectorId = faceEmbeddingVec.get_face_embedding()

    # Get feature vector for Selfie image
    detect = FaceExtraction(selfieImage, modelPath)
    faces = detect.detect_face()
    if (len(faces) < 1):
        print("More than 1 faces detected in the Selfie\nPlease provide another Selfie!!!")
        return False
    else:
        faceEmbeddingVec = FaceEmbedding(faces[0], embeddingModel)
        embeddingVectorSelfie = faceEmbeddingVec.get_face_embedding()
        

    # Get cosine distance between id and selfie images
    similarity_dist = spatial.distance.cosine(embeddingVectorId, embeddingVectorSelfie)

    return str(similarity_dist)



if ('__main__' == __name__):
    app.run(debug=True)




