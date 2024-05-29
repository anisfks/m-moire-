<?php 
require_once "conection.php";
session_start();

if (isset($_POST['registr'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sexe = $_POST['sexe'];

    // Insertion des données dans la base de données
    $sql = mysqli_query($conn, "INSERT INTO `utilisatuer`(`nom`, `sexe`, `prénom`, `email`, `mot de passe`) VALUES ('$firstname','$sexe','$lastname','$email','$password')");
}

if (isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql1 = mysqli_query($conn, "SELECT `id_utilisateur`, `email`, `mot de passe` FROM `utilisatuer` WHERE email='$email' AND `mot de passe`='$password' LIMIT 1");
    if (mysqli_num_rows($sql1)) {
        $row = mysqli_fetch_assoc($sql1);
        $_SESSION['id_u'] = $row['id_utilisateur'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['login_success'] = true;
    } else {
        echo "Login failed. Please check your credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>job opp</title>
    <meta http-equiv="refresh" content="">
    <link rel="stylesheet" href="../css/search.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../images/Capture d’écran (7).png" type="image/x-icon">
</head>
<body>
    <!-- Your existing header content -->
    
    <header>
        <div class="logo">
            <p><span>job</span>opportunity</p>
        </div>
        <ul class="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="offreopp.php">Offer</a></li>
            <li><a href="search.php">Search</a><i class="fa fa-search" style="font-size:15px" ></i></li>
            <li><a href="aboutus.php" >About us</a></li>


            <?php 
            if (!isset($_SESSION['id_u']))
         
         
         {
            echo'<li><a href="espace recruteure.php">Recruiting area</a></li>';
         }
         ?>

<?php 
              if (!isset($_SESSION['email']))
         
         
            {
           echo '<li  onclick="openk()" id="open"><a>Sign In</a><i class="fa fa-sign-in" aria-hidden="true" style="font-size:15px" ></i></li>';
              }
              else if (!isset($_SESSION['id_u']));
              ?>

            
<?php 
              if (isset($_SESSION['id_r']))
         
         
            {
           echo '<li><a href="profile.php" >Profile</a></li>';
              }
              ?>
               
              <?php 
              if (isset($_SESSION['email']))
         
         
            {
           echo '<li><a href="logout.php" >logout</a></li>';
              }
              ?>

              


        </ul>

        <!-- menu responsive -->
        <div class="toggle_menu"></div>
        
    </header>



<br>
<br>
<br>
<br>






    <div id="popup" class="popup">
        <p>Login successful!</p>
    </div>
   
    <div id="signInPopup" class="popu">
        <p>Sign in first to apply to an offer!</p>
    </div>

    <!-- Filter form -->
    <form method="GET" action="search.php">
        <label for="type_de_contrat">Filter by Contract Type:</label>
        <select name="type_de_contrat" id="type_de_contrat">
            <option value="">All</option>
            <option value="Permanent Contract">PC (Permanent Contract)</option>
            <option value="Fixed term contract">FTC (Fixed term contract)</option>
            <option value="Work study contract">Work study contract</option>
            <option value="Studentjob">Studentjob</option>
        </select>
        <button type="submit">Filter</button>
    </form>

    <div class="advertise">
        <?php
        $contractType = isset($_GET['type_de_contrat']) ? $_GET['type_de_contrat'] : '';
        $query = "SELECT * FROM `offre` WHERE naw3='special'";
        if (!empty($contractType)) {
            $query .= " AND `type_de_contrat` = '$contractType'";
        }
        $get_offers = mysqli_query($conn, $query);
        if (mysqli_num_rows($get_offers) > 0) {
            echo '<h1>Special offers</h1>';
            while ($row = mysqli_fetch_assoc($get_offers)) {
                echo '
                <div class="alll">
                    <img src="./offer/'.$row['logo'].'">
                    <div class="text">
                        <h2>'.$row['nom_entreprise'].':</h2>
                        <p>'.$row['Kind_worker'].'</p>
                        <h6>For more information: 0'.$row['tel_entreprise'].'</h6>
                        <a href="apply.php?offre='.$row['id_offre'].'&k='.$row['id_recruteure'].'"><button class="butn1">Apply</button></a>
                        <button onclick="openm()" id="open" class="butn2">Learn more</button>
                    </div>
                    <div id="windw2">
                        <div id="dakhel2">
                            <span id="close2" onclick="closem()">&times;</span>
                            <div class="more">
                                <h5>'.$row['détaille_offre'].'</h5>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }
        ?>
    </div>

    <div class="zayed">
        <h1>Offers:</h1>
        <div class="card-contain">
            <?php
            $query = "SELECT * FROM `offre` WHERE naw3='simple'";
            if (!empty($contractType)) {
                $query .= " AND `type_de_contrat` = '$contractType'";
            }
            $get_offers = mysqli_query($conn, $query);
            if (mysqli_num_rows($get_offers) > 0) {
                while ($row = mysqli_fetch_assoc($get_offers)) {
                    echo '
                    <div class="card">
                        <div class="front">
                            <div class="circle">
                                <img src="./offer/'.$row['logo'].'">
                            </div>
                            <div class="ktiba">
                                <h3>'.$row['nom_entreprise'].':</h3>
                                <h5>'.$row['Kind_worker'].'</h5>
                                <h4>Type of contract:</h4>
                                <h5>'.$row['type_de_contrat'].'</h5>
                                <h6>For more information: 0'.$row['tel_entreprise'].'</h6>
                            </div>
                            <div class="sahm">
                                <p class="r">rotate</p>
                                <p class="s"> →</p>
                            </div>
                        </div>
                        <div class="back">
                            <div class="ktiba">
                                <h5>'.$row['détaille_offre'].'</h5>
                            </div>
                            <a href="apply.php?offre='.$row['id_offre'].'&k='.$row['id_recruteure'].'"><button class="button">Apply</button></a>
                        </div>
                    </div>';
                }
            }
            ?>
        </div>
    </div>

    <!-- Your existing footer content -->

    <!-- Your existing scripts -->
</body>
<div id="windw" >
      <div id="dakhel">
        <span id="close" onclick="closek()">&times;</span>
        <section>
        <form class="form" method="post">
                <div class="flex-column">
                  <label>Email</label>
                </div>
                <div class="inputForm">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    viewBox="0 0 32 32"
                    height="20"
                  >
                    <g data-name="Layer 3" id="Layer_3">
                      <path
                        d="m30.853 13.87a15 15 0 0 0 -29.729 4.082 15.1 15.1 0 0 0 12.876 12.918 15.6 15.6 0 0 0 2.016.13 14.85 14.85 0 0 0 7.715-2.145 1 1 0 1 0 -1.031-1.711 13.007 13.007 0 1 1 5.458-6.529 2.149 2.149 0 0 1 -4.158-.759v-10.856a1 1 0 0 0 -2 0v1.726a8 8 0 1 0 .2 10.325 4.135 4.135 0 0 0 7.83.274 15.2 15.2 0 0 0 .823-7.455zm-14.853 8.13a6 6 0 1 1 6-6 6.006 6.006 0 0 1 -6 6z"
                      ></path>
                    </g>
                  </svg>
                  <input placeholder="Enter your Email" class="input" type="text" name="email" />
                </div>
              
                <div class="flex-column">
                  <label>Password </label>
                </div>
                <div class="inputForm">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    viewBox="-64 0 512 512"
                    height="20"
                  >
                    <path
                      d="m336 512h-288c-26.453125 0-48-21.523438-48-48v-224c0-26.476562 21.546875-48 48-48h288c26.453125 0 48 21.523438 48 48v224c0 26.476562-21.546875 48-48 48zm-288-288c-8.8125 0-16 7.167969-16 16v224c0 8.832031 7.1875 16 16 16h288c8.8125 0 16-7.167969 16-16v-224c0-8.832031-7.1875-16-16-16zm0 0"
                    ></path>
                    <path
                      d="m304 224c-8.832031 0-16-7.167969-16-16v-80c0-52.929688-43.070312-96-96-96s-96 43.070312-96 96v80c0 8.832031-7.167969 16-16 16s-16-7.167969-16-16v-80c0-70.59375 57.40625-128 128-128s128 57.40625 128 128v80c0 8.832031-7.167969 16-16 16zm0 0"
                    ></path>
                  </svg>
                  <input placeholder="Enter your Password" class="input" type="password" name="password"/>
                </div>
              
                <div class="flex-row">
                  
                  <span class="span">Forgot password?</span>
                </div>
                <button class="button-submit" name="login">Sign In</button>
                <p class="p">Don't have an account? <a class="rgstr" onclick="openl()" id="open1">Sign Up</span></a></p>
            
                </div>
              </form>
              
        </section>
      </div>
    </div>



    <div id="windw1">
        <div id="dakhel1">
          <section>
          <form class="form1" method="post">
                <p class="title">Register </p>
                <p class="message">Signup now and get your job</p>
                    <div class="flex">
                    <label>
                        <input style="width: 200px;" id="fn" class="input" type="text" placeholder="" required="" aria-activedescendant="" name="firstname">
                        <span>Firstname</span>
                    </label>
            
                    <label>
                        <input id="ln" style=" width: 200px; position: relative; right: 18px;" class="input" type="text" placeholder="" required="" name="lastname">
                        <span >Lastname</span>
                    </label>
                </div>  
                <label>
                    <select name="sexe" id="" >
                      <option value="sexe" selected disabled>Sex</option>
                      <option value="homme">homme</option>
                      <option value="femme">femme</option>
            </select>
                </label> 
                        
                <label>
                    <input class="input" type="email" placeholder="" required="" name="email">
                    <span>Email</span>
                </label> 
                    
                <label>
                    <input class="input" type="password" placeholder="" required="" name="password">
                    <span>Password</span>
                </label>
                <label>
                    <input class="input" type="password" placeholder="" required="">
                    <span>Confirm password</span>
                </label>
                <button  class="submit" name="registr">Sign up</button>
                <p class="signin">Already have an acount ? <a onclick="closel()" id="close1">Signin</a> </p>
            </form>
        </section>
        </div>
    </div>
           
    <footer>
        <div class="services_list">
            <div class="service">
                <img src="../icon/clock.png" alt="">
                <h2>Ouverture</h2>
                <p>10h30 à 23h45</p>
                <p>23h45 à 9h30</p>
            </div>

            <div class="service">
              <img src="../icon/pin.png" alt="">
              <h2>Adresses</h2>
              <p>France-Paris</p>
              <p>Annaba-Algérie</p>
          </div>
          <div class="service">
              <img src="../icon/email.png" alt="">
              <h2>Emails</h2>
              <p>email@gmail.com</p>
              <p>étudiantopp@gmail.com</p>
          </div>
          <div class="service">
              <img src="../icon/call.png" alt="">
              <h2>Numbers</h2>
              <p>+231 657542328</p>
              <p>+33 45687515</p>
          </div>
          
          <hr>
        </div>

        <p class="footer_text">Directed by <span>DJAMEL MLM Dev</span> | All rights reserved.</p>
    </footer>

    <script>

<?php if(isset($_SESSION['login_success']) && $_SESSION['login_success']): ?>
    
    setTimeout(function(){
document.getElementById('popup').style.display = 'block';
}, 400);


setTimeout(function(){
document.getElementById('popup').style.display = 'none';
}, 2500);
<?php
// Reset the session variable
unset($_SESSION['login_success']);
endif;
?>

<?php if (!isset($_SESSION['email'])): ?>
    
    setTimeout(function(){
        document.getElementById('signInPopup').style.display = 'block';
      }, 400);
      
      
      setTimeout(function(){
        document.getElementById('signInPopup').style.display = 'none';
      }, 3000);
  <?php endif; ?>




















var open=document.getElementById('open');
var close=document.getElementById('close');
var windw=document.getElementById('windw');





function openk(){
    windw.style.display = 'block';

    
}

function closek(){
    windw.style.display = 'none';
   
}

window.onclick = function(event) {
    if (event.target == windw) {
      windw.style.display = "none";
    }
  }


  window.onclick = function(event) {
    if (event.target == windw1) {
      windw1.style.display = "none";
    }
  }





var open_1=document.getElementById('open1');
var closem_1=document.getElementById('close1');
var windw_1=document.getElementById('windw1');
function openl(){
    windw_1.style.display = 'block';
    
}

function closel(){
    windw_1.style.display = 'none';
}




var open_1=document.getElementById('open2');
var closem_1=document.getElementById('close2');
var windw_1=document.getElementById('windw2');
function openm(){
    windw_1.style.display = 'block';
    
}

function closem(){
    windw_1.style.display = 'none';
}








var small_menu = document.querySelector('.toggle_menu')
var menu = document.querySelector('.menu')

small_menu.onclick = function(){
     small_menu.classList.toggle('active');
     menu.classList.toggle('responsive');
}
  



        
    </script>
   
</body>

</html>
