<?php
require_once __DIR__ . '/../inc/bootstrap.php';
requireAuth();

$book = getBook(request()->get('bookId'));
if (!isAdmin() && !isOwner($book['owner_id'])) {
   $session->getFlashBag()->add('error', 'Not Authorized');
   redirect('/books.php');
}

if (deleteBook($book['id'])) {
    $session->getFlashBag()->add('success', 'Book Deleted');
} else {
    $session->getFlashBag()->add('error', 'Unable to Delete Book');
}
redirect('/books.php');