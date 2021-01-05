<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('section/head.php'); ?>
<body>
    <!-- Navigation, same for every page -->
    <?php require_once('section/navigation.php'); ?>
    <!-- MAIN SECTION OF PAGE -->
    <?php require 'main.php'; ?>

    <?php 
    if(!isset($_GET['page'])) {
        require('pages/index.php');
    } 
    ?>
</body>
</html>