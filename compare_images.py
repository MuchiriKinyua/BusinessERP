import sys
import cv2
import os

def compare_faces(image1_path, employee_id):
    # Load the image to be verified
    image1 = cv2.imread(image1_path)
    
    if image1 is None:
        return "Error: Image could not be loaded."

    # Convert the image to grayscale (needed for face comparison)
    gray1 = cv2.cvtColor(image1, cv2.COLOR_BGR2GRAY)

    # Use OpenCV's face detector (Haar Cascade for simplicity here)
    face_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_frontalface_default.xml')

    # Detect faces
    faces1 = face_cascade.detectMultiScale(gray1, scaleFactor=1.1, minNeighbors=5)

    if len(faces1) == 0:
        return "No faces detected in the image."

    # For simplicity, compare the first face detected in the image (could be extended to handle multiple faces)
    x, y, w, h = faces1[0]
    face1 = gray1[y:y+h, x:x+w]

    # Load the pre-trained face recognizer for the given employee's face model
    face_recognizer = cv2.face.LBPHFaceRecognizer_create()
    
    model_path = f"trained_faces/{employee_id}_model.yml"
    if not os.path.exists(model_path):
        return f"Error: No model found for employee {employee_id}."

    try:
        face_recognizer.read(model_path)  # Load the specific employee's face model
    except cv2.error as e:
        return f"Error loading trained model: {e}"

    # Predict on the face detected in the uploaded image
    label, confidence = face_recognizer.predict(face1)

    # Compare the confidence value to a threshold (lower confidence means higher match)
    # You can adjust the threshold based on the expected matching accuracy
    threshold = 100  # Threshold can be fine-tuned based on your needs
    if confidence < threshold:
        return "True"  # Faces match
    else:
        return "False"  # Faces don't match

if __name__ == '__main__':
    # Get image path and employee ID from command line arguments
    if len(sys.argv) != 3:
        print("Usage: python compare_faces.py <image1_path> <employee_id>")
        sys.exit(1)
        
    image1_path = sys.argv[1]
    employee_id = sys.argv[2]
    
    # Compare the faces
    result = compare_faces(image1_path, employee_id)
    print(result)
