<?php

//include 'conexion.php';

$botToken = "517459197:AAGAplPrJ-VZrngZt4HJuIsau2qTd_I1d0k";
$website = "https://api.telegram.org/bot".$botToken;

$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);
$id = $update["update_id"];

$chatId = $update["message"]["chat"]["id"]; 
$chatType = $update["message"]["chat"]["type"]; 
$message = $update["message"]["text"]; 
$nombre = $update["message"]["from"]["first_name"];
$userName = $update["message"]["from"]["username"];
$date= $update["message"]["date"];

//foreach ($update as $usuario) {
  //  mysqli_query($conexion,"INSERT INTO usuario(chatId,chatType,message,userName) VALUES(".$usuario["message"]["chat"]["id"].",'".$usuario["message"]["chat"]["type"]."','".$usuario["message"]["text"]."','".$usuario["message"]["from"]["username"]."')");	
//}
evaluateMessage($chatId ,$message,$nombre);
//$query = "INSERT INTO usuario (id,chatId,chatType,message,userName) VALUES('id','$chatId','$chatType','$message','$userName')";


$IS = "Ingenieria en Software";
$NI = "Licenciatura en Negocios Internacionales";
$IF = "Ingenieria Financiera";
$IMA = "Ingenieria en Mecanica Automotriz";
$ITM = "Ingenieria en Tecnologias de Manufactura";



switch ($message) 
{
    case '/ayuda':
    $response = "Hola $nombre este es un bot sobre la UPTecamac, coloca una diagnonal / para ver todos los comandos disponibles";
        sendMessage($chatId,$response);
    break;
    case '/calendario':
         getCalendario($chatId);
    break;
    case '/carreras':
     $opciones = '["'.$IS.'"],["'.$NI.'"],["'.$IF.'"],["'.$IMA.'"],["'.$ITM.'"]';
     $response = "La universidad cuenta con las siguientes carreras, te interesa alguna?";
        getCarreras($chatId,$response,$opciones);
    break;
    case '/servicios':
    $web = "https://sfpya.edomexico.gob.mx/recaudacion/";
    $response=  "Te proporciono la pagina del gobierno donde podras realizar distintos procesos, reinscripciones, pagos de titulacion, credenciales, etc. <a href ='".$web."'>  Click Aqui</a> Sabes usarla?";
    $opciones = '["SI"],["NO"]';
      getServicios($chatId,$response,$opciones);
    break;
    case '/convocatorias':
    $url = "http://uptecamac.edomex.gob.mx/sites/uptecamac.edomex.gob.mx/files/files/2DA_CONVOCATORIA%202018.pdf";
    $response= "Perfecto, te adjunto el PDF en el que podras leer toda la informacion sobre la nueva convocatoria <a href ='".$url."'>Click Aqui</a>";
    sendMessage($chatId,$response);
    break;
    case '/ubicacion':
    getUbicacion($chatId);
    break;
    case '/noticias':
    EjemploMineria($chatId);
    break;
    default:
     
    break;
}

if($message == $IS){getSoftware($chatId);}
elseif ($message == $NI) {getNI($chatId);}
elseif ($message == $IF) {getIF($chatId);}
elseif ($message == $IMA) {getIMA($chatId);}
elseif ($message == $ITM) {getITM($chatId);}

if ($message == "SI" ||  $message == "si" || $message == "Si"){getSIserv($chatId);}
elseif($message == "NO" || $message == "no" || $message == "No"){getInfoServ($chatId);
}

