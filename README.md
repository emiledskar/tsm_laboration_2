Laboration 2 i kursen Teknik för Sociala Medier.
--------

I denna tutorial kommer vi att gå igenom hur man från grunden bygger upp en enkel applikation för att söka och hämta tweet's från Twitter. För att utföra detta kommer vi i denna tutorial att bygga applikationen i PHP och använda oss utav biblioteket **TwitterOAuth** för att komminucera med Twitter's API

Denna tutorial förutsätter att du som användare har någorlunda kunskaper kring PHP och HTML samt erfarenheter av att använda någon form textbaserat gränssnitt (som t.ex. terminalen i OSX).

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
Composer version 1.0-dev (825*******************************f6f) 2015-01-20 16:39:06
```

### Skapa composer.json
För att tala om för composer vilka dependencies som vår applikation har så skapar vi en composer.json fil. I denna fil anges först egenskaper för vår applikation/paket och som minst måste vi ange ett namn på applikationen/paketet och en kort beskrivning. De dependencies som vi vill använda oss utav lägger vi under ``"require"``

```JSON
{
    "name": "tsm/laboration-2",    
    "description": "En applikation skapad i sammband med kursen Teknik för Sociala Medier.",
    "keywords": ["education"],
    "homepage": "https://github.com/emiledskar/tsm_laboration_2",
    "license": "MIT",
    "authors": [
        {
            "name": "Emil Edskar",
            "email": "emiledskar@gmail.com",
            "homepage": "http://www.edskar.se",
            "role": "Developer"
        }
    ],
    "require": {
        "php": ">=5.4.0",
        "abraham/twitteroauth": "0.4.1",
        "bootflat/bootflat": "dev-master"
    }
}
```

###Installera Twitter oauth med composer

###Upprätthålla kommunikation med Twitter

###slutord, vad kan man göra sen 