<?php

namespace App\Http\Controllers;

use App\Models\Stamp;
use Mockery\Undefined;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChallengeController extends Controller
{
    public function index(){
        
        $employees = Employee::all();
        $employeesEnter = Stamp::where('verso','E')->orderBy('employee_id', 'DESC')->get();
        $employeesExit = Stamp::where('verso', 'U')->orderBy('employee_id', 'DESC')->get();
        $stamps = Stamp::orderBy('employee_id', 'asc')->get();

        // date ---> 2, 4
        //helper function to find minutes, hours, or dates
        function sliceTime($times, $x,$y){
            $arr = [];
            foreach ($times as $time) {
                array_push($arr, intval(substr($time->dataora, $x,$y))); 
            }
            return $arr;
        }

        // helper function to calc the differece between to minutes and hours
        function diffTime($diffTime1, $diffTime2, $h24){

            $diffArr = [];

            for ($i= 0; $i < sizeof($diffTime1); $i++) {
                if ($h24) {
                    array_push($diffArr, (24 - ($diffTime1[$i]) + $diffTime2[$i]));  
                } else {
                    array_push($diffArr,  $diffTime1[$i] + $diffTime2[$i]);
                }
            }
            return $diffArr;
        }

        $diffTimeHours = diffTime(sliceTime($employeesEnter, 10, 3),sliceTime($employeesExit, 10, 3), 24);
        
        $diffTimeMinutes = diffTime(sliceTime($employeesEnter, -5, 2), sliceTime($employeesExit, -5, 2), 0);
        
        
        for ($i = 0; $i < sizeof($diffTimeHours); $i++) { 
                $collection = collect();
                $stringTimeH = $diffTimeHours[$i] < 10 ? '0' . strval($diffTimeHours[$i])  . ':' : strval($diffTimeHours[$i])  . ':';
                $stringTimeM =  $diffTimeMinutes[$i] < 10 ? '0' . strval($diffTimeMinutes[$i]) : strval($diffTimeMinutes[$i]);
                $stringTime = $stringTimeH . $stringTimeM;
                $merged = $collection->merge([$stringTime => ($i + 1)]);
                $employeeId = $employeesEnter[$i]['employee_id'];
                
                //save the total time into the DB
                foreach ($merged as $key => $value) {    
                    Stamp::where('employee_id', $value)->update(['total_time' => $key]);
                }
        }
        //Here we are looking for unique user in the stamp model and put them into an array.
        $uniqueUserStamp = array();

        foreach ($stamps as $stamp) {
            array_push($uniqueUserStamp, $stamp->employee);
        }

        $uniqueUserStamp = array_unique($uniqueUserStamp);
        
        return view('home', compact('employees', 'employeesEnter', 'employeesExit', 'stamps', 'diffTimeHours', 'diffTimeMinutes','uniqueUserStamp'));
    }

    public function createEmployee(Request $request){
        $employee = Employee::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
        ]);

        return redirect(route('homepage', compact('employee')));

    }
}
