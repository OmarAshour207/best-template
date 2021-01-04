<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{

    public function index()
    {
        $services = Service::paginate(10);
        return view('dashboard.services.index', compact('services'));
    }

    public function create()
    {
        return view('dashboard.services.create');
    }

    public function store(Request $request)
    {
        $attr = [];
        foreach (config('locales.languages') as $key => $value) {
            $attr['title.' . $key] = 'required|string';
            $attr['description.' . $key] = 'required|string';
            $attr['meta_tag.' . $key] = 'sometimes|nullable|string';
        }

        $data = $request->validate($attr);
        $data['image'] = $request->image;

        Service::create($data);
        session()->flash('success', trans('admin.added_successfully'));
        return redirect()->route('services.index');
    }

    public function edit($service)
    {
        $service = Service::where('slug->' . app()->getLocale(), $service)->first();
        return view('dashboard.services.edit', compact('service'));
    }

    public function update(Request $request, $service)
    {
        $attr = [];
        foreach (config('locales.languages') as $key => $value) {
            $attr['title.' . $key] = 'required|string';
            $attr['description.' . $key] = 'required|string';
            $attr['meta_tag.' . $key] = 'sometimes|nullable|string';
        }

        $data = $request->validate($attr);
        $data['image'] = $request->image;

        $service = Service::where('slug->' . app()->getLocale(), $service)->first();

        $service->update($data);
        session()->flash('success', trans('admin.added_successfully'));
        return redirect()->route('services.index');
    }

    public function destroy($service)
    {
        $service = Service::where('slug->' . app()->getLocale(), $service)->first();

        if ($service->image) {
            Storage::disk('local')->delete('public/services/'. $service->image);
            Storage::disk('local')->delete('public/services/thumbnail/'. $service->image);
        }
        $service->delete();
        session()->flash('success', trans('admin.deleted_successfully'));
        return redirect()->route('services.index');
    }

}
