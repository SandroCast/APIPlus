<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Goutte\Client;

class CorreiosController extends Controller
{
    public function rastreio(Request $request): JsonResponse
    {
        $data = [];

        if (!request('rastreio'))
            return response()->json('Parâmetro não passado corretamente.', 401);

        $siteUrl = "https://www.muambator.com.br/pacotes/{$request->rastreio}/detalhes/";

        $client = new Client();

        $crawler = $client->request('GET', $siteUrl);

        $milestones = $crawler->filter('.milestones');

        if ($milestones->count() === 0)
            return response()->json('Rastreio não encontrado', 401);

        $milestones->each(function ($milestone) use (&$data) {

            $liElements = $milestone->filter('li');

            $liElements->each(function ($li) use (&$data) {

                $atualizacao = $li->filter('span')->first();

                if ($atualizacao->count() === 0) 
                    return response()->json('Ocorreu um erro no nosso servidor, aguarde alguns minutos e tente novamente.', 501);

                $status = $li->filter('strong')->first();
                $brNode = $li->filterXPath('//br')->first();
                $descricao = trim($brNode->getNode(0)->nextSibling->textContent);

                $data['atualizacao'] = $atualizacao->text();
                $data['status'] = $status->text();
                $data['descricao'] = $descricao;
            });
        });

        return response()->json($data);
    }
}
