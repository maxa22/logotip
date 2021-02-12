<!--  rendering user calculators -->
<?php

if(!isset($_SESSION['id'])) {
    session_unset();
    header('Location: login');
    exit();
}
$http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$link = $http . '://' . $_SERVER['HTTP_HOST'];

?>
<body>

<main>
<div class="hero">
<div class="card__header text-center weight-500 w-100">
    <h1>Dashboard</h1>
</div>
<?php 
    require_once('include/autoloader.php');

    $id = $_SESSION['id'];
    $archived = '0';
    $calculators = Calculator::findAllByQueryWithTwoArguments('userId', $id, 'archived', $archived);
    if(count($calculators) > 0) { ?>
        <div class="calculator-wrapper d-flex gap-m wrap m-flex-column">
        <?php
         foreach($calculators as $row) { 
        ?> 
            <div class="calculator card w-25-gap-m l-w-50-gap-m m-w-100">
            <div class="card-body text-center">
                <img src="images/calculator.svg" width="200px" alt="calculator" class="calculator__image">

                <h3 class="calculator__heading">
                    <a href="<?php echo 'calculator_render/' .  $row['id']; ?>">
                        <?php echo $row['name']; ?>
                    </a>
                </h3>
                <span class="calculator__span d-block mb-xs">(Click on calculator name to preview)</span>
                <span class="calculator__date d-block mb-xs"><?php $time = strtotime($row['date']); echo date('d-m-Y H:i', $time) ; ?></span>
                <div class="d-flex jc-sb gap-s mb-xs">
                    <a href="edit/<?php echo $row['id']; ?>" class="btn btn-primary w-100 ">Edit <i class="fas fa-edit hide-icon"></i></a>
                    <span class="btn btn-primary w-100 modal-toggle ">Archive <i class="fas fa-trash hide-icon"></i></span>
                </div>
                <?php if($row['defaultCalculators'] == '1') { ?>
                    <a href="<?php base(); ?>include/remove_from_examples.inc.php?id=<?php echo $row['id'] ?>" class="btn btn-primary w-100 mb-xs h-auto">Remove from examples</a>
                <?php } else { ?>
                    <a href="<?php base(); ?>include/set_example.inc.php?id=<?php echo $row['id'] ?>" class="btn btn-primary w-100 mb-xs h-auto">Set as example</a>
                <?php } ?>
                <div class="mb-xs">
                    <input type="text" class="form__input mb-xs iframe-text" value="<iframe src='<?php echo $link; base(); echo 'calculator_render/' .  $row['id']; ?>' width='100%' height='500px' title='Calculator iframe'></iframe>">
                    <button class="btn btn-primary w-100 iframe-copy">Copy iframe <i class="fas fa-copy hide-icon"></i></button>
                </div>
                <div class="modal-overlay">
                    <div class="modal">
                        <div class="modal__heading">
                            <h3>DELETE CONFIRMATION</h3>
                        </div>
                        <div class="modal__warning">
                            <p>Are you sure you want to delete calculator?</p>
                        </div>
                        <div class="text-right p-s">
                            <a href="include/archive_calculator.inc.php?id=<?php echo $row['id']; ?>" class="btn btn-danger archive text-center">Archive</a>
                            <span class="btn btn-secondary modal-toggle text-center">Cancel</span>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    <?php } ?>
        </div>
    <?php } else { ?>
        <p>You haven't created any calculators yet...</p>
    <?php } ?>
    
</div>
</div>
</main>


