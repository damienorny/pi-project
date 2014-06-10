from SimpleCV import Color, Image 
import time
import math
import sys
if len(sys.argv) == 0:
	couleur = Color.BLUE
elif sys.argv[1] == "rouge":
	couleur = Color.RED
elif sys.argv[1] == "bleu":
	couleur = Color.BLUE
img = Image("test.jpg") 
color_distance = img.colorDistance(couleur).invert() 
blobs = color_distance.findBlobs() 
# blobs.draw(color=Color.PUCE, width=3)
# img.addDrawingLayer(color_distance.dl())
coord = blobs[-1].centroid() 
print(coord)
x = math.floor(coord[0])
y = math.floor(coord[1])
points = [(x+10,y+10),(x+10,y-10),(x-10,y-10),(x-10,y+10)]
img.dl().polygon(points, filled=True, color=Color.RED)
img.show()
time.sleep(10)