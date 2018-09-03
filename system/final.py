from __future__ import print_function
from tkinter import *
import tkinter as tk
from PIL import ImageTk, Image
from tkinter import filedialog
import sys
import os
import cv2
import subprocess
import threading
import datetime, time
import imutils
from imutils.video import VideoStream
import Main

#global variables
currentFrame = None; #stores current frame of camera
stopEvent = None; #Initials
thread = None; #Initials
livePanel = None

# initialize the video stream and allow the camera sensor to warmup
print("[INFO] warming up camera...")
vs = VideoStream(usePiCamera=False).start()
time.sleep(2.0)

#Tkinker instance
root = Tk()
root.geometry('1200x960')
root.title("DESIGNING AND DEVELOPMENT OF AN ASSISTANT GATEMAN")
filename = PhotoImage(file = "back.png")
background_label = Label(root, image=filename)
background_label.place(x=0, y=0, relwidth=1, relheight=1)



label = Label(root, text = ' DESIGN AND DEVELOPMENT OF AN ASSISTANT GATEMAN', fg = 'black',
bg ='grey', font = (None, 15,'bold'),width = 100, height = 2)
label.pack(side = TOP)

lbl = Label(root,bg='black', width=18, height=4,fg="turquoise", text='Results',font=(None,10,"bold"))
lbl.pack( pady = 20, padx = 20,side="right")
panel = Label(root)

def handleWindowClose():
		# set the stop event, cleanup the camera, and allow the rest of
		# the quit process to continue
		print("[INFO] closing...")
		stopEvent.set()

		#stoping camera from recoding
		vs.stream.release()
		root.destroy()
		exit()

def videoLoop():
	global currentFrame, stopEvent, livePanel, panel
	# DISCLAIMER:
	# try/except statement is a pretty ugly hack to get around
	# a RunTime error that tknter throws due to threading
	print("There we go")
	try:
		# keep looping over frames until we are instructed to stop
		print(stopEvent.is_set())
		while not stopEvent.is_set():
			# grab the frame from the video stream and resize it to
			# have a maximum width of 300 pixels
			currentFrame = vs.read()
			currentFrame = imutils.resize(currentFrame, width=300)

			outputPath = 'plates'
			filename = "current.jpg"
			imagePath = os.path.sep.join((outputPath, filename))
			# save the file
			cv2.imwrite(imagePath, currentFrame.copy())

			foundPlates = Main.findPlates(imagePath)
			# print((foundPlates == False))
			if(foundPlates != False):	
				print(foundPlates)
				img = Image.open(imagePath)
				img = img.resize((470, 350), Image.ANTIALIAS)
				img = ImageTk.PhotoImage(img)
				panel.destroy()
				panel = Label(root, image=img)
				panel.image = img
				panel.pack(anchor=NW)
				lbl['text'] = foundPlates
				time.sleep(5)
	
			# OpenCV represents images in BGR order; however PIL
			# represents images in RGB order, so we need to swap
			# the channels, then convert to PIL and ImageTk format
			image = cv2.cvtColor(currentFrame, cv2.COLOR_BGR2RGB)
			image = Image.fromarray(image)
			image = ImageTk.PhotoImage(image)

			# time.sleep(.5)
			# if the panel is not None, we need to initialize it
			if livePanel is None:
				livePanel = tk.Label(image=image)
				livePanel.image = image
				livePanel.pack(side="top", padx=10, pady=10)
	
			# otherwise, simply update the panel
			else:
				livePanel.configure(image=image)
				livePanel.image = image

	except RuntimeError:
		print("[INFO] caught a RuntimeError")


def GUI():
	global stopEvent, thread
	
	# btn.pack(anchor=NW)

	#image capturing button
	captureBtn = Button(root, bg="grey" ,fg="black",width=19, height=0,font=("italic",10,"bold"),activebackground="turquoise", text='Capture', command=
		takeSnapshot)
	captureBtn.pack(side="bottom", fill="both", padx=1, pady=1)

	# start a thread that constantly pools the video sensor for the most recently read frame
	stopEvent = threading.Event()
	thread = threading.Thread(target=videoLoop, args=())
	thread.start()

	#on window Close
	root.wm_protocol("WM_DELETE_WINDOW", handleWindowClose)

	root.mainloop()

#Function definitions
def openfn():
	path = filedialog.askopenfilename(title='open')
	
	return path

def open_img():
	global panel;
	imagePath = openfn()
	img = Image.open(imagePath)
	img = img.resize((470, 350), Image.ANTIALIAS)
	img = ImageTk.PhotoImage(img)
	panel.destroy()
	panel = Label(root, image=img)
	panel.image = img
	panel.pack(anchor=NW)
	
	detectResult = Main.detectCar(imagePath)
	lbl['text'] = detectResult
	#print("Detected:")
	print(detectResult)

def findPlate(imagePath):
	global panel;
	img = Image.open(imagePath)
	img = img.resize((470, 350), Image.ANTIALIAS)
	img = ImageTk.PhotoImage(img)
	panel.destroy()
	panel = Label(root, image=img)
	panel.image = img
	panel.pack(anchor=NW)
	
	detectResult = Main.detectCar(imagePath)
	lbl['text'] = detectResult
	print("Detected:")
	print(detectResult)



frame2 = Frame(root, bg = "#eee",width=4)
frame2.pack(anchor=NW)

#entry of the program

def takeSnapshot():
		global currentFrame 
		# grab the current timestamp and use it to construct the
		# output path
		outputPath = 'plates'
		ts = datetime.datetime.now()
		filename = "{}.jpg".format(ts.strftime("%Y-%m-%d_%H-%M-%S"))
		p = os.path.sep.join((outputPath, filename))
		# save the file
		cv2.imwrite(p, currentFrame.copy())
		print("[INFO] saved {}".format(filename))

		#find plate info and authorisation
		findPlate(p)

if __name__ == "__main__":
	GUI()
