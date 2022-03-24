#include <Arduino.h> 
#include <OneWire.h>
#include <DallasTemperature.h> 
#define TdsSensorPin A1
#define VREF 5.0 // analog reference voltage(Volt) of the ADC 
#define SCOUNT 1 // sum of sample point
#define ONE_WIRE_BUS 2 // sensor diletakkan di pin 2
//Setup OLED 
#include <SPI.h> 
#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#define SCREEN_WIDTH 128 // OLED display width, in pixels 
#define SCREEN_HEIGHT 32 // OLED display height, in pixels
// Declaration for an SSD1306 display connected to I2C (SDA, SCL pins)
#define OLED_RESET 4 // Reset pin # (or -1 if sharing Arduino reset pin)

int analogBuffer[SCOUNT]; // store the analog value in the array, 
read from ADC
int analogBufferTemp[SCOUNT];
int analogBufferIndex = 0,copyIndex = 0;
float averageVoltage = 0,tdsValue = 0,temperature = 25;

// setup sensor
OneWire oneWire(ONE_WIRE_BUS);

// berikan nama variabel,masukkan ke pustaka Dallas 
DallasTemperature sensorSuhu(&oneWire);
float suhuSekarang;

//pH Sensor Declaration 
int pHSense = A0;
int samples = 1;
float adc_resolution = 1024.0;


Adafruit_SSD1306 display(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, OLED_RESET);
//Setup Serial dan Pin 
void setup(){
  Serial.begin(9600); 
  sensorSuhu.begin(); 
  pinMode(TdsSensorPin,INPUT); 
  pinMode(pHSense,INPUT);
  if(!display.begin(SSD1306_SWITCHCAPVCC, 0x3C)) { // Address 0x3C for 128x32
  //Serial.println(F("SSD1306 allocation failed")); 
  for(;;); // Don't proceed, loop forever
  }
}

//Menentukan nilai suhu 
float ambilSuhu(){
  sensorSuhu.requestTemperatures();
  float suhu = sensorSuhu.getTempCByIndex(0); 
  return suhu;
}

//Menentukan nilai ph 
float ph (float voltage) {
  //Serial.println(voltage);
  return 7 + ((2.5 - voltage) / 0.18);
}

//Mencari nilai median
int getMedianNum(int bArray[], int iFilterLen){
  int bTab[iFilterLen];
  for (byte i = 0; i<iFilterLen; i++) 
  bTab[i] = bArray[i];
  int i, j, bTemp;
  for (j = 0; j < iFilterLen - 1; j++){
    for (i = 0; i < iFilterLen - j - 1; i++){
      if (bTab[i] > bTab[i + 1]){
        bTemp = bTab[i]; 
        bTab[i] = bTab[i + 1]; 
        bTab[i + 1] = bTemp;
        }
      }
    }
  if ((iFilterLen & 1) > 0) 
    bTemp = bTab[(iFilterLen - 1) / 2];
  else
    bTemp = (bTab[iFilterLen / 2] + bTab[iFilterLen / 2 - 1]) / 2; 
  return bTemp;
}

void loop () {
  //Merata-rata Nilai Pembacaan pH 
  int measurings=0;
  for (int i = 0; i < samples; i++){
    measurings = analogRead(pHSense);
  }
  float voltage = 5 / adc_resolution * measurings;
  // Sensor TDS
  static unsigned long analogSampleTimepoint = millis(); 
  if(millis()-analogSampleTimepoint > 40U){ //every 40milliseconds,read the analog value from the ADC
  analogSampleTimepoint = millis(); 
  analogBuffer[analogBufferIndex] = analogRead(TdsSensorPin); //read the analog value and store into the buffer
  analogBufferIndex++; 
  if(analogBufferIndex == SCOUNT) 
    analogBufferIndex = 0;
  }
  static unsigned long printTimepoint = millis(); 
  if(millis()-printTimepoint > 800U){
    printTimepoint = millis(); 
    for(copyIndex=0;copyIndex<SCOUNT;copyIndex++) 
    analogBufferTemp[copyIndex]= analogBuffer[copyIndex]; 
    averageVoltage = getMedianNum(analogBufferTemp,SCOUNT) * (float)VREF / 1024.0; // read the analog value more stable by the median filtering algorithm, and convert to voltage value
    float compensationCoefficient=1.0+0.02*(temperature-25.0);
    //temperature compensation formula: fFinalResult(25^C) = fFinalResult(current)/(1.0+0.02*(fTP-25.0));
    float compensationVolatge=averageVoltage/compensationCoefficient;
    //temperature compensation 
    tdsValue=(133.42*compensationVolatge*compensationVolatge*compensationVolatge - 255.86*compensationVolatge*compensationVolatge + 857.39*compensationVolatge)*0.5; //convert voltage value to tds value
  }
  
  //Sensor suhu
  suhuSekarang = ambilSuhu(); 
  temperature = suhuSekarang;
  //Menampilkan Data di OLED 
  display.clearDisplay();
  display.setCursor(0,0); // Start at top-left corner 
  display.setTextSize(1); // Draw 2X-scale text 
  display.setTextColor(WHITE);
  display.println("==== RSB Monitor ====");
  display.setTextSize(1); // Normal 1:1 pixel scale 
  display.setTextColor(WHITE); // Draw white text 
  display.print("pH : ");
  display.println(ph(voltage));
  display.setTextSize(1); // Normal 1:1 pixel scale 
  display.setTextColor(WHITE);
  display.print("TDS : "); 
  display.println(tdsValue,0);
  display.setTextSize(1); // Normal 1:1 pixel scale 
  display.setTextColor(WHITE);
  display.print("Temp : "); 
  display.print(suhuSekarang);
  display.display(); 
  String stresp; 
  stresp = String(ph(voltage))+String(";")+String(tdsValue)+String(";")+String(suhuSekarang)+String(";");
  Serial.print(stresp); 
  delay(5000);
}
