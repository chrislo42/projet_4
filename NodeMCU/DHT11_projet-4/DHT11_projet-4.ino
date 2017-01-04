/* 
 * *************************
 * Capteur : DHT11
 * 
 * Les broches sont numérotées de la gauche vers la droite lorsque l'on regarde le capteur de face
 * 
 * Broche n°1 connectée au +3.3V
 * Broche n°2 (data) connectée à la broche 'D3' du NodeMcu (Pin 2 pour l'arduino) avec une résistance de 10 K reliée au +3.3v
 * Broche n°3 non connectée
 * Broche n°4 connectée à la masse (GND)
 *  
 *  
 *  lecture de la consigne dans un fichier temp.cfg 
 *  avec la syntaxe suivante "Consigne : 23 °C"
 *  Modifier SSID_name, SSID_password et url de communication
 */

// Déclaration des librairies
#include <DHT.h>
#include <DHT_U.h>
#include <ESP8266WiFi.h>

#include <Arduino.h>
#include <ESP8266HTTPClient.h>

// Préparation du capteur DHT
#define DHTPIN 0                      // broche sur laquelle est raccordée la data du capteur (la broche 'D4' du NodeMcu correspond à la broche 2 de l'arduino)
#define DHTTYPE DHT11                 // précise la référence du capteur DHT (DHT11 ou DHT21 ou DHT22)
DHT dht(DHTPIN, DHTTYPE);             // Initialisation du capteur DHT

// Préparation communication
char ssid[] = "SSID_name";    //  your network SSID (name) 
char pass[] = "SSID_password";   // your network password
int status = WL_IDLE_STATUS;
WiFiClient  client;

// définition des broches pour les leds rouge et vert
int marche = 16;
int arret = 5;

// définition des variables utilisées
int consigne = 22;


// fonction de démarrage
void setup() {
  // Démarrage du bus série
  Serial.begin(115200);               // vitesse
  for(uint8_t t = 4; t > 0; t--) {
    Serial.printf("[SETUP] WAIT %d...\n", t);
    Serial.flush();
    delay(1000);
  }
  Serial.println();
  Serial.println("Bonjour");          // écriture d'un petit message...
  Serial.println("DHT11 et afficheur");
  
  // Démarrage du capteur DHT11
  dht.begin();

  //Démarrage service
  WiFi.begin(ssid, pass);

  // configuration des broches
  pinMode(arret, OUTPUT);
  pinMode(marche, OUTPUT);

}

// boucle infinie
void loop() {
  HTTPClient http;

  // lecture de la consigne sur serveur
  Serial.print("[HTTP] begin...\n");
  http.begin("http://164.132.194.239/Projets/projet_4/temp.cfg"); //HTTP mettre la bonne adresse IP

  Serial.print("[HTTP] GET temp...\n");
  int httpCode = http.GET();        		// start connection, send HTTP header and  read status

  if(httpCode > 0) {						// httpCode will be negative on error
    // HTTP header has been send and Server response header has been handled
    Serial.printf("[HTTP] GET temp... code: %d\n", httpCode);

    // file found at server
    if(httpCode == HTTP_CODE_OK) {
      String payload = http.getString();
      int debut = payload.lastIndexOf(":");
      String lecture = payload.substring(debut+2,debut+4);
      consigne = lecture.toInt();
      Serial.print("Consigne du fichier : ");
      Serial.println(consigne);
    }
  } else {
    Serial.printf("[HTTP] GET temp... failed, error: %s\n", http.errorToString(httpCode).c_str());
  }
  http.end();

  // acquisition des mesures
  float t_read = dht.readTemperature();
  float h_read = dht.readHumidity();
  int t = int(t_read);
  int h = int(h_read);
  if(t > 100) t = 1000;     // pour éviter les erreurs de lecture
  // si la valeur est erronée, "t" es mis à une valeur arbitraire afin de pouvoir la tester
  // test si des valeurs ont été récupérées ou si t etait erronée
  if (isnan(t) || t == 1000) {         // si non
    Serial.println("Failed to read from DHT sensor!");    // affiche un message d'erreur
    return;                           // quitte pour retenter une lecture
  }

  // gestion des leds de simulation de commande
  if(t >= consigne){
    digitalWrite(arret, HIGH);
    digitalWrite(marche, LOW);
  }
  else {
    digitalWrite(arret, LOW);
    digitalWrite(marche, HIGH);
  }

  // affichage des valeurs dans le bus série
  Serial.print("Temperature : ");
  Serial.print(t);
  Serial.print(" *C\t");
  Serial.print("Humidity : ");
  Serial.print(h);
  Serial.println(" %");
  Serial.print("consigne :");
  Serial.print(consigne);
  Serial.println(" *C");

  // Envoi des données du capteur
  Serial.print("[HTTP] begin...\n");
  String donnee = String(t)+";"+String(h);
  String adresse = "http://164.132.194.239/Projets/projet_4/save_data.php?data=" +donnee;
  http.begin(adresse); //HTTP

  Serial.print("[HTTP] GET php...\n");
  httpCode = http.GET();				// start connection, send HTTP header and read status

  if(httpCode > 0) {					// httpCode will be negative on error
    // HTTP header has been send and Server response header has been handled
    Serial.printf("[HTTP] GET php... code: %d\n", httpCode);
  }else {
    Serial.printf("[HTTP] GET php... failed, error: %s\n", http.errorToString(httpCode).c_str());
  }
  http.end();


  delay(600000); 
 
}
