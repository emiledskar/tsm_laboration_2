Laboration 2 i kursen Teknik för Sociala Medier.
--------

I denna tutorial kommer vi att gå igenom hur man från grunden bygger upp en enkel applikation för att söka och hämta tweet's från Twitter. För att utföra detta kommer vi i denna tutorial att bygga applikationen i PHP och använda oss utav biblioteket **TwitterOAuth** för att komminucera med Twitter's API

Denna tutorial förutsätter att du som användare har någorlunda kunskaper kring PHP och HTML samt erfarenheter av att använda någon form textbaserat gränssnitt (som t.ex. terminalen i OSX).

###Använda composer
*   skriva composer.json 
*   lägga till composer som kommando
```
curl -sS https://getcomposer.org/installer | php
```

```JSON
{
    "name": "tsm/laboration-2",    
    "type": "",
    "description": "Implementation of ...",
    "keywords": ["education"],
    "homepage": "http://www.edskar.se",
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