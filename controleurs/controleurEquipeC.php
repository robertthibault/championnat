<?php

/*****************************************************************************************************
 * Instancier un objet contenant la liste des équipes et le conserver dans une variable de session
 *****************************************************************************************************/
if(!isset($_SESSION['listeEquipes'])){
	$_SESSION['listeEquipes'] = new Equipes(EquipeDAO::lesEquipes());

}

/*****************************************************************************************************
 * Conserver dans une variable de session l'item actif du menu equipe
 *****************************************************************************************************/
if(isset($_GET['equipe'])){
	$_SESSION['equipe']= $_GET['equipe'];
}
else
{
	if(!isset($_SESSION['equipe'])){
		$_SESSION['equipe']="0";
	}
}

/*****************************************************************************************************
 * Créer un menu vertical à partir de la liste des équipes
 *****************************************************************************************************/
$menuEquipe = new menu("menuEquipe");

foreach ($_SESSION['listeEquipes']->getEquipes() as $uneEquipe){
	$menuEquipe->ajouterComposant($menuEquipe->creerItemLien($uneEquipe->getNomEquipe() ,$uneEquipe->getIdEquipe()));
}

$leMenuEquipes = $menuEquipe->creerMenuEquipe($_SESSION['equipe']);

/*****************************************************************************************************
 * Récupérer l'équipe sélectionnée
 *****************************************************************************************************/
 
 if ($_SESSION['equipe'] != "0"){
 	$equipeActive = $_SESSION['listeEquipes']->chercheEquipe($_SESSION['equipe']);

 /*****************************************************************************************************
 * Récupérer les informations de l'équipe sélectionnée
 *****************************************************************************************************/
 	$formulaireEquipe = new Formulaire('post', 'index.php', 'fEquipe', '');

 	$formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerInputImage($equipeActive->getNomEquipe(), $equipeActive->getNomEquipe(), "images/" . lcfirst($equipeActive->getNomEquipe()) . "2.png"), 2);
 	$formulaireEquipe->ajouterComposantTab();

 	$formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerLabelFor('nom', 'Nom :'), 1);
 	$formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerLabelFor('nom', $equipeActive->getNomEquipe()), 1);
 	$formulaireEquipe->ajouterComposantTab();

 	$formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerLabelFor('nomLong', 'Nom Long :'), 1);
 	$formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerLabelFor('nomLong', $equipeActive->getNomEquipeLong()), 1);
 	$formulaireEquipe->ajouterComposantTab();

 	$formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerLabelFor('entraineur', 'Entraîneur :'), 1);
 	$formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerLabelFor('entraineur', $equipeActive->getNomEntraineur()), 1);
 	$formulaireEquipe->ajouterComposantTab();

 	$formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerLabelFor('president', 'Président :'), 1);
 	$formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerLabelFor('president', $equipeActive->getNomPresident()), 1);
 	$formulaireEquipe->ajouterComposantTab();

 	$formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerLabelFor('dateFondation', 'Date de fondation :'), 1);
 	$formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerLabelFor('dateFondation', $equipeActive->getDateFondation()), 1);
 	$formulaireEquipe->ajouterComposantTab();


 	$formulaireEquipe->creerFormulaire();
 }
include_once 'vues/squeletteEquipe.php';
