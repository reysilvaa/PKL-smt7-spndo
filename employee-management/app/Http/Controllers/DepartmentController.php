<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['index', 'show']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('departments.index')
                ->with('error', 'Anda tidak memiliki izin untuk menambahkan departemen');
        }
        
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|unique:departments',
        ]);

        Department::create($request->all());
        return redirect()->route('departments.index')
            ->with('success', 'Departemen berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::findOrFail($id);
        $employees = $department->employees;
        return view('departments.show', compact('department', 'employees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $department = Department::findOrFail($id);
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:100|unique:departments,name,' . $id,
        ]);

        $department = Department::findOrFail($id);
        $department->update($request->all());
        
        return redirect()->route('departments.index')
            ->with('success', 'Departemen berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::findOrFail($id);
        
        // Check if department is being used by employees
        if ($department->employees()->count() > 0) {
            return redirect()->route('departments.index')
                ->with('error', 'Departemen tidak dapat dihapus karena masih digunakan oleh karyawan');
        }
        
        $department->delete();
        
        return redirect()->route('departments.index')
            ->with('success', 'Departemen berhasil dihapus');
    }
}
