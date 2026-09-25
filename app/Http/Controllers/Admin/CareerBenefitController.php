<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareerBenefit;
use Illuminate\Http\Request;

class CareerBenefitController extends Controller
{
    public function index()
    {
        $benefits = CareerBenefit::orderBy('sort_order')->get();
        return view('admin.pages.career-benefits.index', compact('benefits'));
    }

    public function create()
    {
        return view('admin.pages.career-benefits.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'icon' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:30',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);
        CareerBenefit::create($data);
        return redirect()->route('admin.career-benefits.index')->with('success', 'Benefit added!');
    }

    public function edit(CareerBenefit $careerBenefit)
    {
        return view('admin.pages.career-benefits.form', ['benefit' => $careerBenefit]);
    }

    public function update(Request $request, CareerBenefit $careerBenefit)
    {
        $data = $request->validate([
            'icon' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:30',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $careerBenefit->update($data);
        return redirect()->route('admin.career-benefits.index')->with('success', 'Benefit updated!');
    }

    public function destroy(CareerBenefit $careerBenefit)
    {
        $careerBenefit->delete();
        return redirect()->route('admin.career-benefits.index')->with('success', 'Benefit deleted!');
    }
}
