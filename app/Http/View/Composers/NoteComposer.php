<?php

namespace App\View\Composers;

use App\Models\Note;
use Illuminate\View\View;

class PostComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('notes', Note::all());
    }
}