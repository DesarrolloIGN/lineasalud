<?php
///////////////////////////////////////////////////////////////////
/////////////////////////// CONFIGURATION /////////////////////////
///////////////////////////////////////////////////////////////////
function RandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// EDIT THIS: your auth parameters
$username = 'admin';
$password = 'px32mj551An2NKM';

// EDIT THIS: the query parameters
$url     = "https://lineasalud.es/step5s.php?phone=".$_POST["destino"]."&id_buyer=".$_POST["id_buyer"]."&source=".$_POST["source"].""; // URL to shrink
$keyword = RandomString(5);                        // optional keyword
$title   = 'Super blog!';                // optional, if omitted YOURLS will lookup title with an HTTP request
$format  = 'simple';                       // output format: 'json', 'xml' or 'simple'

// EDIT THIS: the URL of the API file
$api_url = 'http://ignc.es/yourls-api.php';


///////////////////////////////////////////////////////////////////
///////////////////////////// SCRIPTS /////////////////////////////
///////////////////////////////////////////////////////////////////


// Init the CURL session
$ch = curl_init();
curl_setopt( $ch, CURLOPT_URL, $api_url );
curl_setopt( $ch, CURLOPT_HEADER, 0 );            // No header in the result
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true ); // Return, do not echo result
curl_setopt( $ch, CURLOPT_POST, 1 );              // This is a POST request
curl_setopt( $ch, CURLOPT_POSTFIELDS, array(      // Data to POST
        'url'      => $url,
        'keyword'  => $keyword,
        'title'    => $title,
        'format'   => $format,
        'action'   => 'shorturl',
        'username' => $username,
        'password' => $password
    ) );

// Fetch and return content
$data = curl_exec($ch);
curl_close($ch);

// Do something with the result. Here, we just echo it.
echo $data;


 
        $destino=$_POST["destino"];
        $mensaje="Para descubrir tu aseguradora perfecta pulse: ".$data."";
    
		$ch = curl_init('http://www.panelsms.com/httpinput/input.php');
		$params = array();
		$params['message'] = $mensaje;
		$params['confirmation'] = 'true';
		$params['senderId'] = 'Linea Salud';
		$params['user'] = 'ign2dir4';
		$params['password'] = 'auybqzqk';
		$params['to'] = $destino;
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		$result = curl_exec($ch);
		curl_close($ch);
    
        var_dump($result);
	



?>