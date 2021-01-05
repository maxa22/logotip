<?php 
    session_start();
    if(!isset($_SESSION['id'])) {
        header('Location: ../login');
        exit();
    }

    if(isset($_GET['id'])) {
        require_once('autoloader.php');
        $id = $_GET['id'];
        $validate = new Validate;
        $key = 'id';
        $validate->validateString($key, $id);
        $error = Message::getError();
        if($error) {
            echo json_encode($error);
            exit();
        }
        $id = Sanitize::sanitizeString($id);
        $sql = "SELECT * FROM calculator WHERE id = ?";
        $args = DatabaseObject::findById($sql, $id);
        if($args['userId'] != $_SESSION['id']) {
            header('Location: ../login');
            exit();
        }
        $args['archived'] = '0';
        $calculator = new Calculator($args);
        $calculator->updateRow();
        header('Location: ../archive');
        exit();
    } else {
        header('Location: ../calculator');
        exit();
    }