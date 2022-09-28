<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class MakeRepository extends Command
{
    /** @var Filesystem $files */
    protected Filesystem $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:ispa-repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make repository with Model';

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
        return __DIR__ . '/stubs/Repository.stub';
    }

    /**
     * Execute the console command.
     *
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        $repositoryName = app_path('Repositories/Eloquent/' . $this->argument('name') . 'Repository.php');

        if ($this->files->exists($repositoryName)) {
            $this->warn($this->argument('name') . 'Repository already exists!');
            return;
        }

        $repositoryContent = Str::replace('{{ name }}', $this->argument('name'), $this->files->get($this->getStub()));

        //  Check & make dir
        if (! $this->files->exists(app_path('Repositories/Eloquent'))) {
            $this->files->makeDirectory(app_path('Repositories/Eloquent'));
        }

        $this->files->put($repositoryName, $repositoryContent);

        $this->info($this->argument('name') . 'Repository created successfully.');
    }
}
