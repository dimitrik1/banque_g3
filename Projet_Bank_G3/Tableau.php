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


    <title>Bank G3 - Dashboard </title> 
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
                <li  style="color:#a6b485;"><a href="Tableau.php">
                 <i  style="color:#a6b485;">   <ion-icon name="analytics-outline"></ion-icon></i>
                    <span  style="color:#a6b485;" class="link-name">Tableau</span>
                </a></li>
                <li><a href="Service_client.php">
                   <i> <ion-icon name="headset-outline"></ion-icon></i>
                    <span class="link-name">Service Client</span>
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
                    <span class="link-name">Light | Dark</span>
                </a>

                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
            </li>
            </ul>
        </div>
    </nav>


    <!-- LES POPUP (FORMULAIRES) DES OPERATIONS -->

<div class="operatioPopup " id="op1">

       <div class="popup transfertPopup">
                    <form  method="post" action="traiter.php">
                        <span>Transfert d'argent</span>

                        <div class="inputs">
                        <input type="text" name="numb" id="" placeholder="numéro du bénéficiaire *" required>
                        <input type="number" name="montantv" id="" placeholder="montant (XAF) *" required>
                        <input type="password" name="mdpv" id="" placeholder="votre mot de passe *">
                   <div class="btn">
                        <input type="submit"  name="tranfert" value="Tranfert">
                    <input type="reset" value="Annuler" onclick="closePopup1()">
                </div>
                    </div>

                    </form>
                </div>
               
            </div>

            <div class="operatioPopup " id="op2">
                <div class="popup retraitPopup">
                    <form action="traiter.php" method="post">
                        <span>Retirer de l'argent</span>

                        <div class="inputs">
                        <input type="number" name="montantr" id="" placeholder="montant (XAF) *" required>
                        <input type="password" name="mdpr" id="" placeholder="mot de passe *" required>
                        <div class="btn">
                    <input type="submit" name="retirer" value="Retirer">
                    <input type="reset" value="Annuler" onclick="closePopup2()">
                        </div>
                </div>
                    
                    </form>
                </div>

            </div>

            <div class="operatioPopup " id="op3">
                <div class="popup depotPopup">
                    <form action="traiter.php" method="post">
                        <span>Déposer de l'argent</span>

                        <div class="depotOptions">
                       <button type="button" onclick="momoOmPopup()"><img src="Images/mtn_momo.png" alt="" ><span>Via MTN Mobile Money</span></button>
                       <button type="button" onclick="momoOmPopup()"><img src="Images/Orange-Money-emblem-500x228.png" alt=""><span>Via Orange Money</span></button>
                       <div class="btn">
                    <input type="reset" value="Annuler" onclick="closePopup3()">
                        </div>
                </div>
                    
                    </form>
                </div>

            </div>



            <div class="operatioPopup " id="op4">

                <div class="popup momoOmPopup">
                             <form action="traiter.php" method="post">
                                 <span>Dépôt d'argent</span>
         
                                 <div class="inputs">
                                 <input type="text" name="numerod" id="" placeholder="numéro du téléphone *" required>
                                 <input type="number" name="montantd" id="" placeholder="montant (XAF) *" required>
                                 <input type="password" name="mdpd" id="" placeholder="votre mot de passe *">
                            <div class="btn">
                                 <input type="submit"  name="depot" value="Tranfert">
                             <input type="reset" value="Annuler" onclick="closePopup4()">
                         </div>
                             </div>
         
                             </form>
                         </div>
                        
                     </div>
            


            <!-- LE DASHBOARD -->
    <section class="dashboard">
        <div class="top">
            <i class="sidebar-toggle"><ion-icon name="menu-outline"></ion-icon></i>

            <div class="search-box">
                <i><ion-icon name="search-outline"></ion-icon></i>
                <input type="text" placeholder="Afficher un type de transaction...">
            </div>
            <?php
            @$dossier = "upload/";
            @$chemin= $dossier.$img;
            if(file_exists($chemin)){
              echo  "<img src=".$chemin." alt=''>";
            }else{
              echo "<img src='images/profile.jpg' alt=''>";
            }
  ?>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title hello">
                    <span>Bon retour, </span> <span> <?php

// Vérification de l'authentification (à adapter à votre logique)
if (isset($_SESSION["compte"])) {
    $numcompte = $_SESSION["compte"];
} else {
    echo "<p>Veuillez vous connecter pour accéder à la page d'accueil.</p>";
    // Formulaire de connexion...
}
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "";
$base = "banque";

$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $base);

// Vérification de la connexion
if ($connexion->connect_error) {
die("Échec de la connexion : " . $connexion->connect_error);
}
$query = "SELECT * FROM user WHERE numero_compte = '$numcompte'";
$result = mysqli_query($connexion, $query);
if($result){
while($row = $result->fetch_assoc()){
$nom=$row["nom"];
$solde=$row["solde"];
$img=$row['profil'];
}echo $nom ;

}  ?> </span>
                </div>

                <div class="title">
                    <i><ion-icon name="speedometer-outline"></ion-icon></i>
                    <span class="text">Tableau de Bord</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                       <i> <ion-icon name="wallet-outline"></ion-icon><span class="text">Solde du compte</span></i>
                       
                       
                        <span class="number"><?php echo $solde; ?> <span>XAF</span></span>
                    
                    </div>
                    <div class="box box2">
                        <!-- <i><ion-icon name="swap-horizontal-outline"></ion-icon> <span>Opérations</span></i> -->
                       
                        <div class="box21">
                         
                            <button class="operation" onclick="startWithdrawPopup()">Retrait</button>
                        </div>

                        <div class="box22">
                          
                            <button class="operation" onclick="startTransfertPopup()">Virement</button>
                        </div>

                        <div class="box22">
                          
                            <button class="operation" onclick="startDepotPopup()">Dépôt</button>
                        </div>
                    </div>

                   
                    <div class="box box3">
                        <span class="text">Infos de compte (numéro)</span>
                        <span class="number"><?php echo $numcompte ;?></span>
                    </div>
                </div>
            </div>

            <div class="activity">
                <div class="title">
                    <i><ion-icon name="time-outline"></ion-icon></i>
                    <span class="text">Historique des transactions</span>
                </div>

               <div>
                <?php 
                $comp=$_SESSION['compte'];

                $req=" SELECT * FROM historique WHERE num_send='$comp' OR num_recep='$comp' ORDER BY heure DESC";

                $resultat = $connexion->query($req);
       // if($resultat->num_rows > 0) {

            while($row = $resultat->fetch_assoc()){ 
                   // $row = $resultat->fetch_assoc();
                    $solde=$row["montant"];
                    $type=$row['typet'];
                    $heure=$row['heure'];
                    $recep=$row['num_recep'];
                    $envoie=$row['num_send'];

                    if($type=='depot' && $envoie=='***'){

                        echo'vous avez effectuer un depot de  '.$solde. '  a        '.$heure;
                        echo'<br>';
                    }elseif($type='retrait' && $recep=="***"){
                        echo'vous avez effectuer un retrait de  '.$solde. '  a        '.$heure;
                        echo'<br>';

                    }elseif($type='virement' && $comp==$envoie){
                        echo'vous avez envoyer la  somme  de  '.$solde. '  a        '.$heure;
                        echo'<br>';
                    
                    }elseif($type='virement' && $comp==$recep){
                        echo'vous avez recu   la somme  de'.$solde. '  a        '.$heure;
                        echo'<br>';
                    
                    }


                    
                }
                
                
                ?>

               </div>
                </div>
            </div>
        </div>
        
    </section>

    <script src="js/script.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>