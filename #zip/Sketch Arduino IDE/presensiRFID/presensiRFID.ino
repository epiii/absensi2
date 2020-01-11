/*
========================================= HARAP BACA !!! =====================================================================

Daftar yang akan diganti pada sketch dibawah dan pastikan telah mengikuti panduan dengan benar :

1. Address I2C : lihat pada line program "LiquidCrystal_I2C lcd(0x27, 16, 2);"
0x27 adalah Address I2C yang DT Production gunakan. dan setiap modul I2C Address-nya ada yg tidak sama.
Jika gambar pada LCD tidak tampil, putarlah trimpot biru dengan obeng + untuk mengatur kontras. Jika
tidak tampil cobalah untuk mengganti Address I2C dengan 0x3F.

2. Ganti SSID (Nama WiFi Access Point) & Password SSID. 

3. Ganti URL (IP Address) sesuai dengan IP dari laptop/pc server (PC yang menyimpan file web dan akan dijalankan Xamppp)

4. Matikan windows Firewall pada laptop/pc Server dan pastikan apache & mysql pada software xampp dalam keadaan start
untuk menjalankan project ini.

5. Jika respon saat melakukan presensi /  menambahkan pegawai ERROR -1 :
Pastikan anda telah menonaktifkan firewall pada server dan pastikan server terhubung ke jaringan yang sama dengan ESP32.

6. Jika respon saat melakukan presensi / menambahkan pegawai ERROR -11 :
Pastikan anda telah menonaktifkan firewall pada server dan pastikan server terhubung ke jaringan yang sama dengan ESP32
selanjutnya lakukan restart apache dan mysql (di software Xampp) atau reset esp32.

7. Jika ada modul / alat yang tidak bekerja, periksa kabel jumper yang digunakan apakah dalam keadaan baik tidak putus.

==============================================================================================================================
*/

#include <SPI.h>
#include <MFRC522.h>
#include <WiFi.h>
#include <HTTPClient.h>
#include <LiquidCrystal_I2C.h>
#include <Wire.h>

#define SS_PIN 21
#define RST_PIN 22

MFRC522 mfrc522(SS_PIN, RST_PIN);
LiquidCrystal_I2C lcd(0x27, 16, 2); //LiquidCrystal_I2C lcd(Alamat I2C, TIPELCD, YANGDIPAKAI);

const char* ssid = "DTproduction"; //Nama WiFi
const char* password = "3dprinter"; //Password WiFi

unsigned long previousMillis = 0;
const long interval = 3000;
const int btn_absen = 2;
const int btn_config = 4;
int btnStat_absen = 0;
int btnStat_config = 0;
int mode; //0 = mode read absen 1=config mode
String content = "";
String admin_auth = "";
int printLCD = 0;
boolean lcd_home = true;
void setup() {
  Serial.begin(115200);
  pinMode(btn_absen, INPUT);
  pinMode(btn_config, INPUT);
  SPI.begin();
  mfrc522.PCD_Init();
  Wire.begin(5, 15); //PIN (SDA, SCL)
  lcd.begin();
  lcd.setCursor(1, 0);
  lcd.print("DT PRODUCTION");
  delay(1500);
  connection();
}

void loop() {
  if (lcd_home) {
    unsigned long currentMillis = millis();

    if (currentMillis - previousMillis >= interval) {
      previousMillis = currentMillis;

      if (printLCD == 0) {
        lcd.clear();
        lcd.setCursor(1, 0);
        lcd.print("SELAMAT DATANG");
        lcd.setCursor(1, 1);
        lcd.print("*SCAN TAG UID*");
        printLCD = 1;
      } else {
        lcd.clear();
        lcd.setCursor(2, 0);
        lcd.print("IoT PRESENSI");
        lcd.setCursor(5, 1);
        lcd.print("ESP-32");
        printLCD = 0;
      }
    }
  }
  btnStat_absen = digitalRead(btn_absen);
  btnStat_config = digitalRead(btn_config);

  if (WiFi.status() == WL_CONNECTED) {
    if ( ! mfrc522.PICC_IsNewCardPresent())
    {
      if (btnStat_absen == HIGH && btnStat_config == LOW ) {
        lcd_home=true;
        mode = 0;
      }
      else if (btnStat_config == HIGH && btnStat_absen == LOW) {
        mode = 1;
        adminlcd();
      }

      return;
    }
    if ( ! mfrc522.PICC_ReadCardSerial())
    {
      if (btnStat_absen == HIGH && btnStat_config == LOW ) {
        lcd_home=true;
        mode = 0;
      }
      else if (btnStat_config == HIGH && btnStat_absen == LOW) {
        mode = 1;
        adminlcd();
      }

      return;
    }

    content = "";
    Serial.println();
    Serial.print(" UID tag :");
    byte letter;
    for (byte i = 0; i < mfrc522.uid.size; i++)
    {
      Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? "0" : "");
      Serial.print(mfrc522.uid.uidByte[i], HEX);
      content.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? "0" : ""));
      content.concat(String(mfrc522.uid.uidByte[i], HEX));
    }
    content.toUpperCase();
    lcd_home = false;
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("ID: ");
    lcd.print(content);
    if (mode == 0) {
      Serial.println();
      presensi();
    } else if (mode == 1) {
      Serial.println();
      administrator();
    }
    else if (mode == 2) {
      Serial.println();
      administrator();
    }
  }else{
    lcd.clear();
    lcd_home = false;
    lcd.setCursor(0,0);
    lcd.print("KONEKSI ERROR :(");
    connection();
  }
}

