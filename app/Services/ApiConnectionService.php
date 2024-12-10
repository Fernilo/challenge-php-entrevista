<?php 

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class ApiConnectionService
{
    protected $apiUrl;
    protected $apiToken;

    public function __construct()
    {
        $this->apiUrl = env('API_URL');
        $this->apiToken = $this->getApiToken();
    }

    protected function getApiToken()
    {
        $response = Http::post($this->apiUrl . 'auth/login', [
            'email' => env('API_USERNAME'),
            'password' => env('API_PASSWORD'),
        ]);

        return $response->json('data')['access_token'];
    }

    protected function getAllProperties()
    {
        try {
            $response = Http::withToken($this->apiToken)->get($this->apiUrl . 'properties');

            if (!$response->successful()) {
                throw new Exception('Error al conectar con la API:' . $response->status() . ' - ' . $response->body());
            }

            return collect($response->json());
        } catch (\Throwable $th) {
            Log::error('Error en ApiConnectionService: ' . $th->getMessage());

            throw new Exception('No se pudo obtener las propiedades. Intente nuevamente más tarde.');
        }
    }

    public function getOne(int $idProperty)
    {
        try {
            $response = Http::withToken($this->apiToken)->get($this->apiUrl . 'properties/'.$idProperty);

            if (!$response->successful()) {
                throw new Exception('Error al conectar con la API:' . $response->status() . ' - ' . $response->body());
            }

            return collect($response->json());
        } catch (\Throwable $th) {
            Log::error('Error en ApiConnectionService: ' . $th->getMessage());

            throw new Exception('No se pudo obtener la propiedad. Intente nuevamente más tarde.');
        }
    }

    public function getAllPropertiesWithCache()
    {
        if(Cache::has('responseApiAll')) {
            $responseApiAll = Cache::get('responseApiAll');
        } else {
            $responseApiAll = $this->getAllProperties();
            Cache::put('responseApiAll', $responseApiAll, 600);
        }

        return $responseApiAll;
    }
}