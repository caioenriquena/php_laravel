<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ExportDatabaseSchema extends Command
{
    protected $signature = 'export:schema';
    protected $description = 'Exporta o esquema do banco de dados para um arquivo';

    public function handle()
    {
        $tables = DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'");
        $output = "Tabelas do banco:\n\n";

        foreach ($tables as $table) {
            $output .= "Tabela: {$table->table_name}\n";
            $columns = DB::select("SELECT column_name, data_type FROM information_schema.columns WHERE table_name = ?", [$table->table_name]);
            foreach ($columns as $column) {
                $output .= "  - {$column->column_name} ({$column->data_type})\n";
            }
            $output .= "\n";
        }

        file_put_contents(storage_path('schema.txt'), $output);
        $this->info("Esquema exportado para " . storage_path('schema.txt'));
    }
}
