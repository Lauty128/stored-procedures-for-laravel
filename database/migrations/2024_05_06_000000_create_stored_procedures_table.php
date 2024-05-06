<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Foundation\Bootstrap\HandleExceptions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            # Obtener el contenido de la carpeta sp y elimminar los dos primeros elementos ('.' y '..')
            $sp_folder = File::files(database_path('migrations/sp'));

            # Ejecutar los "Drop if exists"
            foreach ($sp_folder as $sp){
                # Obtener nombre del archivo
                $sp_name = pathinfo($sp, PATHINFO_FILENAME); # => 'procedure_name'
                # Ejecutamos la consulta con el nombre obtenido
                DB::unprepared('DROP PROCEDURE IF EXISTS '.$sp_name.';');
            }

            # Ejecutar los Stored Procedures
            foreach ($sp_folder as $sp){
                # Obtenemos el contenido del SP
                $sp_name = pathinfo($sp, PATHINFO_FILENAME); # => 'procedure_name'
                $sp_content = file_get_contents(database_path('migrations/sp/'.$sp_name.'.sql')); # Solo funciona para archivos .sql
                // $sp_content = File::get(database_path('migrations/sp/'.$sp_name.'.sql')); # Alternativa a file_get_contents para laravel
                
                # Preparar procedure para ejecutar
                DB::unprepared($sp_content);
            }

        } catch (HandleExceptions $e){
            echo($e);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stored_procedures');
    }
};
