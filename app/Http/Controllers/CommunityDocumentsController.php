<?php

namespace App\Http\Controllers;

use App\Models\CommunityDocument;
use Illuminate\Http\Request;

class CommunityDocumentsController extends Controller
{
    // Lấy danh sách tài liệu cộng đồng
    // Lấy danh sách tài liệu cộng đồng với khả năng tìm kiếm
public function index(Request $request)
{
    $query = CommunityDocument::query(); // Khởi tạo query builder

    // Tìm kiếm theo tiêu đề (title) nếu có
    if ($request->has('title') && !empty($request->title)) {
        $query->where('title', 'like', '%' . $request->title . '%');
    }

    // Tìm kiếm theo trạng thái (status) nếu có
    if ($request->has('status') && !empty($request->status)) {
        $query->where('status', $request->status);
    }

    // Thực hiện truy vấn và lấy kết quả
    $documents = $query->get();

    return response()->json([
        'success' => true,
        'data' => $documents
    ], 200);
}


    // Tạo mới tài liệu
    public function store(Request $request)
    {
        $request->validate([
            'mentor_id' => 'nullable|exists:mentor_info,id',
            'mentee_id' => 'nullable|exists:mentee_info,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $document = CommunityDocument::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $document,
            'message' => 'Tài liệu đã được tạo thành công.'
        ], 201);
    }

    // Lấy chi tiết một tài liệu
    public function show(CommunityDocument $document)
{
    // Truy vấn thông tin tài liệu cộng đồng, bao gồm cả tên người dùng
    $document->load('mentor', 'mentee'); // Nạp dữ liệu mentor và mentee

    return response()->json([
        'success' => true,
        'data' => $document,
        'user_name' => $document->user_name, // Tên người dùng của mentor hoặc mentee
    ], 200);
}

    // Cập nhật thông tin tài liệu
    public function update(Request $request, CommunityDocument $document)
    {
        $request->validate([
            'mentor_id' => 'nullable|exists:mentor_info,id',
            'mentee_id' => 'nullable|exists:mentee_info,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $document->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $document,
            'message' => 'Tài liệu đã được cập nhật thành công.'
        ], 200);
    }

    // Xóa tài liệu
    public function destroy(CommunityDocument $document)
    {
        $document->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tài liệu đã được xóa thành công.'
        ], 200);
    }
}
