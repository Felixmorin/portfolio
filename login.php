<?php
session_start();

require 'database.php';


if(isset($_POST['login'])) {

    $user_email = $_POST['user_email'];
    $user_pass = $_POST['user_pass'];

    if(empty($user_email) || empty($user_pass)) {
        $message = 'All field are required';
    } else {
    
        $pdo = Database::connect();
        $sql = "SELECT user_email, user_pass FROM users WHERE user_email=?";
        $q = $pdo->prepare($sql);
        $q->execute(array($user_email));
        $row = $q->fetch(PDO::FETCH_BOTH);
        
      
        //print_r($row);

        if($q->rowCount() > 0) {
            if (password_verify($user_pass, $row['user_pass'])) { 
                
                $_SESSION['user_email'] = $user_email;
                $_SESSION['authentified_user'] = true;
                
                

                header('location: admin.php');
            } else { 
                $message = 'Invalid password.'; 
            } 
        } else {
            $message = "Email or Password is wrong";
        }
        Database::disconnect();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Account Login</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/adminStyle.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
  </head>
  <body>

    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">ADMIN</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center"> Félix Morin  <small>Account Login</small></h1>
          </div>
        </div>
      </div>
    </header>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <form id="login" method="post" action="login.php" class="well">
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" name='user_email' class="form-control" placeholder="Enter Email">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name='user_pass' class="form-control" placeholder="Password">
                  </div>
                <?php echo $message; ?>
                  <button type="submit" name="login" class="btn btn-default btn-block">Login</button>
              </form>
          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
      <p>Copyright Félix, &copy; 2019</p>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="scripts/bootstrap.min.js"></script>
  </body>
</html>
