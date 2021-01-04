<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::paginate(10);
        return view('dashboard.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('dashboard.projects.create');
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

        Project::create($data);
        session()->flash('success', trans('admin.added_successfully'));
        return redirect()->route('projects.index');
    }

    public function edit($project)
    {
        $project = Project::where('slug->' . app()->getLocale(), $project)->first();
        return view('dashboard.projects.edit', compact('project'));
    }

    public function update(Request $request, $project)
    {
        $attr = [];
        foreach (config('locales.languages') as $key => $value) {
            $attr['title.' . $key] = 'required|string';
            $attr['description.' . $key] = 'required|string';
            $attr['meta_tag.' . $key] = 'sometimes|nullable|string';
        }

        $data = $request->validate($attr);
        $data['image'] = $request->image;

        $project = Project::where('slug->' . app()->getLocale(), $project)->first();

        $project->update($data);
        session()->flash('success', trans('admin.added_successfully'));
        return redirect()->route('projects.index');
    }

    public function destroy($project)
    {
        $project = Project::where('slug->' . app()->getLocale(), $project)->first();

        if ($project->image) {
            Storage::disk('local')->delete('public/projects/'. $project->image);
            Storage::disk('local')->delete('public/projects/thumbnail/'. $project->image);
        }
        $project->delete();
        session()->flash('success', trans('admin.deleted_successfully'));
        return redirect()->route('projects.index');
    }
}
