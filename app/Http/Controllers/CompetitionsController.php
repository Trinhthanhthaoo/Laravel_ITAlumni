<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;

class CompetitionsController extends Controller
{
    // Hiển thị danh sách các cuộc thi
    // Hiển thị danh sách các cuộc thi
 public function index()
{
    $competitions = Competition::all();
    return response()->json($competitions);
}


    // Hiển thị form tạo mới cuộc thi
    public function create()
    {
        return view('competitions.create');
    }

    // Lưu cuộc thi mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        $request->validate([
            'mentor_id' => 'required|exists:mentor_info,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Competition::create($request->all());

        return response()->json(['message' => 'Create form endpoint reached']);    }

    // Hiển thị chi tiết một cuộc thi
    public function show(Competition $competition)
    {
        return response()->json($competition);
    }

    // Hiển thị form chỉnh sửa cuộc thi
    public function edit(Competition $competition)
    {
        return view('competitions.edit', compact('competition'));
    }

    // Cập nhật thông tin cuộc thi trong cơ sở dữ liệu
    public function update(Request $request, Competition $competition)
    {
        $request->validate([
            'mentor_id' => 'required|exists:mentor_info,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $competition->update($request->all());

        return redirect()->route('competitions.index')->with('success', 'Cuộc thi đã được cập nhật thành công.');
    }

    // Xóa cuộc thi
    public function destroy(Competition $competition)
    {
        $competition->delete();

        return redirect()->route('competitions.index')->with('success', 'Cuộc thi đã được xóa thành công.');
    }
}
