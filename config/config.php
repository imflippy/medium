<?php

// Osnovna podesavanja
define("ABSOLUTE_PATH", $_SERVER["DOCUMENT_ROOT"]."/Medium");
//define("RELATIVE_PATH", $_SERVER["DOCUMENT_ROOT"]."/labphp/termin7");

// Ostala podesavanja
define("ENV_FAJL", ABSOLUTE_PATH."/config/.env");
define("LOG_FAJL", ABSOLUTE_PATH."/data/log.txt");
define("ERROR_FILE", ABSOLUTE_PATH."/data/errors.txt");
define("LOGGING_FAJL", ABSOLUTE_PATH."/data/logging.txt");

// Podesavanja za bazu
define("SERVER", env("SERVER"));
define("DATABASE", env("DBNAME"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));

function env($naziv){
    $podaci = file(ENV_FAJL);
    $vrednost = "";
    foreach($podaci as $key=>$value){
        $konfig = explode("=", $value);
        if($konfig[0]==$naziv){
            $vrednost = trim($konfig[1]); // trim() zbog \n
        }
    }
    return $vrednost;
}
