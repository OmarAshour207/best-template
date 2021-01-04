<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Page;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::latest()->paginate(10);
        return view('dashboard.pages.index', compact('pages'));
    }

    public function edit(Page $page)
    {
        return view('dashboard.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $attr = [];
        foreach (config('locales.languages') as $key => $value) {
            $attr['title.' . $key]          = 'sometimes|nullable|string';
            $attr['description.' . $key]    = 'sometimes|nullable|string';
        }
        $attr['slug'] = 'sometimes|nullable|string|unique:pages,' . $request->slug;
        $attr['status'] = 'required|numeric';

        $data = $request->validate($attr);

        $data['image'] = $request->image;

        $page->update($data);
        session()->flash('success', trans('admin.added_successfully'));
        return redirect()->route('pages.index');
    }

}
