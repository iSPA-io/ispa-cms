<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class MakeRequests extends Command
{
    /** @var Filesystem $files */
    protected Filesystem $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:ispa-requests {name} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create form validation for the request controller';

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
        return __DIR__ . '/stubs/RequestValidation.stub';
    }

    /**
     * Execute the console command.
     *
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        $typeArray = ['Get', 'Store', 'Update', 'MassDestroy'];

        foreach ($typeArray as $type) {
            $fileName = app_path('Http/Requests/' . $this->argument('name') . '/' . $type.$this->argument('name') . 'Request.php');

            if (! File::exists($fileName)) {
                $fileContent = Str::replace(
                    ['{{ name }}', '{{ type }}'],
                    [$this->argument('name'), $type],
                    $this->files->get($this->getStub())
                );

                //  Check & make dir
                if (! File::exists(app_path('Http/Requests/' . $this->argument('name')))) {
                    File::makeDirectory(app_path('Http/Requests/' . $this->argument('name')));
                }
                //  File put content
                File::put($fileName, $fileContent);

                $this->info($this->argument('name') . $type . 'Request created!');
            } else {
                $this->warn($this->argument('name') . $type . 'Request already exists!');
            }
        }
    }
}
