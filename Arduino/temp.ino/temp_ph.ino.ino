#include <OneWire.h>

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
}

void loop() {  
  float temp;
  
  if (get_temp(&temp, true) != READ_OK) {
    Serial.println(F("Erreur de lecture du capteur"));
    return;
  }

  Serial.print(F("Temperature : "));
  Serial.print(temp, 2);
  Serial.write('C');
  Serial.println();
  delay(2000); 
}

byte get_temp(float *temp, byte reset_search) {
  byte data[9], addr[8];
  // data[] : Données lues depuis le scratchpad
  // addr[] : Adresse du module 1-Wire détecté
  
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
