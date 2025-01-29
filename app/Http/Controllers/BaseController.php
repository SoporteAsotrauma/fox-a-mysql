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

    public function search(Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
    {
        $filters = $request->all(); // Captura los filtros de la solicitud
        $results = $this->service->search($filters);

        // Convertir los resultados de objetos Eloquent a arrays
        $arrayResults = $results->toArray();

        // Convertir el array a XML
        $xmlData = $this->arrayToXml($arrayResults);

        // Devolver como respuesta XML
        return response($xmlData, 200)->header('Content-Type', 'application/xml');
    }

    private function arrayToXml($data, &$xmlData = null): bool|string
    {
        if ($xmlData === null) {
            $xmlData = new \SimpleXMLElement('<root/>');
        }

        foreach ($data as $value) {
            // Crear un contenedor <item> para cada fila de datos
            $itemNode = $xmlData->addChild('item');

            // Recorrer cada campo dentro de la fila de datos
            foreach ($value as $key => $val) {
                // Convertir cada clave en una etiqueta y su valor en contenido
                $itemNode->addChild($key, htmlspecialchars($val));
            }
        }

        return $xmlData->asXML();
    }

    public function show($id): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
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
    public function create(Request $request)
    {
        // Crear el registro a través del servicio
        $createdRecord = $this->service->create($request->all());

        // Convertir el modelo a array antes de pasarlo a XML
        $xmlResponse = $this->arrayToXml([$createdRecord->toArray()]);

        return response($xmlResponse, 201)->header('Content-Type', 'application/xml');
    }




}
