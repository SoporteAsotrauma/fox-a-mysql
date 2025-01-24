<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registra los servicios y repositorios.
     *
     * @return void
     */
    public function register()
    {
        // Obtiene todos los modelos en la carpeta 'app/Models'
        $models = File::files(app_path('Models'));

        // Recorre cada modelo para registrar su repositorio y servicio
        foreach ($models as $model) {
            $modelName = $model->getFilenameWithoutExtension(); // Nombre del modelo sin extensión

            // Registra el repositorio
            $this->app->bind(
                "App\\Repositories\\{$modelName}RepositoryInterface",
                "App\\Repositories\\{$modelName}Repository"
            );

            // Registra el servicio
            $this->app->bind(
                "App\\Services\\{$modelName}Service",
                "App\\Services\\{$modelName}Service"
            );
        }
    }
}
