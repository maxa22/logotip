<!--  getting the id of the calculator to render the steps and options  -->
<?php
    if(!isset($_SESSION['id'])) {
        header('Location: login');
        exit();
    }
    if(isset($_GET['id'])) {

        require_once('include/autoloader.php');
        $id = htmlspecialchars($_GET['id']);
        $sql = "SELECT * FROM calculator WHERE id = ?";
        $calculator = DatabaseObject::findById($sql, $id);
        if($calculator['userId'] != $_SESSION['id'] || $calculator['archived'] == '1') {
            header('Location: ../calculators');
            exit();
        }
        $_SESSION['calculatorId'] = $calculator['id'];
    } else {
        header('Location: calculators');
    }
?>

<main>
<div class="hero">
<div class="mt-s mb-s">
<form action="" method="POST" id="calculator-form">
    <!-- RENDER CALCULATOR FORM -->
    <div class="card mb-m">
        <div class="card__header btn-primary">
            <h2><?php echo $calculator['name']; ?></h2>
        </div>
        <p class="error-message"></p>
        <div class="card-body">
        <div class="d-flex jc-sb gap-m mb-s">
            <div class="w-100">
                <div class="mb-s">
                    <label for="calculator-name" class="d-block">Calculator Name</label>
                    <input type="text" class="form__input" name="<?php echo $calculator['id']; ?>-calculatorName" id="calculator-name" disabled value="<?php echo $calculator['name']; ?>" >
                    <span class="registration-form__error"></span>
                </div>
                <div>
                    <label for="estimate-text" class="d-block">Estimate Text</label>
                    <textarea name="estimateText" class="form__textarea" id="estimate-text" cols="30" rows="5" disabled value="<?php echo $calculator['estimateText']; ?>"><?php echo $calculator['estimateText']; ?></textarea>
                    <span class="registration-form__error"></span>
                </div>
            </div>
            <div class="w-100">
                <div class="mb-s">
                    <label for="calculator-heading" class="d-block">Calculator Heading</label>
                    <input type="text" class="form__input" name="heading" id="calculator-heading" disabled value="<?php echo $calculator['heading']; ?>">
                    <span class="registration-form__error"></span>
                </div>
                <div>
                    <label for="calculator-text" class="d-block">Calculator Text</label>
                    <textarea name="calculatorText" class="form__textarea" id="calculator-text" cols="30" rows="5" disabled value="<?php echo $calculator['calculatorText']; ?>"><?php echo $calculator['calculatorText']; ?></textarea>
                    <span class="registration-form__error"></span>
                </div>
            </div>
        </div>
        
        <div class="d-flex jc-sb gap-m">
            <div class="w-100">
                <label for="calculator-button" class="d-block">Calculator Button Text</label>
                <input type="text" class="form__input" name="button" id="calculator-button" disabled value="<?php echo $calculator['button']; ?>">
                <span class="registration-form__error"></span>
            </div>
            <div class="w-100">
                <label for="calculator-logo" class="d-block">Add logo</label>
                <label for="calculator-logo" class="file-label d-block mb-xs">Upload Image</label>
                <input type="file" class="form__input-file" name="logo" id="calculator-logo" disabled >
                <img src="<?php echo $calculator['logo'] ? base() . 'images/' . $calculator['logo'] : ''; ?>" alt="" class="calculator-image d-block m-auto">
            </div>
        </div>
        <div class="d-flex jc-sb gap-m mb-s">
            <div class="w-100">
                <label for="background-color" class="d-block">Choose background color</label>
                <input type="color" class="form__input" name="backgroundColor" id="background-color" disabled value="#<?php echo $calculator['backgroundColor']; ?>">
            </div>
            <div class="w-100">
                <label for="color" class="d-block">Choose text color</label>
                <input type="color" class="form__input" name="color" id="color" disabled value="#<?php echo $calculator['color']; ?>">
            </div>
        </div>
        <div class="w-50-gap-m mb-s">
            <?php require_once('section/currency_array.php'); ?>
            <select name="currency" disabled class="form__input">
                <option value="<?php echo $calculator['currency']; ?>" selected> <?php echo $currency[$calculator['currency']]; ?> </option>
                <?php foreach($currency as $key => $value) { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>
            </select>
            <span class="registration-form__error"></span>
        </div>
        <div class="d-none editing">
            <button class="btn btn-primary save-calculator" name="submit">Save</button>
            <button class="btn btn-secondary cancel">Cancel</button>
        </div>
        <div class="text-right disabling">
            <button class="btn btn-info edit">Edit</button>
        </div>
        </div>  
    </div>
</form>
<!-- END OF CALCULATOR FORM -->
    <?php
        $sql = "SELECT * FROM step WHERE calculatorId = ?";
        $stepResult = DatabaseObject::findAllByQuery( $sql, $id);
        if($stepResult) { 
            $j = 0;
        foreach($stepResult as $stepRow ) { 
            ++$j;    
        ?>

        <!-- RENDER STEP FORM -->
        <form action="" method="POST" class="question-form">
        <div class="card mb-m" data-id="<?php echo $calculator['id'] . '-' . $stepRow['id']; ?>">
            <div class="card__header btn-primary">
                <h2>Question <?php echo $j; ?></h2>
            </div>
            <div class="card-body">
                <div class="mb-m" >
                    <h3 class="mb-xs">Question</h3>
                    <p class="error-message"></p>
                    <input type="text" class="form__input mb-xs" name="<?php echo $stepRow['id'] . '-question'; ?>" disabled value="<?php echo $stepRow['name']; ?>">
                    <span class="registration-form__error"></span>
                </div>
                <?php

                    $i = 0;  
                    $sql = "SELECT * FROM options WHERE stepId = ?";
                    $optionResult = DatabaseObject::findAllByQuery($sql, $stepRow['id']);
                    if(count($optionResult) > 0) { ?>

                    <!-- OPTION RENDER CONTAINER -->
                       <div class="card-body__option-container mb-s">
                        <?php foreach($optionResult as $optionRow) { ?>

                            <!-- OPTION CARD -->
                            <div class="card-option">
                                <div class="card__header card__header-border d-flex jc-sb ai-c">
                                    <h3>Option <?php echo ++$i; ?></h3>
                                    <a href="<?php base(); ?>include/delete_option.inc.php?id=<?php echo $optionRow['id'] . '&calculator_id=' . $calculator['id'] ?>" class="danger f-s-2 disabling">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                                <div class="card-option__body">
                                    <p class="error-message mb-xs"></p>
                                    <div class="mb-xs">
                                        <label for="<?php echo $optionRow['id'] . '-optionName'; ?>">Name</label>
                                        <input type="text" class="form__input" disabled name="<?php echo $optionRow['id'] . '-optionName'; ?>" id="<?php echo $optionRow['id'] . '-optionName'; ?>" value="<?php echo $optionRow['name']; ?>">
                                        <span class="registration-form__error"></span>
                                    </div>
                                    <div class="mb-xs">
                                        <label for="<?php echo $optionRow['id'] . '-' . $optionRow['optionPrice']; ?>">Price</label>
                                        <input type="text" class="form__input" disabled name="<?php echo $optionRow['id'] . '-optionPrice'; ?>" id="<?php echo $optionRow['id'] . '-optionPrice'; ?>" value="<?php echo $optionRow['price']; ?>">
                                        <span class="registration-form__error"></span>
                                    </div>
                                    <div>
                                        <label for="<?php echo $optionRow['id'] . '-optionImage'; ?>" class="file-label mb-xs">Upload Image</label>
                                        <input type="file" class="form__input-file" disabled name="<?php echo $optionRow['id'] . '-optionImage'; ?>" id="<?php echo $optionRow['id'] . '-optionImage'; ?>" value="<?php echo $optionRow['image']; ?>">
                                        <img src="<?php echo $optionRow['image'] ? base() . 'images/' . $optionRow['image'] : ''; ?>" class="w-100">
                                        <span class="registration-form__error"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- END OF OPTION CARD -->
                    <?php } ?>
                        </div>
                        <!-- END OF OPTION CARD CONTAINER -->
                    <?php } else { ?>
                    <div class="card mb-xs">
                        <div class="card-body">
                            <p>You don't have any options for this question...</p>
                        </div>
                    </div>
                    <?php } ?>
                    <button class="btn btn-primary mb-m d-none editing add-option">Add option</button>
                    <div class="d-none editing">
                        <button class="btn btn-primary save-question" name="submit">Save</button>
                        <button class="btn btn-secondary cancel">Cancel</button>
                    </div>
                    <div class="text-right disabling">
                        <button class="btn btn-info edit">Edit</button>
                        <a href="<?php base(); ?>include/delete_step.inc.php?id=<?php echo $stepRow['id'] . '&calculator_id=' . $calculator['id'] ?>" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
            </form>
            <!-- END OF STEP -->
        <?php } ?>
</form>
<?php } else { ?>
<div class="card mb-xs">
    <div class="card-body">
        <p>You don't have any questions in your calculator.</p>
    </div>
</div>
<?php } ?>
<a href="<?php base(); ?>add_question" class="btn btn-primary mt-s" id="redirect-link">Add question</a>
</div>
</div>
</main>

<script src="<?php base(); ?>javascript/functions.js"></script>
<script src="<?php base(); ?>javascript/file_upload_preview.js"></script>
<script src="<?php base(); ?>javascript/edit_file_upload_preview.js"></script>
<script src="<?php base(); ?>javascript/sidebar_toggle.js"></script>
<script src="<?php base(); ?>javascript/edit_button.js"></script>
<script src="<?php base(); ?>javascript/edit_add_option.js"></script>
<script src="<?php base(); ?>javascript/edit_question.js"></script>