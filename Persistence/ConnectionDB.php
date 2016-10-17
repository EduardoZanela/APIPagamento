<?php
class ConnectionDB extends PDO{
    private static $instance = null;

    public function ConnectionDB($dsn, $user, $pwd){
        parent::__construct($dsn, $user, $pwd);
    }
    
    public static function getInstance(){
        if(!isset(self::$instance)){
            try{
                self::$instance = new ConnectionDB("mysql:dbname=api;host=localhost", "root", "");
                //echo 'Connectado ao banco';
            } catch (Exception $ex) {
                echo 'Ocorreram falhas ao conectar';
                echo "$ex";
                exit();
            }            
        }
        return self::$instance;       
    }
    
}
