<?php

namespace App\Http\Controllers;

use App\Models\Stamp;
use App\Models\Employee;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index(){
        $employees = Employee::all();
        $employeeEnter = Stamp::where('verso','E')->get('dataora');
        $employeeExit = Stamp::where('verso','U')->get('dataora');
        $stamps = Stamp::all();
        // dd($employeeExit, 'test');
        $stamps = Stamp::all();
        return view('home', compact('employees', 'employeeEnter', 'employeeExit', 'stamps'));
    }

    public function createEmployee(Request $request){
        $employee = Employee::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
        ]);

        
        return redirect(route('homepage', compact('employee')));

    }
}
