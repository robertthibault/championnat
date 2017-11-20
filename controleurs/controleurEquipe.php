<?php

/*****************************************************************************************************
 * Instancier un objet contenant la liste des équipes et le conserver dans une variable de session
 *****************************************************************************************************/
	$_SESSION['listeEquipes'] = new Equipes(EquipeDAO::lesEquipes());

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

$menuEquipe->ajouterComposant($menuEquipe->creerItemLien("Ajouter une équipe", "creer"));
foreach ($_SESSION['listeEquipes']->getEquipes() as $uneEquipe){
	$menuEquipe->ajouterComposant($menuEquipe->creerItemLien($uneEquipe->getNomEquipe() ,$uneEquipe->getIdEquipe()));
}

$leMenuEquipes = $menuEquipe->creerMenuEquipe($_SESSION['equipe']);

/*****************************************************************************************************
 * Récupérer l'équipe sélectionnée
 *****************************************************************************************************/
 if ($_SESSION['equipe'] != "0" && $_SESSION['equipe'] != "creer"){
	 $equipeActive = $_SESSION['listeEquipes']->chercheEquipe($_SESSION['equipe']);

	 if(isset($_POST['modifier'])){
		 $equipeActive->setNomEquipe($_POST['nom']);
		 $equipeActive->setNomEquipeLong($_POST['nomLong']);
		 $equipeActive->setNomEntraineur($_POST['entraineur']);
		 $equipeActive->setNomPresident($_POST['president']);
		 $equipeActive->setDateFondation($_POST['dateFondation']);
		 EquipeDAO::modifier($equipeActive);
	 }
	 if (isset($_POST['supprimer'])) {
		 EquipeDAO::supprimer($equipeActive);
		 include_once 'vues/squeletteEquipe.php';
		 echo "L'équipe a bien été supprimée.";
	 }

/*****************************************************************************************************
 * Récupérer les informations de l'équipe sélectionnée
 *****************************************************************************************************/
	 if (isset($equipeActive)){

	 $formulaireEquipe = new Formulaire('post', 'index.php', 'fEquipe', '');

	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerInputImage($equipeActive->getNomEquipe(), $equipeActive->getNomEquipe(), "images/" . lcfirst($equipeActive->getNomEquipe()) . "2.png"), 2);
	 $formulaireEquipe->ajouterComposantTab();

	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerLabelFor('nom', 'Nom :'), 1);
	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerInputTexte('nom', 'nom', $equipeActive->getNomEquipe(), 1, ''), 1);
	 $formulaireEquipe->ajouterComposantTab();

	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerLabelFor('nomLong', 'Nom Long :'), 1);
	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerInputTexte('nomLong', 'nomLong', $equipeActive->getNomEquipeLong(),1 , ''), 1);
	 $formulaireEquipe->ajouterComposantTab();

	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerLabelFor('entraineur', 'Entraîneur :'), 1);
	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerInputTexte('entraineur', 'entraineur', $equipeActive->getNomEntraineur(), 1, ''), 1);
	 $formulaireEquipe->ajouterComposantTab();

	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerLabelFor('president', 'Président :'), 1);
	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerInputTexte('president', 'president', $equipeActive->getNomPresident(), 1, ''), 1);
	 $formulaireEquipe->ajouterComposantTab();

	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerLabelFor('dateFondation', 'Date de fondation :'), 1);
	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerInputTexte('dateFondation', 'dateFondation', $equipeActive->getDateFondation(), 1, ''), 1);
	 $formulaireEquipe->ajouterComposantTab();

	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerInputSubmit('supprimer', 'supprimer', "Supprimer"), 1);
	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerInputSubmit('modifier', 'modifier', "Modifier"), 1);
	 $formulaireEquipe->ajouterComposantTab();

	 $formulaireEquipe->creerFormulaire();
 	 }
	}

	if ($_SESSION['equipe'] == "creer"){

		if (isset($_POST['ajouter'])) {
			$equipe = new Equipe();
			$equipe->setNomEquipe($_POST['nom']);
 		 	$equipe->setNomEquipeLong($_POST['nomLong']);
 		 	$equipe->setNomEntraineur($_POST['entraineur']);
 		 	$equipe->setNomPresident($_POST['president']);
 		 	$equipe->setDateFondation($_POST['dateFondation']);
			EquipeDAO::ajouter($equipe);
 	 }

	 $formulaireEquipe = new Formulaire('post', 'index.php', 'fEquipe', '');

	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerLabelFor('nom', 'Nom :'), 1);
	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerInputTexte('nom', 'nom', '', 1, ''), 1);
	 $formulaireEquipe->ajouterComposantTab();

	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerLabelFor('nomLong', 'Nom Long :'), 1);
	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerInputTexte('nomLong', 'nomLong', '', 1 , ''), 1);
	 $formulaireEquipe->ajouterComposantTab();

	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerLabelFor('entraineur', 'Entraîneur :'), 1);
	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerInputTexte('entraineur', 'entraineur', '', 1, ''), 1);
	 $formulaireEquipe->ajouterComposantTab();

	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerLabelFor('president', 'Président :'), 1);
	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerInputTexte('president', 'president', '', 1, ''), 1);
	 $formulaireEquipe->ajouterComposantTab();

	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerLabelFor('dateFondation', 'Date de fondation :'), 1);
	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerInputTexte('dateFondation', 'dateFondation', '', 1, ''), 1);
	 $formulaireEquipe->ajouterComposantTab();

	 $formulaireEquipe->ajouterComposantLigne($formulaireEquipe->creerInputSubmit('ajouter', 'ajouter', "Ajouter"), 1);
	 $formulaireEquipe->ajouterComposantTab();

	 $formulaireEquipe->creerFormulaire();
 }

include_once 'vues/squeletteEquipe.php';
