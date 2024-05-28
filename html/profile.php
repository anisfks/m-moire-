<?php 
require_once "conection.php";
session_start();


// Vérification et récupération des données utilisateur
if (isset($_SESSION['id_r'])) {
    $user_id = $_SESSION['id_r'];

    // Requête pour récupérer les données de l'utilisateur
    $query = "SELECT `nom`, `sexe`, `prénom`, `email` FROM `recruteur` WHERE `id_recruteure` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user_data = $result->fetch_assoc();
        $firstname = $user_data['prénom'];
        $lastname = $user_data['nom'];
        $email = $user_data['email'];
        $gender = $user_data['sexe'];
    } else {
        
    }
}

?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>job opp</title>
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../images/Capture d’écran (7).png" type="image/x-icon">
</head>
<body>
    
    <header>
        <div class="logo">
            <p><span>job</span>opportunity</p>
        </div>
        <ul class="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="offreopp.php">Offer</a></li>
            <li><a href="aboutus.php">About us</a></li>
            <li><a href="espace recruteure.php">Recruiting area</a></li>
            <?php 
                if (isset($_SESSION['id_r'])) {
                    echo '<li><a href="profile.php">Profile</a></li>';
                }
            ?>
            <?php 
                if (isset($_SESSION['id_r'])) {
                    echo '<li><a href="logout.php">Logout</a></li>';
                }
            ?>
        </ul>
        <div class="toggle_menu"></div>
        
    </header>

    
</head>
<body>
    <div class="container">
        <div class="profile-header">User Profile:</div>
        <div class="profile-content">
            <table class="profile-table">
                <tr><th colspan="2">User Details:</th></tr>
                <tr><th>Email</th><td><?php echo $email; ?></td></tr>
                <tr><th>First name</th><td><?php echo $firstname; ?></td></tr>
                <tr><th>Last name</th><td><?php echo $lastname; ?></td></tr>
                <tr><th>Gender</th><td><?php echo $gender; ?></td></tr>
            </table>
        </div>
        <div class="button-container">
            <a href="profile-edit.php">
                <button class="btn btn-primary">Edit</button>
            </a>
            <a href="profile_delet.php">
                <button class="btn btn-warning">Delete</button>
            </a>
            <a href="logout.php">
                <button class="btn btn-info">Logout</button>
            </a>
        </div>
    </div>

   
    <?php   
     $get_offers=mysqli_query($conn," SELECT * FROM `offre` WHERE  naw3='special' AND id_recruteure='$user_id'  ");
     if(mysqli_num_rows($get_offers) > 0)
     {
         
         while($row=mysqli_fetch_assoc($get_offers))
          {
             echo'
             <div class="advertise">
             <h1>Special offre</h1>
             <div class="alll">
             <img src="./offer/'.$row['logo'].'">
             <div class="text">
             <h2>'.$row['nom_entreprise'].':</h2>
              <p>'.$row['Kind_worker'].'</p>
                 <h6>For more information:0'.$row['tel_entreprise'].'</h6>

            <button id="openl" class="butn1" >Details</button>
            <a href="deletoffre.php?d='.$row['id_offre'].'"> <button class="butn1d" >delete</button></a>
            <button  onclick="openk()" id="open" class="butn2">Learn more</button>
               </div>
               <div id="windw" >
               <div id="dakhel">
                 <span id="close" onclick="closek()">&times;</span>
                 <div class="more" >
                 <h5> '.$row['détaille_offre'].' </h5>
                 </div>
               </div>
             </div>  
              </div></div>
             
              
              
        



             ';
         }
    }
    ?>


    



        <div class="zayed">
        <h1>Offers:</h1>
            <div class="card-contain" >
     <?php
     $get_offers=mysqli_query($conn," SELECT * FROM `offre` WHERE naw3='simple' AND id_recruteure='$user_id'");
     if(mysqli_num_rows($get_offers) > 0)
     {
         
         while($row=mysqli_fetch_assoc($get_offers))
          {
             echo'

             
             <div class="card">
             <div class="front">
                 <div class="circle" >
                 <img src="./offer/'.$row['logo'].'">

                 </div>
                 <div class="ktiba" >
                     <h3>'.$row['nom_entreprise'].':</h3>
                     <h5>'.$row['Kind_worker'].'</h5>
                     <h4>Type of contract:</h4>
                     <h5>'.$row['type_de_contrat'].'</h5>
                     <h6>For more information:0'.$row['tel_entreprise'].'</h6>
                     
                 </div>
                 <div class="sahm">
                     <p class="r">rotate</p>
                     <p class="s"> →</p>
                 </div>
                 
                 
             </div>
             <div class="back">
                 <div class="ktiba">
                     <h5> '.$row['détaille_offre'].' </h5>
                 </div>
                 <button id="openl"  onclick="openl()"  class="button" >Details</button>
                <a href="deletoffre.php?d='.$row['id_offre'].'"> <button id="openl"  class="buttond" >delete</button></a>
             </div>
         </div>
         


             ';
         }
    }
    ?>
            </div>
        </div>



   
    
        <script src="window.js" >
      var small_menu = document.querySelector('.toggle_menu')
var menu = document.querySelector('.menu')

small_menu.onclick = function(){
     small_menu.classList.toggle('active');
     menu.classList.toggle('responsive');
}
      </script>
</body>

</html>