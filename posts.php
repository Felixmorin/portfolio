<?php
@ini_set('display_errors', 'on');
include 'acces.php';

error_reporting(E_ALL);
require_once('database.php');

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Posts</title>
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
            <li><a href="admin.php">Dashboard</a></li>
            <li class="active"><a href="posts.php">Projets</a></li>
            <li><a href="image.php">Partenaires</a></li>
            <li><a href="user.php">Users</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Welcome</a></li>
            <li><a href="login.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Posts<small style=margin-left:10px;>Manage Projets</small></h1>
          </div>
          <div class="col-md-2">
            
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="active">Projets</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <a href="admin.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Dashboard</a>
              <a href="posts.php" class="list-group-item"><span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span> Projets
                  <?php
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
                <a href="user.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users
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
                <h3 class="panel-title">Projets</h3>
              </div>
              <div class="panel-body">
                  <a class="btn btn-danger" href="create.php" style="margin-bottom:10px; background-color:green; border-color:green;">Create</a>
                  <br>
                  <br>
                
                  
                  
                  
                     <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                        <th>Id</th>
                        <th>Type</th>
                        <th>Titre</th>
                        <th>Sous-titre</th>
                        <th>Image</th>
                        <th>Edit/Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   $pdo = Database::connect();
                      
                                            
                    if(!isset($_GET["cat"])){
                        $sql = "SELECT * FROM projet";
                        $q = $pdo->prepare($sql);
                        $q->execute();
                        $rows = $q->fetchAll(PDO::FETCH_BOTH);
                      } else {
                        $sql = "SELECT * FROM projet";
                        $q = $pdo->prepare($sql);
                        $q->execute(array($_GET["cat"]));
                        $rows = $q->fetchAll(PDO::FETCH_BOTH);
                      }

                   foreach ($rows as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['id'] . '</td>';
                            echo '<td>'. $row['type'] . '</td>';
                            echo '<td>'. $row['titre'] . '</td>';
                            echo '<td>'. $row['sous_titre'] . '</td>';
                            echo '<td>'. $row['image'] . '</td>';
                       echo '<td width=250>';
                                echo '<a class="btn" href="read.php?id='.$row['id'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
                                echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
              </div>
              </div>

          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
      <p>Copyright Félix Morin, &copy; 2019</p>
    </footer>

  <script>
     CKEDITOR.replace( 'editor1' );
 </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="scripts/bootstrap.min.js"></script>
  </body>
</html>
