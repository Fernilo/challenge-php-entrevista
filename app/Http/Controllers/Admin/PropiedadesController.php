<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ApiConnectionService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class PropiedadesController extends Controller
{
    private $apiConnectionService;

    public function __construct(ApiConnectionService $api_ConnectionService)
    {
        $this->apiConnectionService = $api_ConnectionService;
    }


    public function index(Request $request)
    {
        $currentPage = $request->input('page', 1);
        $response = $this->apiConnectionService->getAllProperties();
    
        $properties = $response['data'];
    
        if ($request->ajax()) {
            return response()->json([
                'properties' => $properties,
                'pagination' => $response['pagination'],
            ]);
        }
    
        return view('admin.propiedades.index', [
            'properties' => $properties,
            'pagination' => $response['pagination'],
        ]);
    }

    public function show(int $id)
    {

    }
}