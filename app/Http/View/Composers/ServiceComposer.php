<?php


namespace App\Http\View\Composers;

use App\Service;
use Illuminate\View\View;

class ServiceComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('services', Service::latest()->take(4)->get());
    }

}