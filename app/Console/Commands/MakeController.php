<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class MakeController extends Command
{
    /** @var Filesystem $files */
    protected Filesystem $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:ispa-controller {name} {--api} {--v=V1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make controller with Model';

    /** @var string $type */
    protected string $type = 'Controller';

    /**
     * Command constructor
     *
     * @author malayvuong
     * @since 7.0.0 - 2022-09-19, 22:55 ICT
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Get the stub file
     *
     * @author malayvuong
     * @since 7.0.0 - 2022-09-20, 23:34 ICT
     */
    protected function getStub(): string
    {
        return __DIR__ . '/stubs/' . ($this->option('api') ? 'ControllerApi' : 'Controller') . '.stub';
    }

    /**
     * Execute the console command.
     *
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        $appDir = app_path('Http/Controllers/' . ($this->option('api') ? $this->option('v').'/' : ''));

        if (! File::exists($appDir)) {
            File::makeDirectory($appDir, 0777, true);
        }

        //  Generate ADMIN file
        $adminFileName = app_path('Http/Controllers/' . ($this->option('api') ? $this->option('v').'/Admin/' : 'Admin') . $this->argument('name') . 'Controller.php');

        //  if file not exists -> process to create this file
        if (!File::exists($adminFileName)) {
            $controllerFileContent = Str::replace(
                ['{{ name }}', '{{ api }}', '{{ type }}'],
                [$this->argument('name'), '\\' . $this->option('v') . '\Admin', 'Admin'],
                $this->files->get($this->getStub())
            );
            //  Make directory
            $dir = app_path('Http/Controllers/' . ($this->option('api') ? $this->option('v').'/Admin/' : '/'));
            //  Check the directory exists
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0777, true);
            }
            //  put file content to file
            File::put($adminFileName, $controllerFileContent);

            $this->info($this->argument('name') . $this->type . ' Admin created!');
        } else {
            $this->warn($this->argument('name') . $this->type . ' Admin already exists!');
        }

        //  Generate CLIENT file
    }
}
