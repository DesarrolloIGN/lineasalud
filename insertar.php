<?php 
ini_set('default_charset', 'utf-8');

$conn_l=mysqli_connect("13.80.183.196","pbi","63yTbzjZdafBA7Ay","leadexp") or die("Failed to connect to MySQL: " . mysqli_connect_error());
		


		mysqli_set_charset($conn_l,'utf8');	
			$fechaActual = getdate();
			$fechaInsertar = $fechaActual['year']."-".$fechaActual['mon']."-".$fechaActual['mday']."-".$fechaActual['hours']."-".$fechaActual['minutes']."-".$fechaActual['seconds'];
            
                $ip = $_SERVER["REMOTE_ADDR"]; 
                $edad;
                $ec;
                $dc;
                $subfuente;
                
                $content=$_POST['utm_content']; 
                $term=$_POST['utm_term'];
                $campaign=$_POST['utm_campaign']; 
                $medium=$_POST['utm_medium'];
                $source=$_POST['utm_source'];

               if($_POST['utm_content']=='')
                   
               {
                  $content=" "; 
                  echo "llega1";
               }

                if($_POST['utm_term']=='')
                   
               {
                  $term=" ";
                    echo "llega2";
                    
               }

                if($_POST['utm_campaign']=='')
                   
               {
                  $campaign=0; 
                    echo "llega3";
                   
               }

                if($_POST['utm_medium']=='')
                   
               {
                  $medium=" "; 
                    echo "llega4";
                    
               }

                if($_POST['utm_source']=='')
                   
               {
                  $source=" "; 
                    echo "llega5";
                    
               }
else
{
    
    echo "llega6";
}

                if($_POST['edad']==1)
                {
                    $edad=40;
                }
                else if($_POST['edad']==2)
                                {
                                    $edad=45;
                                }
                else if($_POST['edad']==3)
                                {
                                    $edad=60;
                                }
                else if($_POST['edad']==4)
                                {
                                    $edad=65;
                                }

                    if($_POST['ec']==1)
                    {
                    $ec='S';
                    }
                    else if($_POST['ec']==2)
                    {
                    $ec='C';
                    }

                    if($_POST['dc']==1)
                    {
                    $dc=1;//Si
                    }
                    else if($_POST['dc']==2)
                    {
                    $dc=0;//No
                    }
               
                    $subfuente="https://lineasalud.es/step5.php?utm_content=".$content."&utm_term=".$term."&utm_campaign=".$campaign."&utm_medium=".$medium."&utm_source=".$source."";

                $query_q   = "INSERT INTO `landing_lineasalud`(`rango_edad`,`ec`,`np`, `cp`, `es_salud`, `nombre`, `telefono`, `ip`,`fecha_entr`,`utm_source`,`utm_medium`,`utm_campaign`,`utm_term`,`utm_content`) VALUES (" . $_POST['edad'] . ",'" . $_POST['ec'] . "'," . $_POST['np'] . ",'" . $_POST['cp'] . "', " . $_POST['dc'] . ", '" . $_POST['nombre'] . "', '" . $_POST['telefono'] . "', '" . $ip . "', '" . $fechaInsertar . "','" . $source . "','" .$medium. "'," .$campaign. ",'" . $term . "','" . $content . "')";
				$results_l = mysqli_query($conn_l, $query_q);
                    

$hoy= new DateTime('now');
$woo=$hoy->format("Y-m-d");
$wee=$hoy->format("Y-m-d H:i:s");
$line="Recibido el: ".$wee."\r\n";
$line.="Enviado por: ".$_SERVER['REMOTE_ADDR']." ".$_SERVER['HTTP_X_FORWARDED_FOR']."\r\n";
$line.="Metodo: ".$_SERVER['REQUEST_METHOD']."\r\n";
$line.= json_encode($_REQUEST)."\r\n";

                if($results_l)
                {
                    $line.= mysqli_error($conn_l)." "."OK"."\r\n";
                }

                else
                {
                   $line.= mysqli_error($conn_l)." "."KO"."\r\n";
                }

$fichero = 'entradas/recepcion_dup-'.$woo.'.txt';
file_put_contents($fichero, $line, FILE_APPEND | LOCK_EX);

               
                
                   
               




?>
