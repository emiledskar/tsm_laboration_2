Laboration 2 i kursen Teknik för Sociala Medier.
--------
Denna tutorial förutsätter att du som användare har någorlunda kunskaper kring PHP, HTML och CSS. Det krävs även att du har prövat att använda någon form terminal (typ terminalen i OSX).

I denna tutorial kommer vi att gå igenom hur man från grunden bygger upp en enkel applikation för att söka och hämta tweet's från Twitter. För att utföra detta kommer vi i denna tutorial att bygga applikationen i PHP och använda oss utav biblioteket **TwitterOAuth** för att komminucera med Twitter's API.


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

För att tala om för composer vilka dependencies som vår applikation har så skapar vi en composer.json fil. I denna fil anges först egenskaper för vår applikation/paket och som minst måste vi ange ett namn på applikationen/paketet och en kort beskrivning. De dependencies som vi vill använda oss utav lägger vi under ``"require: {"``. I detta fall har jag lagt till ``"php": ">=5.4.0",`` & ``"abraham/twitteroauth": "0.4.1",`` . Kom ihåg att separerar varje rad med ett komma. När du laggt till dessa två rader i *require* så sparar du filen. Nu är det dags att validera composer.json så att det inte är något fel i filen. I terminalfönstret skriver du:
```
composer validate
```

Detta bör genererar utskriften 
```
./composer.json is valid
```

*composer.json som finns med bland projektets filer kan användas som mall.*

###Installera TwitterOAuth med hjälp av composer
För att installera **TwitterOAuth** och **Bootflat** så börjar vi med att köra kommandot:
```
composer install --no-dev
```
Kommandot kommer att skapa en mapp med namn **vendor** i ditt projekt och spara ner respektive paket som vi angivit i **composer.json** till vendor mappen.

Nästa steg är att skapa filen index.php och lägga till följande rader:
```PHP
<?php
session_start();
require "vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;
```

**TwitterOAuth** är nu installerat.

###Upprätthålla kommunikation med Twitter
För att påbörja kommunikationen mellan din applikation och Twitter lägger du till denna rad i index.php:
```PHP
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
```

De två konstanterna **CONSUMER_KEY** & **COMSUMER_SECRET** är unika nycklar som du måste hämta från [Twitter's development sida](https://apps.twitter.com/). För att få tag i dessa nycklar måste du logga in som developer och sedan välja skapa ny applikation.
*   Name: Applikationens namn, i detta fall blev det *tsm_laboration_2*.
*   Description: Beskrivning av applikationen.
*   Website: En länk till sidan du tänk hosta applikationen på eller ett github repo.
*   Callback URL: En länk dit Twitter skickar dina användare efter att de autentiserat sig (Denna länk kan vara vilken som helst eftersom vi kommer att skicka med en ny länk senare).

För att sedan erhålla de unika nycklarna till applikationen går du in under fliken **Keys and Access Tokens**. Där finns ett avsnitt som heter **Application Settings** och där under finns de nycklar du ska använda. Kopierna dessa två och ersätt de konstanterna **CONSUMER_KEY** & **COMSUMER_SECRET**.

Nästa steg är att skicka ett request till Twitter för att ta emot applikationens **access token**. Detta görs genom följande kodrad:
```PHP
$access_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
```

Det är i detta anrop som den callback som du angav tidigare byts ut. Det är variabeln **OAUTH_CALLBACK** som ska ersättas med den adress du vill att Twitter ska skicka dina användare efter att de autentiserat sig. I detta exemepel sätts callbacken till **callback.php**. Som svar till detta anrop skickar Twitter tillback **oauth_token** & **oauth_token_secret**, dessa bör du spara i en sessions variabel för att senare komma åt efter omdirigeringen till din callback.




###slutord, vad kan man göra sen 

