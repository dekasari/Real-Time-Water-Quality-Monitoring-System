#include <ESP8266WiFi.h> 
#include<FirebaseESP8266.h>
#include <FirebaseESP8266HTTPClient.h> 
#include <FirebaseFS.h>
#include <FirebaseJson.h> 
#include <ArduinoJson.h> 
#include <SoftwareSerial.h> 
#include <StringSplitter.h>
#define FIREBASE_HOST "https://monitoring-4386b-defaultrtdb.firebaseio.com/"
#define FIREBASE_AUTH "gxMuwUNv5xoH1XXkMvGsVrl9X0BYZFxEsbZ2U7wQ" 
#define WIFI_SSID "RSB Group"
#define WIFI_PASSWORD "RSBoce123" 

static unsigned long timeup = millis(); 
FirebaseData firebaseData;
FirebaseJson json; 
int countertime = 0; 
int vr = A0;
int data = 0; // The variable resistor value will be stored in sdata. 
String myString;

void setup(){
  Serial.begin(9600);
  // connect to wifi.
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
  Serial.print("connecting");
  while (WiFi.status() != WL_CONNECTED){
    Serial.print("."); 
    delay(500);
    }
  Serial.println(); 
  Serial.print("connected: "); 
  Serial.println(WiFi.localIP());
  Firebase.begin(FIREBASE_HOST, FIREBASE_AUTH); 
  Firebase.reconnectWiFi(true);
}

void loop(){
  while (WiFi.status() != WL_CONNECTED){
    Serial.print("."); 
    delay(500);
  }
  if (Serial.available()) {
    String datas = Serial.readString();
    StringSplitter *splitter = new StringSplitter(datas, ';', 7); 
  if(millis()-timeup > 60000UL) //every 1 jam 3600000
  {
    countertime++; 
    timeup = millis();
  }
  if(countertime>=15){
    float ph = splitter->getItemAtIndex(0).toFloat(); 
  if (ph<0) ph = fabs(ph);
  json.add("name", "pH");
  json.add("value", ph); 
  Firebase.pushJSON(firebaseData, "sensor", json); 
  float tds = splitter->getItemAtIndex(1).toFloat(); 
  if (tds<0) tds = fabs(tds);
  json.add("name", "TDS");
  json.add("value", tds); 
  Firebase.pushJSON(firebaseData, "sensor", json); 
  float suhu = splitter->getItemAtIndex(2).toFloat();
  if (suhu<0) suhu = fabs(suhu); 
  json.add("name", "Temp");
  json.add("value", suhu); 
  Firebase.pushJSON(firebaseData, "sensor", json); 
  delay(50);
  countertime = 0;
  }
  }
}
