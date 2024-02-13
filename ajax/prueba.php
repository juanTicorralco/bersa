<?php
require_once "../controllers/curlController.php";
require_once "../controllers/templateController.php";
session_start();
class ControllerModifyStock{
    public $id;
    public $idStock;
    public $statusOrder;
    public $comment;
    public $gastos;

    public function AgregarAlStock(){        
        if (!isset($_SESSION['user'])) {
            echo '500';
            return;
        }else{
            $time= time();
            if($_SESSION["user"]->token_exp_user < $time){
                echo '500';
                return;
            }else{
                if($_SESSION["user"]->token_user !== "NULL" && $_SESSION["user"]->token_user !== ""){
                    $dataStore = "stock_out_order=1";
                    $url = CurlController::api()."orders?id=". $this->id."&nameId=id_order&token=".$_SESSION["user"]->token_user;
                    $method = "PUT";
                    $fields = $dataStore;
                    $header = array(
                    "Content-Type" => "application/x-www-form-urlencoded"
                    );
                    $updateOrder = CurlController::request($url,$method,$fields,$header);
                    if($updateOrder->status == "200"){
                        echo '200';
                    }else{
                        echo '400'; 
                    }
                }else{
                    echo '500';
                }
            }
        }
    }
    public function CancelarOrderDentroDeRegisters(){        
        if (!isset($_SESSION['user'])) {
            echo '500';
            return;
        }else{
            $time= time();
            if($_SESSION["user"]->token_exp_user < $time){
                echo '500';
                return;
            }else{
                if($_SESSION["user"]->token_user !== "NULL" && $_SESSION["user"]->token_user !== ""){
                    $dataStore = "status_order=Cancelado";
                    $url = CurlController::api()."orders?id=". $this->id."&nameId=id_order&token=".$_SESSION["user"]->token_user;
                    $method = "PUT";
                    $fields = $dataStore;
                    $header = array(
                    "Content-Type" => "application/x-www-form-urlencoded"
                    );
                    $updateOrder = CurlController::request($url,$method,$fields,$header);
                    if($updateOrder->status == "200"){
                        if($_POST["outStockOrder"] == 1){
                            $dataStore = "number_stock=". $_POST["numStock"]+1 ;
                            $url = CurlController::api()."stocks?id=". $this->idStock."&nameId=id_stock&token=".$_SESSION["user"]->token_user;
                            $method = "PUT";
                            $fields = $dataStore;
                            $header = array(
                            "Content-Type" => "application/x-www-form-urlencoded"
                            );
                            $updateStock = CurlController::request($url,$method,$fields,$header);
                            if($updateStock->status == "200"){
                                echo '200';    
                            }else{
                                $dataStore = "status_order=Pendiente";
                                $url = CurlController::api()."orders?id=". $this->id."&nameId=id_order&token=".$_SESSION["user"]->token_user;
                                $method = "PUT";
                                $fields = $dataStore;
                                $header = array(
                                "Content-Type" => "application/x-www-form-urlencoded"
                                );
                                $updateOrder = CurlController::request($url,$method,$fields,$header);
                                if($updateOrder->status == "200"){
                                    echo '400';
                                }
                            }
                        }else if($_POST["outStockOrder"] == 0){
                            echo '200';
                        }
                    }else{
                        echo '400'; 
                    }
                }else{
                    echo '500';
                }
            }
        }
    }
    public function confirmarFinalizarOrder(){        
        if (!isset($_SESSION['user'])) {
            echo '500';
            return;
        }else{
            $time= time();
            if($_SESSION["user"]->token_exp_user < $time){
                echo '500';
                return;
            }else{
                if($_SESSION["user"]->token_user !== "NULL" && $_SESSION["user"]->token_user !== ""){
                    $dataStore = "status_order=". $this->statusOrder;
                    $url = CurlController::api()."orders?id=". $this->id."&nameId=id_order&token=".$_SESSION["user"]->token_user;
                    $method = "PUT";
                    $fields = $dataStore;
                    $header = array(
                    "Content-Type" => "application/x-www-form-urlencoded"
                    );
                    print_r("Correcto finalizado");
                    print_r("variable: ". $this-> comment);
                    if( $this-> comment == ""){
                        print_r("la variable no existe");
                    }
                    // $updateOrder = CurlController::request($url,$method,$fields,$header);
                    // if($updateOrder->status == "200"){
                    //     echo '200';
                    // }else{
                    //     echo '400'; 
                    // }
                }else{
                    echo '500';
                }
            }
        }
    }
}

$idOrder = new ControllerModifyStock();
// $idOrder ->  comment = $_POST["comment"];
// $idOrder ->  gastos = $_POST["gastos"];        
// $idOrder ->  id = $_POST["idOrder"];
// $idOrder ->  statusOrder = $_POST["statusorder"];
$idOrder -> confirmarFinalizarOrder();
?>