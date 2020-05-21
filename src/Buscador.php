<?php

/**
 * Classe de Buscador de cursos
 */

namespace msmelos\BuscadorDeCursos;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{
    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function getCursos(string $url): array
    {
        $resposta = $this->httpClient->request('GET', $url);
        $html =  $resposta->getBody();

        $this->crawler->addHtmlContent($html);

        $elementosCursos = $this->crawler->filter('span.card-curso__nome');

        $cursos = [];

        foreach ($elementosCursos as $elementos) {
            $cursos[] = $elementos->textContent;
        }

        return $cursos;
    }
}
