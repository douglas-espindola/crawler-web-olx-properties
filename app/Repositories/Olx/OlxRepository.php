<?php
    declare(strict_types=1);

    namespace App\Repositories\Olx;

    use Illuminate\Http\Client\Response;
    use Illuminate\Support\Facades\Http;

    class OlxRepository
    {
        public static function getScrapProperties($params): Response
        {
            $baseUrl = "https://www.olx.com.br/imoveis/aluguel/estado-pa";
            $queryString = http_build_query($params);
            $url = $baseUrl . '?' . $queryString;

            if (!empty($params)) {
                logs()->info("Parâmetros da pesquisa", $params);
                return Http::get($url);
            }

            return Http::get("https://www.olx.com.br/imoveis/aluguel/estado-pa?bae=3&bas=2&gsp=1&q=venda&roe=3&ros=2&se=3&ss=2&cos=100&coe=500&rfs=100&rfs=111&rfs=115&rcf=203&rcf=207&rcf=205&rcf=202&rcf=200&rcf=209");
        }
        public static function params(): array
        {
            //Detalhes do imóvel (rfs)
            $academia = 100;
            $aquecimento = 102;
            $arCondicionado = 103;
            $areaServico = 104;
            $internet = 108;
            $varanda = 115;

            //Detalhes do condomínio (rcf)
            $academiaCondominio = 200;
            $areaMurada         = 201;
            $condominioFechado  = 202;
            $elevador           = 203;
            $petsPermitidos     = 204;
            $piscina            = 205;
            $portaoEletronico   = 206;
            $portaria           = 207;
            $salaoFesta         = 208;
            $seguranca24h       = 209;

            //Filters
            $vagasGaragem = 1;
            $numeroMinimoQuartos = 2;
            $numeroMaximoQuartos = 3;

            $numeroMiniBanheiros = 2;
            $numeroMaximoBaneiros = 3;

            $valorMinimoCondominio = 100;
            $valorMaximoCondominio = 500;

            return [
                'bae' => $numeroMaximoBaneiros,
                'bas' => $numeroMiniBanheiros,
                'gsp' => $vagasGaragem,
                'q' => 'venda',
                'roe' => $numeroMaximoQuartos,
                'ros' => $numeroMinimoQuartos,
                'se' => 3,
                'ss' => 2,
                'cos' => 100,
                'coe' => 500,
                'rfs' => [$academia, 111, 115],
                'rcf' => [$elevador, $portaria, $piscina, $condominioFechado, $academiaCondominio, $seguranca24h]
            ];
        }
    }
