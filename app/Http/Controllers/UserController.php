<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the currently authenticated user
        $currentUser = Auth::user();

        // Get all users except the currently authenticated user
        $dataUser = User::where('id', '!=', $currentUser->id)->latest()->get();

        return view('user.index', compact('dataUser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal ditambah');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Temukan peran (role) yang sesuai, misalnya "kasir"
        $role = Role::where('name', 'kasir')->first();

        // Berikan peran tersebut kepada pengguna
        $user->assignRole($role);

        return redirect()->back()->with('success', 'User berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $id,
            // 'password' => 'nullable|min:6', // Password is optional
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal diperbarui');
        }

        // Find the user by ID
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }

        // Update user data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->back()->with('success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the user by ID
        $user = User::find($id);

        // Check if the user exists
        if ($user) {
            // Delete the user
            $user->delete();
            return redirect()->back()->with('success', 'User berhasil dihapus');
        }

        return redirect()->back()->with('error', 'User tidak ditemukan');
    }

    public function profile()
    {
        $user = auth()->user();


        return view('user.profile', compact('user'));
    }

    public function profileUpdate(Request $request, string $id)
    {
        // $id = auth()->id(); // Get the ID of the authenticated user

        // Validation rules
        $validator = Validator::make($request->all(), [
            'nama' => 'required|min:3',
            'email' => 'required|min:1',
            'password' => 'nullable|min:6', // Password is optional
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal diperbarui');
        }

        // Find the user by ID
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }

        // Update user data
        // $userData = [
        //     'nama' => $request->name,
        //     'email' => $request->email,
        // ];
        $user->name = $request->input('nama', $user->name);
        $user->email= $request->input('email', $user->email);

        $user->save();
        // Update the password only if it's provided
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        return redirect()->back()->with('success', 'User berhasil diperbarui');
    }
}
