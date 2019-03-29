<?php

include 'acces.php';

    require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: posts.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM projet where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
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
                        <h3>Read</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">type</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['type'];?>
                            </label>
                        </div>
                      </div>
                        <br/>
                      <div class="control-group">
                        <label class="control-label">Titre</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['titre'];?>
                            </label>
                        </div>
                      </div>
                        <br/>
                      <div class="control-group">
                        <label class="control-label">Sous-titre</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['sous_titre'];?>
                            </label>
                        </div>
                      </div>
                        <br/>
                        <div class="control-group">
                        <label class="control-label">Image</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['image'];?>
                            </label>
                        </div>
                      </div>
                        <br/>
                        <div class="form-actions">
                          <a class="btn" href="posts.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>