<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with('department')->get();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('employees.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'dob' => 'required|date',
            'dept_id' => 'required',
            'status' => 'required',
        ]);

        Employee::create($request->all());
        return redirect()->route('employees.index')
            ->with('success', 'Data karyawan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::with('department')->findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('employees.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit data');
        }
        
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        return view('employees.edit', compact('employee', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('employees.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit data');
        }
        
        $request->validate([
            'firstname' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'dob' => 'required|date',
            'dept_id' => 'required',
            'status' => 'required',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($request->all());
        
        return redirect()->route('employees.index')
            ->with('success', 'Data karyawan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('employees.index')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus data');
        }
        
        $employee = Employee::findOrFail($id);
        $employee->delete();
        
        return redirect()->route('employees.index')
            ->with('success', 'Data karyawan berhasil dihapus');
    }
    
    public function reportList()
    {
        $employees = Employee::with('department')->get();
        return view('reports.employee_list', compact('employees'));
    }
    
    public function reportSummaryStatus()
    {
        $statusSummary = [
            'Contract' => Employee::where('status', 'cont')->count(),
            'Employee' => Employee::where('status', 'emp')->count(),
            'Not Active' => Employee::where('status', 'not_act')->count(),
        ];
        
        return view('reports.status_summary', compact('statusSummary'));
    }
    
    public function reportStatusByDepartment()
    {
        $departments = Department::all();
        $statusByDept = [];
        
        foreach ($departments as $dept) {
            $statusByDept[$dept->id] = [
                'name' => $dept->name,
                'contract' => Employee::where('dept_id', $dept->id)->where('status', 'cont')->count(),
                'employee' => Employee::where('dept_id', $dept->id)->where('status', 'emp')->count(),
                'not_active' => Employee::where('dept_id', $dept->id)->where('status', 'not_act')->count(),
            ];
            
            $statusByDept[$dept->id]['total'] = 
                $statusByDept[$dept->id]['contract'] + 
                $statusByDept[$dept->id]['employee'] + 
                $statusByDept[$dept->id]['not_active'];
        }
        
        return view('reports.status_by_department', compact('statusByDept'));
    }
}
