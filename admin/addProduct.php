<?php
    include '../validation/connectSQL.php';
    session_start();

    $productName = $_SESSION['productName'];
    $productPrice = $_SESSION['productPrice'];
    $productStock = $_SESSION['productStock'];
    $productPicture = $_FILES["productPicture"]["name"];
    $tempPic = $_FILES['productPicture']['tmp_name'];

    if(move_uploaded_file($tempPic,$target_path)){
        $sql = "INSERT INTO products (Name, Price, Stock, image) VALUES ('$productName', '$productPrice','$productStock','$productPicture')";
        if (mysqli_query($conn, $sql) === TRUE) {
            header('Location: dashboard.php');
        }else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }   
    } else{
        echo "Sorry, there was an error uploading your file.";
    }

    // $sql = "INSERT INTO products (Name, Price, Stock) VALUES ('$productName', '$productPrice','$productStock')";

    // if (mysqli_query($conn, $sql) === TRUE) {
    //     header('Location: dashboard.php');
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }
?>