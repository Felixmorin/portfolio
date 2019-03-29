<?php
include 'acces.php';

session_start();
    require_once 'database.php';
 
    $id = null;
    if ( !empty($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: image.php");
    }
     

    if ( !empty($_POST)) {
        // keep track validation errors
        $titleError = null;
        $imageError = null;
        
         
        // keep track post values
        $title = $_POST['title'];
        $image = $_POST['image'];
        
         
        // validate input
        $valid = true;
        if (empty($title)) {
            $titleError = 'Please enter title';
            $valid = false;
        }
        
        if (empty($image)) {
            $imageError = 'Please enter image';
            $valid = false;
        }
        
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE image_gallery set title = ?, image = ? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($title,$image,$id));
            Database::disconnect();
            header("Location: image.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM image_gallery WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $title = $data['title'];
        $image = $data['image'];
        Database::disconnect();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Update a image</h3>
                    </div>
                    
                    <form action="imageUpdate.php" class="form-image-upload" method="POST" enctype="multipart/form-data">


        <div class="row">
            <div class="col-md-5">
                <strong>Title:</strong>
                <input type="text" name="title" class="form-control" placeholder="Title" value="<?php echo !empty($title)?$title:'';?>"/>
                <input type="hidden" name="image" value="<?php echo !empty($image)?$image:'';?>"/>
                <input type="hidden" name="id" value="<?php echo !empty($id)?$id:'';?>"/>
            </div>
            <div class="col-md-2">
                <br/>
                <button type="submit" class="btn btn-success">Update</button>
                <a class="btn" href="image.php">Back</a>
            </div>
        </div>


    </form> 
             
                    
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>