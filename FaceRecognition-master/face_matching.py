import os, sys
import cv2
import time
import scipy
import numpy as np

from scipy import spatial

from face_extraction import FaceExtraction
from face_embedding import FaceEmbedding

import argparse

idImage = cv2.imread('Raval Darshankumar Kirtibhai.jpg')
# selfieImage = cv2.imread('WIN_20210430_20_46_43_Pro.jpg')
modelPath = 'face_detection_model\\'
embeddingModel = 'face_embedding_model\openface_nn4.small2.v1.t7'
out_dir = 'output'


def main(img):
    selfieImage = cv2.imread('targetImages\\' + img)
    # Get feature vector for ID image
    detect = FaceExtraction(idImage, modelPath)
    faces = detect.detect_face()
    if (len(faces) < 1):
        print("More than 1 faces detected in the ID image\nPlease provide another ID!!!")
        return 500
    else:
        cv2.imwrite(out_dir + 'A001.png', faces[0])
        faceEmbeddingVec = FaceEmbedding(faces[0], embeddingModel)
        embeddingVectorId = faceEmbeddingVec.get_face_embedding()

    # Get feature vector for Selfie image
    detect = FaceExtraction(selfieImage, modelPath)
    faces = detect.detect_face()
    if (len(faces) < 1):
        print("More than 1 faces detected in the Selfie\nPlease provide another Selfie!!!")
        return "More than 1 faces detected in the Selfie\nPlease provide another Selfie!!!", 400
    else:
        cv2.imwrite('targetImages\\' + img, faces[0])
        faceEmbeddingVec = FaceEmbedding(faces[0], embeddingModel)
        embeddingVectorSelfie = faceEmbeddingVec.get_face_embedding()

    # Get cosine distance between id and selfie images
    similarity_dist = spatial.distance.cosine(embeddingVectorId, embeddingVectorSelfie)

    return similarity_dist


if __name__ == '__main__':
    main()
