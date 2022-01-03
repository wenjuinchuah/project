<?php
session_start();
include "../validation/connectSQL.php";
include '../validation/loginValidation.php';

$target_dir = "../userpic/";
$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
$uploadOK = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//Check if image file is a actual image or fake image

if(isset($_POST["submit"])){
	if(empty($_FILES["fileToUpload"]["name"])){
		echo "No file is chosen. ";
		$uploadOk = 0;
	} else{	
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check === false){
			echo "File is not a image.";
			$uploadOK = 0;
		}
		//Check file size
		else if($_FILES["fileToUpload"]["size"] > 500000){
			echo "Sorry, your file is too large.";
			$uploadOK = 0;
		}
		//Allow certain file formats
		else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ){
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOK = 0;
		}
	}
}
//Check if file already exists 
/*
if(file_exists($target_file)){
	echo "Sorry, file already exists.";
	$uploadOK = 0;
}
*/

//Check if $uploadOK is set to 0 by an error
if($uploadOK == 0){
	echo "Sorry, your file was not uploaded.";
//if everything is ok, try to upload file
}else{

    //fetch id for naming purposes
    $sql = "SELECT UserID FROM user WHERE Email='$loginUsername'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);

	//change picture name to help organize
	$temp = explode(".", $_FILES["fileToUpload"]["name"]);
	$newfilename = $row[0].'.'.end($temp);

	if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_dir.$newfilename)){
		echo "The file".basename($_FILES["fileToUpload"]["name"])." has been uploaded.";
		$path = $newfilename;
		$sql = "UPDATE user SET pic_path='$path' WHERE Email='$loginUsername'";
		mysqli_query($conn, $sql);
        header("Location: userProfile.php");
	}else{
		echo "Sorry, there was an error uploading your file.";
	}
}
?>