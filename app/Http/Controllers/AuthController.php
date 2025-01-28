<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validar los datos de entrada
        $credentials = $request->only('email', 'password');

        // Intentar crear un token para el usuario
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response($this->toXml(['error' => 'Unauthorized']), 401)
                    ->header('Content-Type', 'application/xml');
            }
        } catch (JWTException $e) {
            return response($this->toXml(['error' => 'Could not create token']), 500)
                ->header('Content-Type', 'application/xml');
        }

        // Devolver el token como XML
        $response = ['token' => $token];
        return response($this->toXml($response))
            ->header('Content-Type', 'application/xml');
    }

    /**
     * Helper para convertir un arreglo a XML.
     *
     * @param array $data
     * @param string $rootElement
     * @return string
     */
    private function toXml(array $data, string $rootElement = 'response'): string
    {
        $xml = new \SimpleXMLElement("<{$rootElement}/>");

        $this->arrayToXml($data, $xml);

        return $xml->asXML();
    }

    /**
     * Convertir un arreglo a XML recursivamente.
     *
     * @param array $data
     * @param \SimpleXMLElement $xml
     */
    private function arrayToXml(array $data, \SimpleXMLElement &$xml): void
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $subnode = $xml->addChild(is_numeric($key) ? 'item' : $key);
                $this->arrayToXml($value, $subnode);
            } else {
                $xml->addChild(is_numeric($key) ? 'item' : $key, htmlspecialchars($value));
            }
        }
    }
}
