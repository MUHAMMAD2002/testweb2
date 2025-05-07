<?php 

if ($_SERVER["SERVER_NAME"] == "testweb") {
    define("ROOT", "http://testweb/public");

    define("DBNAME", "newsweb");
    define("DBHOST", "testweb");
    define("DBUSER", "root");
    define("DBPASS", "");
    define("DBDRIVER", "");
} else {
    define("ROOT", "https://www.yourwebsite.com");

    define("DBNAME", "newsweb");
    define("DBHOST", "yourwebsite");
    define("DBUSER", "root");
    define("DBPASS", "asdf");
    define("DBDRIVER", "");
}