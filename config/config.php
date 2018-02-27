<?php

/* 
 * CONFIG OPTIONS
 */

//ENDEREÇO EX: header("Location: ".BASE_URL_ALG."visao/principal.php");
define("BASE_URL_ALG",  "/algtot/");

//BANCO DE DADOS
define("LOCAL_HOST",  "localhost");
define("DB_NAME",  "algtot");
define("DB_USER_NAME",  "root");
define("DB_USER_SENHA",  "root");

//CONFIGURAÇÕES DE DATA/HORA
date_default_timezone_set("America/Bahia");

//CONFIGURAÇÕES DE CHARSET
header('Content-Type: text/html; charset=UTF-8');
