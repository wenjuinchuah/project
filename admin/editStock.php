<?php

$action = $_REQUEST['action'];
$id = $_REQUEST['id'];

include '../validation/connectSQL.php';

if($conn){
    if($action == 'add'){
        $sql = "UPDATE products SET Stock=Stock+1 WHERE ID=$id";
        mysqli_query($conn, $sql);
    }else if($action == 'minus'){
        $sql = "SELECT Stock FROM products WHERE ID=$id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($result);
        if($row[0] == 0){
            echo "<div style='border: 2px solid black; background: white; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%)'>
                    <h1 onclick='this.remove()'>The stock cannot be less than 0!</h1>
                </div>";
        }else{
            $sql = "UPDATE products SET Stock=Stock-1 WHERE ID=$id";
            mysqli_query($conn, $sql);  
        }
    }

    $sql = "SELECT Stock FROM products WHERE ID=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    echo $row[0];
}
?>