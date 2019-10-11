<?php
require_once __DIR__ . '/../inc/bootstrap.php';

$session->getFlashBag()->add('success', 'Successfully Logged Out');
$cookie = setAuthCookie('expired', 1);
redirect('/login.php', ['cookies' => [$cookie]]);