<?php
include 'acces.php';

    require_once 'database.php';
 
    $id = null;
    if ( !empty($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: posts.php");
    }
     

    if ( !empty($_POST)) {
        // keep track validation errors
        $headerError = null;
        $sorteError = null;
        //$categoryError = null;
        $nomError = null;
        $descriptionError = null;
        $priceError = null;
         
        // keep track post values
        $header = $_POST['header'];
        $sorte = $_POST['sorte'];
        //$category = $_POST['category'];
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $price = $_POST['price'];
         
        // validate input
        $valid = true;
        if (empty($header)) {
            $headerError = 'Please enter header';
            $valid = false;
        }
        
        if (empty($sorte)) {
            $sorteError = 'Please enter sorte';
            $valid = false;
        }
        
        /*if (empty($category)) {
            $categoryError = 'Please enter Category';
            $valid = false;
        }*/
         
        if (empty($nom)) {
            $nomError = 'Please enter nom';
            $valid = false;
        }
         
        if (empty($description)) {
            $descriptionError = 'Please enter description';
            $valid = false;
        }
        
        if (empty($price)) {
            $categoryError = 'Please enter Price';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE menu SET header = ?, sorte = ?, nom = ?, description = ?, price = ? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($header,$sorte,$nom,$description,$price,$id));
            Database::disconnect();
            header("Location: posts.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM menu where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $header = $data['header'];
        $sorte = $data['sorte'];
        //$category = $data['category'];
        $nom = $data['nom'];
        $description = $data['description'];
        $price = $data['price'];
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
                        <h3>Update Menu item</h3>
                    </div>
             
                    <form class="form-horizontal" action="update.php" method="post">
                        
                     <div class="control-group <?php echo !empty($headerError)?'error':'';?>">    
                    <label class="control-label">Header</label>
                    <div class="controls">
                    <select name="header">
                            <option value="">...</option>
                            <option value="Menu" <?php echo !empty($header)&&$header=='Menu'?selected:'';?>>Menu</option>
                            <option value="Vin" <?php echo !empty($header)&&$header=='Vin'?selected:'';?>>Vins &amp; Bières</option>
                    </select>
                    <?php if (!empty($headerError)): ?><span class="help-inline"><?php echo $headerError;?></span><?php endif; ?>
                    </div>    
                    </div>        
                        
                    <div class="control-group <?php echo !empty($sorteError)?'error':'';?>">    
                    <label class="control-label">Sorte</label>
                    <div class="controls">
                    <select name="sorte">
                            <option value="">...</option>
                            <option value="1" <?php echo !empty($sorte)&&$sorte=='1'?selected:'';?>>Entrée</option>
                            <option value="3" <?php echo !empty($sorte)&&$sorte=='3'?selected:'';?>>Plat principal</option>
                            <option value="4" <?php echo !empty($sorte)&&$sorte=='4'?selected:'';?>>Dessert</option>
                            <option value="5" <?php echo !empty($sorte)&&$sorte=='5'?selected:'';?>>Breuvage</option>
                            <option value="7" <?php echo !empty($sorte)&&$sorte=='7'?selected:'';?>>Vin</option>
                            <option value="6" <?php echo !empty($sorte)&&$sorte=='6'?selected:'';?>>Bières</option>
                    </select>
                    <?php if (!empty($sorteError)): ?><span class="help-inline"><?php echo $sorteError;?></span><?php endif; ?>
                    </div>    
                    </div>  
                        
                          <div class="control-group <?php echo !empty($nomError)?'error':'';?>">
                        <label class="control-label">Nom</label>
                        <div class="controls">
                            <input type="text" name="nom"  placeholder="Name" value="<?php echo !empty($nom)?$nom:'';?>">
                            <?php if (!empty($nomError)): ?>
                                <span class="help-inline"><?php echo $nomError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                        
                          <div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
                        <label class="control-label">Description</label>
                        <div class="controls">
                            <input type="text" name="description"  placeholder="Description" value="<?php echo !empty($description)?$description:'';?>">
                            <?php if (!empty($descriptionError)): ?>
                                <span class="help-inline"><?php echo $descriptionError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                        
                          <div class="control-group <?php echo !empty($priceError)?'error':'';?>">
                        <label class="control-label">Prix</label>
                        <div class="controls">
                            <input type="text" name="price" placeholder="Price" value="<?php echo !empty($price)?$price:'';?>">
                            <?php if (!empty($priceError)): ?>
                                <span class="help-inline"><?php echo $priceError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      
                    <input type="hidden" value="<?php echo $id?>" name="id"/>
                      <div class="form-actions">
                          <button style="margin-top:10px;" type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="posts.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>