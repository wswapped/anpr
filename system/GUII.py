from tkinter import *
from PIL import ImageTk, Image
from tkinter import filedialog
import sys
import os
import cv2
import subprocess
import Main


#Tkinker instance
root = Tk()
root.geometry('800x520')
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

def GUI():
    
    

    
    #label = Label(root, text = 'DESIGNING AND IMPLEMENTATION OF AN ASSISTANT GATEMAN', fg = 'dark green', bg = 'dark gray', font = ("italic",15,"bold"), height= 4)
    #label.pack(side = TOP, fill='both')

    

    btn = Button(root, bg="grey" ,fg="black",width=19, height=0,font=("italic",10,"bold"),activebackground="turquoise", text='Load-image', command=open_img)
    btn.pack( anchor=NW)



# btn = Button(root,bg="gray" ,width=15, height=0,font=("italic",10,"bold"), fg="black" ,activebackground="turquoise", text='Preprocess', command=callback1)
#btn.pack(anchor=NW)

#btn = Button(root,bg="gray" ,width=20, height=0,font=("italic",10,"bold"), fg="black" ,activebackground="turquoise", text='Exi', command=root.quit)
#btn.pack(anchor=NW)



    

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

frame2 = Frame(root, bg = "red",width=4)
frame2.pack(anchor=NW)

label = Label(frame2, text = ' Manual Overload', fg = 'white',bg ='red', font = ( 'bold',10,'italic'))
label.pack(side = TOP)


btn = Button(frame2,bg="black" ,width=4, height=0,font=("italic",10,"bold"),fg="light green",activebackground="turquoise", text='open ', command=open_img)
btn.pack(pady = 20, padx = 20,side='left')

btn = Button(frame2,bg="black" ,width=4, height=0,font=("italic",10,"bold"),fg="red",activebackground="turquoise", text='Close', command=open_img)
btn.pack( pady = 20, padx = 20,side="right")
#def callback1():
    #cmd = 'python main.py'

    #it will execute script which runs only `function1`
    # output = subprocess.check_output(cmd, shell=True)

    # lbl['text'] = output.strip()

#entry of the program
if __name__ == "__main__":
    GUI()
