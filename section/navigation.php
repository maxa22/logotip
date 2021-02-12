<?php 
    if(isset($_SESSION['id'])) { 
        require_once('admin_nav.php');
        require_once('admin_sidebar.php');
    } else {
?>

<nav>
    <div class="<?php echo isset($_GET['page']) && $_GET['page'] == 'index' ? 'index-wrapper' : ''; ?>">
        <div class="navigation d-flex jc-sb ai-c">
            <a href="<?php base(); ?>index" class="logo d-flex jc-c ai-c">
                <?php if(isset($_COOKIE['theme'])) { ?>
                    <img src="<?php base(); ?>images/logo-2.png" class="logo__image" id="theme-logo" alt="Lab387 logo">
                <?php } else{ ?>
                    <img src="<?php base(); ?>images/logo.png" class="logo__image" id="theme-logo" alt="Lab387 logo">
                <?php } ?>
            </a>
            <ul class="navigation__menu">
                <li><a href="<?php base(); ?>index" class="navigation__link">Index</a></li>            
                <li><a href="<?php base(); ?>login" class="navigation__link">Login</a></li>
                <li><a href="<?php base(); ?>register" class="navigation__link">Register</a></li>
            </ul>
        </div>
    </div>
</nav>

<?php } ?>