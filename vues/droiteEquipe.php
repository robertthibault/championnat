<div>

  <?php
    if ($_SESSION['equipe'] != "0"  || $_SESSION['equipe'] == "creer" && isset($formulaireEquipe)){
      echo $formulaireEquipe->afficherFormulaire();
    }  else{
      echo "Veuillez selectionner une équipe.";
    }
  ?>

</div>
