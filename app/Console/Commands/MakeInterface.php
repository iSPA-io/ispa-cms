<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeInterface extends Command
{
    /** @var Filesystem $files */
    protected Filesystem $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:ispa-interface {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create interface for the repository';

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
        return __DIR__ . '/stubs/Interface.stub';
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $interfaceName = app_path('Repositories/Interface/' . $this->argument('name') . 'Interface.php');

        if ($this->files->exists($interfaceName)) {
            $this->warn($this->argument('name') . 'Interface already exists!');
            return;
        }

        $interfaceContent = Str::replace('{{ name }}', $this->argument('name'), $this->files->get($this->getStub()));

        //  Check & make dir
        if (! $this->files->exists(app_path('Repositories/Interface'))) {
            $this->files->makeDirectory(app_path('Repositories/Interface'));
        }

        $this->files->put($interfaceName, $interfaceContent);

        $this->info($this->argument('name') . 'Interface created successfully.');
    }
}
