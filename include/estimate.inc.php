<?php
    // - calculating the price of the options choosen by the user
    // - updating status of the step, and status of the choosen option in matching database tables and rows
    // - storing the price in a cookie and displaying it to user

    session_start();
    if(isset($_POST['submit'])) {
    // getting the prices of the selected radio inputs, calculating them and storing in price variable
    require_once('autoloader.php');
    $price = 0;
    $steps = array();
    $choosenOptions = array();
    foreach($_POST as $key => $value) {
        if(strpos($key, 'answer')) {
            // validate and sanitize input
            $id = Sanitize::sanitizeString(explode('-', $value)[2]);
            $stepId = Sanitize::sanitizeString(explode('-', $value)[0]);
            Validate::validateString($key, $id);
            Validate::validateString($key, $stepId);

            $option = Option::findById($id);
            array_push($choosenOptions, $option);

            $step = Step::findById($stepId);
            array_push($steps, $step);
            $price += $option['price'];
        }
    }

    $error = Message::getError();
    if($error) {
        header('Location: ../index');
        exit();
    }

    //updating all stepStatus fields from used steps
    foreach($steps as $stepArguments) {
        $stepArguments['stepStatus'] = '1';
        $step = new Step($stepArguments);
        $step->save();
    }
    //updating all optionStatus fields that are selected
    foreach($choosenOptions as $optionArguments) {
        $optionArguments['optionStatus'] = '1';
        $option = new Option($optionArguments);
        $option->save();
    }


    setcookie('price', $price, time() + (86400 * 30), '/');
    $calculatorUserArgs['choosenOptions'] = '';
    for($i = 0; $i < count($choosenOptions); $i++) {
        if($i + 1 == count($choosenOptions)) {
            $calculatorUserArgs['choosenOptions'] .= $choosenOptions[$i]['id'];
        } else {
            $calculatorUserArgs['choosenOptions'] .= $choosenOptions[$i]['id'] . ',';
        }
    }
    $calculatorUserArgs['userId'] = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
    $calculatorUserArgs['calculatorId'] = $step->calculatorId;

    $calculatorUser = new CalculatorUser($calculatorUserArgs);
    $calculatorUser->save();

    header('Location: ../estimate/' . $step->calculatorId);
    exit();
    } else {
        header('Location: index');
        exit();
    }
?>