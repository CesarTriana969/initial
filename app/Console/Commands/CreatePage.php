<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreatePage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:vue-page {name} {--folder= : Specify a custom folder}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Laravel page and a corresponding Vue component';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $folder = $this->option('folder') ?: '';

        // 1. Crea el controlador
        $this->call('make:controller', ['name' => "{$folder}/{$name}Controller"]);

        // 2. Crea la vista
        if (!is_dir($dir = resource_path("views/admin/{$folder}"))) {
            mkdir($dir, 0777, true);
        }
        $viewPath = resource_path("views/admin/{$folder}/{$name}.blade.php");
        if (!file_exists($viewPath)) {
            file_put_contents($viewPath, "@extends('layouts.app')\n\n@section('content')\n    <{$name}-component></{$name}-component>\n@endsection");
        }

        // 3. Crea el componente Vue
        if (!is_dir($dir = resource_path("js/pages/{$folder}"))) {
            mkdir($dir, 0777, true);
        }
        $vuePath = resource_path("js/pages/{$folder}/{$name}Component.vue");
        $vueTemplate = <<<VUE
            <template>
                <div>
                    <!-- Vue code here -->
                </div>
            </template>

            <script>
            export default {
                name: '{$name}Component',
                data() {
                    return {
                        //
                    };
                },
                methods: {
                    //
                }
            }
            </script>

            <style scoped>
                /* Styles here */
            </style>
            VUE;
        file_put_contents($vuePath, $vueTemplate);

        // 4. Agrega rutas (esto es solo un ejemplo, podrías necesitar adaptarlo a tus necesidades)
        $routesPath = base_path('routes/web/panel.routes.php');
        $routeContent = file_get_contents($routesPath);
        $routeContent .= "\nRoute::get('/{$name}', [App\Http\Controllers\{$folder}\\{$name}Controller::class, 'index']);\n";

        file_put_contents($routesPath, $routeContent);

        $this->info("Page, component and route for {$name} created successfully in the {$folder} folder!");
    }
}
