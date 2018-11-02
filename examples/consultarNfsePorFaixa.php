<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once '../bootstrap.php';

use NFePHP\Common\Certificate;
use NFePHP\NFSeNac\Tools;

$config = [
    'cnpj' => '99999999000191',
    'im' => '1733160024',
    'cmun' => '4314902',
    'razao' => 'Empresa Test Ltda',
    'version' => '1.0.0'
];

$configJson = json_encode($config);

$content = file_get_contents('expired_certificate.pfx');
$password = 'associacao';
$cert = Certificate::readPfx($content, $password);

$tools = new Tools($configJson, $cert);

$nini = '1';
$nfim = '100';
$pagina = 1;

$response = $tools->consultarNfsePorFaixa($nini, $nfim, $pagina);

header("Content-type: text/xml");
echo $tools->lastRequest;
