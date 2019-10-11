<?php
require __DIR__ . '/../inc/bootstrap.php';
requireAuth();
$user = getAuthenticatedUser();

vote(request()->get('bookId'), request()->get('vote'), $user['id']);

redirect('/books.php');