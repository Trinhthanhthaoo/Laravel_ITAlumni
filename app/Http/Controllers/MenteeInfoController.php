<?php

namespace App\Http\Controllers;

use App\Models\MenteeInfo;
use Illuminate\Http\Request;

class MenteeInfoController extends Controller
{
   public function index()
   {
    $menteeInfos = MenteeInfo::all();
    return response() -> json($menteeInfos);
   }

   public function create() 
   {
    return view('mentee.create');
   }

     // Tạo mới mentee
     public function store(Request $request)
     {
         $request->validate([
             'user_id' => 'required|exists:users,id',
             'gpa' => 'nullable|numeric|min:0|max:4',
             'achievements' => 'nullable|string',
             'goals' => 'nullable|string',
         ]);
 
         $mentee = MenteeInfo::create($request->all());
 
         return response()->json(['message' => 'Mentee created successfully', 'data' => $mentee], 201);
     }

     // Lấy chi tiết một mentee
    public function show(MenteeInfo $mentee)
    {
        $mentee->load('user');
        return response()->json($mentee, 200);
    }

    // Cập nhật thông tin mentee
    public function update(Request $request, MenteeInfo $mentee)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'gpa' => 'nullable|numeric|min:0|max:4',
            'achievements' => 'nullable|string',
            'goals' => 'nullable|string',
        ]);

        $mentee->update($request->all());

        return response()->json(['message' => 'Mentee updated successfully', 'data' => $mentee], 200);
    }
     // Xóa mentee
     public function destroy(MenteeInfo $mentee)
     {
         $mentee->delete();
 
         return response()->json(['message' => 'Mentee deleted successfully'], 200);
     }
}
