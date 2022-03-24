# Real-Time-Water-Quality-Monitoring-System

This repository will tell you about my project during internship. My project is real-time water quality monitoring system in lobster pond. For checking the water quality, I am using pH, TDS, and temperature sensor. 

The packaging of the device:

![image](https://user-images.githubusercontent.com/50353456/159843443-b5da8b71-37fb-43d3-85a2-814b588ed538.png) 

The close-up look (show the value of each sensor):

![image](https://user-images.githubusercontent.com/50353456/159843916-fc223c32-0703-496d-ad5e-bb5d1ad5884d.png)

The device when it is installed in the lobster pond:

![image](https://user-images.githubusercontent.com/50353456/159843834-ca4f23d2-2eee-400f-95a8-e342eaea96a1.png)

**Step How to Use Water Quality Monitoring System:**
1. Upload file getSensorData.ino to Arduino board using arduino IDE. This file is used to get sensor data. 
2. After that, upload file sendSensorData.ino to ESP8266 board using arduino IDE. This file is used to send sensor data to database.
3. Open the website: http://rsbmonitoring.epizy.com/. You must register your account first before using the website. 
![image](https://user-images.githubusercontent.com/50353456/159845243-59f92f92-0970-4969-a9bd-6067e5d6eaee.png)
4. Click login and fill your username and password.
![image](https://user-images.githubusercontent.com/50353456/159845467-17327acc-f865-43cb-8523-3724eeb5262f.png)
5. You will go to the main page, and finally you can monitoring water quality in your lobster pond from the graph.
![image](https://user-images.githubusercontent.com/50353456/159845902-b8cc1a05-9940-49d4-a8ed-beb99c2d112e.png)
![image](https://user-images.githubusercontent.com/50353456/159846052-f960eb0c-de12-409a-8746-7759e6b19ed5.png)
![image](https://user-images.githubusercontent.com/50353456/159846129-62298dd4-4b68-4c70-ae41-d7711ab62145.png)
![image](https://user-images.githubusercontent.com/50353456/159846190-20c2fcab-793f-447a-a046-bd652bcdd8d1.png)
6. You can see the value of the sensor by direct your cursor to the dots on the graph.
![image](https://user-images.githubusercontent.com/50353456/159846473-02beb368-ca64-4c48-8032-83a895b6da69.png)

