<?php
error_reporting(E_ALL);
require_once 'database.php';

include 'acces.php';


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Dashboard</title>
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
          <ul class="nav navbar-nav">
            <li class="active"><a href="admin.php">Dashboard</a></li>
            <li><a href="posts.php">Projets</a></li>
            <li><a href="image.php">Partenaires</a></li>
            <li><a href="user.php">User</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Welcome</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard <small>Manage Your Site</small></h1>
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="active">Dashboard</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="admin.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <a href="admin.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Dashboard</a>
              <a href="posts.php" class="list-group-item"><span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span> Projets <?php
                   $pdo = Database::connect();
                   $sql = 'SELECT count(id) as count FROM projet'; 
                   
                   foreach ($pdo->query($sql) as $row) {   
                    echo '<span class="badge">'. $row['count'] . '</span>';
                   }
                   Database::disconnect();
                  ?></a>
                <a href="image.php" class="list-group-item"><span class="glyphicon glyphicon-th" aria-hidden="true"></span> Partenaires
                <?php
                   $pdo = Database::connect();
                   $sql = 'SELECT count(id) as count FROM image_gallery'; 
                   
                   foreach ($pdo->query($sql) as $row) {   
                    echo '<span class="badge">'. $row['count'] . '</span>';
                   }
                   Database::disconnect();
                  ?>
                </a>
                <a href="user.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> User
                <?php
                   $pdo = Database::connect();
                   $sql = 'SELECT count(user_id) as count FROM users'; 
                   
                   foreach ($pdo->query($sql) as $row) {   
                    echo '<span class="badge">'. $row['count'] . '</span>';
                   }
                   Database::disconnect();
                  ?>
                </a>
            </div>

            
          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Website Overview</h3>
              </div>
              <div class="panel-body">
                <div class="col-md-4">
                      
                      <div class="well dash-box">
                          <?php
                       $pdo = Database::connect();
                       $sql = 'SELECT count(id) as count FROM projet'; 

                       foreach ($pdo->query($sql) as $row) {   
                        echo '<h2><span style="margin-right:7px;" class="glyphicon glyphicon-wrench" aria-hidden="true"></span>'. $row['count'] . '</span>';
                       }
                       Database::disconnect();
                      ?>
                        <h4>Projets</h4>
                      </div>
                </div>
                
                 <div class="col-md-4">
                      
                      <div class="well dash-box">
                          <?php
                       $pdo = Database::connect();
                       $sql = 'SELECT count(id) as count FROM image_gallery'; 

                       foreach ($pdo->query($sql) as $row) {   
                        echo '<h2><span style="margin-right:7px;" class="glyphicon glyphicon-th" aria-hidden="true"></span>'. $row['count'] . '</span>';
                       }
                       Database::disconnect();
                      ?>
                        <h4>Partenaires</h4>
                      </div>
                </div>
                  
                  <div class="col-md-4">
                      
                      <div class="well dash-box">
                          <?php
                       $pdo = Database::connect();
                       $sql = 'SELECT count(user_id) as count FROM users'; 

                       foreach ($pdo->query($sql) as $row) {   
                        echo '<h2><span style="margin-right:7px;" class="glyphicon glyphicon-user" aria-hidden="true"></span>'. $row['count'] . '</span>';
                       }
                       Database::disconnect();
                      ?>
                        <h4>User</h4>
                      </div>
                </div>
                
              </div>
              </div>

              <!-- Latest Users -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Last Connections</h3>
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-hover">
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined</th>
                      </tr>
            <?php
                   
            $pdo = Database::connect();
                      
                $sql = "SELECT user_email, user_name, user_lastlogin FROM users ORDER BY user_lastlogin DESC";
                $q = $pdo->prepare($sql);
                $q->execute();
                $row = $q->fetchALL(PDO::FETCH_BOTH);
                
                for($i=0; $i<count($row); $i++){
                echo '<tr>';
                    echo '<td>'. $row[$i]['user_name'] . '</td>';
                    echo '<td>'. $row[$i]['user_email'] . '</td>';
                    echo '<td>'. $row[$i]['user_lastlogin'] . '</td>';
                echo '</tr>';
                }
            Database::disconnect();
            ?>
                    </table>
                </div>
              </div>
          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
      <p>Copyright Communication Mallabar, &copy; 2018</p>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="scripts/bootstrap.min.js"></script>
  </body>
</html>
