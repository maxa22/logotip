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
$calculators = Calculator::findAllByQuery('userId', $id, 'DESC');

?>

<body>
<main>
<div class="hero">
<div class="mt-s mb-xm text-center">
    <h1>Filled out calculator forms</h1>
</div>

<select name="calculator" id="calculator" class="form__input w-50 mb-m m-w-100">
  <option value="">Choose calculator</option>
  <?php foreach($calculators as $calculator) {?>
    <option value="<?php echo $calculator['id'] ?>"><?php echo $calculator['name'] ?></option>
  <?php } ?>
</select>
<div id="statistics"></div>
<div class="calculator-wrapper d-flex gap-m wrap m-flex-column" id="result">
</div>
</div>
</div>
</main>

