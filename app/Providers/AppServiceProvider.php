<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $storePath = env('IMAGE_STORE_PATH');
        if($storePath == null) {
            error_log("[ERROR] Image store path does not exist!");
            exit(1);
        }
        if (!file_exists($storePath)) {
            mkdir($storePath, 0766, true);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
