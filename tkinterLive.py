import tkinter as tk
import cv2, time
from PIL import ImageTk, Image
app = tk.Tk()

def display(frame):
	global app
	#rearranging color channel
	
	

	b,g,r = cv2.split(frame)
	imgStream = cv2.merge((r,g,b))
	imgStream = Image.fromarray(imgStream)
	time.sleep(1)
	img = ImageTk.PhotoImage(imgStream)
	introLabel = tk.Label(app, text="Welcome to the live feed", image=img)
	introLabel.pack()
	print("Hello world")
	app.mainloop()

cap = cv2.VideoCapture(0)
while(True):
	ret, frame = cap.read()
	# cv2.imshow('frame', frame)
	print("Gig")
	display(frame)


	if cv2.waitKey(1) & 0xFF == ord('q'):
		break

# When everything done, release the video capture and video write objects
cap.release()
 
# Closes all the frames
cv2.destroyAllWindows()

# imgStream = cv2.imread('rdf.jpg')

# #rearranging color channel
# b,g,r = cv2.split(imgStream)
# imgStream = cv2.merge((r,g,b))
# imgStream = Image.fromarray(imgStream)

# img = ImageTk.PhotoImage(imgStream)
# introLabel = tk.Label(app, text="Welcome to the live feed", image=img)
# introLabel.pack()
# print("Hello world")
# app.mainloop()