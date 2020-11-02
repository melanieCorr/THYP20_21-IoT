float calibration_value = 21.34;
int phVal = 0; 
unsigned long int avgVal; 
int arr[10];
int tmp;
int phPin = 1;
float temp;
int tempPin = 0;

void setup() {
  Serial.begin(9600);
}

void loop() {  
  // Temperature
  temp = analogRead(tempPin);
  temp = temp * 0.48828125;
  
  // pH
  // Lire 10 échantillons de valeurs analogiques 
  // Les stocker dans un tableau
  for(int i = 0; i < 10; i++) { 
    arr[i] = analogRead(phPin);
 	delay(30);
  }
  
  // Trier les valeurs analogiques par ordre croissant
  for(int i = 0; i < 9; i++) {
 	for(int j = i + 1; j < 10; j++) {
 		if(arr[i] > arr[j]) {
 			tmp = arr[i];
 			arr[i] = arr[j];
			arr[j] = tmp;
 		}
 	}
  }

  avgVal = 0;
  for(int i = 2; i < 8; i++) avgVal += arr[i];
  
  // Conversion en valeur pH
  float volt = (float)avgVal * 5.0 / 1024 / 6;
  float ph = -5.70 * volt + calibration_value;
  
  // Print 
  Serial.print("TEMPERATURE = ");
  Serial.print(temp); // display temperature value
  Serial.print(" Celsius");
  Serial.println();
  //Serial.print("pH = "); 
  //Serial.print(ph); 
  delay(1000);
}