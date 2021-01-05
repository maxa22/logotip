<?php
    session_start();
    if(!isset($_SESSION['id'])) {
        header('Location: ../login');
        exit();
    }
    if(isset($_GET['id'])) {
        require_once('autoloader.php');
        
        $id = $_GET['id'];
        $calculatorId = $_GET['calculator_id'];
        $validate = new Validate;
        $key = 'id';
        $validate->validateString($key, $id);
        $validate->validateString($key, $calculatorId);
        $id = Sanitize::sanitizeString($id);
        $calculatorId = Sanitize::sanitizeString($calculatorId);
        $error = Message::getError();
        if($error) {
            header('Location: ../edit/' . $calculatorId);
            exit();
        }
        $sql = "SELECT * FROM step WHERE id = ?;";
        $stepToDelete = DatabaseObject::findById($sql, $id);
        $step = new Step($stepToDelete);
        $sql = "SELECT * FROM options WHERE stepId = ?";
        $optionsToDelete = DatabaseObject::findAllByQuery($sql, $stepToDelete['id']);
        foreach($optionsToDelete as $optionToDelete) {
            $option = new Option($optionToDelete);
            $option->delete();
            if(file_exists('../images/' . $option->image) && $option->image) {
                unlink('../images/' . $option->image);
            }
        }
        $step->delete();
        header('Location: ../edit/' . $calculatorId);
        exit();
    } else {
        header('Location: ../index');
        exit();
    }