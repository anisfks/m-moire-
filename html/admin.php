<?php 
require_once "conection.php";
session_start();
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            width: 1100px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 9px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .admin-header {
            font-size: 2rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .admin-content {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .admin-table {
            width: 100%;
            max-width: 1000px;
            border-collapse: collapse;
            text-align: left;
            border-radius: 9px;
        }

        .admin-table th, .admin-table td {
            padding: 15px;
            border: 1px solid #ddd;
        }

        .admin-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin: 20px auto;
            gap: 20px;
        }

        .btn {
            width: 120px;
            height: 40px;
            font-size: 1.25rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-warning {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-info {
            background-color: #17a2b8;
            color: white;
        }

        @media (max-width: 768px) {
            .admin-header {
                font-size: 1.5rem;
            }

            .admin-table th, .admin-table td {
                padding: 10px;
            }

            .btn {
                width: 100px;
                height: 35px;
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .admin-header {
                font-size: 1.25rem;
            }

            .admin-table th, .admin-table td {
                padding: 5px;
            }

            .btn {
                width: 70px;
                height: 30px;
                font-size: 0.875rem;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="admin-header">Admin Dashboard</div>
        <div class="admin-content">
            <table class="admin-table">
                <tr>
                    <th>first name recruter</th>
                    <th>last name recruter</th>
                    <th>Email</th>
                    <th>delete recruter</th>
                    
                </tr>
               <?php
                 $query=mysqli_query($conn,"SELECT * FROM recruteur ");

                 if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        echo '<tr>
                    <td>'.$row['nom'].'</td>       
                    <td>'.$row['prénom'].'</td>         
                    <td>'.$row['email'].'</td>              
                    <td>
                        <a onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce recrutuere ?\');" href="admin_deletrecru.php?v='.$row['id_recruteure'].'">
                            <button class="btn btn-warning">Delete</button>
                            <br>
                            <br>
                       
                    </td>
                    </tr>';
                    } 
                 }
                 
              
                   
               
                ?>
                <!-- Ajoutez d'autres lignes pour chaque recruteur -->
            </table>
        </div>
        <br>
        <br>
      
        <table class="admin-table">
                <tr>
                    <th>first name recruter</th>
                    <th>last name recruter</th>
                    <th>Email</th>
                    <th>Compagnie</th>
                    <th>Kind worker</th>
                    <th>Type de Contrat</th>
                    <th>delete offre</th>
                </tr>
                <?php
                 $get_offers=mysqli_query($conn,"SELECT o.*,r.* FROM offre o JOIN recruteur r ON o.id_recruteure=r.id_recruteure");

                 if (mysqli_num_rows($get_offers) > 0) {
                    while ($row = mysqli_fetch_assoc($get_offers)) {
                        echo '<tr>
                        <td>'.$row['nom'].'</td>       
                        <td>'.$row['prénom'].'</td>         
                        <td>'.$row['email'].'</td>  
                    <td>'.$row['nom_entreprise'].'</td>       
                    <td>'.$row['Kind_worker'].'</td>         
                    <td>'.$row['type_de_contrat'].'</td>              
                    <td>
                    <a  onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce offre ?\');" href="admin_deletoffre.php?v='.$row['id_offre'].'">
                            <button class="btn btn-warning">Delete</button>
                            <br>
                            <br>
                       
                    </td>
                    </tr>';
                    } 
                 }
                 
              
                   
               
                ?>
                <!-- Ajoutez d'autres lignes pour chaque recruteur -->
            </table>
        <div class="button-container">

            <a href="logout.php">
                <button class="btn btn-info">Logout</button>
            </a>
        </div>
    </div>
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
    </header>
	<style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;500;700&display=swap');
        @import url('https://fonts.cdnfonts.com/css/segoe-ui-4');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body, html {
            height: 100%;
        }
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 50px;
            padding: 0 10%;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: rgb(243, 242, 238);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.557);
            z-index: 10;
        }
        .menu {
            display: flex;
        }
        .logo {
            color: #2793ae;
            font-weight: 700;
            font-size: 25px;
        }
        .logo span {
            color: #273e60;
        }
        .menu li {
            margin: 0 15px;
            list-style: none;
        }
        .menu li a {
            font-size: 14px;
            text-decoration: none;
            color: #6f6f6f;
            position: relative;
        }
        .menu li a::before {
            position: absolute;
            top: -5px;
            left: 0;
            content: "";
            width: 0;
            height: 2px;
            border-radius: 6px;
            background-color: #2793ae;
            transition: 0.5s;
        }
        .menu li a:hover::before {
            width: 100%;
        }
        .menu li a::after {
            position: absolute;
            bottom: -5px;
            right: 0;
            content: "";
            width: 0;
            height: 2px;
            border-radius: 6px;
            background-color: #2793ae;
            transition: 0.5s;
        }
        .menu li a:hover::after {
            width: 100%;
        }
        .menu li a:hover {
            color: #000;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding-top: 50px;
        }
        .border {
            background-color: white;
        }
        /*Scrollbar CSS*/
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-thumb {
            background-color: #2793ae;
        }
    </style>
</body>