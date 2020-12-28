from time import sleep
import requests
import serial

# Configuration
# USB port - Adruino USB connection to PC
usb_serial_port = "COM3"

# Website host address
host= "http://localhost/Water-Quality-Monitoring-System-Website/" # End url with a slash '/'

ser = serial.Serial(usb_serial_port,9600)
while True:
	getVal = ser.readline()
	val = str(getVal).replace("b'","").replace("\\r\\n'","")
	arr = val.split(",")
	print(arr)

	# send to web server (php)
	userdata = {"temperature": arr[0], "turbidity": arr[1], "ph": arr[2]}
	resp = requests.post(host + "insert_data.php", params=userdata)