<?php 
    if(!isset($_SESSION['id'])) { 
        header('Location: login');
        exit();
    }
    
?>
<body>

<main>
<div class="wrapper d-flex jc-c">
<div class="form-container">
<h1 class="card__header w-100 text-center card__header-border">Create calculator</h1>
<form action="" method="POST">
    <div class="card-body">
        <div class="mb-xm">
            <label for="name">Calculator name</label>
            <input type="text" name="name" id="name"  class="form__input" value="<?php $_POST['calculator'] ?? ''; ?>">
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xm">
            <label for="estimate-text">Estimate text</label>
            <textarea name="estimateText" id="estimate-text" class="form__textarea" rows="5" value="<?php $_POST['estimateText'] ?? ''; ?>" ><?php $_POST['estimateText'] ?? ''; ?></textarea>
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xm">
            <label for="heading">Heading</label>
            <input type="text" name="heading" id="heading" class="form__input" value="<?php $_POST['heading'] ?? ''; ?>" >
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xm">
            <label for="calculator-text">Calculator text</label>
            <textarea name="calculatorText" id="calculator-text" class="form__textarea" rows="5" value="<?php $_POST['calculatorText'] ?? ''; ?>" ></textarea>
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xm">
            <label for="button">Button text</label>
            <input type="text" name="button" id="button" class="form__input" value="<?php $_POST['button'] ?? ''; ?>" >
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xm">
            <label for="logo" class="file-label mb-xs">Upload logo <i class="fas fa-plus hide-icon"></i></label>
            <i class="fas fa-times d-none remove-image pointer text-right mb-xs"></i>
            <input type="file" name="logo" id="logo" class="form__input-file">
            <img src="" alt="" class="calculator-image d-block m-auto">
            <span class="registration-form__error"></span>
        </div>
        <div class="d-flex jc-sb gap-s mb-xm">
            <div class="w-100">
                <label for="background-color" class="d-block mb-xm">Background color</label>
                <input type="color"  name="backgroundColor" id="background-color" class="form__input" value="#f4f6f9">
            </div>
            <div class="w-100 mb-xm">
                <label for="color" class="d-block mb-xm">Text color</label>
                <input type="color"  name="color" id="color" class="form__input" value="#212529">
            </div>
        </div>
        <div class="mb-xm">
            <select name="currency"  class="form__input">
                    <?php require_once(base() . 'section/currency_array.php'); ?>
                    <?php if($error) { ?>
                        <option value="<?php echo $_POST['calculatorCurrency']; ?>" selected><?php echo $currency[$_POST['calculatorCurrency']]; ?></option>
                    <?php } else { ?>
                        <option value="" selected="selected">Select currency</option>
                    <?php } ?>
                    <?php foreach($currency as $key => $value) { ?>
                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php } ?>
            </select>
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xm">
            <label for="contact-form">Contact form text</label>
            <textarea name="contactForm" id="contact-form" class="form__textarea" rows="5" value="<?php $_POST['contactForm'] ?? ''; ?>" ></textarea>
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xm d-flex ai-c">
            <input type="checkbox" name="includeContactForm" id="include-contact-form" class="form__input-checkbox" value="1">
            <label for="include-contact-form" class="m-none">Include contact form on estimate</label>
            <span class="registration-form__error"></span>
        </div>
        <button class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>
</div>
</main>

