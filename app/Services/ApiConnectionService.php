<?php 

namespace App\Services;
use Illuminate\Support\Facades\Http;

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

    public function getAllProperties()
    {
        $response = Http::withToken($this->apiToken)->get($this->apiUrl.'properties');
        return $response->json();
    }
}