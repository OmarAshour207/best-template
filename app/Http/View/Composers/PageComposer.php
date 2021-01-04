<?php

namespace App\Http\View\Composers;

use App\Page;
use Illuminate\View\View;

class PageComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('pages', Page::where('status', 1)->get());
    }
}