function evaluateMessage($chatId ,$message,$nombre){
	if(strpos($message, 'uda')||strpos($message, 'udar')){
        $finalMessage = "habla conmigo";
        
        //$random = rand(0,1);
        //if ($random>0) {
          //  $finalMessage = "Coloca una diagnonal / o dime en que te podria ayudar";
        //}else {
          //  $finalMessage = "En que te puedo ayudar";
       // }

	}elseif (strpos($message, 'dario')) {

        $url = "http://uptecamac.edomex.gob.mx/sites/uptecamac.edomex.gob.mx/files/files/Calendario%20escolar%202018-2019.jpg";
        $finalMessage = "<a href ='".$url."'>Mira o entra al calendario escolar dando click aqui</a>";    
    }elseif (strpos($message,'ola')) {

        $finalMessage = "Bienvenido, te  llamas $nombre cierto, espero ser de utilidad, dime que te gustaria saber sobre la UPT?";

    }elseif (strpos($message,'reras')) {

        $IS = "Ingenieria en Software";
        $NI = "Licenciatura en Negocios Internacionales";
        $IF = "Ingenieria Financiera";
        $IMA = "Ingenieria en Mecanica Automotriz";
        $ITM = "Ingenieria en Tecnologias de Manufactura";
        $opciones = '["'.$IS.'"],["'.$NI.'"],["'.$IF.'"],["'.$IMA.'"],["'.$ITM.'"]';
        $finalCarrera = "La Universidad cuenta con 5 carreras te interesa alguna?"; 
        getCarreras($chatId,$finalCarrera,$opciones);

    }elseif (strpos($message,'vicios')||strpos($message,'obierno')||strpos($message,'uyente')) {
        
        $web = "https://sfpya.edomexico.gob.mx/recaudacion/";
        $finalMessage = "Te proporciono la pagina del gobierno donde podras realizar distintos procesos, reinscripciones, pagos de titulacion, credenciales, etc. <a href ='".$web."'>  Click Aqui</a> Sabes usarla?";

    }elseif (strpos($message,'deos')|| strpos($message,'tube')||strpos($message,'anal')) {

        $webYoutube = "https://www.youtube.com/channel/UCfMmeRkkuUKEV47QS3LH3wA/videos";
        $finalMessage = "Si quieres conocer mas sobre los avances y actividades entra y conoce nuestro canal de Youtube<a href ='".$webYoutube."'> Click Aca :D </a>";
    
    }elseif (strpos($message,'cación')||strpos($message,'cacion')||strpos($message,'ccion')||strpos($message,'cción')) {
       $finalMessage = "Nos ubicamos en Av. 5 de Mayo Tecamac CP 55740 Tecamac de Felipe Villanueva";
    }elseif (strpos($message,'cente')||strpos($message,'uacion')) {
        $urlEvaDOC = "189.254.6.230/eva_doc2018";
        $finalMessage = "Realiza tu evaluacion docente o imprime tu comprobante por aqui<a href = '".$urlEvaDOC."'> Ingresar</a>";
    }elseif (strpos($message,'fono')||strpos($message,'fonos')||strpos($message,'mero')||strpos($message,'meros')||strpos($message,'rreo')) {
        $correo = "control_escolar@uptecamac.edu.mx";
        $finalMessage = "Contactanos para resolver tus dudas al 01(55) 59388670 o escribenos en control_escolar@uptecamac.edu.mx";
    }elseif (strpos($message,'k')||strpos($message,'K')) {
        $finalMessage = "Genial $nombre un placer ayudarte";
    }elseif (strpos($message,'toria')||strpos($message,'torias')) {
        $urlConvocatoria = "http://uptecamac.edomex.gob.mx/sites/uptecamac.edomex.gob.mx/files/files/2DA_CONVOCATORIA%202018.pdf";
        $finalMessage = "Perfecto, te adjunto el PDF en el que podras leer toda la informacion sobre la nueva convocatoria <a href ='".$urlConvocatoria."'>Click Aqui</a>";
    }elseif (strpos($message,'tado')||strpos($message,'tados')) {
        $urlResultados = "http://uptecamac.edomex.gob.mx/sites/uptecamac.edomex.gob.mx/files/files/admision/RESULTADOS%20ABRI18.pdf"; 
        $finalMessage = "Mucha Suerte mira los resultados en el siguiente enlace -><a href ='".$urlResultados."'>Click Aqui</a>";
    }elseif (strpos($message,'start')) {
        $finalMessage = "Hola";
    }elseif (strpos($message,'omos')||strpos($message,'emes')) {//
       $imagenes =  "https://scontent.fmex12-1.fna.fbcdn.net/v/t1.0-9/38258922_661757724190184_5050579058434244608_n.jpg?_nc_cat=0&oh=18b87e2f540eeded86d65c6b2b23a30c&oe=5BF98E4A";
       $finalMessage = "Mira jaja <a href = '".$imagenes."'>.</a>";
    }elseif (strpos($message,'genieria')||strpos($message,'cenciatura')) {
        $finalMessage = "Bueno...";
    }elseif (strpos($message,'ipcion')||strpos($message,'ipciones')||strpos($message,'bimos')||strpos($message,'cribo')) {
        $i1 = "https://scontent.fmex12-1.fna.fbcdn.net/v/t1.0-9/38808241_1733592610087749_8107259295327846400_n.jpg?_nc_cat=0&oh=24274b02bdca5185c0c850ce595b968d&oe=5BFD9B28";
        $i2 = "https://scontent.fmex12-1.fna.fbcdn.net/v/t1.0-9/38734194_1733592620087748_6832082255309963264_n.jpg?_nc_cat=0&oh=811d08e50c4fe4071913cd3436f32cc3&oe=5C1086BB";
        $i3 = "https://scontent.fmex12-1.fna.fbcdn.net/v/t1.0-9/38784266_1733592603421083_2012812294144131072_n.jpg?_nc_cat=0&oh=d1e8bbafb6907afed3c0853348038749&oe=5BC8B056";
        $i4 = "https://scontent.fmex12-1.fna.fbcdn.net/v/t1.0-9/38734153_1733592730087737_4583800281833144320_n.jpg?_nc_cat=0&oh=4ab1e67ee1795db805ba8ff4edae6530&oe=5BCCF26F";
        $i5 = "https://scontent.fmex12-1.fna.fbcdn.net/v/t1.0-9/38758291_1733592773421066_5609102708754612224_n.jpg?_nc_cat=0&oh=894d0dc2331c4390df9d58fcf8f07f81&oe=5C134602";
        $arrayName = array($i1,$i2,$i3,$i4,$i5);
        $longitud = count($arrayName);
        for ($i=0; $i < $longitud ; $i++) { 
            sendMessage($chatId,"<a href ='".$arrayName[$i]."'>Click Aqui</a>");
        }
        
    }elseif (strpos($message,'etencia')||strpos($message,'etencias')) {
        $finalMessage = "Tienes hasta el 19 de Agosto para realizar tus competencias";
    }elseif (strpos($message,'rtas')||strpos($message,'rta')) {
        $c1 = "Carta de Intencion: 9 de Julio al 15 de Agosto";
        $c2 = "Carta de Presentacion: 16 de Agosto al 3 de Septiembre";
        $c3 = "Carta de Aceptacion: 3 de Septiembre al 8 de Sepptiembre";
        $c4 = "Carta de Termino: 14 de Diciembre";
        $arregloCarta = array($c1,$c2,$c3,$c4);
        $tam = count($arregloCarta);
        for ($i=0; $i < $tam; $i++) { 
            sendMessage($chatId,$arregloCarta[$i]);
        }

    }else{    
       $finalMessage = "No entendi podrias replantear tu peticion ;)";
	}
	sendMessage($chatId,$finalMessage);
}

