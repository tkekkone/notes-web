# Things come across with cups

Running cups on raspberrypi 4 raspbian. Printing with samsung ml 2165w
Cups sends correctly to printer but printer doesnt print:

```
192.168.10.229 - - [23/Mar/2021:11:00:12 +0000] "POST /printers/samsung_ml-2160_series HTTP/1.1" 200 620 Validate-Job successful-ok
192.168.10.229 - - [23/Mar/2021:11:00:12 +0000] "POST /printers/samsung_ml-2160_series HTTP/1.1" 200 585 Create-Job successful-ok
192.168.10.229 - - [23/Mar/2021:11:00:12 +0000] "POST /printers/samsung_ml-2160_series HTTP/1.1" 200 486006 Send-Document successful-ok
```

Edit in /etc/modprobe.d/usblp.conf

```
# The "usblp" module causes a bug with the printer
blacklist usblp
```

https://bbs.archlinux.org/viewtopic.php?id=175331
