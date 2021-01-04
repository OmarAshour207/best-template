<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::paginate(10);
        return view('dashboard.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('dashboard.testimonials.create');
    }

    public function store(Request $request)
    {
        $attr = [];
        foreach (config('locales.languages') as $key => $value) {
            $attr['name.' . $key]           = 'required|string';
            $attr['title.' . $key]          = 'required|string';
            $attr['description.' . $key]    = 'required|string';
            $attr['meta_tag.' . $key]       = 'sometimes|nullable|string';
        }

        $data = $request->validate($attr);
        $data['image'] = $request->image;
        $data['status']= $request->status;
        $data['stars'] = $request->stars;

        Testimonial::create($data);
        session()->flash('success', __('admin.added_successfully'));
        return redirect()->route('testimonials.index');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('dashboard.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $attr = [];
        foreach (config('locales.languages') as $key => $value) {
            $attr['name.' . $key]           = 'required|string';
            $attr['title.' . $key]          = 'required|string';
            $attr['description.' . $key]    = 'required|string';
            $attr['meta_tag.' . $key]       = 'sometimes|nullable|string';
        }

        $data = $request->validate($attr);
        $data['image'] = $request->image;
        $data['status']= $request->status;
        $data['stars'] = $request->stars;

        $testimonial->update($data);
        session()->flash('success', __('admin.updated_successfully'));
        return redirect()->route('testimonials.index');
    }

    public function destroy(Testimonial $testimonial)
    {
        if($testimonial->image != null) {
            Storage::disk('local')->delete('public/testimonials/' . $testimonial->image);
            Storage::disk('local')->delete('public/testimonials/thumbnail/' . $testimonial->image);
        }
        $testimonial->delete();
        session()->flash('success', __('admin.deleted_successfully'));
        return redirect()->route('testimonials.index');
    }
}