function sendMessage($chatId,$response){
    $url = $GLOBALS[website].'/sendMessage?chat_id='.$chatId.'&parse_mode=HTML&text='.urlencode($response);
        file_get_contents($url);
}

function getCalendario($chatId){
   $url = "http://uptecamac.edomex.gob.mx/sites/uptecamac.edomex.gob.mx/files/files/Calendario%20escolar%202018-2019.jpg";
   $salida = "<a href ='".$url."'>Mira o entra al calendario escolar dando click aqui</a>";
        sendMessage($chatId,$salida);
}

function getCarreras($chatId,$response,$opciones){
    if(isset($opciones)){
       $elegida = '&reply_markup={"keyboard":['.$opciones.'],"resize_keyboard":true}';
    }
    $url = $GLOBALS[website].'/sendMessage?chat_id='.$chatId.'&parse_mode=HTML&text='.urlencode($response).$elegida;
        file_get_contents($url);
}

function getSoftware($chatId){
$url = "http://uptecamac.edomex.gob.mx/ingenieria_en_software";
$salida =  "Te interesa el desarollo de aplicaciones y chatbots como este? Genial, conoce mas de esta carrera en este link <a href ='".$url."'>+ Info</a>";
        sendMessage($chatId,$salida);
}

function getNI($chatId){
$url = "http://uptecamac.edomex.gob.mx/licenciatura_en_negocios_internacionales";
$salida =  "Te gustaria tener la capacidad de dirigir, asesorar y ejecutar estrategias gerenciales, conoce mas de esta carrera en este link <a href ='".$url."'>+ Info</a>";
        sendMessage($chatId,$salida);
}

