<?php

// Setup Composer
require "vendor/autoload.php";

$local = array(
	'127.0.0.1',
	'::1',
	'endpoint-proxy.dev'
);

// If it's a local environment get env variables
if(in_array($_SERVER['REMOTE_ADDR'], $local)){
	$dotenv = new Dotenv\Dotenv(__DIR__);
	$dotenv->load();
}

var_dump($_ENV);
