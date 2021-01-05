<?php
    session_start();
    session_unset();
    unset($_SESSION['id']);
    header('Location: ../index');
?>