void administrator() {
  lcd.setCursor(0, 1);
  lcd.print("LOGIN...");
  int httpResponseCode;
  HTTPClient http;
  http.begin("http://192.168.1.7/absen/konfig/add_id.php");
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  delay(100);
  if (mode != 2) {
    httpResponseCode = http.POST("status=cek_admin&id="+content);
    if (httpResponseCode > 0) {
      String response = http.getString();
      admin_auth = response;
      if (admin_auth != "1") {
        mode = 2;
        lcd.clear();
        lcd.setCursor(1,0);
        lcd.print("AKSES DITERIMA");
        lcd.setCursor(0,1);
        lcd.print("<=SCAN TAG BARU");
        Serial.println("Scan TAG yang akan ditambahkan");
      } else {
        Serial.println("Gagal Melanjutkan");
        mode = 0;
        lcd.clear();
        lcd.setCursor(1,0);
        lcd.print("AKSES DITOLAK   ");
        delay(2500);
        lcd_home=true;
      }
    } else {
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("PROSES GAGAL!!");
      lcd.setCursor(0, 1);
      lcd.print("ERORR : ");
      lcd.print(httpResponseCode);
      mode = 0;
      delay(2500);
      lcd_home=true;
    }
    content = "";
  }
  else {
    lcd.setCursor(0, 1);
    lcd.print("Mohon Menunggu..");
    delay(100);
    httpResponseCode = http.POST("status="+admin_auth+"&id="+content);
    if (httpResponseCode > 0) {
      String response = http.getString();
      lcd.setCursor(0, 1);
      lcd.print(response);
      lcd.print("    ");
      Serial.println(response);      
    } else {
      Serial.print("Error on sending POST: ");
      Serial.println(httpResponseCode);
    }
    mode = 0;
    content = "";
    admin_auth = "";
    lcd_home=true;
    delay(3000);
  }
  http.end(); 
}

void presensi() {
  lcd.setCursor(0, 1);
  lcd.print("Mohon Menunggu..");
  int httpResponseCode;
  String response = "";
  HTTPClient http;
  http.begin("http://192.168.1.7/absen/konfig/absen.php");
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  httpResponseCode = http.POST("id="+content);
  delay(100);
  if (httpResponseCode > 0) {
    response = http.getString();
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("STATUS KEHADIRAN");
    lcd.setCursor(0, 1);
    lcd.print(response);
  } else {
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("PRESENSI GAGAL!!");
    lcd.setCursor(0, 1);
    lcd.print("ERORR : ");
    lcd.print(httpResponseCode);
  }
  delay(3000);
  response = "";
  content = "";
  lcd_home = true;
  mode = 0;
  http.end(); 
}

void adminlcd() {
  lcd_home = false;
  lcd.clear();
  lcd.setCursor(2, 0);
  lcd.print("*ADMIN MODE*");
  lcd.setCursor(0, 1);
  lcd.print("<=SCAN ADMIN UID");
}

void connection(){
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(200);
    Serial.println("Connecting..");
  }
  lcd.clear();
  lcd.setCursor(1, 0);
  lcd.print("KONEKSI SUKSES");
  lcd.setCursor(0, 1);
  lcd.print("IP:");
  lcd.print(WiFi.localIP());
  mode = 0;
  lcd_home = true;
  delay(3000);
}
