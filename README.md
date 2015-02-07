Laboration 2 i kursen Teknik för Sociala Medier.
--------
Denna tutorial förutsätter att du som användare har någorlunda kunskaper kring PHP, HTML och CSS. Det krävs även att du har prövat att använda någon form terminal (typ terminalen i OSX).

I denna tutorial kommer vi att gå igenom hur man från grunden bygger upp en enkel applikation för att söka och hämta tweet's från Twitter. För att utföra detta kommer vi i denna tutorial att bygga applikationen i PHP och använda oss utav biblioteket **TwitterOAuth** för att komminucera med Twitter's API. För att skapa det visuella använder vi oss utav UI paketet **Bootflat**.


### Installera Composer (MAC OSX)
För att hämta hem composer.phar kör följande kommando i terminalen:
```
curl -sS https://getcomposer.org/installer | php
```

Kör följande kommando för att installera compsoser som ett globalt kommando:
```
mv composer.phar /usr/local/bin/composer
```

För att testa att allt fungerar som det ska skriv:
```
composer -V
```

Vilket bör resultera i en utskrift liknanden den nedan:
```
Composer version 1.0-dev (8***********************************f) 2015-01-20 16:39:06
```

### Skapa composer.json

För att tala om för composer vilka dependencies som vår applikation har så skapar vi en composer.json fil. I denna fil anges först egenskaper för vår applikation/paket och som minst måste vi ange ett namn på applikationen/paketet och en kort beskrivning. De dependencies som vi vill använda oss utav lägger vi under ``"require: {"``. I detta fall har jag lagt till ``"php": ">=5.4.0",``, ``"abraham/twitteroauth": "0.4.1",`` & ``"bootflat/bootflat": "2.0.4"``. Kom ihåg att separerar varje raderna med ett komma. När du laggt till dessa tre rader i `require` så sparar du filen. Nu är det dags att validera composer.json så att det inte är något fel i filen. I terminalfönstret skriver du då:
```
composer validate
```

Detta bör genererar utskriften 
```
./composer.json is valid
```

composer.json som finns med bland projektets filer kan användas som mall.

###Installera Twitter oauth med composer
För att installera **TwitterOAuth** och **Bootflat** så börjar vi med att köra kommandot:
```
composer install --no-dev
```
Kommandot kommer att skapa en vendor mapp i ditt projekt och spara ner respektive paket till den mappen.

För att sedan använda oss utav **TwitterOAuth** i projektet så lägger vi till följande rader:
```
require "vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;
```

###Upprätthålla kommunikation med Twitter


###slutord, vad kan man göra sen 

