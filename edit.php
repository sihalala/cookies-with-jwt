<?php
require_once __DIR__ . '/inc/bootstrap.php';
require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/templates/nav.php';

$book = getBook(request()->get('bookId'));

$bookTitle = $book['name'];
$bookDescription = $book['description'];
$buttonText = 'Update Book';
?>
<div class="container">
    <div class="well">
        <h2>Update book</h2>

        <form class="form-horizontal" method="post" action="/procedures/editBook.php">
            <input type="hidden" name="bookId" value="<?php echo $book['id']; ?>" />
        <?php include_once __DIR__ .'/templates/bookForm.php'; ?>
        </form>

    </div>
</div>
<?php
require_once __DIR__ . '/templates/footer.php';
