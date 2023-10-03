<?php
    declare(strict_types=1);

    namespace App\Services\Olx;

    use App\Repositories\Olx\OlxRepository;

    class OlxScraperService
    {
        public static function getResultSearch($params): array
        {
            $result = OlxRepository::getScrapProperties($params);

            if ($result->failed()) {
                logs()->debug("Falha na conexão com o site da OLX!", ['status' => $result->status(), 'message' => $result->json()]);
                return [];
            }

            $content = $result->body();
            if (empty($content)) {
                logs()->debug("Conteúdo da pesquisa está vazio!", ['status' => $result->status(), 'message' => $result->json()]);
                return [];
            }

            $search = '<script id="__NEXT_DATA__" type="application/json">';
            if (!str($content)->contains($search, true)) {
                logs()->debug("Script com id não foi encontrado no corpo do site", ['status' => $result->status(), 'message' => $result->json()]);
                return [];
            }

            $script = str($content)->betweenFirst($search, "</script>")->value();

            unset($content);

            $initial_search = '{"props":{';
            $final_search = '},"__N_SSP":true},';

            $content_search = str($script)->betweenFirst($initial_search, $final_search)->value();
            $content_search = "{{$content_search}}}";
            $json = json_decode($content_search, true);

            if (empty($json) || $json === null) {
                logs()->debug("Falha ao decodificar o json", ['status' => $result->status(), 'message' => $result->json()]);
                return [];
            }

            $key = 'ads';
            if (empty($json['pageProps'][$key])) {
                logs()->debug("Não foi possível encontrar a key $key", ['status' => $result->status(), 'message' => $result->json()]);
                return [];
            }

            logs()->info("Json decodificado com sucesso!", ['status' => $result->status(), 'message' => $result->json()]);
            return $json['pageProps'][$key];
        }
        public static function filters() : array
        {
            return OlxRepository::params();
        }
    }
