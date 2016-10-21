<?php
include '../Persistence/ConnectionDB.php';
class ProductDAO{
	private $connection = null;

	public function __construct() {
		$this->connection = ConnectionDB::getInstance();
	}


    public  function selectProduct(){
        try{
            $status = $this->connection->prepare("Select * from products");

            $status->execute();

            $array = array();
            $array = $status->fetchAll();

            $this->connection = null;

            return $array;
        } catch (PDOException $e){
            echo utf8_decode('Ocorrema erros ao busca o usuário' . $e);
        }
    }

    public  function selectBuyProduct($id){
        try{
            $status = $this->connection->prepare("Select * from products where id=$id");

            $status->execute();

            $array = array();
            $array = $status->fetchAll();

            $this->connection = null;

            return $array;
        } catch (PDOException $e){
            echo utf8_decode('Ocorrema erros ao busca o usuário' . $e);
        }
    }
}


?>
