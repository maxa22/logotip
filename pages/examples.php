<?php
    //  rendering example calculators 
        require_once('include/autoloader.php');
?>
<body>
<?php if(isset($_SESSION['id'])) { ?>
<main>
<?php } else { ?>
<main class="m-auto">
<?php } ?>
<div class="main__heading">
    <h1>Examples</h1>
</div>
<?php 
    $archived = '0';
    $default = '1';
    $calculators = Calculator::findAllByQueryWithTwoArguments('archived', $archived, 'defaultCalculators', $default);
    if(count($calculators) > 0) { ?>
        <div class="calculator-wrapper d-flex gap-m wrap m-column">
        <?php foreach($calculators as $row) { ?>
            <div class="calculator card w-25-gap-m l-w-50-gap-m m-w-100">
                <div class="card-body text-center">
                    <img src="images/calculator.svg" alt="calculator" class="w-100">
                    <h3 class="mb-s"><?php echo $row['name']; ?></h3>
                    <p class="intro__paragraph mb-s"><?php echo $row['calculatorText']; ?></p>
                    <a class="btn btn-primary" href="calculator_render/<?php echo $row['id']; ?>">Check it out</a>
                </div>
            </div>
    <?php } ?>
        </div>
    <?php } else { ?>
        <p>No default calculators selected by admin...</p>
    <?php } ?>
    
</div>
</main>
