<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Hàm lấy danh sách người dùng
    public function index()
    {
        $users = User::all(); // Lấy tất cả người dùng
        return response()->json($users); // Trả về dữ liệu dưới dạng JSON
    }

    // Hàm tạo người dùng mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Tạo người dùng mới
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'usertype' => $request->input('usertype', 'user') // Default là 'user'
        ]);

        return response()->json($user, 201); // Trả về người dùng đã tạo
    }

    // Hàm lấy thông tin người dùng theo ID
    public function show($id)
    {
        $user = User::findOrFail($id); // Tìm người dùng theo ID

        return response()->json($user); // Trả về dữ liệu người dùng
    }

    // Hàm cập nhật thông tin người dùng
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id); // Tìm người dùng theo ID

        // Validate dữ liệu
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        // Cập nhật thông tin người dùng
        if ($request->has('name')) {
            $user->name = $validated['name'];
        }
        if ($request->has('email')) {
            $user->email = $validated['email'];
        }
        if ($request->has('password')) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save(); // Lưu thay đổi

        return response()->json($user); // Trả về thông tin người dùng đã cập nhật
    }

    // Hàm xóa người dùng
    public function destroy($id)
    {
        $user = User::findOrFail($id); // Tìm người dùng theo ID
        $user->delete(); // Xóa người dùng

        return response()->json(['message' => 'User deleted successfully']); // Trả về thông báo
    }
}
