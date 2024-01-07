<?php

namespace App\Http\Controllers\Api;

use App\Models\email;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    public function index()
    {
        $emails = email::all();
        
        if($emails->count() > 0){
        $data = [
            'status' => 200,
            'emails' => $emails,
        ];

        return response()->json([
            'status' => 200,
            'emails' => $emails,
        ],200);
    }else{
        return response()->json([
            'status' => 404,
            'status_message' => 'No records are found',
        ],404);
    };
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ContactPersonName' => 'required|string|max:200',
            'Email' => 'required|email|max:200',
            'CompanyName' => 'required|string|max:200',
            'PhoneNumber' => 'required|string|max:20',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
            'errors' => $validator->messages(),
            ],422);
        }else{
            $email = email::create([
                'ContactPersonName' => $request->ContactPersonName,
                'Email' => $request->Email,
                'CompanyName' => $request->CompanyName,
                'PhoneNumber' => $request->PhoneNumber,
            ]);

            if($email){

                return response()->json([
                    'status' => 200,
                    'message' => 'Contact Information is created successfully',
                ]);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong!',
                ]);
            }
        }
    }

    public function show($id)
    {
        $emails = email::find($id);

        if($emails){
            return response()->json([
                'status' => 200,
                'Email' => $emails,
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'No Contact information is found with this id'
            ],404);
        }
    }

    public function edit($id)
    {
        $emails = email::find($id);

        if($emails){
            return response()->json([
                'status' => 200,
                'Email' => $emails,
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'No Contact information is found with this id'
            ],404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'ContactPersonName' => 'required|string|max:200',
            'Email' => 'required|email|max:200',
            'CompanyName' => 'required|string|max:200',
            'PhoneNumber' => 'required|string|max:20',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
            'error' => $validator->messages(),
            ],422);
        }else{
            $email = email::find($id);

            if($email){
                $email->update([
                    'ContactPersonName' => $request->ContactPersonName,
                    'Email' => $request->Email,
                    'CompanyName' => $request->CompanyName,
                    'PhoneNumber' => $request->PhoneNumber,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Contact information is updated successfully',
                ]);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => 'There is no Contact information with this id!',
                ]);
            }
        }
    }
    
    public function destroy($id)
    {
        $email = email::find($id);
        if($email)
        {
            $email->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Contact information is deleted successfully',
            ]);
        }else{
            return response()->json([
                'status' => 500,
                'message' => 'There is no Contact information with this id!',
            ]);
        }

    }
}
