<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class MakePolicy extends Command
{
    /** @var Filesystem $files */
    protected Filesystem $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:ispa-policy {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make custom policy';

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
        return __DIR__ . '/stubs/Policy.stub';
    }

    /**
     * Execute the console command.
     *
     * @throws FileNotFoundException
     */
    public function handle()
    {
        $policyName = app_path('Policies/' . $this->argument('name') . 'Policy.php');

        if ($this->files->exists($policyName)) {
            $this->error($this->argument('name') . 'Policy already exists!');
            return;
        }

        $policyContent = Str::replace(
            ['{{ name }}', '{{ name_lower }}'],
            [$this->argument('name'), Str::lower(Str::singular($this->argument('name')))],
            $this->files->get($this->getStub())
        );

        //  Check & make dir
        if (! $this->files->exists(app_path('Policies'))) {
            $this->files->makeDirectory(app_path('Policies'));
        }

        //  $this->makeDirectory($policyName);
        $this->files->put($policyName, $policyContent);

        $this->info($this->argument('name') . 'Policy created successfully.');
    }
}
