<?php
if(isset($_POST['delete'])){
    $id = $_POST['deleteID'];

    $sql = "DELETE FROM products WHERE ID='$id'";
    if (mysqli_query($conn, $sql) === TRUE) {
        header('Location: dashboard.php');
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }   
}
?>