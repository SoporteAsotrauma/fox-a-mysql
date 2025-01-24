<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    protected $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function search(Request $request): \Illuminate\Http\JsonResponse
    {
        $filters = $request->all(); // Captura los filtros de la solicitud
        return response()->json($this->service->search($filters));
    }
    public function show($id): \Illuminate\Http\JsonResponse
    {
        $result = $this->service->find($id);
        if (!$result) {
            return response()->json(['error' => 'Resource not found'], 404);
        }
        return response()->json($result);
    }

    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        // Crear el registro a través del servicio sin validación en el backend
        $createdRecord = $this->service->create($request->all());

        return response()->json($createdRecord, 201);
    }


}
