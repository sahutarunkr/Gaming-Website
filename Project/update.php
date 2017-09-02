<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
}

$con = mysqli_connect("localhost", "root", "root", "project");
$imgData = addslashes(file_get_contents($_FILES['fileToUpload']['tmp_name']));
$imageProperties = getimageSize($_FILES['fileToUpload']['tmp_name']);
$sql = "UPDATE product SET ";
if(!empty($_POST['ProductName'])){
	$sql .= "productName = '".$_POST['ProductName']."', ";
}
if(!empty($_POST['Category'])){
	$sql .= "category = '".$_POST['Category']."', ";
}
if(!empty($_POST['Description'])){
	$sql .= "description = '".$_POST['Description']."', ";
}
if(!empty($_POST['Price'])){
	$sql .= "price = ".$_POST['Price'].", ";
}
if($uploadOk == 1){
	$sql .= "image = '{$imgData}', ";
}
if($_POST['addBack'] == on){
	$sql .= "is_deleted = 0, ";
}

$sql = substr($sql, 0, -2);
$sql .= " WHERE productID = ".$_POST['ProductID'];
mysqli_query($con, $sql);
header("Location: Homepage.php");
?>