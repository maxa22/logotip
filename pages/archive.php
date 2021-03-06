<!--  rendering user calculators -->
<?php

if(!isset($_SESSION['id'])) {
    session_unset();
    header('Location: login');
    exit();
}

?>
<body>

<main>
<div class="hero">
<div class="mt-s mb-m text-center">
    <h1>Archived calculators</h1>
</div>
<?php 
    require_once('include/autoloader.php');

    $id = $_SESSION['id'];
    $archived = '1';
    $calculators = Calculator::findAllByQueryWithTwoArguments('userId', $id, 'archived', $archived);
    if(count($calculators) > 0) { ?>
        <div class="calculator-wrapper d-flex gap-m wrap">
        <?php
         foreach($calculators as $row) { 
        ?> 
            <div class="calculator card">
            <!-- promijeniti width sa slike -->
            <div class="card-body text-center">
                <img src="images/calculator.svg" width="200px" alt="calculator" class="calculator__image">

                <h3 class="calculator__heading">
                    <a href="<?php echo 'calculator_redirect/' .  $row['id']; ?>">
                        <?php echo $row['name']; ?>
                    </a>
                </h3>
                <span class="calculator__date d-block mb-xs"><?php $time = strtotime($row['date']); echo date('d-m-Y H:i', $time) ; ?></span>
                <a href="<?php base(); ?>include/restore_calculator.inc.php?id=<?php echo $row['id']; ?>" class="btn btn-info w-100">Restore</a>
            </div>
            </div>
    <?php } ?>
        </div>
    <?php } else { ?>
        <p>You don't have any calculator in your archive...</p>
    <?php } ?>
    
</div>
</div>
</main>

