<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use App\Services\MailConfigService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Http;   
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('website_data', function () {
        return Http::get('http://3.227.19.224/web3/api/websites/54');
    });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $inner=DB::table('miscs')->get(); $misc = [];
            foreach ($inner as $row) {
                session()->put($row->name, $row->value);
                 $misc[$row->name] = $row->value;
                   }
                View::share('misc', $misc);


        if(app()->environment('production') && request()->header('x-forwarded-proto') !== 'https') {
            URL::forceScheme('https');
	    }
        Schema::defaultStringLength(191);
        $menu=Category::getAllParentWithChild();
        // $menu=Category::get();
        View::share('category',$menu);
        
        // Configure mail from S3 credentials
        try {
            $mailConfigService = app(MailConfigService::class);
            $mailConfigService->configureMailFromS3();
        } catch (\Exception $e) {
            // Log error but don't break the application
            \Log::warning('Failed to configure mail from S3: ' . $e->getMessage());
        }
    }
}
