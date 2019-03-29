<?php
require "database.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Heirloom</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   
</head>
<body>  

<nav>
      <ul class="ulNav">
        <li><a href="#">Accueil</a></li>
        <li><a href="#">Menu</a></li>  
        <li class="logo"><a href="index.html"><img src="img/Logo.png" alt="logo"></a></li>
        <li><a href="#">Photo</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    <div class="spinner-master4">
  <input type="checkbox" id="spinner-form4" />
  <label id="barMenu"  for="spinner-form4" class="spinner-spin4">
    <div class="spinner4 diagonal part-1"></div>
    <div class="spinner4 horizontal"></div>
    <div class="spinner4 diagonal part-2"></div>
  </label>
</div>
    </nav>
    
<header>
   
    
    <div class="wrapper textHeader">
    <img src="img/Heirloomlogo.png">
        <p>Restaurant Pizzeria situé dans le quartier Hochelaga-Maisonneuve à Montréal. Pizzas au four à bois et pâtes fraîches maison. </p>
        <h2>(514) 905-8211</h2>
    </div>
</header>
    
<section class="menu">
    
   <div class="wrapper">
    <span class="linetitle"><h1 class="center"><div class="box">MENU</div></h1></span>
    </div>
    
<div class="wrapper">
    
    <?php
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM menu INNER JOIN type_plat ON type_plat.id = menu.sorte WHERE menu.header = "Menu" ORDER BY type_plat.custom_order';
                    
    
            $catName;
            $bool = false;
            foreach($pdo->query($sql) as $row)
            {
                if($catName != $row['sorte_nom']){
                    if($bool){
                        
                        echo '</div>';
                    }
                $bool = true;
                echo '<h2 class="center line">'.$row['sorte_nom'].'</h2>';
                echo '<div class="plat wrapperMobile">';
                }
                
                echo '<div class="repas">';
                echo '<p><b>'.$row['nom'].'</b><br/>'.$row['description'].'</p>';
                echo '<p>'.$row['price'].'</p>';
                echo '</div>';
                
                $catName = $row['sorte_nom'];
                
            }
    
            echo '</div>';
    
            
            if($row['category'] == 'Pizza'){
                echo '<p class="center">*Pizza sur base blanche</p>';
            }
    
    
            ?>
      
   
    
    </div>
  
    
    
</section>
    
<section class="menu">

<div class="wrapper">
    <span class="linetitle"><h1 class="center"><div class="box">VINS & BIÈRES</div></h1></span>
</div>
<p class="center subtitle">Importation privée</p>    
    
<div class="wrapper">
    <?php
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM menu INNER JOIN type_plat ON type_plat.id = menu.sorte WHERE menu.header = "Vin" ORDER BY type_plat.custom_order';
                    
    
            $catName;
            $bool = false;
            foreach($pdo->query($sql) as $row)
            {
                if($catName != $row['sorte_nom']){
                    if($bool){
                        echo '</div>';
                    }
                $bool = true;
                echo '<h2 class="center line">'.$row['sorte_nom'].'</h2>';
                echo '<div class="plat wrapperMobile">';
                }
                
                echo '<div class="repas">';
                echo '<p><b>'.$row['nom'].'</b><br/>'.$row['description'].'</p>';
                echo '<p>'.$row['price'].'</p>';
                echo '</div>';
                
                $catName = $row['sorte_nom'];
            }
            echo '</div>';
            ?>
    
    </div>
    
</section>
<section>
    <div class="gallery">
         <?php
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM image_gallery';
                    
    
            
            foreach($pdo->query($sql) as $row)
            {
              
                echo '<img src="/uploads/'.$row['image'].'" />';
             
            }
     
            ?>
    
         
    </div>      
</section>
<section>
     
    <div id="map"></div>
    
</section> 
<footer>
<div class="wrapper">    
<p><b>(514) 905-8211</b></p>
<p>3991, rue Ontario E.<br/>H1W 1T1 Montréal</p>
<p>Heures d’ouverture<br/>11h à 23h.</p>
    <div class="social">    
        <a href="facebook.com"><img src="img/facebook-256.png"></a>
        <a href="instagram.com"><img class="margin" src="img/61164.png"></a>
    </div>
</div>    
</footer>


<script src="scripts/script.js"></script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvIyALYLw5kcFwJ_YEnIXtBVXU4SKutxU&callback=initMap">
</script>
</body>
</html>