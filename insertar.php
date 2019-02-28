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
                  
               }

                if($_POST['utm_term']=='')
                   
               {
                  $term=" ";
                    
                    
               }

                if($_POST['utm_campaign']=='')
                   
               {
                  $campaign=0; 
                    
                   
               }

                if($_POST['utm_medium']=='')
                   
               {
                  $medium=" "; 
                    
                    
               }

                if($_POST['utm_source']=='')
                   
               {
                  $source=" "; 
                    
                    
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


            $api_url = 'https://api.leadexp.ignium.net/entrada/interno.php';
            $ch = curl_init();
			curl_setopt( $ch, CURLOPT_URL, $api_url );
			curl_setopt( $ch, CURLOPT_HEADER, 0 );            // No header in the result
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true ); // Return, do not echo result
			curl_setopt( $ch, CURLOPT_POST, 1 );              // This is a POST request
			curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt( $ch, CURLOPT_VERBOSE, true);
			curl_setopt( $ch, CURLOPT_POSTFIELDS, array(      // Data to POST
					'age'  => $edad,
					'sexo'      => $sexo,
					'var1'   => $dc,
                    'var2'   => $_POST['np'],
                    'var3'   => $_POST['ec'],
					'cp'   => $_POST['cp'],
                    'phone' =>$_POST['telefono'],
                    'name'  =>$_POST['nombre'],
                    'subsource'  =>$_POST['subsource'],
                    'id_buyer'  =>$_POST['id_buyer'],
                    'source'  =>$_POST['source'],
                    'lastname'  =>" ",
					
				) );
			$data = curl_exec($ch);
			curl_close($ch);
            $data=(json_decode($data,true));
            var_dump($data["Message"]);
            $aux=$data["Message"];
            echo "<br>";


            if($aux>0)
           
            {
            
            $url  = "http://isengard.westeurope.cloudapp.azure.com/lineasaludremake/step3s.php?id=".$aux."";
            $api_url2 = 'https://api.leadexp.ignium.net/sms/';

            $ch = curl_init();
			curl_setopt( $ch, CURLOPT_URL, $api_url2 );
			curl_setopt( $ch, CURLOPT_HEADER, 0 );            // No header in the result
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true ); // Return, do not echo result
			curl_setopt( $ch, CURLOPT_POST, 1 );              // This is a POST request
			curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt( $ch, CURLOPT_VERBOSE, true);
			curl_setopt( $ch, CURLOPT_POSTFIELDS, array(      // Data to POST
					'telefono'  => $_POST['telefono'],
					'id'      => $aux,
					'short'   => 1,
					'url'   => $url,
                    'sender' =>"LineaSalud",
                    'mensaje'  =>"Descubre la OFERTA con el seguro médico perfecto PARA TI. ¡PINCHA QUÍ! ",
                    'id_buyer'  =>$_POST['id_buyer'],
                    'id_accounting'  =>$_POST['source'],
                    'ip_address'  =>$_POST['ip_address'],
                    'ip_address_forward'  =>$_POST['ip_address_forward'],
                
                    
					
				) );
			$data = curl_exec($ch);
			curl_close($ch);
			echo $data;
            echo "<br>";

            
            $api_url3 = "http://isengard.westeurope.cloudapp.azure.com/lineasaludremake/modificar.php";

            $ch = curl_init();
			curl_setopt( $ch, CURLOPT_URL, $api_url3 );
			curl_setopt( $ch, CURLOPT_HEADER, 0 );            // No header in the result
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true ); // Return, do not echo result
			curl_setopt( $ch, CURLOPT_POST, 1 );              // This is a POST request
			curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt( $ch, CURLOPT_VERBOSE, true);
			curl_setopt( $ch, CURLOPT_POSTFIELDS, array(      // Data to POST
					'id'  => $aux,
					'optin2' => 1,
					
                
                    
					
				) );
			$data = curl_exec($ch);
			curl_close($ch);
			echo $data;

            }

               
                
                   
               




?>
