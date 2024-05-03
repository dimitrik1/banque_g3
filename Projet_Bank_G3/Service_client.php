<?php  session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!----======== ICON ======== -->
<link rel="shortcut icon" href="ico/icons8-bank-bubbles-96.png" type="image/x-icon">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style/style.css">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">



    <title>Admin Dashboard Panel</title> 
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="images/logo.png" alt="">
                
            </div>

            <span class="logo_name">Bank G3</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="Tableau.php">
                 <i>   <ion-icon name="analytics-outline"></ion-icon></i>
                    <span class="link-name">Tableau</span>
                </a></li>
                <li style="color:#a6b485;"><a href="Service_client.php">
                   <i  style="color:#a6b485;"> <ion-icon name="headset-outline"></ion-icon></i>
                    <span style="color:#a6b485;" class="link-name">Service Client</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="Formulaires.php"  onclick="SignoutConfirm()">
                    <i><ion-icon name="log-out-outline"></ion-icon></i>
                    <span class="link-name">Déconnexion</span>
                </a></li>

                <li class="mode">
                    <a href="#">
                        <i><ion-icon name="moon-outline"></ion-icon></i>
                    <span class="link-name">Dark | Light</span>
                </a>

                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
            </li>
            </ul>
        </div>
    </nav>

    <section class="service">
        <div class="top">
            <i class="sidebar-toggle"><ion-icon name="menu-outline"></ion-icon></i>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title hello">
                    <span>Avez-vous des questions ?</span>
                </div>

                <div class="MsgBox">
                    <textarea name="question" id="question" placeholder="Qu'avez-vous rencontré comme problème ?"></textarea>
                    <button type="submit">Envoyer</button>
                </div>
            </div>
    </section>


    <script src="js/script.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>