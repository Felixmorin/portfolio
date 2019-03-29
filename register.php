<?php

require_once 'database.php';

 if ( !empty($_POST)) {
        // keep track validation errors
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
            $user_nameError = 'Please enter your name';
            $valid = false;
        }
        
        $valid = true;
        if (empty($user_email)) {
            $user_emailError = 'Please enter a email';
            $valid = false;
        }
        
        $valid = true;
        if (empty($user_pass)) {
            $user_passError = 'Please enter a password';
            $valid = false;
        }
         
        
        
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $sql = "INSERT INTO users (user_name, user_email, user_pass) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($user_name,$user_email,$user_pass));
            Database::disconnect();
            header("Location: admin.php");
        }

    }     
?>

<!DOCTYPE html>
<html>
<head>
  <title>Create your account</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div class="header">
  	<h2 style="text-align:center;">Register</h2>
  </div>
	
  <form method="post" action="register.php">
    
     <div class="input-group <?php echo !empty($user_nameError)?'error':'';?>">
        <label>Name</label>
            <input  type="name" name="user_name"  placeholder="Name" value="<?php echo !empty($user_name)?$user_name:'';?>">
                <?php if (!empty($user_nameError)): ?>
                    <span class="help-inline"><?php echo $user_nameError;?></span>
                        <?php endif; ?>
                            </div>
                          
      <div class="input-group <?php echo !empty($user_emailError)?'error':'';?>">
        <label>Email</label>
            <input  type="email" name="user_email"  placeholder="Email" value="<?php echo !empty($user_email)?$user_email:'';?>">
                <?php if (!empty($user_emailError)): ?>
                    <span class="help-inline"><?php echo $user_emailError;?></span>
                        <?php endif; ?>
                            </div>
      
        <div class="input-group <?php echo !empty($user_passError)?'error':'';?>">
            <label>Password</label>
                <input type="password" name="user_pass"  placeholder="Password" value="<?php echo !empty($user_pass)?$user_pass:'';?>">
                    <?php if (!empty($user_passError)): ?>
                        <span class="help-inline"><?php echo $user_passError;?></span>
                            <?php endif; ?>
                                </div>
      
  	     <div class="input-group">
  	         <button type="submit" class="btn btn-success">Register</button>
             <a style="margin-left:10px;" class="btn" href="user.php">Back</a>
  	     </div>
  </form>
</body>
</html>






















