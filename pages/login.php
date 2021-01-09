<?php 
    if(isset($_SESSION['id'])) {
        header('Location: index');
        exit();
    } 
?>
<div class="wrapper">
<div class="form-container">
<form action="" method="POST">
    <div class="card-body">
        <h2 class="card-body__heading">Sign In</h2>
        <div class="mb-s">
            <input type="email" name="email"  class="form__input" placeholder="Email">
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-s">
            <input type="password" name="password" class="form__input" placeholder="Password">
            <span class="registration-form__error"></span>
        </div>
        <button class="btn btn-primary" name="submit">Login</button>
    </form>
</div>
</div>
<script src="<?php base(); ?>javascript/functions.js"></script>
<script src="<?php base(); ?>javascript/login.js"></script>
