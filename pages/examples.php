<?php
    //  rendering example calculators 
        require_once('include/autoloader.php');
?>


<main>
<div class="main__heading">
    <h1>Examples</h1>
</div>
<?php 
    $sql = "SELECT * FROM calculator WHERE defaultCalculators = '1' AND archived = ?";
    $archived = '0';
    $calculators = DatabaseObject::findAllByQuery($sql, $archived);
    if(count($calculators) > 0) { ?>
        <div class="calculator-wrapper d-flex gap-m f-wrap">
        <?php foreach($calculators as $row) { ?>
            <div class="calculator card">
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
