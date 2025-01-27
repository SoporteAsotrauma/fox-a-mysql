<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateRoutes extends Command
{
    protected $signature = 'routes:generate';
    protected $description = 'Generate API routes for all models dynamically';

    public function handle()
    {
        $models = File::files(app_path('Models'));
        $routesContent = "<?php\n\nuse Illuminate\Support\Facades\Route;\n\n";

        // Añadir el grupo de middleware
        $routesContent .= "Route::middleware(['jwt.auth'])->group(function () {\n";

        foreach ($models as $model) {
            $modelName = $model->getFilenameWithoutExtension(); // Nombre del modelo sin extensión
            $controller = "App\\Http\\Controllers\\{$modelName}Controller";

            $routePrefix = strtolower($modelName) . 's';

            // Añade las rutas al contenido
            $routesContent .= <<<EOT
    Route::get('$routePrefix/{id}', ['$controller', 'show']);
    Route::post('$routePrefix', ['$controller', 'create']);
    Route::post('$routePrefix/search', ['$controller', 'search']);
EOT;
            $routesContent .= "\n\n";
        }

        // Cerrar el grupo
        $routesContent .= "});\n";

        // Guarda las rutas generadas en un archivo
        File::put(base_path('routes/generated_routes.php'), $routesContent);

        $this->info('Routes generated successfully!');
    }
}
