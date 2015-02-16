Laboration 2 i kursen Teknik för Sociala Medier.
------------------------------------------------

##Inledning

Förutsättningarna för denna tutorial är att du som användare har någorlunda kunskaper kring PHP och HTML. Det krävs även att du har erfarenhet av att använda någon form av terminal (typ terminalen i OSX).

Denna tutorial kommer att gå igenom hur man från grunden bygger upp en enkel applikation för att hämta och söka bland användardata från Twitter. Det första du får lära dig är att använda dig utav dependency managern Composer för att lägga till paket/bibliotek i ditt projektet. När du satt upp ditt projekt med hjälp av Composer kommer du att lära dig hur du autentisera din applikation mot Twitter's API med hjälp av biblioteket **[TwitterOAuth](https://twitteroauth.com/)**. Till sist kommer du lära dig hur du gör anrop mot Twitter's API för att hämta användardata.

I detta repo finns dels denna tutorial men även ett exempel på en enkel applikation för att visa exempel på vad som går att göra. Det grafiska i applikationen är byggt med hjälp av [Bootflat](http://bootflat.github.io/).

##Sätta upp projektet
Nu sätter vi igång!

*   Starta ett nytt terminalfönster.
*   Använd kommandot ``cd`` för ta dig fram till den sökväg där du vill att ditt projekt ska sparas.
*   Skapa en ny mapp för ditt projekt genom att skriva ``mkdir "app_namn"`` och gå sedan in i den mappen.

Första steget är nu klart, du är nu redo att gå till nästa avsnitt för att installera Composer.


##Composer
[Composer](https://getcomposer.org/) är en dependency manager för PHP som hjälper dig att enkelt uppdatera och installera paket eller bibliotek som du vill använda dig av i ett projekt.

###Installera Composer (MAC OSX)
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

###Skapa composer.json
*composer.json som finns med bland projektets filer kan användas som mall.*

För att tala om för composer vilka dependencies som din applikation ska användas så behöver du skapa en composer.json fil. I denna fil anger du först egenskaper för din applikation/paket. Som minst måste du ange ett namn på applikationen/paketet och en kort beskrivning. De dependencies som du vill använda lägger du under ``"require: {"``. I detta fall ska du lägga till ``"php": ">=5.4.0",`` & ``"abraham/twitteroauth": "0.4.1",``. Kom ihåg att separerar varje rad med ett komma. När du lagt till dessa två rader i *require*så sparar du filen. Nu är det dags att validera composer.json så att det inte är något fel i filen. I terminalfönstret skriver du:
```
composer validate
```

Detta bör genererar utskriften 
```
./composer.json is valid
```


###Installera TwitterOAuth med hjälp av composer
För att installera **TwitterOAuth** så börjar du med att köra kommandot:
```
composer install --no-dev
```
Kommandot kommer att skapa en mapp med namn **vendor** i ditt projekt och spara ner respektive paket som du angivit i **composer.json** till vendor mappen.

Nästa steg är att skapa filen index.php och lägga till följande rader:
```PHP
<?php
session_start();
require "vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;
```

**TwitterOAuth** är nu installerat.


##Uppbyggnad av applikation

###Upprätthålla kommunikation med Twitter

####index.php
För att påbörja kommunikationen mellan din applikation och Twitter lägger du till denna rad i index.php:
```PHP
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
```

De två konstanterna **CONSUMER_KEY** & **COMSUMER_SECRET** är unika nycklar som du måste hämta från [Twitter's development sida](https://apps.twitter.com/). För att få tag i dessa nycklar måste du logga in som developer och sedan välja skapa ny applikation.
*   Name: Applikationens namn, i detta fall blev det *tsm_laboration_2*.
*   Description: Beskrivning av applikationen.
*   Website: En länk till sidan du tänk hosta applikationen på eller ett github repo.
*   Callback URL: En länk dit Twitter skickar dina användare efter att de autentiserat sig (Denna länk kan vara vilken som helst eftersom du kommer att skicka med en ny länk senare).

För att sedan erhålla de unika nycklarna till applikationen går du in under fliken **Keys and Access Tokens**. Där finns ett avsnitt som heter **Application Settings** och där under finns de nycklar du ska använda. Kopierna dessa två och ersätt de konstanterna **CONSUMER_KEY** & **COMSUMER_SECRET**.

Nästa steg är att skicka ett request till Twitter för att ta emot applikationens **access token**. Detta görs genom följande kodrad:
```PHP
$access_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));

$_SESSION['oauth_token'] = $access_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $access_token['oauth_token_secret'];
```

Det är i detta anrop som den callback som du angav tidigare byts ut. Det är variabeln **OAUTH_CALLBACK** som ska ersättas med den adress du vill att Twitter ska skicka dina användare efter att de autentiserat sig. I detta exemepel sätts callbacken till **callback.php**. Som svar till detta anrop skickar Twitter tillback **oauth_token** & **oauth_token_secret**, dessa bör du spara i en sessions variabel för att senare komma åt efter omdirigeringen till din callback.

För att låta användarna autentisera sig måste du lägga till en länk på sidan som skickar användaren till Twitters sida för autentisering. Detta görs med kodraden:
```
<a href="https://api.twitter.com/oauth/authenticate?oauth_token=<?=$access_token['oauth_token']?>">Logga in med twitter</a>
```

####callback.php
När användaren autentiserat sig mot Twitter så skickas de tillbaka till den url som du angav som callback url. Twitter skickar även med en **aouth_verifier** nyckel, men innan du använder dig utav den måste ett nytt objekt av TwitterOAuth klassen skapas.
```PHP
<?php
session_start();
require "vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
```

Använd samma **CONSUMER_KEY** & **CONSUMER_SECRET** som du angav tidigare. Ange även de access token som tidigare sparades i sessioner som inparametrar till den nya instansen av **TwitterOAuth** klassen.

Det sista som nu behöver göras för att få tillstånd att hämta information om användaren från Twitter är att hämta nya access tokens som är kopplade till användaren. Detta gör du med följande kod:
```
$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
```

Sätt dessa som **TwitterOAuth** objektets access tokens:
```PHP
$connection->setOauthToken($access_token['oauth_token'], $access_token['oauth_token_secret']);
```

Du har nu färdigställt autentiseringen mot Twitter och kan börja skicka requests för att hämta data från Twitter.

###Ett enkelt exempel
För att hämta data från Twitter använder du funktionen ``get()`` ifrån **TwitterOAuth**. Med denna metod anger du vilken av [Twitter's API funktioner](https://dev.twitter.com/rest/public) du vill hämta data ifrån. Ett sådant anrop kan till exempel se ut så här:
```PHP
$connection->get('search/tweets', array( 'q' => 'PHP', 'count' => 100));
```
Detta anrop söker efter tweet's som matchar en söksträng. Här anges söksträngen i variabeln 'q' och i detta anrop söker vi efter tweet's som innehåller ordet PHP. I anropet kan du också skicka med ytterliggare parametrar beroende på vilken funktion du anropar. Fler funktioner samt beskrivning av vilka parametrar de tar emot finner du på [Sidan för twitter's API](https://dev.twitter.com/rest/public).

##Avslut

Grattis! Du har nu lärt dig att:
*   Använda Composer
*   Autentisera dig mot Twitter
*   Hämta data från Twitter