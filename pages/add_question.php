<?php
if(!isset($_SESSION['id'])) {
    header('Location: login');
    exit();
}
if(!isset($_SESSION['calculatorId'])) {
    header('Location: create_calculator');
}
?>
<main>
<div class="hero mt-s mb-s">
    <div class="add-question">
        <form action="" method="POST">
            <div class="card-container">
                <div class="card mb-s" data-id="1">
                    <div class="card__header btn-primary">
                        <h2>Question 1</h2>
                    </div>
                    <div class="card-body">
                        <div class="card-body__question mb-xs">
                            <input type="text" class="form__input" name="1question" placeholder="Provide Question">
                            <span class="registration-form__error"></span>
                        </div>
                        <div class="card-body__option-container mb-m">
                            <div class="card-option">
                                <h3 class="card__header btn-secondary">Option 1</h3>
                                <div class="card-option__body">
                                    <div class="mb-xs">
                                        <input type="text" name="1optionName1"  class="form__input" placeholder="Option">
                                        <span class="registration-form__error"></span>
                                    </div>
                                    <div class="mb-xs">
                                        <input type="number" name="1optionPrice1"  class="form__input" placeholder="Price">
                                        <span class="registration-form__error"></span>
                                    </div>
                                    <div>
                                        <label for="1optionImage1" class="file-label  mb-xs">Upload Image</label>
                                        <input type="file" name="1optionImage1" id="1optionImage1" class="form__input-file">
                                        <img src="" alt="" class="w-100">
                                        <span class="registration-form__error"></span>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card-option">
                                <h3 class="card__header btn-secondary">Option 2</h3>
                                <div class="card-option__body">
                                    <div class="mb-xs">
                                        <input type="text" name="1optionName2"  class="form__input" placeholder="Option">
                                        <span class="registration-form__error"></span>
                                    </div>
                                    <div class="mb-xs">
                                        <input type="number" name="1optionPrice2"  class="form__input" placeholder="Price">
                                        <span class="registration-form__error"></span>
                                    </div>
                                    <div>
                                        <label for="1optionImage2" class="file-label mb-xs">Upload Image</label>
                                        <input type="file" name="1optionImage2" id="1optionImage2" class="form__input-file">
                                        <img src="" alt="" class="w-100">
                                        <span class="registration-form__error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-secondary option">Add option</button>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" id="question">Add question</button>
            <button class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</div>
</main>
<script src="<?php base(); ?>javascript/functions.js"></script>
<script src="<?php base(); ?>javascript/sidebar_toggle.js"></script>
<script src="<?php base(); ?>javascript/add_question.js"></script>
<script src="<?php base(); ?>javascript/add_question_submit.js"></script>