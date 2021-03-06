<?php 
    //  getting calculator id and rendering calculator content, including steps and options 

    if(isset($_GET['id'])) {
        require_once('include/autoloader.php');
        $id =  $_GET['id'];
        $key = 'id';
        Validate::validateString($key, $id);
        $id = Sanitize::sanitizeString($id);
        $error = Message::getError();
        if($error) {
            header('Location: ../index');
            exit();
        }
        // select calculator with matching id
        $sql = "SELECT * FROM calculator WHERE id = ?";
        $calculator = Calculator::findById($id);
        if(!$calculator) {
            header('Location: ../index');
            exit();
        }
    } else {
        header('Location: ../index');
        exit();
    }
    if($calculator['archived'] == '0') { 
?>
<body style="background-color: #<?php echo $calculator['backgroundColor']; ?>; color: #<?php echo $calculator['color']; ?>">
<?php if(isset($_SESSION['id'])) { ?>
<main >
<?php } else { ?>
<main class="m-auto">
<?php } ?>
    <div class="hero">
    <div class="wrapper d-flex jc-c ai-c">
        <div class="form-container m-auto text-center p-s mb-m intro">
            <h1 class="mb-s text-t-upper"><?php echo $calculator['heading']; ?></h1>
            <p class="mb-s"><?php echo $calculator['calculatorText']; ?></p>
            <button class="btn btn-primary intro__button mb-xs" style="background-color: #<?php echo $calculator['color']; ?>;border-color: #<?php echo $calculator['color']; ?>; color: #<?php echo $calculator['backgroundColor']; ?>"><?php echo $calculator['button']; ?></button>
            <?php if($calculator['logo']) { ?>
                <img src="<?php base();?>images/<?php echo $calculator['logo']?>" class="calculator-image d-block m-auto" alt="calculator logo">
            <?php } ?>
        </div>    
    </div>
        <?php
            $stepResult = Step::findAllByQuery('calculatorId', $calculator['id']);
            if(!empty($stepResult)) { ?>

            <form action="<?php base(); ?>include/estimate.inc.php" method="POST">

            <?php foreach($stepResult as $stepRow) { ?>

                <div class="input-wrapper d-none text-center mb-m mt-m step-<?php echo $stepRow['id']; ?>">
                    <h2 class="mb-s"><?php echo $stepRow['name']; ?></h2>
                    <div class="input-wrapper__options">
                        <?php  
                            $optionResult = Option::findAllByQuery('stepId', $stepRow['id']);
                            foreach($optionResult as $optionRow) { ?>

                            <div>
                                <input type="radio" name="<?php echo $stepRow['id'] . '-answer'; ?>" class="d-none" id="<?php echo $optionRow['name']  . '-' . $stepRow['id']; ?> " value="<?php echo $stepRow['id'] . '-answer-' . $optionRow['id']; ?> ">
                                <label for="<?php echo $optionRow['name'] . '-' . $stepRow['id']; ?> " class="label d-flex flex-column jc-c ai-c p-xs">
                                    <?php if($optionRow['image']) { ?>
                                        <img src="<?php base(); ?>images/<?php echo $optionRow['image'] ?>" alt="<?php echo $optionRow['name']; ?>" class="w-100 mb-xs">
                                    <?php } ?>
                                    <span class="d-block"><?php echo $optionRow['name'] ?></span>
                                </label>
                            </div>
                            <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <div class="input-wrapper d-none text-center">
                <button name="submit" class="btn btn-primary btn-xl h-auto" style="background-color: #<?php echo $calculator['color']; ?>;border-color: #<?php echo $calculator['color']; ?>; color: #<?php echo $calculator['backgroundColor']; ?>">Get your price estimate</button>                     
            </div>
            </form>
            
        <?php } else { ?>
            <div class="input-wrapper">
                <p>No default calculator or no questions added to current calculator...</p>
            </div>
        <?php } ?>
    </div>
</main>
<?php } else { ?>
    <main class="d-flex jc-c ai-c hero">
        <div class="text-center form-container p-s m-auto">
            <h2 class="mb-s">Calculator no longer in use...</h2>
            <a href="../examples" class="btn btn-primary">Check out another calculator</a>
        </div>
    </main>
<?php } ?>
