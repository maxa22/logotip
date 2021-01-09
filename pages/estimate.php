<?php 
if(!isset($_GET['id'])) {
    header('Location: ../index');
    exit();
} else {
    require_once('include/autoloader.php');
    $id = $_GET['id'];
    $validate = new Validate;
    $key = 'id';
    $validate->validateString($key, $id);
    if(Message::getError()) {
        header('Location: ../index');
        exit();
    }
    $id = Sanitize::sanitizeString($id);
    $sql = "SELECT * FROM calculator WHERE id = ?";
    $calculator = DatabaseObject::findById($sql, $id);
}
?>

<?php if(isset($_SESSION['id'])) { ?>
<main style="background-color: #<?php echo $calculator['backgroundColor']; ?>; color: #<?php echo $calculator['color']; ?> ">
<?php } else { ?>
<main class="m-auto" style="background-color: #<?php echo $calculator['backgroundColor']; ?>; color: #<?php echo $calculator['color']; ?> ">
<?php } ?>
    <div class="hero">
        <div class="m-auto mb-m p-s text-center estimate">
            <h1 class="text-t-upper">your estimate <span><?php echo $_COOKIE['price'] . ' ' . $calculator['currency'] ?></span></h1>
        </div>
        <div class="m-auto p-s estimate">
            <p><?php echo $calculator['estimateText'] ; ?></p>
        </div>
    </div>
</main>
<script src="<?php base(); ?>javascript/check_iframe.js"></script>
<?php if(isset($_SESSION['id'])) { ?>
<script src="<?php base(); ?>javascript/sidebar_toggle.js"></script>
<?php } ?>