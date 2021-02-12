<?php 
    session_start();
    if(!isset($_SESSION['id'])) {
        header('Location: ../login');
        exit();
    }

    if(isset($_GET['id'])) {
        require_once('autoloader.php');
        $id = $_GET['id'];
        $key = 'id';
        Validate::validateString($key, $id);
        $error = Message::getError();
        if($error) {
            echo json_encode($error);
            exit();
        }
        $id = Sanitize::sanitizeString($id);
        $args = Calculator::findById($id);
        if($args['userId'] != $_SESSION['id']) {
            header('Location: ../login');
            exit();
        }
        $args['defaultCalculators'] = '0';
        $calculator = new Calculator($args);
        //update calculator default column
        $calculator->save();
        header('Location: ../calculators');
        exit();
    } else {
        header('Location: ../calculator');
        exit();
    }