<?php
class Equipe{
	private $idEquipe;
	private $nomEquipe;
	private $nomEquipeLong;
	private $nomEntraineur;
	private $nomPresident;
	private $dateFondation;
	private $lesMatchs = array();

	public function __construct($unIdEquipe = NULL , $unNomEquipe = NULL){
		$this->idEquipe = $unIdEquipe;
		$this->nomEquipe = $unNomEquipe;
	}

	public function getIdEquipe(){
		return $this->idEquipe;
	}

	public function getNomEquipe(){
		return $this->nomEquipe;
	}
	public function setNomEquipe($unNomEquipe){
		$this->nomEquipe = $unNomEquipe;
	}

	public function getNomEquipeLong(){
		return $this->nomEquipeLong;
	}
	public function setNomEquipeLong($unNomEquipeLong){
		$this->nomEquipeLong = $unNomEquipeLong;
	}

	public function getNomEntraineur(){
		return $this->nomEntraineur;
	}
	public function setNomEntraineur($unNomEntraineur){
		$this->nomEntraineur = $unNomEntraineur;
	}

	public function getNomPresident(){
		return $this->nomPresident;
	}
	public function setNomPresident($unNomPresident){
		$this->nomPresident = $unNomPresident;
	}

	public function getDateFondation(){
		return $this->dateFondation;
	}
	public function setDateFondation($uneDateFondation){
		$this->dateFondation = $uneDateFondation;
	}

	public function getLesMatchs(){
		return $this->lesMatchs;
	}
	public function setLesMatchs($lesMatchs){
		$this->lesMatchs = $lesMatchs;
	}


	public function hydrate(array $donnees)
	{
		foreach ($donnees as $key => $value)
		{
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
	}



}

