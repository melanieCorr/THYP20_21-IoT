#include <OneWire.h>

#define TdsSensorPin 1
#define VOLTAGE 5.0      // Référence de voltage du capteur
#define SCOUNT  30

int analogBuffer[SCOUNT];    // stock la valeur lu par le capteur 
int analogBufferTemp[SCOUNT];
int analogBufferIndex = 0, copyIndex = 0;
float averageVoltage = 0, tdsValue = 0, temperature = 25;

const byte SENSOR_PIN = 7;
enum DS18B20_RCODES {
  READ_OK,  // Lecture ok
  NO_SENSOR_FOUND,  // Pas de capteur
  INVALID_ADDRESS,  // Adresse reçue invalide
  INVALID_SENSOR  // Capteur invalide (pas un DS18B20)
};

OneWire ds(SENSOR_PIN);

void setup() {
  Serial.begin(9600);
  pinMode(TdsSensorPin, INPUT);
}

void loop() {
  temperatureLoop(); 
  Serial.println();
  tdsLoop(); 
}

/******************** Temperature Sensor ********************************/

// Get temperature values
byte get_temp(float *temp, byte reset_search) {
  byte data[9]; // Données lues depuis le scratchpad
  byte addr[8]; // Adresse du module 1-Wire détecté
  
  if (reset_search) {
    ds.reset_search();
  }
 
  if (!ds.search(addr)) {
    // Pas de capteur
    return NO_SENSOR_FOUND;
  }
  
  if (OneWire::crc8(addr, 7) != addr[7]) {
    // Adresse invalide
    return INVALID_ADDRESS;
  }
 
  if (addr[0] != 0x28) {
    // Mauvais type de capteur
    return INVALID_SENSOR;
  }
 
  ds.reset();
  ds.select(addr);
  
  ds.write(0x44, 1);
  delay(2000);
  
  ds.reset();
  ds.select(addr);
  ds.write(0xBE);
 
  for (byte i = 0; i < 9; i++) {
    data[i] = ds.read();
  }
   
  *temp = (int16_t) ((data[1] << 8) | data[0]) * 0.0625; 
  
  return READ_OK;
}

void temperatureLoop() {
  float temp;
  
  if (get_temp(&temp, true) != READ_OK) {
    Serial.println(F("Erreur de lecture du capteur"));
    return;
  }

  Serial.print(F("Temperature : "));
  Serial.print(temp, 2);
  Serial.write('C');
  delay(6000); 
}

/******************** TDS Sensor ********************************/
int getMedianNum(int tdsArray[], int iFilterLen) {
  int tab[iFilterLen];
  for (byte i = 0; i < iFilterLen; i++) tab[i] = tdsArray[i];
  
  int i, j, tmp;
  for (j = 0; j < iFilterLen - 1; j++) {
    for (i = 0; i < iFilterLen - j - 1; i++) {
      if (tab[i] > tab[i + 1]) {
        tmp = tab[i];
        tab[i] = tab[i + 1];
        tab[i + 1] = tmp;
      }
    }
  }
  
  if ((iFilterLen & 1) > 0) tmp = tab[(iFilterLen - 1) / 2];
  else tmp = (tab[iFilterLen / 2] + tab[iFilterLen / 2 - 1]) / 2;
  
  return tmp;
}

void tdsLoop() {
  static unsigned long analogSampleTimepoint = millis();
  if(millis()-analogSampleTimepoint > 40U) {    //Chaque 40 milliseconds, lire la valeur du capteur
   analogSampleTimepoint = millis();
   analogBuffer[analogBufferIndex] = analogRead(TdsSensorPin);    // Lire la valeur du capteur et la stocker dans le buffer
   analogBufferIndex++;
   if(analogBufferIndex == SCOUNT) analogBufferIndex = 0;
  }   
  
  static unsigned long printTimepoint = millis();
  if(millis()-printTimepoint > 800U) {
    printTimepoint = millis();
    
    for(copyIndex=0;copyIndex<SCOUNT;copyIndex++) analogBufferTemp[copyIndex]= analogBuffer[copyIndex];
    
    averageVoltage = getMedianNum(analogBufferTemp,SCOUNT) * (float)VOLTAGE / 1024.0; // Lecture la valeur du capteur et convertion en voltage
    float compensationCoefficient = 1.0 + 0.02 *(temperature - 25.0);    // formule de compensation de la température: fFinalResult(25^C) = fFinalResult(current)/(1.0+0.02*(fTP-25.0));
    float compensationVolatge = averageVoltage / compensationCoefficient;  // Compensation de la température
    tdsValue = (133.42 * compensationVolatge * compensationVolatge * compensationVolatge - 255.86 * compensationVolatge * compensationVolatge + 857.39 * compensationVolatge) * 0.5; // Convertion du voltage en valeur TDS
  
    Serial.print("TDS Value:");
    Serial.print(tdsValue, 0);
    Serial.println("ppm");
  }
}
