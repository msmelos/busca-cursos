<?php
require 'vendor/autoload.php';

use msmelos\BuscadorDeCursos\Buscador;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;


$client = new Client(['verify' => false, 'base_uri' => 'https://www.alura.com.br']);
$crawler = new Crawler();

$busca = new Buscador($client, $crawler);
$cursos = $busca->getCursos('/cursos-online-front-end/javascript');

foreach ($cursos as $curso) {

    echo $curso.PHP_EOL;
}
