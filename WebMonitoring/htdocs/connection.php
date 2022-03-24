<?php

$dbhost = "sql204.epizy.com"; 
$dbuser = "epiz_27825186";
$dbpass = "PaCOCCmH2p";
$dbname = "epiz_27825186_signup";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)){
	die("failed to connect!");
}
