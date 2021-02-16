<?php
    session_start();
    if(!isset($_SESSION['id'])) {
        header('Location: ../login');
        exit();
    }
 
    require_once('autoloader.php');

    if(isset($_GET['id'])) {
      $id = Sanitize::sanitizeString($_GET['id']);
      Validate::validateNumber('id', $id);
      $error = Message::getError();
      if($error) {
        echo json_encode($error);
        exit();
      }
      $calculator = Calculator::findById($id);
      if($calculator['userId'] != $_SESSION['id']) {
        header('Location: ../calculator_users');
        exit();
      }
      $steps = Step::findAllByQuery('calculatorId', $calculator['id']);
      $calculatorUsers = CalculatorUser::findAllByQuery('calculatorId', $calculator['id'], 'DESC');
      if(empty($calculatorUsers)) {
        echo json_encode('');
        exit();
      }
      $calculatorUserCount = CalculatorUser::countRows('calculatorId', $calculator['id']);
      $form = '1';
      $calculatorUserForms = CalculatorUser::findAllByQueryWithTwoArguments('calculatorId', $calculator['id'], 'form', $form);
      if(!empty($calculatorUserForms)) {
        $calculatorUserFormsCount = count($calculatorUserForms);
      } else {
        $calculatorUserFormsCount = 0;
      }
      $calculatorUserNoFormCount = $calculatorUserCount - $calculatorUserFormsCount;
      $total = 0;
      $totalNoForm = 0;
      $totalForm = 0;
      for($i = 0; $i < count($calculatorUsers);$i++) {
        $calculatorUsers[$i]['calculatorName'] = $calculator['name'];
        if($calculatorUsers[$i]['form'] == '0') {
          $userName = User::findById($calculatorUsers[$i]['userId']);
          if(!empty($userName)) {
            $calculatorUsers[$i]['userName'] = $userName['name'];
          } else {
            $calculatorUsers[$i]['userName'] = 'Unregistered user';
          }
        }

        $choosenOptions = explode(',', $calculatorUsers[$i]['choosenOptions']);
        $price = 0;

        for($j = 0; $j < count($steps); $j++) {
          $calculatorUsers[$i]['steps'][$j]['name'] = $steps[$j]['name'];
          $choosenOption = Option::findById($choosenOptions[$j]);
          $calculatorUsers[$i]['steps'][$j]['option'] = $choosenOption['name'];
          $calculatorUsers[$i]['steps'][$j]['price'] = $choosenOption['price'];
          $price += $choosenOption['price'];
        }
        if($calculatorUsers[$i]['form'] == '0') {
          $totalNoForm += $price;
        } else {
          $totalForm += $price;
        }
        $calculatorUsers[$i]['estimate'] = $price;
        $calculatorUsers[$i]['currency'] = $calculator['currency'];
        $total += $price;
      }
      if($calculatorUserNoFormCount) {
        $averageEstimateNoForm = $totalNoForm / $calculatorUserNoFormCount;
      } else {
        $averageEstimateNoForm = 0;
      }
      if($calculatorUserFormsCount) {
        $averageEstimateForm = $totalForm / $calculatorUserFormsCount;
      } else {
        $averageEstimateForm = 0;
      }
      $averageEstimate = $total / $calculatorUserCount;

      $calculatorUsers[$i]['total'] = sprintf('%0.2f', $total);
      $calculatorUsers[$i]['totalWithNoForm'] = sprintf('%0.2f', $totalNoForm);
      $calculatorUsers[$i]['totalWithForm'] = sprintf('%0.2f', $totalForm);
      $calculatorUsers[$i]['averageEstimateWithNoForm'] = sprintf('%0.2f', $averageEstimateNoForm);
      $calculatorUsers[$i]['averageEstimateWithForm'] = sprintf('%0.2f', $averageEstimateForm);
      $calculatorUsers[$i]['averageEstimate'] = sprintf('%0.2f', $averageEstimate);
      $calculatorUsers[$i]['count'] = $calculatorUserCount;
      $calculatorUsers[$i]['countWithNoForm'] = $calculatorUserNoFormCount;
      $calculatorUsers[$i]['countWithForm'] = $calculatorUserFormsCount;
      $calculatorUsers[$i]['currency'] = $calculator['currency'];
      
      $dateCalculatorLastUsed = CalculatorUser::findAllWithOffset('calculatorId', $id, 1, 0);
      $dateCalculatorLastUsed = strtotime($dateCalculatorLastUsed[0]['date']);
      $dateCalculatorLastUsed = date('d.m.Y', $dateCalculatorLastUsed);
      $calculatorUsers[$i]['date'] = $dateCalculatorLastUsed;

      echo json_encode($calculatorUsers);
      exit();
    } else {
      header('Location: ../calculator_users');
      exit();
    }