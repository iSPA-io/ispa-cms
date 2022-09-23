<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class MakeModel extends Command
{
    /** @var Filesystem $files */
    protected Filesystem $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:ispa-model {name} {--soft}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make custom model';

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
     * @since 7.0.0 - 2022-09-20, 23:36 ICT
     */
    protected function getStub(): string
    {
        return __DIR__ . '/stubs/' . ($this->option('soft') ? 'ModelSoft' : 'Model') . '.stub';
    }

    /**
     * Execute the console command.
     *
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        $eloquentName = app_path('Models/' . $this->argument('name') . '.php');

        if ($this->files->exists($eloquentName)) {
            $this->warn('Model file already exists!');
            return;
        }

        $eloquentContent = Str::replace(
            ['{{ name }}', '{{ name_lower }}'],
            [$this->argument('name'), Str::snake(Str::plural($this->argument('name')))],
            $this->files->get($this->getStub())
        );
        //  Process to replace uppercase text here
        $eloquentContent = Str::replace(
            ['{{ name_upper }}'],
            Str::upper(Str::plural($this->argument('name'))),
            $eloquentContent
        );

        $this->files->put($eloquentName, $eloquentContent);

        $this->info($this->argument('name').'Model file created!');
    }
}
