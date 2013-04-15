# This script sends a msg to the log server listening on 192.168.1.7

import os


stream = os.popen("/home/pi/Desktop/HelloWorld/client/client 192.168.1.7",'w')
stream.write('GPIO is High\n')
stream.write('exit')
stream.close
