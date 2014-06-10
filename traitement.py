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
elif sys.argv[1] == "jaune":
	couleur = Color.YELLOW
elif sys.argv[1] == "vert":
	couleur = Color.GREEN

img = Image("test.jpg") 
color_distance = img.colorDistance(couleur).invert() 
blobs = color_distance.findBlobs() 
coord = blobs[-1].centroid() 

x = math.floor(coord[0])

sys.exit(x)

# points = [(x+10,y+10),(x+10,y-10),(x-10,y-10),(x-10,y+10)]
# img.dl().polygon(points, filled=True, color=Color.RED)
# img.show()
#time.sleep(10)