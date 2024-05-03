<?php 
// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "";
$base = "banque";

$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $base);

// Vérification de la connexion serveur
if ($connexion->connect_error){
    die("Échec de la connexion : " . $connexion->connect_error);
}


// Récupération des données du formulaire

if(isset($_POST['enregistrer']))
{ 
@$nom = htmlspecialchars($_POST["nom"]);
@$email = htmlspecialchars($_POST["email"]);
@$tel = htmlspecialchars($_POST["tel"]);
@$motdepasse = md5($_POST["pswd"]); // Hashage du mot de passe
    //upload de l'image sur le serveur 
   
   //récupération de l'image
$dossier="upload/";
$filename=basename($_FILES["image"]["name"]);
$chemin= $dossier.$filename;
// Vérifiction del'extension du fichier
$extention= array("jpg","jpeg","png");
$extent_file=strtolower(substr(strrchr($filename,"."),1));
//$extent_file = strtolower(pathinfo($cheminFichier, PATHINFO_EXTENSION));
if(in_array($extent_file,$extention))
{
    move_uploaded_file($_FILES["image"]["tmp_name"],$chemin);
    echo "extention valide";
}
else
{
    echo "format de fichier invalide";
}


// Génération d'un numéro de compte aléatoire à huit chiffres
@$numCompte = mt_rand(10000000, 99999999);

// Vérification que le numéro de compte n'existe pas déjà dans la base
$query = "SELECT numero_compte FROM user WHERE numero_compte = $numCompte";
$result = $connexion->query($query);

while ($result->num_rows > 0) {
    // Tant que le numéro de compte existe déjà, générez-en un nouveau
    $numCompte = mt_rand(10000000, 99999999);
    $query = "SELECT numero_compte FROM user WHERE numero_compte = $numCompte";
    $result = $connexion->query($query);
}
$solde=0;
// Insertion des données dans la table "user"
$requete = "INSERT INTO user (email, nom, num_tel,passw,numero_compte,solde,profil) VALUES ('$email', '$nom', '$tel', '$motdepasse','$numCompte','$solde','$filename')";
session_start();
$_SESSION["compte"] = $numCompte;
if ($connexion->query($requete) === TRUE) {
    header("Location: Tableau.php");
    exit; 
} else {
    echo "Erreur : " . $requete . "<br>" . $connexion->error;
}

$connexion->close();
}



//gestion de la connexion 


if(isset($_POST['seconnecter'])){
    // Récupération des données du formulaire de connexion
$email_con = $_POST["email"];
$motdepasse= $_POST["pswd"];

// Requête pour récupérer le mot de passe associé à l'e-mail fourni
$verif = "SELECT passw,numero_compte FROM user WHERE email = '$email_con'";
$resultat = $connexion->query($verif);

if ($resultat->num_rows > 0) {
    $row = $resultat->fetch_assoc();
    $compte=$row["numero_compte"];
    session_start();
    if (md5($motdepasse)===$row['passw']) {
        $_SESSION["compte"] = $compte;
        header("Location: Tableau.php");
        exit;
        
    } else {
        echo'mot de passe incorrect';
   
    }
}else {
    echo "Identifiant inconnu !";
}

}

/*gestion du virement*/

if(isset($_POST['tranfert']))
{
    session_start();
    $benef=$_POST['numb'];
    $comp=$_SESSION['compte'];
   $montant=$_POST['montantv'];
    $pswd=$_POST['mdpv'];

    $req=" SELECT solde,passw from USER where numero_compte='$comp'";
    $resultat = $connexion->query($req);
    if ($resultat->num_rows > 0) {
        $row = $resultat->fetch_assoc();
        $solde=$row["solde"];
        
        //verification que le solde est
        if(md5($pswd) === $row['passw']){ 

        if($solde<$montant){
            echo'montant insufisant';
        }else {
            //transfert 
            $req="SELECT solde from USER where numero_compte='$benef'";
            $resultat = $connexion->query($req);
            if ($resultat->num_rows > 0) {
                $row = $resultat->fetch_assoc();
                $soldeb=$row["solde"];
                $soldeb+=$montant;
            $times=date("y-m-d "); 

                //mise a jour compte recepteur
            $req=" UPDATE user SET solde='$soldeb' where numero_compte='$benef'";
            $type="virement";
            $resultat = $connexion->query($req);
            //enregistrement de la transaction          
           // $req="INSERT INTO `historique` (`montant`, `heure`, `typet`, `num_send`, `num_recep`) VALUES ('$montant', '$times', '$type', '$comp', '$benef')";
            $resultat = $connexion->query($req);
            
            //mise a jour compte emmeteur

           
            $solde-=$montant;
            $req=" UPDATE user SET solde='$solde' where numero_compte='$comp'";
            $resultat = $connexion->query($req);
            $times=date("y-m-d H:m:s"); 
            $type="virement";    
            $req="INSERT INTO `historique` (`montant`, `heure`, `typet`, `num_send`, `num_recep`) VALUES ('$montant', '$times', '$type', '$comp', '$benef')";
            $resultat = $connexion->query($req);
             
            header("Location: Tableau.php");

            }else{
                echo'beneficiaire indisponible';
            }
        }
        }else{
            echo 'mot de passe incorect';
        }

    }
 
}

/*gestion du retrait*/

if(isset($_POST['retirer'])){

    session_start();
    $comp=$_SESSION['compte'];

    $montant=$_POST['montantr'];
    $pswd=$_POST['mdpr'];

    $req=" SELECT solde,passw from USER where numero_compte='$comp'";
    $resultat = $connexion->query($req);
    if ($resultat->num_rows > 0) {
        $row = $resultat->fetch_assoc();
        $solde=$row["solde"];
        //verification que le solde est suffisant
        if(md5($pswd) === $row['passw']){ 
        if($solde<$montant || $montant<500){
            echo'retrait echouer';
        }else {
            $solde=$solde-$montant;
            $req=" update user SET solde='$solde' where numero_compte='$comp'";
            $resultat = $connexion->query($req);
            //enregistrement du depot
           

            $type="retrait";
            $benef="***";
            $times=date("y-m-d H:m:s"); 


            $req="INSERT INTO `historique` (`montant`, `heure`, `typet`, `num_send`, `num_recep`) VALUES ('$montant', '$times', '$type', '$comp', '$benef')";
            $resultat = $connexion->query($req);
          header("Location: Tableau.php");

        }
    }else{
        echo 'mot de passe incorrect';
    }

}
}

//gestion des depots

if(isset($_POST['depot'])){

    session_start();
    $comp=$_SESSION['compte'];
    $numero=$_POST['numerod'];

    $montant=$_POST['montantd'];
    $pswd=$_POST['mdpd'];

    $req=" SELECT solde,passw from USER where numero_compte='$comp'";
    $resultat = $connexion->query($req);
    if ($resultat->num_rows > 0) {
        $row = $resultat->fetch_assoc();
        $solde=$row["solde"];
        if(md5($pswd) === $row['passw']){ 

            $solde=$solde + $montant;
            echo'solde credite';
            $req=" update  user SET solde='$solde' where numero_compte ='$comp'";
            $resultat = $connexion->query($req);

            $type="depot";
            $benef=$comp;
            $comp='***';
            $times=date("y-m-d H:m:s"); 
 
            $req="INSERT INTO `historique` (`montant`, `heure`, `typet`, `num_send`, `num_recep`) VALUES ('$montant', '$times', '$type', '$comp', '$benef')";
            $resultat = $connexion->query($req);

          header("Location: Tableau.php");
        }else{
            echo"mot de passe incorrect";
        }

}




}




  

        
    

    





