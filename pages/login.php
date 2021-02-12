<?php 
    if(isset($_SESSION['id'])) {
        header('Location: index');
        exit();
    } 
?>
<body>

<div class="wrapper d-flex jc-c">
<div class="form-container">
<h2 class="card__header w-100 text-center card__header-border">Sign In</h2>
<form action="" method="POST">
    <div class="card-body">
        <div class="mb-xm relative">
            <input type="email" name="email"  class="form__input" placeholder="Email">
            <i class="fas fa-envelope form__icon"></i>
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xm relative">
            <input type="password" name="password" class="form__input" placeholder="Password">
            <i class="fas fa-lock form__icon"></i>
            <span class="registration-form__error"></span>
        </div>
        <button class="btn btn-primary" name="submit">Login <i class="fas fa-sign-in-alt hide-icon"></i></button>
    </form>
</div>
</div>

