<?php
    $client2 = new nusoap_client("http://localhost/WSServer/facturar.php?wsdl", array('soap_version' => SOAP_1_1));
    //$client2 = new nusoap_client("http://mora.tk/service/xml/facturar.php?wsdl", array('soap_version' => SOAP_1_1));
?>