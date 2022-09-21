<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class MakeObserver extends Command
{
    /** @var Filesystem $files */
    protected Filesystem $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:ispa-observer {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make Model Observer';

    /** @var string $type */
    protected string $type = 'Observers';

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
        return __DIR__ . '/stubs/Observer.stub';
    }

    /**
     * Execute the console command.
     *
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        $observerFileName = app_path('Observers/' . $this->argument('name') . 'Observer.php');

        if (! File::exists($observerFileName)) {
            $observerContent = Str::replace(
                '{{ name }}',
                $this->argument('name'),
                $this->files->get($this->getStub())
            );

            //  Check the directory
            if (! File::exists(app_path('Observers'))) {
                File::makeDirectory(app_path('Observers'));
            }

            //  Put the content file
            File::put($observerFileName, $observerContent);

            $this->info($this->argument('name') . 'Observer created successfully.');
        } else {
            $this->error($this->argument('name') . 'Observer already exists!');
        }
    }
}
