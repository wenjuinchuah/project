<?php
if (isset($_POST['edit'])) {
    $id = $_POST["editID"];
    $editName = $_POST['editName'];
    $editPrice = $_POST['editPrice'];
    $editStock = $_POST['editStock'];
    //product pic validation
    $boolNewPic = true; //, value='true' if user chose a new product pic
    $editPicture = $_FILES['editPicture']['name'];
    $target_dir = "../productPic/";
    $target_file = basename($_FILES['editPicture']['name']);
    $target_path = $target_dir.$target_file;
    $imageFileType = strtolower(pathinfo($target_path,PATHINFO_EXTENSION));

    if (empty($_POST['editName'])) {
        $editNameError = "Product Name cannot be blank!";
        $showError = 'visible';
    }
    if (empty($_POST['editPrice'])) {
        $editPriceError = "Price cannot be blank!";
        $showError = 'visible';
    }
    if (empty($_POST['editPrice'])){
        $editStockError = "Stock cannot be blank!";
        $showError = 'visible';
    }
    if(empty($_FILES["editPicture"]["name"])){
        //if user didn't choose a picture, use the original pic name
        $editPicture = $_POST['oriPic'];
        $boolNewPic = false;
    }else{
        //validate fake/real image
        $check = getimagesize($_FILES["editPicture"]["tmp_name"]);
        if($check === false){
            $editPicError = "File is not an image.";
            $showError = 'visible';
        } //Check file size
        else if($_FILES["editPicture"]["size"] > 500000){
            $editPicError = "File size too large.";
            $showError = 'visible';
        } //Allow certain file formats
        else if(!in_array($imageFileType,["jpg","jpeg","png"])){
            $editPicError = "Only JPG,JPEG,PNG allowed.";
            $showError = 'visible';
        } //Delete old file with same name
        else if(file_exists($target_path)){
            unlink($target_path);
        }
    }

    if (empty($editNameError) && empty($editPriceError) && empty($editStockError) && empty($editPicError)) {
        if($boolNewPic == true){
            move_uploaded_file($_FILES["editPicture"]["tmp_name"],$target_path);
        } 
        
        $sql = "UPDATE products SET Name='$editName', Price='$editPrice',Stock='$editStock',image='$editPicture' WHERE ID='$id'";
        if (mysqli_query($conn, $sql) === TRUE) {
            header('Location: dashboard.php');
        }else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }   
    } else{
        $editView = "block";
    }
} 
?>