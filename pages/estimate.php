<?php 
if(!isset($_GET['id'])) {
    header('Location: ../index');
    exit();
} else {
    require_once('include/autoloader.php');
    $id = $_GET['id'];
    $key = 'id';
    Validate::validateString($key, $id);
    if(Message::getError()) {
        header('Location: ../index');
        exit();
    }
    $id = Sanitize::sanitizeString($id);
    $calculator = Calculator::findById($id);
}
?>
<body style="background-color: #<?php echo $calculator['backgroundColor']; ?>; color: #<?php echo $calculator['color']; ?> ">

<?php if(isset($_SESSION['id'])) { ?>
<main >
<?php } else { ?>
<main class="m-auto">
<?php } ?>
    <div class="hero">
        <div class="m-auto p-s estimate">
            <p>Your estimate for the project is: <span><?php echo $_COOKIE['price'] . ' ' . $calculator['currency'] ?></span></p>
        </div>
        <div class="m-auto mb-m p-s estimate">
            <p><?php echo $calculator['estimateText'] ; ?></p>
        </div>
        <?php if($calculator['includeContactForm'] == '1') { ?>
            <div class="form-container background-primary color-primary m-auto mb-m" id="result-div">
            <h1 class="card__header w-100 text-center mb-xs">Contact creator</h1>
            <?php if($calculator['contactForm']) { ?>
                <div class="card-body mb-xm">
                    <p><?php echo $calculator['contactForm']; ?></p>
                </div>
            <?php } ?>
            <form action="../include/send_email.inc.php" method="POST" id="contact">
                <div class="card-body">
                    <div class="mb-xm">
                        <label for="fullname">Fullname</label>
                        <input type="text" id="fullname" class="form__input" name="fullname">
                        <span class="registration-form__error"></span>
                    </div>
                    <div class="mb-xm">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form__input" name="email">
                        <span class="registration-form__error"></span>
                    </div>
                    <div class="mb-xm">
                        <label for="text">Text</label>
                        <textarea name="text" id="text" class="form__textarea" cols="10" rows="5"></textarea>
                        <span class="registration-form__error"></span>
                    </div>
                    <input type="hidden" name="calculatorId" value="<?php echo $id; ?>">
                    <button class="btn btn-primary btn-large" id="send" name="submit">Contact Us! <i class="fas fa-envelope hide-icon"></i></button>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</main>

