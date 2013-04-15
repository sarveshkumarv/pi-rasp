# This script reads the GPIO pin function and sends it to the log server.
# Change the GPIO function from the webiopi client browser. This script tests that feature


#Imports
import webiopi
import os

# Enable debug output
webiopi.setDebug()


# Retrieve GPIO lib
GPIO = webiopi.GPIO
USED_PIN = 9


def test(stream):
	webiopi.debug('Hello script - Test')
	value = GPIO.getFunction(USED_PIN)
	while 1:
		#Default is OUT. Change it to IN in the browser
		# TODO : doesnt seem to work. check!
		if value==GPIO.OUT:
			print ("GPIO is high")
			stream.write('GPIO %d is OUT\n'% USED_PIN)
			stream.write('exit')
			break
		else: 
			stream.write('GPIO %d is IN\n'% USED_PIN)

def main():

	stream = os.popen("/home/pi/Desktop/HelloWorld/client/client 192.168.1.7",'w')
	test(stream)
	stream.close()

main()

			
