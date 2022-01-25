<?php
    require_once 'lib/nusoap.php';
	$client = new nusoap_client("http://localhost/WSServer/facturar.php?wsdl", array('soap_version' => SOAP_1_1));
    //$client = new nusoap_client("http://mora.tk/service/xml/facturar.php?wsdl", array('soap_version' => SOAP_1_1));
?>