<?php
if(!isset($_SESSION['id'])) {
    header('Location: login');
    exit();
}
if(!isset($_SESSION['calculatorId'])) {
    header('Location: create_calculator');
}
?>
<body>

<main>
<div class="hero mt-s mb-s">
    <div class="add-question">
        <form action="" method="POST">
            <div class="card-container">
                <div class="card number-of-questions mb-s" data-id="1">
                    <div class="card__header text-center">
                        <h2>Question 1</h2>
                    </div>
                    <div class="card-body">
                        <div class="card-body__question mb-xm">
                            <input type="text" class="form__input" name="1question" placeholder="Provide Question">
                            <span class="registration-form__error"></span>
                        </div>
                        <div class="card-body__option-container mb-m d-flex gap-m m-flex-column wrap">
                            <div class="card-option card card-body w-25-gap-m l-w-50-gap-m m-w-100">
                                <h3 class="card__header mb-s w-100 text-center">Option 1</h3>
                                <div class="card-option__body">
                                    <div class="mb-xm">
                                        <input type="text" name="1optionName1"  class="form__input" placeholder="Option">
                                        <span class="registration-form__error"></span>
                                    </div>
                                    <div class="mb-xm">
                                        <input type="number" name="1optionPrice1"  class="form__input" placeholder="Price">
                                        <span class="registration-form__error"></span>
                                    </div>
                                    <div>
                                        <input type="file" name="1optionImage1" id="1optionImage1" class="form__input-file">
                                        <label for="1optionImage1" class="file-label mb-xs">Upload Image <i class="fas fa-plus hide-icon"></i></label>
                                        <i class="fas fa-times d-none remove-image pointer text-right mb-xs"></i>
                                        <img src="" alt="" class="w-100">
                                        <span class="registration-form__error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-option card card-body w-25-gap-m l-w-50-gap-m m-w-100">
                                <h3 class="card__header mb-s w-100 text-center">Option 2</h3>
                                <div class="card-option__body">
                                    <div class="mb-xm">
                                        <input type="text" name="1optionName2"  class="form__input" placeholder="Option">
                                        <span class="registration-form__error"></span>
                                    </div>
                                    <div class="mb-xm">
                                        <input type="number" name="1optionPrice2"  class="form__input" placeholder="Price">
                                        <span class="registration-form__error"></span>
                                    </div>
                                    <div>
                                        <input type="file" name="1optionImage2" id="1optionImage2" class="form__input-file">
                                        <label for="1optionImage2" class="file-label mb-xs">Upload Image <i class="fas fa-plus hide-icon"></i></label>
                                        <i class="fas fa-times d-none remove-image pointer text-right mb-xs"></i>
                                        <img src="" alt="" class="w-100">
                                        <span class="registration-form__error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-large option">Add option <i class="fas fa-plus hide-icon"></i></button>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-xl" id="question">Add question <i class="fas fa-plus hide-icon"></i></button>
            <button class="btn btn-primary btn-xl" name="submit">Save calculator <i class="fas fa-save hide-icon"></i></button>
        </form>
    </div>
</div>
</main>
