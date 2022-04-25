<x-layout>
   
    <div class="container-fluid  custom-container-style">
        <div class="row ">
            <div class="col-12 col-md-6 offset-md-3">
                <h3 class="text-center mt-5">Challenge!</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 offset-md-5 mt-5 p-2">
                <form method="POST" action="{{route('newEmployee')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 d-flex flex-column">
                        <label for="exampleInputEmail1" class="form-label">
                            Firstname
                        </label>
                        <input type="text" name="first_name" class="form-style mt-2">
                    </div>
                    
                    <div class="mb-3 d-flex flex-column">
                        <label for="exampleInputEmail1" class="form-label">
                            Lastname
                        </label>
                        <input type="text" name="last_name" class="form-style mt-2">
                    </div>
                    
                    <div class="mt-2">
                        <button type="submit" class="btn btn-custom mt-2 btn-success">Submit</button>
                    </div>
                </form>
            </div>
            @foreach ($employees as $employee)
            <div class="col-12 col-md-6 col-lg-4 mt-3 d-flex justify-content-center">
                <div class="card m-2 shadow ">
                    <div class="card-body">
                        <div>
                            <h4 class="card-title mx-3 large text-capitalize">{{$employee->first_name}} {{$employee->last_name}}</h4>
                        </div>
                        
                    </div>
                </div>
            </div>
            @endforeach
            
            <table id="table_id" class="display shadow mt-5">
                <thead>
                    <tr>
                        <th>Dipendente</th>
                        <th>Ingresso</th>
                        <th>Uscita</th>
                        <th>Durata</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($uniqueUserStamp as $value)
                        <tr>
                            <td>{{($value->first_name)}}, {{$value->last_name}} </td>
                    
                                @foreach ($employeesEnter as $employeeEnter)
                                    @if ($value->id == $employeeEnter->employee->id)
                                            
                                        <td>{{$employeeEnter->dataora}}</td>     
                                    @endif
                                @endforeach

                                @foreach ($employeesExit as $employeeExit)                                
                                    @if ($value->id == $employeeExit->employee->id)
                                            
                                        <td>{{($employeeExit->dataora)}}</td>

                                    @endif
                                @endforeach

                        </tr>
                    @endforeach 
                    
                </tbody>
            </table>

            <table class="display shadow mt-5">
                <thead>
                    <tr>
                        <th>December 2020</th>
                        <th>01 mar</th>
                        <th>02 mer</th>
                        <th>03 gio</th>
                        <th>04 ven</th>
                        <th>tot</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($uniqueUserStamp as $value)
                        <tr>
                            <td>{{($value->first_name)}}, {{$value->last_name}} </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
   
</x-layout>
