<?php
require_once __DIR__ . '/inc/bootstrap.php';
require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/templates/nav.php';
?>
<div class="container">
    <div class="well">
        <h2>Book List</h2>

        <?php
        foreach (getAllBooks() as $book) {
            include __DIR__ . '/templates/book.php';
        }
        ?>

    </div>
</div>
<?php
require_once __DIR__ . '/templates/footer.php';
