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

// Get everything after the / in the url ex: http://youtube-playlist-json.dev/PLaa9cZC07ZPFVBqmmNZ4JLM2hb-Ixvtuy
$tokens = explode('/', $_SERVER['REQUEST_URI']);
$request_path = $tokens[1];

$url = '';

if( $request_path === '' ){
	$url = $_ENV['endpoint-index'];
} else {
  foreach($_ENV as $key => $var){
    $is_endpoint  = (0 === strpos($key, 'endpoint-'));
    $is_path      = (strlen($key) - strlen($request_path) == strpos($key, $request_path));

    if ($is_endpoint && $is_path) {
      $url = $var;
    }
  }
}

if ($url !== '') {
    header('Location: ' . $url, true, 302);
}

exit;
