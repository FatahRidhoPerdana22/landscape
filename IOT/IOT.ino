// DEFINE PIN
#define analogMoiture A0
#define analogPh A2
#define digitalPompa 7

// DEFINE PENGUKURAN TERENDAH DAN TERTINGGI
const int dry = 584;
const int wet = 211;

// DEFINE PERHITUNGAN Ph dari Analog
float slope = -0.0139; // koefisien kemiringan (slope) dari garis linear yang menghubungkan nilai ADC dengan nilai pH.
float offset = 7.7851; // pergeseran (offset) dari garis linear tersebut
float ph = 0.0;

// KALKULASI
const float minPh = 6.5; // Ambang pH minimum 
const int minMoisture = 50; // Ambang kelembapan minimum

void setup() {
  Serial.begin(9600);
  pinMode(digitalPompa, OUTPUT);
}

void loop() {
  // BACA DATA ANALOG
  int lembab = analogRead(analogMoiture);
  int asam = analogRead(analogPh);

  // SENSOR MOISTURE
  int kelembapanPersen = map(lembab, dry, wet, 0, 100);

  Serial.print("Kelembapan : ");
  Serial.println(lembab);

  Serial.print("Persen : ");
  Serial.println(kelembapanPersen);

  // SENSOR Ph
  ph = (slope * asam) + offset;

  Serial.print("Ph : ");
  Serial.println(ph);

  // LOGIC
  if (ph < minPh && kelembapanPersen < minMoisture) {
    digitalWrite(digitalPompa, HIGH);
    Serial.println("Mengaktifkan Pompa");
  } else {
    digitalWrite(digitalPompa, LOW); 
    Serial.println("Mematikan Pompa");
  }

  delay(1000);
}
