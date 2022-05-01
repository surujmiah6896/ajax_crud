<?php

namespace App\Http\Controllers;

use App\Models\Ajaxcrud;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    // ================info students===============
    public function getalldata()
    {
        $data = Ajaxcrud::all();
        return response()->json($data);
    }

    // ================get info students===============
    public function studentinfo($id = null)
    {
        if ($id == '') {
            $students = Ajaxcrud::get();
            return response()->json(['students' => $students], 200);
        } else {
            $students = Ajaxcrud::find($id);
            return response()->json(['students' => $students], 200); //200 means Successfully
        }
    }


    // ================Add students===============
    public function addstudent(Request $request)
    {
        if ($request->ismethod('POST')) {
            $data = $request->all();

            $rules = [
                'name' => 'required',
                'depertment' => 'required',
                'semester' => 'required',
            ];
            $coustomMessage = [
                'name.required' => 'Name is required',
                'depertment.required' => 'Depertment is required',
                'semester.required' => 'Semester is required',
            ];
            $validator = Validator::make($data, $rules, $coustomMessage);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422); //422 validation error
            }

            $student = new Ajaxcrud();
            $student->name = $data['name'];
            $student->depertment = $data['depertment'];
            $student->semester = $data['semester'];
            $student->save();

            $message = 'Student Successfully Added!';
            return response()->json(['message' => $message], 201); //201 means created
        }
    }


    // =================add multiple student==============
    public function addmultiplestudent(Request $request)
    {
        if ($request->ismethod('POST')) {
            $data = $request->all();

            $rules = [
                'students.*.name' => 'required',
                'students.*.depertment' => 'required',
                'students.*.semester' => 'required',
            ];
            $coustomMessage = [
                'students.*.name.required' => 'Name is required',
                'students.*.depertment.required' => 'Depertment is required',
                'students.*.semester.required' => 'Semester is required',
            ];
            $validator = Validator::make($data, $rules, $coustomMessage);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422); //422 validation error
            }

            foreach ($data['students'] as $singlestudent) {
                $student = new Ajaxcrud();
                $student->name = $singlestudent['name'];
                $student->depertment = $singlestudent['depertment'];
                $student->semester = $singlestudent['semester'];
                $student->save();
            }

            $message = 'Student Successfully Added!';
            return response()->json(['message' => $message], 201); //201 means created
        }
    }


    // ==============put api for update student details==========
    public function updatestudentdetails(Request $request, $id)
    {
        if ($request->ismethod('PUT')) {
            $data = $request->all();

            $rules = [
                'name' => 'required',
                'depertment' => 'required',
                'semester' => 'required',
            ];
            $coustomMessage = [
                'name.required' => 'Name is required',
                'depertment.required' => 'Depertment is required',
                'semester.required' => 'Semester is required',
            ];
            $validator = Validator::make($data, $rules, $coustomMessage);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422); //422 validation error
            }

            $student = Ajaxcrud::findOrFail($id);
            $student->name = $data['name'];
            $student->depertment = $data['depertment'];
            $student->semester = $data['semester'];
            $student->save();

            $message = 'Student Successfully Updated!';
            return response()->json(['message' => $message], 202); //202 means updated
        }
    }


    // ==============patch api for update single record==========
    public function updatestudentsinglerecord(Request $request, $id)
    {
        if ($request->ismethod('PATCH')) {
            $data = $request->all();

            $rules = [
                'name' => 'required',
                // 'depertment' => 'required',
                // 'semester' => 'required',
            ];
            $coustomMessage = [
                'name.required' => 'Name is required',
                // 'depertment.required' => 'Depertment is required',
                // 'semester.required' => 'Semester is required',
            ];
            $validator = Validator::make($data, $rules, $coustomMessage);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422); //422 validation error
            }

            $student = Ajaxcrud::findOrFail($id);
            $student->name = $data['name'];
            // $student->depertment = $data['depertment'];
            // $student->semester = $data['semester'];
            $student->save();

            $message = 'Student Successfully Updated!';
            return response()->json(['message' => $message], 202); //202 means updated
        }
    }


    // =============delete api for single student============
    public function deletesinglestudent($id = null)
    {
        Ajaxcrud::findOrFail($id)->delete();
        $message = "Student Successfully Deleted!";
        return response()->json(["message" => $message], 200);
    }


    // =============delete api for single student with json============
    public function deletesinglestudentwithjson(Request $request)
    {
        if ($request->isMethod("delete")) {
            //first option for json object
            // Ajaxcrud::where('id',$request->id)->delete();
            // $message = "Student Successfully Deleted!";
            // return response()->json(["message" => $message], 200);
            //second option for json object
            $data = $request->all();
            Ajaxcrud::where('id', $data['id'])->delete();
            $message = "Student Successfully Deleted!";
            return response()->json(["message" => $message], 200);
        }
    }


    // ==========delete multiple records==========
    public function deletemultiplestudent($ids)
    {
        $id = explode(',', $ids);
        Ajaxcrud::whereIn('id', $id)->delete();
        $message = "Student Successfully Deleted!";
        return response()->json(["message" => $message], 200);
    }

    // =============delete api for single student with json ============
    // =============delete api validation with header token jwt============

    public function deletemultiplestudentwithjson(Request $request)
    {
        $header = $request->header('Authorization'); //athorization token create jwt thake
        if ($header == '') {
            $message = "Athorization is requried!";
            return response()->json(["message" => $message], 422);
        } else {
            if ($header == 'suruj.miah.api') {
                if ($request->isMethod("delete")) {
                    //first option for json object
                    // Ajaxcrud::where('id',$request->id)->delete();
                    // $message = "Student Successfully Deleted!";
                    // return response()->json(["message" => $message], 200);
                    //second option for json object
                    $data = $request->all();
                    Ajaxcrud::whereIn('id', $data['ids'])->delete();
                    $message = "Student Successfully Deleted!";
                    return response()->json(["message" => $message], 200);
                }
            } else {
                $message = "Athorization dose not match!";
                return response()->json(["message" => $message], 422);
            }
        }
    }

    // ---------register api useing passport-----------
    public function registerAPIUsingPassport(Request $request)
    {
        if ($request->ismethod('POST')) {
            $data = $request->all();

            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ];
            $coustomMessage = [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'email.email' => 'Email Must be a valid email',
                'password.required' => 'password is required',
            ];
            $validator = Validator::make($data, $rules, $coustomMessage);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422); //422 validation error
            }

            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();

            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
                $user = User::where('email',$data['email'])->first();
                $access_token = $user->createToken($data['email'])->accessToken;
                User::where('email',$data['email'])->update(['access_token'=>$access_token]);
                $message = 'User Successfully Registerd!';
                return response()->json(['message' => $message, 'access_token'=>$access_token], 201); //201 means created
            }else{
                $message = 'Opps! Something went wrong';
                return response()->json(['message' => $message],422); //422 means error
            }


        }
    }

    // ---------login api useing passport-----------
    public function loginAPIUsingPassport(Request $request)
    {
        if ($request->ismethod('POST')) {
            $data = $request->all();

            $rules = [
                'email' => 'required|email|exists:users',
                'password' => 'required',
                ];
            $coustomMessage = [
                'email.required' => 'Email is required',
                'email.email' => 'Email Must be a valid email',
                'email.exists' => 'Email dose not exists',
                'password.required' => 'password is required',
            ];
            $validator = Validator::make($data, $rules, $coustomMessage);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422); //422 validation error
            }

            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']
            ])) {
                $user = User::where('email', $data['email'])->first();
                $access_token = $user->createToken($data['email'])->accessToken;
                User::where('email', $data['email'])->update(['access_token' => $access_token]);
                $message = 'User Successfully Login';
                return response()->json(['message' => $message, 'access_token' => $access_token], 201); //201 means created
            } else {
                $message = 'Invalid Email or Password!';
                return response()->json(['message' => $message], 422); //422 means error
            }
        }
    }
}
