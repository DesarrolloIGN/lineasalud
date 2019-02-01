<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
session_start();

// include database and object files
include_once '../config/db.php';
include_once '../config/config.php';
include_once '../objects/hub.php';
include_once '../objects/clientes.php';

 
// get database connection

$database = new Database();
$db = $database->getConnection();
$hub = new Hub($db);

$user = new Usuarios($db);

$hub->matricula = isset($_POST['matricula']) ? strtoupper($_POST['matricula']) : "";
$hub->telefono = isset($_POST['telefono']) ? $_POST['telefono'] : "";
$hub->empresa = isset($_POST['codempresa']) ? $_POST['codempresa'] : "";
$user->usuario = isset($_POST['usuario']) ? $_POST['usuario'] : "";
$user->pass = isset($_POST['pass']) ? $_POST['pass'] : "";

$pass = $user->pass;

$existe=$user->exist();


$error=0;

$res="Error - falta " ;

if($hub->matricula==""){
	$res.= "Matricula, ";
	$error++;
}

if($hub->empresa==""){
	$res.= "empresa, ";
	$error++;
}

if($user->pass=="" || $user->valida_pass($pass)==0){
	$res.= "usuario o password invalido, ";
	$error++;
}


if($error>0){
	$res=Array("status"=>"KO","mensaje"=>substr($res,0,-1),"con1"=>"","con2"=>"","con3"=>"","con4"=>"","con5"=>"");
}else{
    
	$formulario=$hub->readOne($hub->matricula.$hub->telefono.$hub->empresa);
    //var_dump($formulario);
	$con1=$formulario->con1;
	$con2=$formulario->con2;
	$con3=$formulario->con3;
	$con4=$formulario->con4;
	$con5=$formulario->con5;
    $telefono=$formulario->telefono;
	$id_clientes=$hub->id_clientes;
	$robinson=$formulario->robinson;
	if($id_clientes>0 && $telefono!=""){
        
        if($con1==4 ||  $con1==5  || $con2==4 ||  $con2==5  || $con3==4 ||  $con3==5 || $con4==4 ||  $con4==5)
       {
          $res=Array("status"=>"KO","mensaje"=>"Existe","con1"=>$con1,"con2"=>$con2,"con3"=>$con3,"con4"=>$con4,"robinson"=>$robinson);
       }
        else
        {
        
		$res=Array("status"=>"OK","mensaje"=>"Existe","con1"=>$con1,"con2"=>$con2,"con3"=>$con3,"con4"=>$con4,"robinson"=>$robinson);
	
        }
	}else{
        
        $formulario=$hub->readOnebyMatriculaEmpresa($hub->empresa,strtoupper($_POST['matricula']));
        //var_dump($formulario);
      	$con1=$formulario->con1;
	$con2=$formulario->con2;
	$con3=$formulario->con3;
	$con4=$formulario->con4;
	$con5=$formulario->con5;
	$robinson=$formulario->robinson;
    $id_clientes=$hub->id_clientes;
        if($id_clientes>0)
            
        {
        
        
       if($con1==4 ||  $con1==5  || $con2==4 ||  $con2==5  || $con3==4 ||  $con3==5 || $con4==4 ||  $con4==5)
       {
          $res=Array("status"=>"KO","mensaje"=>"Existe uno con","con1"=>$con1,"con2"=>$con2,"con3"=>$con3,"con4"=>$con4,"robinson"=>$robinson);
       }
        else
        {
            $res=Array("status"=>"OK","mensaje"=>"Existen todos con las condiciones bien","con1"=>$con1,"con2"=>$con2,"con3"=>$con3,"con4"=>$con4,"robinson"=>$robinson);
        }
		/*$res=Array("status"=>"OK","mensaje"=>"No Existe en la GRPD, pero se envia el mensaje igual","con1"=>"","con2"=>"","con3"=>"","con4"=>"");*/
        
        }
        
        else
        {
            $res=Array("status"=>"KO","mensaje"=>"No tiene coincidencias ni coincidencias parciales");
        }
	}
}
echo json_encode($res);
?>
