How to make ESP8266 sleep lightly between connecting to wifi. Adapted from the Arduino esp8266 example LowPowerDemo https://github.com/esp8266/Arduino/blob/master/libraries/esp8266/examples/LowPowerDemo/LowPowerDemo.ino

Go to sleep like this. Current draw drops to 0.8mA.

```
void CloseWifiAndSleep() {
  Serial.printf("Wifi status %d\n", WiFi.status());
  while (WiFi.status() != WL_DISCONNECTED) 
  {
        WiFi.mode(WIFI_OFF);
        Serial.printf("Wifi status %d\n", WiFi.status());
        Serial.println(F("Turning off wifi"));
        delay(500);
  }
  digitalWrite(LED, HIGH);  // turn off the LED   
  //these timers have to be stopped
  extern os_timer_t *timer_list;
  timer_list = nullptr;

  wifi_fpm_set_sleep_type(LIGHT_SLEEP_T);
  wifi_fpm_set_wakeup_cb(wakeupCallback); // set wakeup callback
  // the callback is optional, but without it the modem will wake in 10 seconds then delay(10 seconds)
  // with the callback the sleep time is only 10 seconds total, no extra delay() afterward
  // theres also issue if the callback doesnt do much
  wifi_fpm_open();
  wifi_fpm_do_sleep(10E6);  // Sleep range = 10000 ~ 268,435,454 uS (0xFFFFFFE, 2^28-1)
  delay(10e3 + 1); // delay needs to be 1 mS longer than sleep or it only goes into Modem Sleep
  Serial.println(F("Woke up!"));  // the interrupt callback hits before this is executed
}

```

Callback looks like this:

```

void wakeupCallback() {  
  printMillis();  // if i dont call this, CloseWifiAndSleep stays in delay call after this is called... WTF
  Serial.println(F("Woke from Light Sleep - this is the callback"));
}

void printMillis() {
  Serial.print(F("millis() = "));
  Serial.println(millis());
  Serial.flush();  // It could be that the callback needs to do a flush to serial for some reason.
}
```


After sleep can connect to wifi.

```
void ConnectWifi()
{
  WiFi.begin(AP_SSID, AP_PASS);
  while (WiFi.status() != WL_CONNECTED) 
      {
        Serial.printf("Wifi status %d\n", WiFi.status());
        Serial.printf("Getting wifi\n");
        delay(1000);
      }   
}
```
