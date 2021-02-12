<?php 
    if(isset($_SESSION['id'])) {
        header('Location: index');
        exit();
    } 
?>
<body>

<div class="wrapper d-flex jc-c">
    <div class="form-container">
        <h1 class="card__header w-100 text-center card__header-border">Register</h1>
        <form action=""  method="POST">
            <div class="card-body">
                <div class="mb-xm relative">
                    <input type="text" name="username" class="form__input" placeholder="Name">
                    <i class="fas fa-user form__icon"></i>
                    <span class="registration-form__error username"></span>
                </div>
                <div class="mb-xm relative">
                    <input type="text" name="email" placeholder="Email" class="form__input">
                    <i class="fas fa-envelope form__icon"></i>
                    <span class="registration-form__error email"></span>
                    
                </div>
                <div class="mb-xm relative">
                    <input type="password" name="password" placeholder="Password" class="form__input">
                    <i class="fas fa-lock form__icon"></i>
                    <span class="registration-form__error password"></span>
                </div>
                <div class="mb-xm relative">
                    <input type="password" name="confirmPassword" class="form__input" placeholder="Retype password">
                    <i class="fas fa-lock form__icon"></i>
                    <span class="registration-form__error password"></span>
                </div>
                <button class="btn btn-primary" name="submit">Register <i class="fas fa-user-plus hide-icon"></i></button>
            </div>
        </form>
    </div>
</div>

