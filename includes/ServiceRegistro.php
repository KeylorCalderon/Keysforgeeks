<?php
    require_once 'lib/nusoap.php';
	$client = new nusoap_client("http://localhost/WSServer/registrar.php?wsdl");
    //$client = new nusoap_client("http://mora.tk/service/xml/registrar.php?wsdl");
?>