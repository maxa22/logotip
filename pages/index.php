<!-- index landing page -->
<body>

<?php if(isset($_SESSION['id'])) { ?>
<main>
<?php } else { ?>
<main class="index-wrapper">
<?php } ?>
<div class="hero ai-c d-flex jc-sb m-jc-c gap-m index">
    <div class="w-100 index__text m-text-center">
        <h1 class="mb-xs">Pricing calculator</h1>
        <p class="mb-m">
            Create your calculator. Configure and provide the estimate costs of your logotip creation services.
        </p>
        <a href="examples" class="btn btn-primary text-center m-mb-s">Examples</a>
        <?php if(!isset($_SESSION['id'])) { ?>
        <a href="register" class="btn btn-primary text-center">Sign up <i class="fas fa-user-plus hide-icon"></i></a>
        <?php } ?>
    </div>
    <div class="w-100 index__image m-d-none">
        <img src="<?php base(); ?>images/finance.svg" alt="Personal finance" class="w-100">
    </div>
</div>
</main>