function getIF($chatId){
    $url = "http://uptecamac.edomex.gob.mx/ingenieria_financiera";
    $salida =  "Eres bueno al  investigar, analizar, plantear, dirigir tomar decisiones, y te gustan el mundo financiero? conoce mas de esta carrera en este link <a href ='".$url."'>+ Info</a>";
        sendMessage($chatId,$salida);
}

function getIMA($chatId){
    $url = "http://uptecamac.edomex.gob.mx/ingenieria_mecanica_automotriz";
    $salida =  "Seras capaz de mantener en óptimas condiciones los sistemas mecánicos de la industria automotriz, conoce mas de esta carrera en este link <a href ='".$url."'>+ Info</a>";
        sendMessage($chatId,$salida);
}

function getITM($chatId){
    $url = "http://uptecamac.edomex.gob.mx/ingenieria_en_tecnologias_de_manufactura";
    $salida =  "Aplica los conocimientos científicos y tecnológicos para mejorar, diseñar, implantar y automatizar procesos de manufactura, conoce mas de esta carrera en este link <a href ='".$url."'>+ Info</a>";
        sendMessage($chatId,$salida);
}

function getServicios($chatId,$response,$opciones){   
    if(isset($opciones)){
        $elegida = '&reply_markup={"keyboard":['.$opciones.'],"resize_keyboard":true}';
     }
     $url = $GLOBALS[website].'/sendMessage?chat_id='.$chatId.'&parse_mode=HTML&text='.urlencode($response).$elegida;
        file_get_contents($url);
}

function getSIserv($chatId){
    $salida =  "Muy bien puedes continuar utilizando los comandos, cualquier duda o interes nos los puedes proporcionar al 5577659278, gracias por utilizar UPtecamac_bot";
        sendMessage($chatId,$salida);
}

function getInfoServ($chatId){
    $fp = fopen("ServiciosDatos.txt", "r");
    while(!feof($fp)) {
         $linea = fgets($fp);
         $salida = $linea;
    sendMessage($chatId,$salida);
    }
    fclose($fp);
}

function getUbicacion($chatId){
$fp = fopen("Ubi.txt","r");
while(!feof($fp)){
    $linea = fgets($fp);
    $salida = $linea;
    sendMessage($chatId,$salida);
        }
    fclose($fp);
}

function EjemploMineria($chatId){
include("simple_html_dom.php");
 
$context = stream_context_create(array('http' =>  array('header' => 'Accept: application/xml')));
$url = "https://expansion.mx/rss/mundo";
$xmlstring = file_get_contents($url, false, $context);
$xml = simplexml_load_string($xmlstring, "SimpleXMLElement", LIBXML_NOCDATA);
$json = json_encode($xml);
$array = json_decode($json, TRUE);
        for ($i=0; $i < 9; $i++) 
        {
            $titulos = $titulos."\n\n".$array['channel']['item'][$i]['title']."<a href='".$array['channel']['item'][$i]['link']."'> Ver Nota Completa</a>";
        }
sendMessage($chatId, $titulos);
}


?>