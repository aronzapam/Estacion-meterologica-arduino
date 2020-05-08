#include <SPI.h>
#include <Ethernet.h>
#include <dht.h>
#include <Wire.h>

const int sensorPin = 9;// digital lluvia

int adcPin = 0;
int adcValue = 0; // sensor de dioxido analogico
float v;
float real_v;
float porc;

int photocellPin = 3;     // pin sensor de luz digita
int photocellReading;     // lectura analoga

// declarar variable uv
int sensorValue;

//Declara constantes y pin de entrada
#define DHT11PIN 7  // El sensor de temperatura y humedad


/* datos arduino http */
byte mac[] = { 0x00, 0x25, 0xAB, 0x42, 0x87, 0x4D };
IPAddress ip(192, 168, 1, 100);
EthernetServer server(80);

/* datos hacia xampp */
byte grafico[] = { 192, 168, 1, 10 };
EthernetClient graficocli;

dht DHT11;  //El objeto sensor



void setup() {
  // Abrir comunicacion serial y esperar que el puerto responda
  Serial.begin(9600);
  while (!Serial) {
    ;
  }

  pinMode(9, INPUT);
  //Inicializar la conexion Ethernet y el servidor
  Ethernet.begin(mac, ip);
  server.begin();
  Serial.print("server is at ");
  Serial.println(Ethernet.localIP());
  delay (50000);
} //Termina setup


void loop() {
  //Escucha clientes de entrada
  ///EthernetClient client = server.available();
  adcValue = analogRead(adcPin);
  Serial.print("Out put = ");
  Serial.println (adcValue);


  Serial.println("new client");
  int chk = DHT11.read11(DHT11PIN);

  Serial.print("Read sensor: ");

  switch (chk) {
    case 0:
      Serial.println("OK");
      break;

    case -1:
      Serial.println("Checksum error");
      break;

    case -2:
      Serial.println("Time out error");
      break;

    default:
      Serial.println("Unknown error");
      break;
  }


  Serial.print("Temperatura (Celsius): ");
  Serial.println((float)DHT11.temperature, 1);

  Serial.print("Temperatura (Farenheit): ");
  Serial.println(Fahrenheit(DHT11.temperature), 1);

  Serial.print("Temperatura (Kelvin): ");
  Serial.println(Kelvin(DHT11.temperature), 1);

  Serial.print("Humedad (%): ");
  Serial.println((float)DHT11.humidity, (0));

  Serial.print("Mon&#243;xido de Carbono (CO)= ");
  Serial.println(adcValue);

  delay(60000);


  photocellReading = analogRead(photocellPin);
  int estado_luz = 0;

  if (photocellReading < 10) {
    Serial.println(" - Indice luminosidad = LUZ MUY BRILLANTE");
    estado_luz = 4;
  } else if (photocellReading < 200) {
    Serial.println(" - Indice luminosidad = LUZ BRILLANTE  ");
    estado_luz = 3;
  } else if (photocellReading < 500) {
    Serial.println(" - Indice luminosidad =LUZ TENUE");
    estado_luz = 2;
  } else if (photocellReading < 800) {
    Serial.println(" - Indice luminosidad = OSCURO");
    estado_luz = 1;
  } else {
    Serial.println(" - Indice luminosidad = OSCURIDAD TOTAL");
    estado_luz = 0;
  }

  delay(60000);


  int value = 0;
  int estado_lluvia = 0;

  value = digitalRead(sensorPin);  //lectura digital de pin

  if (value == HIGH) {
    Serial.println("No se detecta lluvia");
    estado_lluvia = 0;
  }

  if (value == LOW) {
    Serial.println("Detectada lluvia");
    estado_lluvia = 1;
  }
  // sensor uv
  
  sensorValue = analogRead(A2);
  Serial.print(sensorValue);
  int incide_uv = 0;
  if (sensorValue < 10) {
    Serial.println(" UV nivel 0");
    incide_uv = 0;
  } else if (sensorValue < 46) {
    Serial.println("UV nivel 1");
    incide_uv = 1;
  } else if (sensorValue < 65) {
    Serial.println("UV nivel 2");
    incide_uv = 2;
  } else if (sensorValue < 83) {
    Serial.println("UV nivel 3");
    incide_uv = 3;
  } else if (sensorValue < 103) {
    Serial.println("UV nivel 4");
    incide_uv = 4;
  } else if (sensorValue < 124) {
    Serial.println("UV nivel 5");
    incide_uv = 5;
  } else if (sensorValue < 142) {
    Serial.println("UV nivel 6");
    incide_uv = 6;
  } else if (sensorValue < 162) {
    Serial.println("UV nivel 7");
    incide_uv = 7;
  } else if (sensorValue < 180) {
    Serial.println("UV nivel 8");
    incide_uv = 8;
  } else if (sensorValue < 200) {
    Serial.println("UV nivel 9");
    incide_uv = 9;
  } else if (sensorValue < 221) {
    Serial.println("UV nivel 10");
    incide_uv = 10;
  } else
  {
    Serial.println("UV nivel 11 extremo ");
    incide_uv = 11;
  }


  delay(60000);


  if (graficocli.connect(grafico, 80) > 0) {
    graficocli.print("GET /arduino/controller/index.php?temp=");
    graficocli.print((float)DHT11.temperature);
    graficocli.print("&hum=");
    graficocli.print((float)DHT11.humidity);
    graficocli.print("&mc=");
    graficocli.print(adcValue);
    graficocli.print("&lluvia=");
    graficocli.print(estado_lluvia);
    graficocli.print("&luz=");
    graficocli.print(estado_luz);
    graficocli.print("&uv=");
    graficocli.print(incide_uv);
    graficocli.println(" HTTP/1.0");
    graficocli.println("User-Agent: Arduino 1.0");
    graficocli.println();
    Serial.println("Conectado");
  } else {
    Serial.println("Fallo en la conexion");
  }

  if (!graficocli.connected()) {
    Serial.println("Cliente desconetado - http server(grafico)");
  }

  graficocli.stop();
  graficocli.flush();
  delay(50000); // Espero un minuto antes de tomar otra muestra

} //Termina loop

//Convertir de grados Centrigrados a Farenheit
double Fahrenheit(double celsius)
{
  return 1.8 * celsius + 32;
}

//Centigrados a Kelvin
double Kelvin(double celsius)
{
  return celsius + 273.15;
}
