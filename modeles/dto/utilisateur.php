<?php
class Utilisateur{
    private $login;
    private $mdp;
    
    public function __construct($unLogin  , $unMdp ){
        $this->login = $unLogin;
        $this->mdp = $unMdp;
    }
    public function getLogin(){
        return $this->login;
    }
    public function setLogin($unLogin){
        $this->login = $unLogin;
    }
    public function getMdp(){
        return $this->mdp;
    }
    public function setMdp($unMdp){
        $this->mdp = $unMdp;
    }
}
?>