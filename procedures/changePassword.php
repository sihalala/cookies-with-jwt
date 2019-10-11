<?php
require_once __DIR__ .'/../inc/bootstrap.php';
requireAuth();

$currentPassword = request()->get('current_password');
$newPassword = request()->get('password');
$confirmPassword = request()->get('confirm_password');

if ($newPassword != $confirmPassword) {
  $session->getFlashBag()->add('error', 'New passwords do not match. Please try again.');
  redirect('/account.php');
}

$user = getAuthenticatedUser();

if (empty($user)) {
  $session->getFlashBag()->add('error', 'Some Error Happend. Try again. If it continues,  please log out and back in.');
  redirect('/account.php');
}

if (!password_verify($currentPassword, $user['password'])) {
  $session->getFlashBag()->add('error', 'Current password was incorrect, please try again');
  redirect('/account.php');
}

$hashed = password_hash($newPassword, PASSWORD_DEFAULT);

if (!updatePassword($hashed, $user['id'])) {
  $session->getFlashBag()->add('error', 'Could not update password, please try again.');
  redirect('/account.php');
}

$session->getFlashBag()->add('success', 'Password Updated');
redirect('/account.php');