<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en" data-theme="<?php echo isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark' ? 'dark' : ''; ?>">
<?php require_once('section/head.php'); ?>
    <!-- Navigation, same for every page -->
    <?php require_once('section/navigation.php'); ?>
    <!-- MAIN SECTION OF PAGE -->
    <?php require 'main.php'; ?>

    <?php 
    if(!isset($_GET['page'])) {
        require('pages/index.php');
    } 
    ?>
    <script src="<?php base(); ?>javascript/script.js"></script>
</body>
</html>