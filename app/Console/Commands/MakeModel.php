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

        if (! file_exists($eloquentName)) {
            $eloquentContent = Str::replace(
                ['{{ name }}', '{{ name|lower }}'],
                [$this->argument('name'), Str::snake(Str::plural($this->argument('name')))],
                $this->files->get($this->getStub())
            );
            //  Process to replace uppercase text here
            $eloquentContent = Str::replace(
                ['{{ name|upper }}'],
                Str::upper(Str::plural($this->argument('name'))),
                $eloquentContent
            );

            file_put_contents($eloquentName, $eloquentContent);

            $this->info($this->argument('name').'Model file created!');
        } else {
            $this->warn('Model file already exists!');
        }
    }
}
