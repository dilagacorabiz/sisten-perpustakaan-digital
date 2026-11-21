<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::with('roles')->paginate(10),
            'roles' => Role::all(),
        ]);
    }

    public function updateRole(Request $request, User $user)
    {
        $data = $request->validate(['role' => ['required', 'exists:roles,name']]);
        $user->syncRoles($data['role']);
        return back()->with('status', 'Role berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        abort_if($user->id === auth()->id(), 403, 'Tidak dapat menghapus akun sendiri.');
        $user->delete();
        return back()->with('status', 'Pengguna dihapus.');
    }
}