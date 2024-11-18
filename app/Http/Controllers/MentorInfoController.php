<?php

namespace App\Http\Controllers;

use App\Models\MentorInfo;
use Illuminate\Http\Request;

class MentorInfoController extends Controller
{
    // Hiển thị tất cả mentor info
    // public function index()
    // {
    //     $mentorInfos = MentorInfo::all(); // Lấy tất cả dữ liệu MentorInfo

    //     return response()->json([
    //         'success' => true,
    //         'data' => $mentorInfos,
    //     ]); // Trả về dữ liệu JSON
    // }
    public function index(Request $request)
    {
        $query = MentorInfo::query(); // Khởi tạo query builder

        // Tìm kiếm theo tên nếu có
        if ($request->has('name') && !empty($request->name)) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Tìm kiếm theo chuyên môn (expertise) nếu có
        if ($request->has('expertise') && !empty($request->expertise)) {
            $query->where('expertise', 'like', '%' . $request->expertise . '%');
        }

        // Tìm kiếm theo tổ chức (organization) nếu có
        if ($request->has('organization') && !empty($request->organization)) {
            $query->where('organization', 'like', '%' . $request->organization . '%');
        }

        // Tìm kiếm theo nguồn giới thiệu (referral_source) nếu có
        if ($request->has('referral_source') && !empty($request->referral_source)) {
            $query->where('referral_source', 'like', '%' . $request->referral_source . '%');
        }

        // Thực hiện truy vấn và lấy kết quả
        $mentorInfos = $query->get();

        return response()->json([
            'success' => true,
            'data' => $mentorInfos,
        ]);
    }

    // Hiển thị form tạo mới mentor info
    public function create()
    {
        return view('mentor-info.create');
    }

    // Lưu mentor info mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'expertise' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:100',
            'referral_source' => 'nullable|string|max:255',
            'suggestions_questions' => 'nullable|string',
            'achievements' => 'nullable|string',
            'status' => 'nullable|string|in:PENDING,APPROVED,REJECTED', // Validate status
        ]);
    
        $data = $request->all();
    
        // Xử lý upload file
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('mentor_images', 'public');
            $data['image'] = $imagePath;
        }
    
        $mentorInfo = MentorInfo::create($data);
    
        return response()->json([
            'message' => 'Thông tin mentor đã được tạo thành công.',
            'data' => $mentorInfo,
        ], 201);
    }
    

    // Hiển thị chi tiết mentor info
    public function show(MentorInfo $mentorInfo)
    {
        return response()->json([
            'success' => true,
            'data' => $mentorInfo,
        ]);
    }

    // Cập nhật mentor info
    public function update(Request $request, MentorInfo $mentorInfo)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate hình ảnh
        'expertise' => 'nullable|string|max:255',
        'organization' => 'nullable|string|max:100',
        'referral_source' => 'nullable|string|max:255',
        'suggestions_questions' => 'nullable|string',
        'achievements' => 'nullable|string',
    ]);

    $data = $request->all();

    // Xử lý upload file nếu có
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('mentor_images', 'public');
        $data['image'] = $imagePath;
    }

    $mentorInfo->update($data);

    return response()->json([
        'message' => 'Thông tin mentor đã được cập nhật thành công.',
        'data' => $mentorInfo,
    ]);
}


    // Xóa mentor info
    public function destroy(MentorInfo $mentorInfo)
    {
        $mentorInfo->delete();

        return response()->json([
            'message' => 'Thông tin mentor đã được xóa thành công.',
        ]);
    }
   

}
