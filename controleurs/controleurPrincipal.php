<?php

require_once 'configs/param.php';
require_once 'lib/menu.php';
require_once 'lib/formulaire.php';
require_once 'lib/tableau.php';
require_once 'lib/dispatcher.php';
require_once 'modeles/dao.php';


if(isset($_GET['menuPrincipalC'])){
	$_SESSION['menuPrincipalC']= $_GET['menuPrincipalC'];
} else{
	if(!isset($_SESSION['menuPrincipalC'])){
		$_SESSION['menuPrincipalC']="equipeC";
	}
}

$messageErreurConnexion ='';
if(isset($_POST['login'] , $_POST['mdp'])){
    $unUtilisateur = new Utilisateur($_POST['login'] , $_POST['mdp']);
    $_SESSION['identification'] = UtilisateurDAO::verification($unUtilisateur);
    if($_SESSION['identification']){
        $_SESSION['menuPrincipalC']="equipe";
    } else {
        $messageErreurConnexion = 'Login ou mot de passe incorrect !';
    }
}

$menuPrincipal = new Menu("menuPrincipal");
if(isset($_SESSION['identification']) && $_SESSION['identification']){
    $menuPrincipal->ajouterComposant($menuPrincipal->creerItemImage("equipe","images/equipe.png", "Equipes"));
} else{
    $menuPrincipal->ajouterComposant($menuPrincipal->creerItemImage("equipeC","images/equipe.png", "Equipes"));
}
$menuPrincipal->ajouterComposant($menuPrincipal->creerItemImage("match", "images/match.png" , "Matchs"));
$menuPrincipal->ajouterComposant($menuPrincipal->creerItemImage("classement", "images/classement.png" , "Classement"));
$menuPrincipal->ajouterComposant($menuPrincipal->creerItemImage("historique", "images/historique.png" , "Historique"));

if(isset($_SESSION['identification']) && $_SESSION['identification']){
    $menuPrincipal->ajouterComposant($menuPrincipal->creerItemImage("connexion", "images/deconnex.png", "Déconnexion"));
} else{
    $menuPrincipal->ajouterComposant($menuPrincipal->creerItemImage("connexion","images/connex.png", "Connexion"));
}



include_once dispatcher::dispatch($_SESSION['menuPrincipalC']);

?>
