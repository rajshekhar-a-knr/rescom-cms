<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
    private function ensureSuperAdmin()
    {
        if (!Auth::user() || !Auth::user()->isSuperAdmin()) {
            abort(403, 'Only super admins can perform this action.');
        }
    }
    public function index() {
        $users = User::orderBy('created_at','desc')->paginate(20);
        return view('admin.pages.users.index', compact('users'));
    }
    public function create() {
        $this->ensureSuperAdmin();
        $permissions = \App\Models\Permission::orderBy('group')->orderBy('name')->get();
        return view('admin.pages.users.form', compact('permissions'));
    }
    public function store(Request $request) {
        $this->ensureSuperAdmin();
        $data = $request->validate(['name'=>'required|max:255','email'=>'required|email|unique:users','password'=>'required|min:8|confirmed','role'=>'in:superadmin,admin,editor']);
        $data['password'] = Hash::make($data['password']);
        $data['is_active'] = $request->boolean('is_active',true);
        $user = User::create($data);
        if ($request->has('permissions')) {
            $user->permissions()->sync($request->input('permissions', []));
        }
        return redirect()->route('admin.users.index')->with('success','Admin user created!');
    }
    public function edit(User $user) {
        $permissions = \App\Models\Permission::orderBy('group')->orderBy('name')->get();
        $assignedPermissions = $user->permissions()->pluck('permission_id')->all();
        return view('admin.pages.users.form', compact('user','permissions','assignedPermissions'));
    }
    public function update(Request $request, User $user) {
        $data = $request->validate(['name'=>'required|max:255','email'=>'required|email|unique:users,email,'.$user->id,'role'=>'in:superadmin,admin,editor']);
        if (!Auth::user()->isSuperAdmin()) {
            unset($data['role']);
        }
        if ($request->filled('password')) {
            $request->validate(['password'=>'min:8|confirmed']);
            $data['password'] = Hash::make($request->password);
        }
        $data['is_active'] = $request->boolean('is_active');
        $user->update($data);

        if (Auth::user()->isSuperAdmin() && $request->has('permissions')) {
            $user->permissions()->sync($request->input('permissions', []));
        }
        return redirect()->route('admin.users.index')->with('success','User updated!');
    }
    public function destroy(User $user) {
        $this->ensureSuperAdmin();
        if ($user->id === Auth::id()) return back()->with('error','Cannot delete yourself!');
        $user->delete();
        return redirect()->route('admin.users.index')->with('success','User deleted!');
    }
    public function toggle($id) {
        $this->ensureSuperAdmin();
        $user = User::findOrFail($id);
        if ($user->id === Auth::id()) return response()->json(['error'=>'Cannot deactivate yourself'],400);
        $user->update(['is_active'=>!$user->is_active]);
        return response()->json(['success'=>true]);
    }
    public function profile() {
        $user = Auth::user();
        return view('admin.pages.users.profile', compact('user'));
    }
    public function updateProfile(Request $request) {
        $user = Auth::user();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'avatar' => 'nullable|image|max:5120',
        ]);
        if ($request->filled('password')) {
            $request->validate(['password'=>'min:8|confirmed']);
            $data['password'] = Hash::make($request->password);
        }
        if ($request->hasFile('avatar')) {
            $data['avatar'] = upload_to_storage($request->file('avatar'), 'avatars');
        }
        $user->update($data);
        return back()->with('success','Profile updated!');
    }

    public function resetPassword(User $user)
    {
        $this->ensureSuperAdmin();
        return view('admin.pages.users.reset-password', compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        $this->ensureSuperAdmin();
        $data = $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);
        $user->update(['password' => Hash::make($data['password'])]);
        return redirect()->route('admin.users.index')->with('success', 'Password reset successfully!');
    }
}
