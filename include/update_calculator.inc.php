<?php
    session_start();
    if(!isset($_SESSION['id'])) {
        header('Location: ../login');
        exit();
    }
 
    require_once('autoloader.php');

    if(isset($_POST['submit'])) {
       
        foreach($_POST as $key => $value) {
            if(strpos($key, 'calculatorName')) {
                $args['id'] = explode('-', $key)[0];
                $args['name'] = $value;
                break;
            }
        }
        $args['estimateText'] = $_POST['estimateText'];
        $args['heading'] = $_POST['heading'];
        $args['calculatorText'] = $_POST['calculatorText'];
        $args['button'] = $_POST['button'];
        $args['backgroundColor'] = substr($_POST['backgroundColor'], 1);
        $args['color'] = substr($_POST['color'], 1);
        $args['currency'] = $_POST['currency'];
        $args['userId'] = $_SESSION['id']; 
        
        $validate = new Validate;
        
        foreach($args as $key => $value) {
            $validate->validateString($key, $args[$key]);
            $args[$key] = Sanitize::sanitizeString($value);
        }
        $args['logo'] = 'logo';
        $validate->validateFile($args['logo'], 'logo');
        $error = Message::getError();
        if($error) {
            echo json_encode($error);
            exit();
        }
        // get old logo if user doesn't upload new logo
        $sql = "SELECT * FROM calculator WHERE id = ?";
        $calculatorToBeupdated = DatabaseObject::findById($sql, $args['id']);
        if($_FILES['logo']['error'] == 4) {
            $args['logo'] = $calculatorToBeupdated['logo'];
        } else {
            unlink('../images/' . $calculatorToBeupdated['logo']);
        }
        $calculator = new Calculator($args);
        $calculator->save();
        $error = Message::getError();
        if(!$error) {
            $_SESSION['calculatorId'] = $calculator->getId();
        } 
        echo json_encode($error);
        exit();
    } else {
        header('Location: ../calculators');
        exit();
    }
?>