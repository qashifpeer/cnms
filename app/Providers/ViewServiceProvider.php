<?php

namespace App\Providers;

use App\Models\Note;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Use following code if you prefer to create a class
        // Based view composer otherwise use callback
        //View::composer('notes', NoteComposer::class);


        // Use following code if you want to use callback
        // Based view composer instead of class based view composer
        // View::composer('post.list', function ($view) {

        //     // following code will create $posts variable which we can use
        //     // in our post.list view you can also create more variables if needed
        //     $view->with('posts', Note::orderByDesc('created_at')->paginate());
        // });
    }
}
