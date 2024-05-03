<?php 
// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "";
$base = "banque";

$connexion=new mysqli($serveur,$utilisateur,$motdepasse);
if($connexion->connect_error){
    die("echec de le connexion");
}
$creation="CREATE DATABASE IF NOT EXISTS banque";
if($connexion->query($creation)==TRUE){

}

$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $base);

// Vérification de la connexion serveur
if ($connexion->connect_error){
    die("Échec de la connexion : " . $connexion->connect_error);
}


$req="CREATE TABLE IF NOT EXISTS `historique` (
    `montant` int NOT NULL,
    `heure` timestamp NULL DEFAULT NULL,
    `typet` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
    `num_send` varchar(10) NOT NULL,
    `num_recep` varchar(20) NOT NULL
  )";
    $resultat = $connexion->query($req);

    $req="CREATE TABLE IF NOT EXISTS `user` (
        `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
        `numero_compte` int NOT NULL,
        `solde` int NOT NULL,
        `nom` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
        `num_tel` int NOT NULL,
        `passw` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
        `profil` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
        PRIMARY KEY (`numero_compte`,`email`),
        KEY `idx_email` (`email`)
      )";
    $resultat = $connexion->query($req);
