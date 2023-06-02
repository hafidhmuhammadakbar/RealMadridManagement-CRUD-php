<?php
require_once 'auth.php';
require 'functions.php';

// Get id from URL
$id = $_GET["id"];

if (remove($id) > 0) {
    echo "<script>
        alert('Delete data success!');
        document.location.href = 'player.php';
        </script>";
}
else {
    echo "<script>
        alert('Data failed to delete!');
        document.location.href = 'player.php';
        </script>";
}
?>