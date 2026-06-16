<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::latest()->paginate(15);
        return view('admin.staff.index', compact('staffs'));
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'title'    => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('lecturers', 'public');
        }

        Staff::create($validated);

        return redirect()->route('admin.staff.index')
            ->with('success', 'Data staf/dosen berhasil ditambahkan!');
    }

    public function edit(Staff $staff)
    {
        return view('admin.staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'title'    => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($staff->photo && Storage::disk('public')->exists($staff->photo)) {
                Storage::disk('public')->delete($staff->photo);
            }
            $validated['photo'] = $request->file('photo')->store('lecturers', 'public');
        }

        $staff->update($validated);

        return redirect()->route('admin.staff.index')
            ->with('success', 'Data staf/dosen berhasil diperbarui!');
    }

    public function destroy(Staff $staff)
    {
        if ($staff->photo && Storage::disk('public')->exists($staff->photo)) {
            Storage::disk('public')->delete($staff->photo);
        }
        $staff->delete();

        return redirect()->route('admin.staff.index')
            ->with('success', 'Data staf/dosen berhasil dihapus!');
    }
}
