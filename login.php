<div class="wrapper">
<div class="form-container">
<form action="" method="POST">
    <div class="card-body">
        <h2 class="card-body__heading">Sign In</h2>
        <div>
            <input type="email" name="email"  class="registration-form__input" placeholder="Email">
        </div>
        <div>
            <input type="password" name="password" class="registration-form__input" placeholder="Password">
            <span class="registration-form__error"><?php echo $error['password'] ?? ''; ?></span>
        </div>
        <button class="btn btn-primary" name="submit">Login</button>
    </form>
</div>
</div>
