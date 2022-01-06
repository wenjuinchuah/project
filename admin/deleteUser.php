<?php
if(isset($_POST['deleteUser'])){
    $id = $_POST['deleteID'];

    $sql = "DELETE FROM user WHERE userID='$id'";
    if (mysqli_query($conn, $sql) === TRUE) {
        header('Location: user.php');
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }   
}
?>