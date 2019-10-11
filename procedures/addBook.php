<?php
require_once __DIR__ .'/../inc/bootstrap.php';
requireAuth();

$bookTitle = request()->get('title');
$bookDescription = request()->get('description');

if (addBook($bookTitle, $bookDescription, $session->get('auth_user_id'))) {
    $session->getFlashBag()->add('success', 'Book Added');
    redirect('/books.php');
} else {
    $session->getFlashBag()->add('error', 'Unable to Add Book');
    redirect('/add.php');
}