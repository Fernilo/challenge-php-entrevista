<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
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

        $response = $this->apiConnectionService->getAllPropertiesWithCache();
        $properties = $response['data'];
   
        if (empty($properties)) {
            return view('admin.propiedades.index', [
                'properties' => [],
                'pagination' => $response['pagination'], 
            ]);
        }
    
        $perPage = $response['pagination']['per_page']; 
        $total = $response['pagination']['total'];
        $propertiesPaginated = new LengthAwarePaginator(
            collect($properties)->slice(($currentPage - 1) * $perPage, $perPage)->all(),
            $total,
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
    
        return view('admin.propiedades.index', [
            'properties' => $propertiesPaginated,
            'pagination' => $response['pagination'], 
        ]);
    }

    public function show(int $id)
    {
        $property = $this->apiConnectionService->getOne($id);
     
        return view('admin.propiedades.show', ['property' => $property['data']]);
    }


    public function sendMessage(MessageRequest $request)
    {
        $validated = $request->validated();

        $validated['property_id'] = $request->input('property_id');

        try {
            $this->apiConnectionService->sendMessage($validated);
            
            return redirect()->route('propiedades.show', $validated['property_id'])
                             ->with('success', 'Mensaje enviado con éxito!');
        } catch (\Exception $e) {
            return redirect()->route('propiedades.show', $validated['property_id'])
                             ->with('error', 'Error al enviar el mensaje. Intente nuevamente ');
        }
    }
}