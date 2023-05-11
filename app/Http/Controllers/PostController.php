<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::all();
        return response()->json(['success'=> true, 'data'=>$post],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(),[
            'title' =>'required|max:255',
            'description' =>'required|max:2000',
            'user_id' =>'required'

        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->first()],422);
        }
        else{
            $post = Post::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => $request->user_id
            ]);
            return response()->json(['success'=>true,'data'=>$post],200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = User::find($id)->post;
        return response()->json(['success'=>true,'data'=>$post],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator= validator::make($request->all(),[
            'title' =>'required|max:255',
            'description' =>'required|max:2000',
            // 'user_id' =>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>false,'message'=>$validator->errors()->first()],422);
        }
        else{
            $post = Post::find($id);
            $post->update([
                'title' => $request->title,
                'description' => $request->description,
                // 'user_id' => $request->user_id
            ]);
            return response()->json(['success'=>true,'data'=>$post],200);
            $post ->update([
                'title' => $request->title,
                'description' => $request->description,
                // 'user_id' => $request->user_id
            ])->where('id',$id);
            return response()->json(['success'=>true,'data'=>$post],200);
        }
       
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return response()->json(['success'=>true,'data'=>$post],200);
    }
}
