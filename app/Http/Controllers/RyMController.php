<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;



use GuzzleHttp\Client;

class RyMController extends Controller
{
    public function getData()
    {
        $client = new Client();
        $res = $client->request('GET', 'https://rickandmortyapi.com/api/character');
        $data = json_decode($res->getBody());
        // dd($data);
        $characters = collect($data->results);

        // Paginar la colección
        $perPage = 6;
        $currentPage = request()->input('page') ?? 1;
        $paginated = new LengthAwarePaginator(
            $characters->forPage($currentPage, $perPage),
            $characters->count(),
            $perPage,
            $currentPage,
            ['path' => url()->current()]
        );
        $origins = $characters->pluck('origin.name')->unique()->values();
        $statuses = $characters->pluck('status')->unique()->values();

        // Pasar los datos a la vista
        return [
            'characters' => $paginated,
            'origins' => $origins,
            'statuses' => $statuses
        ];

    }
}
