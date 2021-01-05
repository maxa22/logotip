<div class="wrapper">
    <div class="form-container">
        <form action=""  method="POST">
            <div class="card-body">
                <h2 class="card-body__heading">Register</h2>
                <div class="mb-s">
                    <input type="text" name="username" class="form__input" placeholder="Name">
                    <span class="registration-form__error username"></span>
                </div>
                <div class="mb-s">
                    <input type="text" name="email" placeholder="Email" class="form__input">
                    <span class="registration-form__error email"></span>
                    
                </div>
                <div class="mb-s">
                    <input type="password" name="password" placeholder="Password" class="form__input">
                    <span class="registration-form__error password"></span>
                </div>
                <div class="mb-s">
                    <input type="password" name="confirmPassword" class="form__input" placeholder="Retype password">
                    <span class="registration-form__error password"></span>
                </div>
                <button class="btn btn-primary" name="submit">Register</button>
            </div>
        </form>
    </div>
</div>
<script src="<?php base(); ?>javascript/functions.js"></script>
<script src="<?php base(); ?>javascript/register.js"></script>
