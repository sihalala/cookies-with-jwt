<?php
if($session->getFlashBag()->has('error')) {
    echo '<div class="alert alert-danger alert-dismissable">';
    foreach ($session->getFlashBag()->get('error') as $message) {
        echo "{$message}<br>";
    }
    echo '</div>';
}
if($session->getFlashBag()->has('success')) {
    echo '<div class="alert alert-success alert-dismissable">';
    foreach ($session->getFlashBag()->get('success') as $message) {
        echo "{$message}<br>";
    }
    echo '</div>';
}
?>
<script   src="http://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>