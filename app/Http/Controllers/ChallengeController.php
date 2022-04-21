<?php

namespace App\Http\Controllers;

use App\Models\Stamp;
use App\Models\Employee;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index(){
        $employees = Employee::all();
        $stamps = Stamp::all();
        return view('home', compact('employees', 'stamps'));
    }

    public function createEmployee(Request $request){
        $employee = Employee::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
        ]);

        
        return redirect(route('homepage', compact('employee')));

    }
}
