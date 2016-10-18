<?php
require_once ('../Persistence/ConnectionDB.php');
class OrderDAO{
    private $connection = null;

    public function __construct() {
        $this->connection = ConnectionDB::getInstance();
    }


    public  function insertOrder($order){
        echo 'ola insert';
        try{
            $status = $this->connection->prepare("Insert Into order_finish(id,comprador,valorComprado,paymentMethod,idmetodo)"
                . " values(null,?,?,?,?)");

            $status->bindValue(1, $order->comprador);
            $status->bindValue(2, $order->valorComprado);
            $status->bindValue(3, $order->paymentMethod);
            $status->bindValue(4, $order->idmetodo);
            echo 'ola insert';
            $status->execute();

            $this->connection = null;


        } catch (PDOException $ex) {
            echo 'Erro ocorreu';
        }

    }

    public function maxId(){
        try{
            $sql = "SELECT id FROM order_finish ORDER BY id DESC LIMIT 1";
            $stmt = $this->connection->prepare($sql);

            $stmt->execute();

            $results = $stmt->fetchAll();

            $this->connection = null;

            return $results;
        } catch (PDOException $e){
            echo utf8_decode('Ocorrema erros ao busca o usuário' . $e);
        }
    }

}


?>