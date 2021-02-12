<!--  rendering user calculators -->
<?php

if(!isset($_SESSION['id'])) {
    session_unset();
    header('Location: login');
    exit();
}
require_once('include/autoloader.php');
$id = $_SESSION['id'];
$archived = '1';
$calculators = Calculator::findAllByQuery('userId', $id);

?>

<body>
<main>
<div class="hero">
<div class="mt-s mb-xm text-center">
    <h1>Filled out calculator forms</h1>
</div>
<?php 

if(count($calculators) > 0) { ?>
    <div class="calculator-wrapper d-flex gap-m wrap m-flex-column">
    <?php
      foreach($calculators as $row) {
        $userCalculator = CalculatorUser::findAllByQuery('calculatorId', $row['id']);
        if(!empty($userCalculator)) {
          foreach($userCalculator as $calculator) {
            $steps = Step::findAllByQuery('calculatorId', $calculator['calculatorId']);
            $calculatorName = Calculator::findById($calculator['calculatorId']);
            $userName = User::findById($calculator['userId']);
            if(empty($userName)) {
              $userName['name'] = 'Unregistered user';
            }
            $choosenOptions = explode(',', $calculator['choosenOptions']);
            $price = 0;
    ?> 
            <div class="calculator card w-25-gap-m l-w-50-gap-m m-w-100">
                  <h2 class="calculator__heading w-100 text-center">
                      <?php echo $calculatorName['name']; ?>
                  </h2>
              <div class="card-body">
                  <h3 class="mb-s">User name:<br><?php echo $userName['name'] ?></h3>
                  <?php for($i = 0; $i < count($steps); $i++) {
                    $choosenOption = Option::findById($choosenOptions[$i]);
                    $j = $i + 1;
                    $price += $choosenOption['price'];
                  ?>
                    <p class="mb-xs"><?php echo $j . '. ' . $steps[$i]['name'] ?></p>
                    <p class="mb-xs">Choosen option: <?php echo $choosenOption['name'] ?></p>
                    <p class="mb-xm">Choosen option price: <?php echo $choosenOption['price'] ?></p>
                  <?php } ?>
                  <p class="mb-xs">Total: <?php echo $price; echo $row['currency'] ?></p>
              </div>
            </div>
          <?php } ?>
        <?php } else { ?>
        <div class="calculator card w-25-gap-m l-w-50-gap-m m-w-100">
                  <h2 class="calculator__heading w-100 text-center">
                      <?php echo $row['name']; ?>
                  </h2>
              <div class="card-body">
          <p>No user has filled out your calculator form...</p>
        </div>
        <?php } ?>
    <?php } ?>
    </div>
<?php } else { ?>
    <p>You haven't created any calculator yet...</p>
<?php } ?>

</div>
</div>
</main>

