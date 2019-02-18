<?php

$conn=mysqli_connect("13.80.183.196","pbi","63yTbzjZdafBA7Ay","leadexp") or die("Failed to connect to MySQL: " . mysqli_connect_error());

    if($_POST["tipo"]=="sms")
    {
        $hoy= new DateTime('now');
        $woo=$hoy->format("Y-m-d");
        $wee=$hoy->format("Y-m-d H:i:s");
        $line="Recibido el: ".$wee."\r\n";
        $line.="Enviado por: ".$_SERVER['REMOTE_ADDR']." ".$_SERVER['HTTP_X_FORWARDED_FOR']."\r\n";
        $line.="Metodo: ".$_SERVER['REQUEST_METHOD']."\r\n";
        $line.= json_encode($_REQUEST)."\r\n";

        $fichero = 'entradas/recepcion_dup-'.$woo.'.txt';
        file_put_contents($fichero, $line, FILE_APPEND | LOCK_EX);
        echo  "sms";
    }
else 
    {
        $hoy= new DateTime('now');
        $woo=$hoy->format("Y-m-d");
        $wee=$hoy->format("Y-m-d H:i:s");
        $line="Recibido el: ".$wee."\r\n";
        $line.="Enviado por: ".$_SERVER['REMOTE_ADDR']." ".$_SERVER['HTTP_X_FORWARDED_FOR']."\r\n";
        $line.="Metodo: ".$_SERVER['REQUEST_METHOD']."\r\n";
        $line.= json_encode($_REQUEST)."\r\n";

            $fichero = 'entradas/recepcion_dup-'.$woo.'.txt';
            file_put_contents($fichero, $line, FILE_APPEND | LOCK_EX);
            echo "interno";
    }