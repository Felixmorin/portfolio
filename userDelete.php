<?php
include 'acces.php';

    require_once 'database.php';
    $id = 0;
     
    if ( !empty($_GET['user_id'])) {
        $id = $_REQUEST['user_id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['user_id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM users WHERE user_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: user.php");
         
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
                        <h3>Delete a user</h3>
                    </div>
                     
                    <form class="form-horizontal" action="userDelete.php" method="post">
                      <input type="hidden" name="user_id" value="<?php echo $id;?>"/>
                      <p class="alert alert-error">Are you sure to delete ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="user.php">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>