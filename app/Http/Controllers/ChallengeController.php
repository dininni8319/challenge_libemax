<?php

namespace App\Http\Controllers;

use App\Models\Stamp;
use App\Models\Employee;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index(){
        
        $employees = Employee::all();
        $employeesEnter = Stamp::where('verso','E')->orderBy('employee_id', 'ASC')->get();
        $employeesExit = Stamp::where('verso', 'U')->orderBy('employee_id', 'ASC')->get();

        function sliceMin($times){
            $arr = [];
            foreach ($times as $time) {
              array_push($arr, intval(substr($time->dataora, -5,2)));
               
            }
            // dd($arr);
            return $arr;
        }

        function sliceHours($times){
        
            $arr = [];
            foreach ($times as $time) {
            array_push($arr,intval(substr($time->dataora, 10,3)));
            }
            return $arr;
        }

        function sliceDate($times){
            $arr = [];
            foreach ($times as $time) {
                array_push($arr, intval(substr($time->dataora, 2,4))); 
            }
            return $arr;
        }
 
        function diffHours($diffH1, $diffH2){
            $diffHours = [];
            for ($i= 0; $i < sizeof($diffH1); $i++) { 
                array_push($diffHours, (24 - $diffH1[$i]) + $diffH2[$i]);
            }
            return $diffHours;
        }

        function diffMin($diffM1, $diffM2){
            $diffArrMin = [];
            for ($i= 0; $i < sizeof($diffM1); $i++) {

                array_push($diffArrMin,  $diffM1[$i] + $diffM2[$i]);
            }
            return $diffArrMin;
        }

        $diffTimehour = diffHours(sliceHours($employeesEnter),sliceHours($employeesExit));
        
        $diffM = diffMin(sliceMin($employeesEnter), sliceMin($employeesExit));
        
        $stamps = Stamp::all();

        return view('home', compact('employees', 'employeesEnter', 'employeesExit', 'stamps', 'diffTimehour', 'diffM'));
    }

    public function createEmployee(Request $request){
        $employee = Employee::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
        ]);

        return redirect(route('homepage', compact('employee')));

    }
}
