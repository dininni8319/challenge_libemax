<?php

namespace App\Http\Controllers;

use App\Models\Stamp;
use App\Models\Employee;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index(){
        
        $employees = Employee::all();
        $employeesEnter = Stamp::where('verso','E')->get();
        $employeesExit = Stamp::where('verso', 'U')->get();
  
        function sliceMin($time){
            foreach ($time as $value) {
              intval(substr($value->dataora, -2,8)); 
            }
        }

        function sliceHours($time){
            foreach ($time as $value) {
              intval(substr($value->dataora, 10,3)); 
            }
        }

        function sliceDate($time){
            foreach ($time as $value) {
              substr($value->dataora, 2,4); 
            }
        }
        
        $date = sliceDate($employeesExit);

        $diffHours = (24 + (sliceHours($employeesEnter) - sliceHours($employeesExit)));
        $diffMin = sliceMin($employeesEnter) - sliceMin($employeesExit);
        $diff = sliceMin($employeesEnter) < sliceMin($employeesExit) ? $diffHours - 1 && (60 + (sliceMin($employeesEnter) - sliceMin($employeesExit))) : $diffMin;
        $diffTime = "$diffHours:$diff";
        $array2 = [];
        array_push($array2, $diffTime);
        
        $stamps = Stamp::all();
     

        return view('home', compact('employees', 'employeesEnter', 'employeesExit', 'stamps', 'array2'));
    }

    public function createEmployee(Request $request){
        $employee = Employee::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
        ]);

        return redirect(route('homepage', compact('employee')));

    }
}
