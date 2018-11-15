<?php namespace models;

class Artist
{
    private $id;
    private $name;
    private $avatar;

    public function __construct($n, $files, $id=""){
        $this->id=$id;
        $this->name=$n;
        $this->avatar= $files;
    }

    public function getName(){
        return $this->name;
    }

    public function getId(){
        return $this->id;
    }

    public function getAvatar() {
         return $this->avatar;
    }

    public function setId($newId){
        $this->id = $newId;
    }

    public function setName($newName){
        $this->name = $newName;
    }
}

?>
