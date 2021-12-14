<?php
    include '../index.php';
    session_destroy();
    header("location: ../index.php");
?>