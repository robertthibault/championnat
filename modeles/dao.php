<?php
class DBConnex extends PDO{

	private static $instance;

	public static function getInstance(){
		if ( !self::$instance ){
			self::$instance = new DBConnex();
		}
		return self::$instance;
	}

	function __construct(){
		try {
			parent::__construct(Param::$dsn ,Param::$user, Param::$pass);
		} catch (Exception $e) {
			echo $e->getMessage();
			die("Impossible de se connecter. " );
		}
	}

	public function __destruct(){
		if(!is_null(self::$instance)){
			self::$instance = null;
		}
	}

	public function queryFetchAll($sql){
		$sth  =$this->query($sql);

		if ( $sth ){
			return $sth -> fetchAll(PDO::FETCH_ASSOC);
		}

		return false;
	}

	public function queryFetchFirstRow($sql){
		$sth    = $this->query($sql);
		$result    = array();

		if ( $sth ){
			$result  = $sth -> fetch();
		}

		return $result;
	}

	public function insert($sql){
		if ( $this -> exec($sql) > 0 ){
			return 1;
			//$this->lastInsertId();
		}
		return false;
	}

	public function update($sql){
		return $this->exec($sql) ;
	}

	public function delete($sql){
		return $this->exec($sql) ;
	}
}

class EquipeDAO{

	public static function lire(Equipe $equipe){
		$sql = "SELECT * FROM Equipe where idEquipe = " . $equipe->getIdEquipe();
		$equipe = DBConnex::getInstance()->queryFetchFirstRow($sql);
		return $equipe;
	}

	public static function supprimer(Equipe $equipe){
		$sql = "DELETE FROM equipe WHERE idEquipe = " . $equipe->getIdEquipe();
		return DBConnex::getInstance()->delete($sql);
	}

	public static function modifier(Equipe $equipe){
		$sql = "UPDATE equipe
						SET nomEquipe = '" . $equipe->getNomEquipe() . "',
								nomEquipeLong = '" . $equipe->getNomEquipeLong() . "',
								nomEntraineur = '" . $equipe->getNomEntraineur() . "',
								nomPresident = '" . $equipe->getNomPresident() . "',
								dateFondation = " . $equipe->getDateFondation() . "
						WHERE idEquipe = " . $equipe->getIdEquipe();
		return DBConnex::getInstance()->update($sql);
	}

	public static function ajouter(Equipe $equipe){
		$sql = "INSERT INTO equipe (nomEquipe, 	nomEquipeLong, nomEntraineur, nomPresident, dateFondation)
						VALUES ('" . $equipe->getNomEquipe() . "','" . $equipe->getNomEquipeLong() . "','" . $equipe->getNomEntraineur() . "','" . $equipe->getNomPresident() . "','"
						. $equipe->getDateFondation() . "')";
		return DBConnex::getInstance()->insert($sql);
	}

	public static function lesEquipes(){
		$result = array();
		$sql = "SELECT * FROM equipe ORDER BY nomEquipe" ;
		$liste = DBConnex::getInstance()->queryFetchAll($sql);
		if(!empty($liste)){
			foreach($liste as $equipe){
				$uneEquipe = new Equipe($equipe['IDR'],$equipe['nomEquipe'] );
				$uneEquipe->hydrate($equipe);
				$result[] = $uneEquipe;
			}
		}
		return $result;
	}

}

class UtilisateurDAO{

    public static function verification(Utilisateur $utilisateur){
        $sql = "SELECT login FROM Utilisateur WHERE login = '" . $utilisateur->getLogin() . "' AND  mdp = '" .  md5($utilisateur->getMdp()) ."'";
        $login = DBConnex::getInstance()->queryFetchFirstRow($sql);
        return $login[0];
    }

}
