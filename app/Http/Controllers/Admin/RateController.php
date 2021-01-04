<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function index()
    {
        $rates = Rate::latest()->paginate(10);
        return view('dashboard.rates.index', compact('rates'));
    }

    public function destroy($id)
    {
        $rate = Rate::findOrFail($id);
        $rate->delete();
        session()->flash('success', __('admin.deleted_successfully'));
        return redirect()->back();
    }
}
