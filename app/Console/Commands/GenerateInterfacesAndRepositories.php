<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateInterfacesAndRepositories extends Command
{
    protected $signature = 'generate:interfaces-repositories-services';
    protected $description = 'Genera interfaces, repositorios y servicios automáticamente para todos los modelos.';

    public function handle()
    {
        $models = File::files(app_path('Models')); // Obtiene todos los modelos en app/Models

        foreach ($models as $model) {
            $modelName = $model->getFilenameWithoutExtension();
            $this->info("Generando interfaz, repositorio y servicio para $modelName");

            // Generar la interfaz
            $this->generateInterface($modelName);

            // Generar el repositorio
            $this->generateRepository($modelName);

            // Generar el servicio
            $this->generateService($modelName);
        }

        $this->info('Interfaces, repositorios y servicios generados con éxito.');
    }

    protected function generateInterface($modelName)
    {
        // Plantilla para la interfaz (como antes)
        $interfaceTemplate = "<?php\n\nnamespace App\Repositories;\n\ninterface {$modelName}RepositoryInterface {\n    public function all();\n    public function find(\$id);\n    public function create(array \$data);\n    public function update(\$id, array \$data);\n    public function delete(\$id);\n}\n";
        $path = app_path("Repositories/{$modelName}RepositoryInterface.php");
        if (!File::exists($path)) {
            File::put($path, $interfaceTemplate);
        }
    }

    protected function generateRepository($modelName)
    {
        // Plantilla para el repositorio (como antes)
        $repositoryTemplate = "<?php\n\nnamespace App\Repositories;\n\nuse App\Models\\{$modelName};\n\nclass {$modelName}Repository implements {$modelName}RepositoryInterface {\n    public function all() {\n        return {$modelName}::all();\n    }\n\n    public function find(\$id) {\n        return {$modelName}::findOrFail(\$id);\n    }\n\n    public function create(array \$data) {\n        return {$modelName}::create(\$data);\n    }\n\n    public function update(\$id, array \$data) {\n        \$model = {$modelName}::findOrFail(\$id);\n        \$model->update(\$data);\n        return \$model;\n    }\n\n    public function delete(\$id) {\n        \$model = {$modelName}::findOrFail(\$id);\n        \$model->delete();\n    }\n}\n";
        $path = app_path("Repositories/{$modelName}Repository.php");
        if (!File::exists($path)) {
            File::put($path, $repositoryTemplate);
        }
    }

    /**
     * Genera el servicio para un modelo.
     *
     * @param string $modelName
     * @return void
     */
    protected function generateService($modelName)
    {
        $serviceTemplate = "<?php\n\nnamespace App\Services;\n\nuse App\Repositories\\{$modelName}RepositoryInterface;\n\nclass {$modelName}Service {\n    protected \$repo;\n\n    public function __construct({$modelName}RepositoryInterface \$repo) {\n        \$this->repo = \$repo;\n    }\n\n    public function all() {\n        return \$this->repo->all();\n    }\n\n    public function find(\$id) {\n        return \$this->repo->find(\$id);\n    }\n\n    public function create(array \$data) {\n        return \$this->repo->create(\$data);\n    }\n\n    public function update(\$id, array \$data) {\n        return \$this->repo->update(\$id, \$data);\n    }\n\n    public function delete(\$id) {\n        return \$this->repo->delete(\$id);\n    }\n}\n";

        $path = app_path("Services/{$modelName}Service.php");

        if (!File::exists($path)) {
            File::put($path, $serviceTemplate);
        }
    }
}
