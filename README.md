tiny_url_file_server
====================

A tiny-url file-server for nfc-rings.
URLs fill the 144 limit to make them unguessable.

Upload Example:

```bash
curl --http1.0 -F "secret=Bob" -F "file=@Alice.vcf" http://my.server.tld/h.php 2>/dev/null
```

```
1_LuTZIYFxeu9oYdHt1KsD2y5I6g7CdJNYeHXWFDuT8Ei6RZATK3xNCCvITDk6n74CP2zuF3nNIGUAGvtqy1eaEKTxoeDMmIobKXFp13dJJ8jpDNQcO5ntg
```

Download Example:

```bash
curl --http1.0 -F "1_LuTZIYFxeu9oYdHt1KsD2y5I6g7CdJNYeHXWFDuT8Ei6RZATK3xNCCvITDk6n74CP2zuF3nNIGUAGvtqy1eaEKTxoeDMmIobKXFp13dJJ8jpDNQcO5ntg" http://my.server.tld/h.php
```

```
BEGIN:VCARD
VERSION:4.0
N:Gump;Forrest;;;
FN:Forrest Gump
ORG:Bubba Gump Shrimp Co.
TITLE:Shrimp Man
PHOTO;MEDIATYPE=image/gif:http://www.example.com/dir_photos/my_photo.gif
TEL;TYPE=work,voice;VALUE=uri:tel:+1-111-555-1212
TEL;TYPE=home,voice;VALUE=uri:tel:+1-404-555-1212
ADR;TYPE=work;LABEL="100 Waters Edge\nBaytown, LA 30314\nUnited States of America"
  :;;100 Waters Edge;Baytown;LA;30314;United States of America
ADR;TYPE=home;LABEL="42 Plantation St.\nBaytown, LA 30314\nUnited States of America"
 :;;42 Plantation St.;Baytown;LA;30314;United States of America
EMAIL:forrestgump@example.com
REV:20080424T195243Z
END:VCARD
```

