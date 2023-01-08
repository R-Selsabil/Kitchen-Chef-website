<?php
class userModel{
    private $dbname="cuisine_chef_php";
    private $host="localhost";
    private $user="root";
    private $password="";
    private function connectDB($dbname,$host,$user,$password){
        try {
            $db= new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$user,$password);
        } catch (PDOException $th) {
            printf("erreur de connexion à la base de donnée",$th->getMessage());
            exit();
        }
        return $db;
    }
    private function disconnect(&$db){
        $db=null;
    }
    private function request($db,$r){
        return $db->query($r);
    }
    public function getMenu(){
        $db=$this->connectDB($this->dbname,$this->host,$this->user,$this->password);
        $query="SELECT * FROM menu";
        $menu=$this->request($db,$query);
        $this->disconnect($db);
        return $menu;
    }
    public function getPopoularRecipes() {
        $db=$this->connectDB($this->dbname,$this->host,$this->user,$this->password);
        $query="SELECT * FROM recipe ORDER BY ratingAverage DESC LIMIT 6";
        $popularRecipes=$this->request($db,$query);
        $this->disconnect($db);
        return $popularRecipes;
    }
    public function getPopoularNews() {
        $db=$this->connectDB($this->dbname,$this->host,$this->user,$this->password);
        $query="SELECT * FROM news LIMIT 2";
        $PopoularNews=$this->request($db,$query);
        $this->disconnect($db);
        return $PopoularNews;
    }

}
?>