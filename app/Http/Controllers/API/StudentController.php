<?php

namespace App\Http\Controllers\API;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    //fetch data(sall records)
    public  function index(){
       $students = Student::all();
       if($students->count() > 0){
        $data = [
            'status'=>200,
            'students'=>$students
           ];
           return response()->json($data, 200);

       }else{
        $data = [
            'status'=>404,
            'message'=>'no records found',
           ];
           return response()->json($data, 404);

       }

      

    }
    //store data
    public function store(Request $request){
        //validate all the input fields
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:191',
            'course'=>'required|string|max:191',
            'email'=>'required|email|max:191',
            'phone'=>'required|digits:9'
            
        ]);
        if($validator->fails()){
             return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
             ],422);
        }else{
            
            $student = Student::create([
                'name'=>$request->name,
                'course'=>$request->course,
                'email'=>$request->email,
                'phone'=>$request->phone

            ]);
            if($student){
                return response()->json([
                    'status'=>200,
                    'message'=>'student created successfully'

                ],200);
            }else{
                return response()->json([
                    'status'=>500,
                    'message'=>'something went wrong'

                 ],500);


            }
        }

    }
    public  function show($id){
        $student = Student::find($id);
        if($student){
            return response()->json([
                'status'=>200,
                'student'=>$student
            ],200);

        }else{
            return response()->json([
                'status'=>404,
                'mesage'=>'no such student found'
            ],404);
        }

    }
    public function edit($id){
        $student = Student::find($id);
        if($student){
            return response()->json([
                'status'=>200,
                'student'=>$student
            ],200);

        }else{
            return response()->json([
                'status'=>404,
                'mesage'=>'no such student found'
            ],404);
        }

    }
    public function update(Request $request, int $id){
        //validate all the input fields
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:191',
            'course'=>'required|string|max:191',
            'email'=>'required|email|max:191',
            'phone'=>'required|digits:9'
            
        ]);
        if($validator->fails()){
             return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
             ],422);
        }else{
            $student = Student::find($id);
           
            if($student){
                $student ->update([
                    'name'=>$request->name,
                    'course'=>$request->course,
                    'email'=>$request->email,
                    'phone'=>$request->phone
    
                ]); 
                return response()->json([
                    'status'=>200,
                    'message'=>'student updated successfully'

                ],200);
            }else{
                return response()->json([
                    'status'=>404,
                    'message'=>'no such student found'

                 ],404);


            }
        }


    }
    public function destroy($id){
        $student = Student::find($id);
        if($student){
            $student->delete();
            return response()->json([
                'status'=>200,
                'mesasge'=>'student deleted successfully'
            ],200);

        }else{
            return response()->json([
                'status'=>404,
                'message'=>'no such student found'
            ],404);
        }


    }
}
