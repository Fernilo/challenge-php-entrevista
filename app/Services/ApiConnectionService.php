<?php 

namespace App\Services;
use Illuminate\Support\Facades\Http;

class ApiConnectionService
{
    protected $apiUrl;
    protected $apiToken;

    public function __construct()
    {
        $this->apiUrl = 'https://www.kiteprop.com/api/v1/';
    }

    public function login()
    {
        $response = Http::post($this->apiUrl . 'auth/login', [
            'email' => env('API_USERNAME'),
            'password' => env('API_PASSWORD'),
        ]);
      dd($response->body());
    }

    public function getProperties()
    {
        $response = Http::get($this->apiUrl.'/properties');
    }
}