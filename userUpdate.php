<?php
include 'acces.php';

    require_once 'database.php';
 
    $id = null;
    if ( !empty($_REQUEST['user_id'])) {
        $id = $_REQUEST['user_id'];
    }
     
    if ( null==$id ) {
        header("Location: user.php");
    }
     

    if ( !empty($_POST)) {
        $user_nameError = null;
        $user_emailError = null;
        $user_passError = null;
         
        // keep track post values
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_pass = password_hash($_POST['user_pass'], PASSWORD_DEFAULT);
        
        
        // validate input
        $valid = true;
        if (empty($user_name)) {
            $user_nameError = 'Please enter Name';
            $valid = false;
        }
        
        if (empty($user_email)) {
            $user_emailError = 'Please enter email';
            $valid = false;
        }
        
    
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if(isset($_POST['user_pass'])&&!empty($_POST['user_pass'])){
                $sql = "UPDATE users SET user_name = ?, user_email = ?, user_pass = ? WHERE user_id = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($user_name,$user_email,$user_pass,$id));
            }else{
                $sql = "UPDATE users SET user_name = ?, user_email = ? WHERE user_id = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($user_name,$user_email,$id));
            }    
            Database::disconnect();
            header("Location: user.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $user_name = $data['user_name'];
        $user_email = $data['user_email'];
        $user_pass = $data['user_pass'];
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
                        <h3>Update User</h3>
                    </div>
             
                    <form class="form-horizontal" action="userUpdate.php" method="post">
                        
                        
                    <div class="control-group <?php echo !empty($user_nameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input type="text" name="user_name" placeholder="Name" value="<?php echo !empty($user_name)?$user_name:'';?>">
                            <?php if (!empty($user_nameError)): ?>
                                <span class="help-inline"><?php echo $user_nameError;?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                        
                    <div class="control-group <?php echo !empty($user_emailError)?'error':'';?>">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input type="text" name="user_email" placeholder="Email" value="<?php echo !empty($user_email)?$user_email:'';?>">
                            <?php if (!empty($user_emailError)): ?>
                                <span class="help-inline"><?php echo $user_emailError;?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                        
                    <div class="control-group <?php echo !empty($user_passError)?'error':'';?>">
                        <label class="control-label">Password</label>
                        <div class="controls">
                            <input type="text" name="user_pass" placeholder="Password" value="<?php !empty($user_pass)?$user_pass:''; ?>">
                            <?php if (!empty($user_passError)): ?>
                                <span class="help-inline"><?php echo $user_passError;?></span>
                            <?php endif; ?> 
                        </div>
                    </div>
                      
                    <input type="hidden" value="<?php echo $id?>" name="user_id"/>
                      <div class="form-actions">
                          <button style="margin-top:10px;" type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="user.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>