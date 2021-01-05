<!-- index landing page -->
<?php if(isset($_SESSION['id'])) { ?>
<main>
<?php } else { ?>
<main class="m-auto">
<?php } ?>
<div class="hero ai-c d-flex jc-sb gap-m index">
    <div class="w-100 index__text">
        <h1 class="mb-xs">Pricing calculator</h1>
        <p class="mb-m">
            Create your calculator. Configure and provide the estimate costs of your logotip creation services.
        </p>
        <a href="examples" class="btn btn-primary">Examples</a>
        <?php if(!isset($_SESSION['id'])) { ?>
        <a href="register" class="btn btn-primary">Sign up</a>
        <?php } ?>
    </div>
    <div class="w-100 index__image">
        <img src="images/finance.svg" alt="Personal finance" class="w-100">
    </div>
</div>
</main>

<?php if(isset($_SESSION['id'])) { ?>
<script src="<?php base(); ?>javascript/sidebar_toggle.js"></script>
<?php } ?>