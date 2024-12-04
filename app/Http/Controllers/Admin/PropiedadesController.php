<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PropiedadesController extends Controller
{
    public function index()
    {
        return view('admin.propiedades.index');
    }
}