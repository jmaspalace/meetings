
<?PHP

/*$name = $_POST['nombre'];
$tel = $_POST['numero'];
$correo = "noaplica";
$tcell = "noaplica";
$tplan = "noaplica";
$toperador ="crosselling";

require_once('lib/nusoap.php');
/*
//$servicio="http://181.49.168.203:8084/Service.asmx";//url
$servicio="http://181.49.168.203:8084/Service.asmx?WSDL";//url

$parametros=array(); //parametros de la llamada
$parametros['campanaCliente']=7;//Siempre debe de ir este numero
$parametros['nombreCliente']=utf8_decode($name);
$parametros['telefonoCliente']=$tel;
$parametros['codSeguridad']="487KMCHWASYT2TR";//Siempre debe de ir esta Cadena
$parametros['equipoCliente']=$tcell;
$parametros['planCliente']=utf8_decode($tplan);
$parametros['operadorCliente']=$toperador;


$client = new nusoap_client($servicio,'wsdl');

$err = $client->getError();
if ($err) {
echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
}

//$client->setUseCurl($servicio);
//$client->soap_defencoding = 'UTF-8';

$result = $client->call("tigoUneTellamamos", $parametros);
*/
//$result = $client->tigoUneTellamamos($parametros);

//echo var_dump($result)."<hr>".$result['tigoUneTellamamosResult'];
$post_data=array(
	'firstname' => "nombre",
	'lastname' => "dgsdfgsdf",
	'email' => "test@test.com",
	);
foreach ( $post_data as $key => $value) {
    $post_items[] = $key . '=' . $value;
}

$post_string = implode ('&', $post_items);

$curl_connection = curl_init("https://forms.hubspot.com/submissions/v3/public/formsnext/submit/multipart/2284186/a8dd16b7-7933-4a08-ad2d-156913a71a9c");
//set options
curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($curl_connection, CURLOPT_USERAGENT, 
  "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);
//set data to be posted
curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);
//perform our request
$result = curl_exec($curl_connection);
print_r(curl_getinfo($curl_connection));
echo curl_errno($curl_connection) . '-' . 
                curl_error($curl_connection);
//close the connection
curl_close($curl_connection);

?>
