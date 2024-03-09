<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeActionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:action {name : The name of the action class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new action class';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $nameInput = $this->argument('name');
        $nameParts = explode('/', $nameInput);
        $name = array_pop($nameParts);
        $subfolder = implode('/', $nameParts);

        // Define the paths for the action, interface, and test files
        $actionPath = app_path("Actions/{$subfolder}/{$name}/{$name}Action.php");
        $interfacePath = app_path("Actions/{$subfolder}/{$name}/Interfaces/{$name}Interface.php");
        // $testPath = base_path("tests/Feature/{$subfolder}/{$name}ActionTest.php");

        // Create the folders if they don't exist
        $this->createFolderIfNotExists(dirname($actionPath));
        $this->createFolderIfNotExists(dirname($interfacePath));
        // $this->createFolderIfNotExists(dirname($testPath));

        // Create the files
        $this->createFile($actionPath, $this->actionFileContent($name, $subfolder));
        $this->createFile($interfacePath, $this->interfaceFileContent($name, $subfolder));
        // $this->createFile($testPath, $this->testFileContent($name, $subfolder));
        
        $this->updateProvider($name);

        $this->info("Action {$name} created successfully!");
    }

    private function createFolderIfNotExists($path)
    {
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true);
        }
    }

    private function createFile($path, $content)
    {
        if (!File::exists($path)) {
            File::put($path, $content);
        }
    }

    private function actionFileContent($name, $subfolder)
    {
        // Add the content of the action file here
        $namespace = $subfolder ? "App\Actions\\{$subfolder}\\" : "App\Actions\\";
        return "<?php\n\nnamespace {$namespace}{$name};\n\nuse {$namespace}{$name}\Interfaces\\{$name}Interface;\n\n// ... other imports ...\n\nclass {$name}Action implements {$name}Interface\n{\n    // ... implementation ...\n}\n";
    }

    private function interfaceFileContent($name, $subfolder)
    {
        // Add the content of the interface file here
        $namespace = $subfolder ? "App\Actions\\{$subfolder}\\" : "App\Actions\\";
        return "<?php\n\nnamespace {$namespace}{$name}\Interfaces;\n\ninterface {$name}Interface\n{\n    // ... methods ...\n}\n";
    }

    private function testFileContent($name, $subfolder)
    {
        // Add the content of the test file here
        $namespace = $subfolder ? "Tests\Feature\\{$subfolder}\\" : "Tests\Feature\\";

        return "<?php\n\nnamespace {$namespace};\n\nuse {$namespace}{$name}Action;\nuse TestCase;\n\n// ... other imports ...\n\nclass {$name}ActionTest extends TestCase\n{\n    // ... tests ...\n}\n";
    }

    private function updateProvider($name)
    {
        $providerPath = app_path('Providers/InstanceInterfaceAppProvider.php');
        $providerContent = File::get($providerPath);

        $newEntry = $this->formatProviderEntry($name);

        if (strpos($providerContent, $newEntry) === false) {
            $beginMarker = '// --BEGIN ACTION BINDINGS--';
            $endMarker = '// --END ACTION BINDINGS--';
            $insertPosition = strpos($providerContent, $endMarker);
            $providerContent = substr_replace($providerContent, $newEntry, $insertPosition, 0);
            File::put($providerPath, $providerContent);
        }
    }

    private function formatProviderEntry($name)
    {
        $namespace = 'App\\Actions';
        $parts = explode('/', $name);
        $className = end($parts);
        $subNamespace = implode('\\', $parts);
        
        return "\n        \$this->app->bind({$namespace}\\{$subNamespace}\\Interfaces\\{$className}Interface::class, {$namespace}\\{$subNamespace}\\{$className}Action::class);\n";
    }
}
