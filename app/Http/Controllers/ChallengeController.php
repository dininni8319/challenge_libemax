<?php

namespace App\Http\Controllers;

use App\Models\Stamp;
use App\Models\Employee;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index(){
        // date("H:i",strtotime(substr($employeeExit->dataora, -8))) 
        
        $employees = Employee::all();
        $employeesEnter = Stamp::where('verso','E')->get();
        $employeesExit = Stamp::where('verso', 'U')->get();

        function sliceMin($time){
            foreach ($time as $key => $value) {
              intval(substr($value->dataora, -2,8)); 
            }
        }
        function sliceHours($time){
            foreach ($time as $key => $value) {
              intval(substr($value->dataora, 10,3)); 
            }
        }
        $diffHours = (24 + (sliceHours($employeesEnter) - sliceHours($employeesExit)));
        $diffMin =  sliceMin($employeesEnter) - sliceMin($employeesExit);
        
        if (sliceMin($employeesEnter) < sliceMin($employeesExit)){
            $diffHours = $diffHours - 1 && (60 + (sliceMin($employeesEnter) - sliceMin($employeesExit))); 
        } else {
            $diffMin;
        }
        $stamps = Stamp::all();
        // dd($employeeExit, 'test');
        return view('home', compact('employees', 'employeesEnter', 'employeesExit', 'stamps'));
    }

    public function createEmployee(Request $request){
        $employee = Employee::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
        ]);

        
        return redirect(route('homepage', compact('employee')));

    }
}
