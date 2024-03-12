#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#define analogMoisture A0
#define analogPh D4

const char* ssid = "....."; // Ganti dengan SSID WiFi Anda
const char* password = "....."; // Ganti dengan password WiFi Anda
const char* serverUrl = "http://localhost/landscape/Monitoring/receiveDataFromESP"; // Ganti dengan URL endpoint Anda

// DEFINE PENGUKURAN TERENDAH DAN TERTINGGI
const int dry = 584;
const int wet = 211;

float slope = -0.0139; // koefisien kemiringan (slope) dari garis linear yang menghubungkan nilai ADC dengan nilai pH.
float offset = 7.7851; // pergeseran (offset) dari garis linear tersebut
float ph = 0.0;

WiFiClient client;

void setup() {
  Serial.begin(9600);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  
  Serial.println("Connected to WiFi");
}

void loop() {
  // BACA DATA ANALOG
  int kelembapan = analogRead(analogMoisture);
  int asam = analogRead(analogPh);

  // SENSOR MOISTURE
  int lembab = ( 100 - ( (kelembapan/1023.00) * 100 ) );
  lembab = constrain(lembab, 0, 100);

  Serial.print("Lembab : ");
  Serial.println(lembab);

  ph = (slope * asam) + offset;
  Serial.print("Ph : ");
  Serial.println(ph);

  // Buat payload untuk dikirim ke server
  String payload = "ph=" + String(ph) + "&lembab=" + String(lembab);

  // Mulai koneksi HTTP
  HTTPClient http;
  http.begin(client, serverUrl);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  // Kirim data ke server dengan metode HTTP POST
  int httpResponseCode = http.POST(payload);

  // Cek status respons dari server
  if (httpResponseCode > 0) {
    Serial.print("HTTP Response code: ");
    Serial.println(httpResponseCode);
  } else {
    Serial.print("Error code: ");
    Serial.println(httpResponseCode);
  }

  // Akhiri koneksi HTTP
  http.end();

  delay(2000); // Tunggu selama 5 detik sebelum mengirim data lagi
}
