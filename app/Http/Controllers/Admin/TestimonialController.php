<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $v = $request->validate([
            'name'     => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'company'  => 'nullable|string|max:255',
            'content'  => 'required|string',
            'rating'   => 'required|integer|min:1|max:5',
        ]);
        $v['is_active'] = $request->has('is_active');
        if ($request->hasFile('avatar')) {
            $v['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }
        Testimonial::create($v);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $v = $request->validate([
            'name'     => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'company'  => 'nullable|string|max:255',
            'content'  => 'required|string',
            'rating'   => 'required|integer|min:1|max:5',
        ]);
        $v['is_active'] = $request->has('is_active');
        if ($request->hasFile('avatar')) {
            $v['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }
        $testimonial->update($v);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted.');
    }
}
