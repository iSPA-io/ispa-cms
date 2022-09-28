<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeIspa extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:ispa {name} {--api} {--soft} {--v=V1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate all of stubs for a new resource';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->call('make:ispa-controller', [
            'name' => $this->argument('name'),
            '--api' => $this->option('api'),
            '--v' => $this->option('v'),
        ]);

        $this->call('make:ispa-model', [
            'name' => $this->argument('name'),
            '--soft' => $this->option('soft'),
        ]);

        $this->call('make:ispa-request', [
            'name' => $this->argument('name')
        ]);

        $this->call('make:ispa-observer', [
            'name' => $this->argument('name'),
        ]);

        $this->call('make:ispa-policy', [
            'name' => $this->argument('name'),
        ]);

        $this->call('make:ispa-interface', [
            'name' => $this->argument('name'),
        ]);

        $this->call('make:ispa-repository', [
            'name' => $this->argument('name'),
        ]);

        $this->info('Done!');
    }
}
