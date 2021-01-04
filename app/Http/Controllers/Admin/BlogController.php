<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::paginate(10);
        return view('dashboard.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('dashboard.blogs.create');
    }

    public function store(Request $request)
    {
        $attr = [];
        foreach (config('locales.languages') as $key => $value) {
            $attr['author.' . $key]         = 'required|string';
            $attr['title.' . $key]          = 'required|string';
            $attr['content.' . $key]        = 'required|string';
            $attr['meta_tag.' . $key]       = 'sometimes|nullable|string';
        }

        $data = $request->validate($attr);
        $data['image'] = $request->image;

        Blog::create($data);
        session()->flash('success', trans('admin.added_successfully'));
        return redirect()->route('blogs.index');

    }

    public function edit($blog)
    {
        $blog = Blog::where('slug->' . app()->getLocale(), $blog)->first();

        return view('dashboard.blogs.edit', compact('blog'));
    }

    public function update(Request $request, $blog)
    {
        $attr = [];
        foreach (config('locales.languages') as $key => $value) {
            $attr['author.' . $key]         = 'required|string';
            $attr['title.' . $key]          = 'required|string';
            $attr['content.' . $key]        = 'required|string';
            $attr['meta_tag.' . $key]       = 'sometimes|nullable|string';
        }

        $blog = Blog::where('slug->' . app()->getLocale(), $blog)->first();

        $data = $request->validate($attr);
        $data['image'] = $request->image;

        $blog->update($data);
        session()->flash('success', trans('admin.updated_successfully'));
        return redirect()->route('blogs.index');
    }

    public function destroy($blog)
    {
        $blog = Blog::where('slug->' . app()->getLocale(), $blog)->first();
        if ($blog->image != null) {
            Storage::disk('local')->delete('public/blogs/' . $blog->image);
            Storage::disk('local')->delete('public/blogs/thumbnail/' . $blog->image);
        }
        $blog->delete();
        session()->flash('success', trans('admin.deleted_successfully'));
        return redirect()->route('blogs.index');
    }

}
