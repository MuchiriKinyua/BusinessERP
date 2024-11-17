import sys
import cv2
import os
import logging

# Set up logging configuration
logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')
logger = logging.getLogger()

def compare_faces(image1_path, image2_path):
    logger.info(f"Comparing faces: {image1_path} with {image2_path}")
    
    # Load the first image (captured image) to be verified
    image1 = cv2.imread(image1_path)
    
    if image1 is None:
        logger.error(f"Error: Image 1 could not be loaded: {image1_path}")
        return "Error: Image 1 could not be loaded."

    # Convert the image to grayscale (needed for face comparison)
    gray1 = cv2.cvtColor(image1, cv2.COLOR_BGR2GRAY)
    logger.info("Converted image 1 to grayscale.")

    # Use OpenCV's face detector (Haar Cascade for simplicity here)
    face_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_frontalface_default.xml')

    # Detect faces in the first image
    faces1 = face_cascade.detectMultiScale(gray1, scaleFactor=1.1, minNeighbors=5)
    if len(faces1) == 0:
        logger.warning("No faces detected in the first image.")
        return "No faces detected in the first image."

    # For simplicity, compare the first face detected in the image (could be extended to handle multiple faces)
    x, y, w, h = faces1[0]
    face1 = gray1[y:y+h, x:x+w]
    logger.info("Detected face in the first image.")

    # Load the second image (employee face image)
    image2 = cv2.imread(image2_path)
    if image2 is None:
        logger.error(f"Error: Image 2 could not be loaded: {image2_path}")
        return "Error: Image 2 could not be loaded."

    # Convert the second image to grayscale
    gray2 = cv2.cvtColor(image2, cv2.COLOR_BGR2GRAY)
    logger.info("Converted image 2 to grayscale.")

    # Detect faces in the second image (employee face)
    faces2 = face_cascade.detectMultiScale(gray2, scaleFactor=1.1, minNeighbors=5)
    if len(faces2) == 0:
        logger.warning("No faces detected in the second image.")
        return "No faces detected in the second image."

    # For simplicity, compare the first face detected in the employee image
    x, y, w, h = faces2[0]
    face2 = gray2[y:y+h, x:x+w]
    logger.info("Detected face in the second image.")

    # Initialize face recognizer (you can also use LBPH face recognizer if you have a model)
    face_recognizer = cv2.face.LBPHFaceRecognizer_create()

    try:
        # Train on employee model (if you have one, or use direct comparison as below)
        label, confidence = face_recognizer.predict(face1)
        logger.info(f"Face recognizer confidence: {confidence}")
    except Exception as e:
        logger.error(f"Error during face recognition: {str(e)}")
        return f"Error during face recognition: {str(e)}"

    # You can adjust the threshold to fit your verification needs
    threshold = 100
    if confidence < threshold:
        logger.info("Faces match.")
        return "True"  # Faces match
    else:
        logger.warning("Faces do not match.")
        return "False"  # Faces don't match

if __name__ == '__main__':
    # Get image paths from command line arguments
    if len(sys.argv) != 3:
        logger.error("Usage: python compare_faces.py <captured_image_path> <employee_image_path>")
        sys.exit(1)
        
    image1_path = sys.argv[1]
    image2_path = sys.argv[2]
    
    # Check if images exist
    if not os.path.exists(image1_path):
        logger.error(f"Image 1 path does not exist: {image1_path}")
        sys.exit(1)
        
    if not os.path.exists(image2_path):
        logger.error(f"Image 2 path does not exist: {image2_path}")
        sys.exit(1)
    
    # Compare the faces
    result = compare_faces(image1_path, image2_path)
    logger.info(f"Face comparison result: {result}")
    print(result)
