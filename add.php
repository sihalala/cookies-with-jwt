<?php
require_once __DIR__ . '/inc/bootstrap.php';
requireAuth();
require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/templates/nav.php';
?>
<div class="container">
    <div class="well">
        <h2>Add a book</h2>

        <form class="form-horizontal" method="post" action="/procedures/addBook.php">
        <?php include_once __DIR__ .'/templates/bookForm.php'; ?>
        </form>

    </div>
</div>
<?php
require_once __DIR__ . '/templates/footer.php';
