<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateComponents extends Command
{
    protected $signature = 'generate:components';
    protected $description = 'Genera controladores, servicios y repositorios basados en los modelos';

    public function handle()
    {
        $modelsPath = app_path('Models');
        $controllersPath = app_path('Http/Controllers');
        $servicesPath = app_path('Services');
        $repositoriesPath = app_path('Repositories');

        $models = File::files($modelsPath);

        foreach ($models as $model) {
            $modelName = $model->getFilenameWithoutExtension();

            // Generar controlador
            $controllerContent = "<?php

namespace App\Http\Controllers;

use App\Services\\{$modelName}Service;

class {$modelName}Controller extends BaseController
{
    public function __construct({$modelName}Service \$service)
    {
        parent::__construct(\$service);
    }
}";
            File::put("{$controllersPath}/{$modelName}Controller.php", $controllerContent);

            // Generar servicio
            $serviceContent = "<?php

namespace App\Services;

use App\Repositories\\{$modelName}Repository;

class {$modelName}Service extends BaseService
{
    public function __construct({$modelName}Repository \$repository)
    {
        parent::__construct(\$repository);
    }
}";
            File::put("{$servicesPath}/{$modelName}Service.php", $serviceContent);

            // Generar repositorio
            $repositoryContent = "<?php

namespace App\Repositories;

use App\Models\\{$modelName};

class {$modelName}Repository extends BaseRepository
{
    public function __construct({$modelName} \$model)
    {
        parent::__construct(\$model);
    }
}";
            File::put("{$repositoriesPath}/{$modelName}Repository.php", $repositoryContent);
        }

        $this->info('Componentes generados exitosamente.');
    }
}
