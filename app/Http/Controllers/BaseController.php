<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\ArrayToXml\ArrayToXml;

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
    public function show($id)
    {
        $result = $this->service->find($id);

        if (!$result) {
            $errorArray = ['error' => 'Resource not found'];
            $xmlContent = ArrayToXml::convert($errorArray, 'response');
            return response($xmlContent, 404)
                ->header('Content-Type', 'application/xml');
        }

        // Convertir el resultado a un array plano
        $resultArray = $result->toArray();

        // Convertir a XML
        $xmlContent = ArrayToXml::convert($resultArray, 'response');

        return response($xmlContent, 200)
            ->header('Content-Type', 'application/xml');
    }
    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        // Crear el registro a través del servicio sin validación en el backend
        $createdRecord = $this->service->create($request->all());

        return response()->json($createdRecord, 201);
    }


}
