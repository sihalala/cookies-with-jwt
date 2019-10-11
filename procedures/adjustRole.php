<?php
require_once __DIR__ . '/../inc/bootstrap.php';
requireAuth();

$user = changeRole(request()->get('userId'), request()->get('roleId'));
if ($user['role_id'] == 1) {
  $session->getFlashBag()->add('success', $user['username'] . ' promoted to admin!');
} else {
  $session->getFlashBag()->add('success', $user['username'] . ' demoted to restricted user!');
}
redirect('/admin.php');