<div class="media well">
  <?php if (isAuthenticated()) : $user = getAuthenticatedUser(); ?>
    <div class="media-left">
        <div class="btn-group-vertical" role="group">
            <a href="/procedures/vote.php?vote=1&bookId=<?php echo $book['id']; ?>">
            <span class="glyphicon glyphicon-triangle-top<?php
            if (getUserVote($book['id'], $user['id']) == 1) echo ' orange';
            ?>"></span></a>
            <span><?php 
            if (isset($book['score'])) echo $book['score']; 
            else echo '0';
            ?></span>
            <a href="/procedures/vote.php?vote=-1&bookId=<?php echo $book['id']; ?>">
            <span class="glyphicon glyphicon-triangle-bottom<?php
            if (getUserVote($book['id'], $user['id']) == -1) echo ' orange';
            ?>"></span></a>
        </div>
    </div>
  <?php endif; ?>
    <div class="media-body">
      <h4 class="media-heading"><?php echo $book['name']; ?></h4>
      <p><?php echo $book['description']; ?></p>
      <?php if (isAdmin() || isOwner($book['owner_id'])) : ?>
        <p>
        <span><a href="/edit.php?bookId=<?php echo $book['id']; ?>">Edit</a> | </span>
        <span><a href="/procedures/deleteBook.php?bookId=<?php echo $book['id']; ?>">Delete</a></span>
        </p>
      <?php endif; ?>
    </div>
</div>