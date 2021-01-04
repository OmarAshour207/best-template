<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;
use Request;

class LanguageController extends Controller
{

    public function changeLanguage($lang)
    {
        if (array_key_exists($lang, config('locales.languages'))) {
            app()->setLocale($lang);
            Lang::setLocale($lang);
            setlocale(LC_TIME, config('locales.languages')[$lang]['unicode']);
            Carbon::setLocale(config('locales.languages')[$lang]['lang']);

            session()->has('lang') ? session()->forget('lang') : '';
            session()->put('lang', $lang);

            $previousSegemnts = request()->create(url()->previous())->segments();
            if (isset($previousSegemnts[2])) {
                return $this->resolveModel(Blog::class, $previousSegemnts[2], $lang);
            }
        }
        return back();
    }

    protected function resolveModel($modelClass, $slug, $locale)
    {
        $model = $modelClass::where('slug->'. $locale, $slug)->first();

        if (is_null($model)) {

            foreach (config('locales.languages') as $key => $val)
            {
                $modelInLocale = $modelClass::where('slug->'. $key, $slug)->first();
                if ($modelInLocale) {
                    $newRoute = str_replace($slug, $modelInLocale->slug, urldecode(urlencode(route('posts.show', $modelInLocale->slug))));
                    return redirect()->to($newRoute)->send();
                }
            }
            abort(404);
        }
        return redirect()->back();
    }

}
