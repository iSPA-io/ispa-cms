<?php

namespace App\Console\Commands;

use App\Constants\Tables;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ExportDatabaseTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ispa:export-db {table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export data from a table to a .sql file to be imported to migration seeder';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $allowedExportedTablesList = [Tables::ENUMERATES, Tables::ENUMERATES_TYPE, Tables::LANGUAGES];
        $table = $this->argument('table');

        if (!in_array($table, $allowedExportedTablesList, true)) {
            $this->error('Table not allowed to export');
            return;
        }

        $fileName = $table . '.sql';

        File::makeDirectory(database_path('seeders/sql'), 0777, true, true);

        $command = "mysqldump --user=root --password=" . env('DB_PASSWORD') . " --host=127.0.0.1"
            . " " . env('DB_DATABASE') . " --no-create-info --skip-triggers "
            . $table . " > " . database_path('seeders/sql/' . $fileName);

        exec($command);

        $this->info('Exported successfully');
    }
}
