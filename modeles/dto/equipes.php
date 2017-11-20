<?php
class Equipes{
	private $equipes= array();

	public function __construct($array){
		if (is_array($array)) {
			$this->equipes = $array;
		}
	}

	public function getEquipes(){
		return $this->equipes;
	}

	public function chercheEquipe($unIdEquipe){
		$i = 0;
		while ($unIdEquipe != $this->equipes[$i]->getIdEquipe() && $i < count($this->equipes)-1){
			$i++;
		}
		if ($unIdEquipe == $this->equipes[$i]->getIdEquipe()){
			return $this->equipes[$i];
		}
	}



}