<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Log; // Agregar esta línea

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Escuchar el evento QueryExecuted para obtener la información de las consultas ejecutadas
        // DB::listen(function (QueryExecuted $query) {
        //     $sqlWithBindings = vsprintf(str_replace(['%', '?'], ['%%', "'%s'"], $query->sql), $query->bindings);
        //     Log::info('Consulta SQL: ' . $sqlWithBindings);
        // });
    }
}
