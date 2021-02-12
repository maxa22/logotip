<!--  getting the id of the calculator to render the steps and options  -->
<?php
if(!isset($_SESSION['id'])) {
    header('Location: login');
    exit();
}

if(isset($_GET['id'])) {
    require_once('include/autoloader.php');
    $id = htmlspecialchars($_GET['id']);
    $calculator = Calculator::findById($id);
    if($calculator['userId'] != $_SESSION['id'] || $calculator['archived'] == '1') {  ?>
        <script>window.location.href="../calculators"</script>
    <?php }
    $_SESSION['calculatorId'] = $calculator['id'];
} else { ?>
   <script>window.location.href="calculators"</script>
<?php } ?>
<body>

<main>
<div class="hero">
<div class="mt-s mb-s">
<form action="" method="POST" id="calculator-form">
    <!-- RENDER CALCULATOR FORM -->
    <div class="card mb-m">
        <div class="card__header text-center">
            <h2><?php echo $calculator['name']; ?></h2>
        </div>
        <p class="error-message"></p>
        <div class="card-body">
        <div class="d-flex jc-sb gap-m m-gap-none m-flex-column">
            <div class="w-100">
                <div class="mb-xm">
                    <label for="calculator-name" class="d-block">Calculator Name</label>
                    <input type="text" class="form__input" name="<?php echo $calculator['id']; ?>-calculatorName" id="calculator-name" disabled value="<?php echo $calculator['name']; ?>" >
                    <span class="registration-form__error"></span>
                </div>
                <div class="mb-xm">
                    <label for="estimate-text" class="d-block">Estimate Text</label>
                    <textarea name="estimateText" class="form__textarea" id="estimate-text" cols="30" rows="5" disabled value="<?php echo $calculator['estimateText']; ?>"><?php echo $calculator['estimateText']; ?></textarea>
                    <span class="registration-form__error"></span>
                </div>
            </div>
            <div class="w-100">
                <div class="mb-xm">
                    <label for="calculator-heading" class="d-block">Calculator Heading</label>
                    <input type="text" class="form__input" name="heading" id="calculator-heading" disabled value="<?php echo $calculator['heading']; ?>">
                    <span class="registration-form__error"></span>
                </div>
                <div class="mb-xm">
                    <label for="calculator-text" class="d-block">Calculator Text</label>
                    <textarea name="calculatorText" class="form__textarea" id="calculator-text" cols="30" rows="5" disabled value="<?php echo $calculator['calculatorText']; ?>"><?php echo $calculator['calculatorText']; ?></textarea>
                    <span class="registration-form__error"></span>
                </div>
            </div>
        </div>
        
        <div class="d-flex jc-sb gap-m m-gap-none m-flex-column">
            <div class="w-100 mb-xm">
                <label for="calculator-button" class="d-block">Calculator Button Text</label>
                <input type="text" class="form__input" name="button" id="calculator-button" disabled value="<?php echo $calculator['button']; ?>">
                <span class="registration-form__error"></span>
            </div>
            <div class="w-100 mb-xm">
                <label for="calculator-logo" class="d-block">Add logo</label>
                <input type="file" class="form__input-file" name="logo" id="calculator-logo" disabled >
                <label for="calculator-logo" class="file-label d-block mb-xs">Upload Image <i class="fas fa-plus hide-icon"></i></label>
                <i class="fas fa-times <?php echo $calculator['logo'] ? 'editing d-none has-value' : 'd-none'; ?> remove-image pointer text-right mb-xs"></i>
                <img src="<?php echo $calculator['logo'] ? base() . 'images/' . $calculator['logo'] : ''; ?>" alt="" class="calculator-image d-block m-auto">
            </div>
        </div>
        <div class="d-flex jc-sb gap-m m-gap-none m-flex-column">
            <div class="w-100 mb-xm">
                <label for="background-color" class="d-block">Choose background color</label>
                <input type="color" class="form__input" name="backgroundColor" id="background-color" disabled value="#<?php echo $calculator['backgroundColor']; ?>">
            </div>
            <div class="w-100 mb-xm">
                <label for="color" class="d-block">Choose text color</label>
                <input type="color" class="form__input" name="color" id="color" disabled value="#<?php echo $calculator['color']; ?>">
            </div>
        </div>
        <div class="d-flex jc-sb gap-m m-gap-none m-flex-column">
        <div class="w-100 mb-xm">
            <?php require_once('section/currency_array.php'); ?>
            <select name="currency" disabled class="form__input">
                <option value="<?php echo $calculator['currency']; ?>" selected> <?php echo $currency[$calculator['currency']]; ?> </option>
                <?php foreach($currency as $key => $value) { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>
            </select>
            <span class="registration-form__error"></span>
            </div>
            <div class="w-100 d-flex ai-c">
                <input type="checkbox" name="includeContactForm" id="include-contact-form" class="form__input-checkbox" <?php echo $calculator['includeContactForm'] == '1' ? 'checked' : ''; ?> disabled value="1">
                <label for="include-contact-form" class="m-none">Include contact form on estimate</label>
                <span class="registration-form__error"></span>
            </div>
        </div>
        <div class="d-flex jc-sb gap-m m-gap-none m-flex-column">
            <div class="w-100 mb-xm">
                <label for="calculator-text" class="d-block">Contact form text</label>
                <textarea name="contactForm" class="form__textarea" id="calculator-text" cols="30" rows="5" disabled value="<?php echo $calculator['contactForm']; ?>"><?php echo $calculator['contactForm']; ?></textarea>
                <span class="registration-form__error"></span>
            </div>
            <div class="w-100"></div>
        </div>

        <div class="d-none editing">
            <button class="btn btn-primary save-calculator" name="submit">Save</button>
            <button class="btn btn-secondary cancel">Cancel</button>
        </div>
        <div class="text-right disabling">
            <button class="btn btn-primary edit">Edit <i class="fas fa-edit hide-icon"></i></button>
        </div>
        </div>  
    </div>
</form>
<!-- END OF CALCULATOR FORM -->
    <?php
        $stepResult = Step::findAllByQuery( 'calculatorId', $id);
        if($stepResult) { 
            $j = 0;
        foreach($stepResult as $stepRow ) { 
            ++$j;    
        ?>

        <!-- RENDER STEP FORM -->
        <form action="../include/update_question.inc.php" enctype="multipart/form-data" method="POST" class="question-form">
        <div class="card mb-m" data-id="<?php echo $calculator['id'] . '-' . $stepRow['id']; ?>">
            <div class="card__header text-center mb-s">
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
                    $optionResult = Option::findAllByQuery('stepId', $stepRow['id']);
                    if(count($optionResult) > 0) { ?>

                    <!-- OPTION RENDER CONTAINER -->
                       <div class="card-body__option-container mb-s d-flex gap-m m-flex-column wrap">
                        <?php foreach($optionResult as $optionRow) { ?>

                            <!-- OPTION CARD -->
                            <div class="card-option card-body card w-25-gap-m l-w-50-gap-m m-w-100">
                                <div class="card__header w-100 p-none card__header-border d-flex jc-sb ai-c mb-xm">
                                    <h3>Option <?php echo ++$i; ?></h3>
                                    <a href="<?php base(); ?>include/delete_option.inc.php?id=<?php echo $optionRow['id'] . '&calculator_id=' . $calculator['id'] ?>" class="danger f-s-2 disabling">
                                        <i class="fas fa-trash icon-color icon-hover-danger"></i>
                                    </a>
                                </div>
                                <div class="card-option__body">
                                    <p class="error-message mb-xs"></p>
                                    <div class="mb-xm">
                                        <label for="<?php echo $optionRow['id'] . '-optionName'; ?>">Name</label>
                                        <input type="text" class="form__input" disabled name="<?php echo $optionRow['id'] . '-optionName'; ?>" id="<?php echo $optionRow['id'] . '-optionName'; ?>" value="<?php echo $optionRow['name']; ?>">
                                        <span class="registration-form__error"></span>
                                    </div>
                                    <div class="mb-xm">
                                        <label for="<?php echo $optionRow['id'] . '-' . $optionRow['optionPrice']; ?>">Price</label>
                                        <input type="text" class="form__input" disabled name="<?php echo $optionRow['id'] . '-optionPrice'; ?>" id="<?php echo $optionRow['id'] . '-optionPrice'; ?>" value="<?php echo $optionRow['price']; ?>">
                                        <span class="registration-form__error"></span>
                                    </div>
                                    <div>
                                        <input type="file" class="form__input-file" disabled name="<?php echo $optionRow['id'] . '-optionImage'; ?>" id="<?php echo $optionRow['id'] . '-optionImage'; ?>" value="<?php echo $optionRow['image']; ?>">
                                        <label for="<?php echo $optionRow['id'] . '-optionImage'; ?>" class="file-label mb-xs">Upload Image <i class="fas fa-plus hide-icon"></i></label>
                                        <i class="fas fa-times <?php echo $optionRow['image'] ? 'editing d-none has-value' : 'd-none'; ?> remove-image pointer text-right mb-xs"></i>
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
                        <button class="btn btn-primary edit">Edit <i class="fas fa-edit hide-icon"></i></button>
                        <a href="<?php base(); ?>include/delete_step.inc.php?id=<?php echo $stepRow['id'] . '&calculator_id=' . $calculator['id'] ?>" class="btn btn-primary text-center">Delete<i class="fas fa-trash hide-icon"></i></a>
                    </div>
                </div>
            </div>
            <input type="hidden" name="calculatorId" value="<?php echo $calculator['id']; ?>">
            </form>
            <!-- END OF STEP -->
        <?php } ?>
</form>
<?php } else { ?>
<div class="card mb-xs">
    <div class="card-body">
        <p>You don't have any question in your calculator.</p>
    </div>
</div>
<?php } ?>
<a href="<?php base(); ?>add_question" class="btn btn-primary mt-s" id="redirect-link">Add question</a>
</div>
</div>
</main>

