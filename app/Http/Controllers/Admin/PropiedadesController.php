<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ApiConnectionService;

class PropiedadesController extends Controller
{
    private $apiConnectionService;

    public function __construct(ApiConnectionService $api_ConnectionService)
    {
        $this->apiConnectionService = $api_ConnectionService;
    }


    public function index()
    {
        $properties = $this->apiConnectionService->getAllProperties();
     
        return view('admin.propiedades.index', [
            'properties' => $properties['data']
        ]);
    }

    public function show(int $id)
    {

    }
}