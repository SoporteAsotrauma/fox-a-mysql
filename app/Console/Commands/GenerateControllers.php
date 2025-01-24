<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateControllers extends Command
{
    protected $signature = 'generate:controllers';
    protected $description = 'Genera controladores automáticamente para todos los modelos.';

    public function handle()
    {
        $models = File::files(app_path('Models')); // Obtiene todos los modelos en app/Models

        foreach ($models as $model) {
            $modelName = $model->getFilenameWithoutExtension();
            $this->info("Generando controlador para $modelName");

            // Generar el controlador
            $this->generateController($modelName);
        }

        $this->info('Controladores generados con éxito.');
    }

    /**
     * Genera el controlador para un modelo.
     *
     * @param string $modelName
     * @return void
     */
    protected function generateController($modelName)
    {
        $controllerTemplate = "<?php\n\nnamespace App\Http\Controllers;\n\nuse App\Services\\{$modelName}Service;\nuse Illuminate\Http\Request;\n\nclass {$modelName}Controller extends Controller\n{\n    protected \$service;\n\n    public function __construct({$modelName}Service \$service)\n    {\n        \$this->service = \$service;\n    }\n\n    public function index()\n    {\n        return response()->json(\$this->service->all());\n    }\n\n    public function show(\$id)\n    {\n        return response()->json(\$this->service->find(\$id));\n    }\n\n    public function store(Request \$request)\n    {\n        return response()->json(\$this->service->create(\$request->all()), 201);\n    }\n\n    public function update(Request \$request, \$id)\n    {\n        return response()->json(\$this->service->update(\$id, \$request->all()));\n    }\n\n    public function destroy(\$id)\n    {\n        return response()->json(\$this->service->delete(\$id));\n    }\n}\n";

        $path = app_path("Http/Controllers/{$modelName}Controller.php");

        // Crea el controlador solo si no existe
        if (!File::exists($path)) {
            File::put($path, $controllerTemplate);
        }
    }
}
