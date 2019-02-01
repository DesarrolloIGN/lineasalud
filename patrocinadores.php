<?php
$conn=mysqli_connect("13.80.183.196","pbi","63yTbzjZdafBA7Ay","leadexp") or die("Failed to connect to MySQL: " . mysqli_connect_error());
	

?>
<!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang="zxx"> <!--<![endif]-->
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Decesos baratos</title>
    <link rel="icon" type="image/png" href="imagenes/arriba.png" />
	<link href="css\estilos.css" rel="stylesheet" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" href="css\main.css">
</head>
    <div class="container" >
        
		<div class="row">
                
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h2 class="ct" style="color:#64cc12;">Patrocinadores</h2><br>
            </div>
        </div>
        
    </div>
<body style="background-color: #F2F2F2;">
    <div class="container" >
					<div class="row">
						
							
<?php

	$query="SELECT * FROM `cbuyer_privacidad` ORDER BY `cbuyer_privacidad`.`orden` ASC ";
	//$results = mysqli_query($conn, $query);
	//echo $query."<br>";
	$a=0;
	while ($resultados = mysqli_fetch_assoc($results)){
                        if($resultados['activo_privacidad']==1){?>
       
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								
	                 <?php  echo'<strong><t class="ct">'; echo $resultados['razon_social_privacidad'];echo '</t></strong><br>'; ?>
				     <?php  echo'<t class="ct">'; echo $resultados['texto_privacidad']; echo '</t><br>'; ?>
                     <?php echo '<a   href="'.$resultados['url_privacidad'].'">'; echo "Condiciones Legales"; echo '</a><br>';echo '<br>'; ?>
                    
                        </div>
                        
           
    
    
<?php } }?>

		
							</div>
						
					</div>
				
	
	<script src="js\vendor\jquery-library.js"></script>
	<script src="js\vendor\bootstrap.min.js"></script>
	
</body>
    <button  style="position: fixed;
    bottom: 4hv;
   font-size: 20px;
    left: 2%;
    
    background-color:orange;" onclick="goBack()">Cerrar</button>
<script>
function goBack() {
    window.history.back();
}
</script>
<footer style="background-color:#1b3a03;position: fixed;
    bottom: 0;width:100%">
                <center><p style="color: white;">Si por algún motivo, desea que sus datos no llegen a alguno de los patrocinadores de la presente promoción, <a style="color:#4a9e09" href="mailto:">pulse aquí</a></p></center>
        </footer>
</html>
    <script type="text/javascript">
    
    $( document ).ready(function() {
        
                localStorage.setItem("utm_source",'<?php echo $_GET["utm_source"];?>');
                
                localStorage.setItem("utm_medium",'<?php echo $_GET["utm_medium"];?>');
                localStorage.setItem("utm_campaign",'<?php echo $_GET["utm_campaign"];?>');
                localStorage.setItem("utm_term",'<?php echo $_GET["utm_term"];?>');
                localStorage.setItem("utm_content",'<?php echo $_GET["utm_content"];?>');
        
    $( ".p1" ).click(function() {
 
         
         url="step1.php"+"?utm_source="+localStorage.getItem("utm_source")+"&utm_medium="+localStorage.getItem("utm_medium")+"&utm_campaign="+localStorage.getItem("utm_campaign")+"&utm_term="+localStorage.getItem("utm_term")+"&utm_content="+localStorage.getItem("utm_content");
         window.location.href=url;
        
});
        
        $( ".p1z" ).click(function() {
            
 
         url="step2.php"+"?edad="+$(this).val();
         window.location.href=url;
            
            //console.log($(this).val());
        
});
});
</script>
