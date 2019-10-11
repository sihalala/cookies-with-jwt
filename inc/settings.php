<?php
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();
/*
 * Handle Exceptions
 */
function exception_handler($e) {
  die($e->getMessage());
}
set_exception_handler("exception_handler");

/*
 * Set up database connection
 */
try {
    $db = new PDO( 'sqlite:'.__DIR__.'/database.db' );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch ( \Exception $e ) {
    echo 'Error connecting to the Database: ' . $e->getMessage();
    exit;
}

/*
 * Set access to components from \Symfony\Component\HttpFoundation\
 * 1. Session
 * 2. Request
 * 3. Redirect
 */

// 1. session \Symfony\Component\HttpFoundation\Session
$session = new \Symfony\Component\HttpFoundation\Session\Session();
$session->start();

// 2. request \Symfony\Component\HttpFoundation\Request
function request() {
  return \Symfony\Component\HttpFoundation\Request::createFromGlobals();
}

// 3. redirect \Symfony\Component\HttpFoundation\Response
function redirect($path, $extra = []) {
  $response = \Symfony\Component\HttpFoundation\Response::create(null, \Symfony\Component\HttpFoundation\Response::HTTP_FOUND, ['Location' => $path]);
  if (key_exists('cookies', $extra)) {
    foreach ($extra['cookies'] as $cookie) {
      $response->headers->setCookie($cookie);
    }
  }
  $response->send();
  exit;
}