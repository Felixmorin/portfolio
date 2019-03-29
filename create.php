<?php
@ini_set('display_errors', 'on');
include 'acces.php';

error_reporting(E_ALL);
require_once'database.php';

    if ( !empty($_POST)) {
        // keep track validation errors
        $typeError = null;
        $titreError = null;
        $sous_titreError = null;
        $imageError = null;

        // keep track post values
        $type = $_POST['type'];
        $titre = $_POST['titre'];
        $sous_titre = $_POST['sous_titre'];
        $image = $_POST['image'];
        
        // validate input
        $valid = true;
        if (empty($type)) {
            $typeError = 'Please enter a valid type';
            $valid = false;
        }
        
        $valid = true;
        if (empty($titre)) {
            $titreError = 'Please enter a valid titre';
            $valid = false;
        }
        
        $valid = true;
        if (empty($sous_titre)) {
            $sous_titreError = 'Please enter a valid sous_titre';
            $valid = false;
        }
         
        if (empty($image)) {
            $imageError = 'Please enter a valid image';
            $valid = false;
        }
        
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $sql = "INSERT INTO projet (type, titre, sous_titre, image) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($type,$titre,$sous_titre,$image));
            Database::disconnect();
            header("Location: posts.php");
        }
    }     
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Add item to projet</h3>
                    </div>
             
                    <form class="form-horizontal" action="create.php" method="post">
                        
                        <div class="control-group <?php echo !empty($typeError)?'error':'';?>">
                        <label class="control-label">Type</label>
                        <div class="controls">
                            <input  type="text" name="type"  placeholder="Type" value="<?php echo !empty($type)?$type:'';?>">
                            <?php if (!empty($typeError)): ?>
                                <span class="help-inline"><?php echo $typeError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                        
                        <div class="control-group <?php echo !empty($titreError)?'error':'';?>">
                        <label class="control-label">Titre</label>
                        <div class="controls">
                            <input type="text" name="titre" placeholder="Titre" value="<?php echo !empty($titre)?$titre:'';?>">
                            <?php if (!empty($titreError)): ?>
                                <span class="help-inline"><?php echo $titreError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                        
                        <div class="control-group <?php echo !empty($sous_titreError)?'error':'';?>">
                        <label class="control-label">Sous-titre</label>
                        <div class="controls">
                            <input type="text" name="sous_titre" placeholder="Sous-titre" value="<?php echo !empty($sous_titre)?$sous_titre:'';?>">
                            <?php if (!empty($sous_titreError)): ?>
                                <span class="help-inline"><?php echo $sous_titreError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                        
                         <div class="control-group <?php echo !empty($imageError)?'error':'';?>">
                        <label class="control-label">Image</label>
                        <div class="controls">
                            <input type="text" name="image" placeholder="Image" value="<?php echo !empty($image)?$image:'';?>">
                            <?php if (!empty($imageError)): ?>
                                <span class="help-inline"><?php echo $imageError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                        
                      <div style="margin-top:10px;" class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="posts.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>