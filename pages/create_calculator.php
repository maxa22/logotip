<?php 
    if(!isset($_SESSION['id'])) { 
        header('Location: login');
        exit();
    }
?>
<main>
<div class="wrapper">
<div class="form-container">
<form action="" method="POST">
    <div class="card-body">
        <h2 class="card-body__heading">Create calculator</h2>
        <div class="mb-xs">
            <input type="text" name="name"   class="form__input" placeholder="Calculator Name" value="<?php $_POST['calculator'] ?? ''; ?>">
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xs">
            <textarea name="estimateText"  class="form__textarea" rows="5" value="<?php $_POST['estimateText'] ?? ''; ?>" placeholder="Provide text to display users on price estimate..."><?php $_POST['estimateText'] ?? ''; ?></textarea>
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xs">
            <input type="text" name="heading"  class="form__input" value="<?php $_POST['heading'] ?? ''; ?>" placeholder="Calculator Heading">
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xs">
            <textarea name="calculatorText"  class="form__textarea" rows="5" value="<?php $_POST['calculatorText'] ?? ''; ?>" placeholder="Calculator text..."></textarea>
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xs">
            <input type="text" name="button"  class="form__input" value="<?php $_POST['button'] ?? ''; ?>" placeholder="Calculator button">
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xs">
            <label for="logo" class="file-label mb-xs">Upload logo</label>
            <input type="file" name="logo" id="logo" class="form__input-file">
            <img src="" alt="" class="calculator-image d-block m-auto">
            <span class="registration-form__error"></span>
        </div>
        <div class="d-flex jc-sb gap-s mb-xs">
            <div class="w-100">
                <label for="background-color" class="d-block mb-xs">Background color</label>
                <input type="color"  name="backgroundColor" id="background-color" class="form__input">
            </div>
            <div class="w-100 mb-xs">
                <label for="color" class="d-block mb-xs">Text color</label>
                <input type="color"  name="color" id="color" class="form__input">
            </div>
        </div>
        <div class="mb-m">
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
        <button class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>
</div>
</main>
<script src="javascript/functions.js"></script>
<script src="javascript/sidebar_toggle.js"></script>
<script src="javascript/file_upload_preview.js"></script>
<script src="javascript/create_calculator.js"></script>
