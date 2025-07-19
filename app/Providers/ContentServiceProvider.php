<?php

namespace App\Providers;

use App\Models\Place;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;

class ContentServiceProvider extends ServiceProvider
{
    public $commonContent;

    public function register(): void
    {
        // Register bindings here if needed
    }

    public function boot(): void
    {
        if (App::runningInConsole()) {
            return;
        }

        $places = Place::where('status', 1)->get();

        $this->commonContent = [
            'places' => $places,
        ];

        // Share with all views
        View::share('commonContent', $this->commonContent);
    }
}
