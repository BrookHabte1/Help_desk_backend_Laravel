<?php

namespace App\Http\Controllers\Api;

use App\Models\faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = faq::all();
        
        if($faqs->count() > 0){
        $data = [
            'status' => 200,
            'faqs' => $faqs,
        ];

        return response()->json([
            'status' => 200,
            'faqs' => $faqs,
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
            'title' => 'required|string|max:500',
            'discription' => 'required|string|max:20000',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
            'errors' => $validator->messages(),
            ],422);
        }else{
            $faq = faq::create([
                'title' => $request->title,
                'discription' => $request->discription,
            ]);

            if($faq){

                return response()->json([
                    'status' => 200,
                    'message' => 'FAQ is created successfully',
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
        $faqs = faq::find($id);

        if($faqs){
            return response()->json([
                'status' => 200,
                'Faq' => $faqs,
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'No FAQ is found with this id'
            ],404);
        }
    }

    public function edit($id)
    {
        $faqs = faq::find($id);

        if($faqs){
            return response()->json([
                'status' => 200,
                'Faq' => $faqs,
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'No FAQ is found with this id'
            ],404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:500',
            'discription' => 'required|string|max:20000',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
            'error' => $validator->messages(),
            ],422);
        }else{
            $faq = faq::find($id);

            if($faq){
                $faq->update([
                    'title' => $request->title,
                    'discription' => $request->discription,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'FAQ is updated successfully',
                ]);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => 'There is no FAQ with this id!',
                ]);
            }
        }
    }
    
    public function destroy($id)
    {
        $faq = faq::find($id);
        if($faq)
        {
            $faq->delete();
            return response()->json([
                'status' => 200,
                'message' => 'FAQ is deleted successfully',
            ]);
        }else{
            return response()->json([
                'status' => 500,
                'message' => 'There is no FAQ with this id!',
            ]);
        }

    }
}
