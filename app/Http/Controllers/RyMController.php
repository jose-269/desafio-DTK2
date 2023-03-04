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
        // dd($characters);

        // Filtrar por origin y status si existen
        $originFilter = request()->input('origin');
        $statusFilter = request()->input('status');
        
        if ($originFilter) {
            $characters = $characters->where('origin.name', $originFilter);
        }
        
        if ($statusFilter) {
            $characters = $characters->where('status', $statusFilter);
        }
        // Paginar characters
        $perPage = 6;
        $currentPage = request()->input('page') ?? 1;
        $paginated = new LengthAwarePaginator(
            $characters->forPage($currentPage, $perPage),
            $characters->count(),
            $perPage,
            $currentPage,
            ['path' => url()->current()]
        );
        // Obtener opciones para select de origin y status
        $allOrigins = collect($data->results)->pluck('origin.name')->unique()->values();
        $allStatuses = collect($data->results)->pluck('status')->unique()->values();

        // Pasar los datos a la vista
        return view('index', [
            'characters' => $paginated,
            'origins' => $allOrigins,
            'statuses' => $allStatuses,
            'selectedOrigin' => $originFilter,
            'selectedStatus' => $statusFilter,
        ]);

    }

    public function getCharacterDetails($id)
    {
        $client = new Client();
        $res = $client->request('GET', 'https://rickandmortyapi.com/api/character/'.$id);
        $data = json_decode($res->getBody());
        $character = $data;
        // dd($character);

        return view('character-details', [
            'character' => $data
        ]);
    }
}
