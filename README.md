# Web-API | HS-Bremen @ SoSe 2016 

## Assetpool

- Die Assetpool-API dient dazu, 'Assets' bzw. Referenzen aus diese in eine Datenbank einzuordnen und zu Taggen. Wobei hier nur Beispieldaten in der Datenbank abgelegt sind.

## Team

- Niklas Hinte 382635
- Mehmet Barutcu 345246

## Projekt aufsetzen

Grundlegende Struktur:
- Die 'Grundsoftware' wurde vom geforkten Projekt größtenteils übernommen.

Composer Installieren:
- cd var/www/sources
- composer install

Datenbank initialisieren:
- cd var/www/sources
- mysql -u root -p web_api < backupfile.sql
(pw: 123)

SSH:
- Host: localhost
- Port: 2222
- User: vagrant
- Private-Key: ./puphpet/files/dot/ssh/id_rsa

URLs:
- Index (frontend): web-api.vm
- Swagger UI: web-api.vm/docs/swagger
- PHPUnit: web-api.vm/unittest
