<?php
require "database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Félix Morin</title>
    
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/animate.css">
    <link rel="stylesheet" href="css/animate.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Oswald" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    
    
    
</head>
    
<body>
       
<div class="grid-container">
    <div class="grid-item item1">
       
        <div class="nav">
            
            <a href="index.php"><img class="headerLogo" src="img/logo.png" alt="headerLogo"></a>  

            <div class="container">
                <ul class="menu">
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
                <ul class="links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="projets.php">Portfolio</a></li>
                    <li><a href="contact.php">Contacts</a></li>
                </ul>
            </div>
        </div>
        
            <h2 class="animated fadeInUp">Creating </h2>
            <h2 class="animated fadeInUp">content that </h2>
            <h2 class="wow animated fadeInUp" data-wow-delay="0.3s">makes a <span style="color:#a68253;background-color: transparent">difference</span></h2>
            <h5 class="wow animated fadeInUp" data-wow-delay="0.6s">I'm a student who just started a career in Web Developer. I already have some experience with a few known companies. If you want to see my projects, learn about me or anything, feel free to contact me or take a look at my website !</h5>
        
            <div class="contract">
                 <?php
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM image_gallery';
                    
    
            
            foreach($pdo->query($sql) as $row)
            {
              
                echo '<img class="wow animated fadeIn" data-wow-delay="1s" src="/uploads/'.$row['image'].'" height="50px" width="100px"/>';
             
            }
     
            ?>
                
                
               
            </div>
       
    </div>
    
   <div class="wow animated fadeIn grid-item item2 inner-border" data-wow-delay="0.1s">
        <a href="work.php"><div class="skill1">
            <img src="img/design.png" alt="design">
            <h1>Design</h1>
            <p>Crafting the unreal</p>
        </div></a>
    </div>
    <div class="wow animated fadeIn grid-item item3 inner-border" data-wow-delay="0.3s">
        <a href="work.php"><div class="skill2">
            <img src="img/webcode.png" alt="prog">
            <h1>Web dev</h1>
            <p>Coding the impossible</p>
        </div></a>
        </div>
    <div class="wow animated fadeIn grid-item item4 inner-border" data-wow-delay="0.6s">
        <a href="work.php"><div class="skill3">
            <img src="img/seo.png" alt="SEO">
            <h1>Tech project</h1>
            <p>Conceiving your ideas</p>
        </div></a>
        </div>
    <div class="wow animated slideInLeft grid-item item5 inner-border">
        <div class="projet">
            <h1>Projects</h1>
            <p>Just unique results</p>
            <a href="projets.php"><button class="button button1">View my projects</button></a>
        </div>
    </div>
    <div class="wow animated slideInUp grid-item item6 inner-border">
        <div class="contact">
            <h1>Any questions ?</h1>
            <p>Call me for a coffee</p>
            <a href="contact.php"><button class="button button1">Call me maybe</button></a>
        </div>
    </div>
    <div class="wow animated slideInRight grid-item item7 inner-border">
        <div class="about">
            <h1>Who are you ?</h1>
            <p>Learn more about me</p>
            <a href="about.php"><button class="button button1">All my life</button></a>
        </div>
        </div>
    
    <div class="grid-item item8">
        <div class="footer">
            <div class="imgFooter">
                <a href="index.php"><img src="img/logo.png" alt="" height="120px" width="120px"></a>
            </div>
            
            <div class="helloFooter">
                <h3>Say Hello</h3>
                <p><i class="fas fa-phone"></i> : (514)-632-5052</p>
                <p><i class="far fa-envelope"></i> : felixmorin123@gmail.com</p>
            </div>
            
            <div class="socialFooter">
                <h3>Stay connected</h3>
                <div class="social">
                    <a href="https://www.facebook.com/felixmor112"><img src="img/fb.png" alt="" height="30px" width="30px"></a>
                    <a href="https://www.instagram.com/morfil112/">
                    <img src="img/ig.png" alt="" height="30px" width="30px"></a>
                    <a href="https://www.linkedin.com/in/f%C3%A9lix-morin-8bb116150/"><img src="img/linkedin.png" alt="" height="30px" width="30px"></a>
                </div>
            </div>
        </div>
    </div>
    
    
    
 
</div>

<script src="scripts/script.js"></script>
<script src="scripts/wow.min.js"></script>
              <script>
                  wow = new WOW(
                      {
                      boxClass:     'wow',      // default
                      animateClass: 'animated', // default
                      offset:       0,          // default
                      mobile:       false,       // default
                      live:         true        // default
                    }
                    )
              new WOW().init();
</script>
</body>
</html>