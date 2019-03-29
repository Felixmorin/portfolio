<?php
error_reporting(E_ALL);
include 'acces.php';

session_start();
require_once('database.php');


if(isset($_POST) && !empty($_FILES['image']['name']) && !empty($_POST['title'])){


	$name = $_FILES['image']['name'];
	list($txt, $ext) = explode(".", $name);
	$image_name = time().".".$ext;
	$tmp = $_FILES['image']['tmp_name'];


	if(move_uploaded_file($tmp, '/uploads/'.$image_name)){

        $pdo = Database::connect();
        $sql = "INSERT INTO image_gallery (id,title,image) values(?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($_POST['title'],$image_name));
        Database::disconnect();

		$_SESSION['success'] = 'Image Uploaded successfully.';
		header("Location: http://localhost:8888");
	}else{
		$_SESSION['error'] = 'image uploading failed';
		header("Location: http://localhost:8888");
	}
}else{
	$_SESSION['error'] = 'Please Select Image or Write title';
	header("Location: http://localhost:8888");
}


?>