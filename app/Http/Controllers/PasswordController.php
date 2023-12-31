<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    protected $userProfilePhoto;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->userProfilePhoto = $this->getUserProfilePhoto(Auth::user());
            return $next($request);
        });
    }

    public function edit(User $user)
    {   
        $user = Auth::user();
        return view('user.profile.change-password', [
            'user' => $user,
            'userProfilePhoto' => $this->userProfilePhoto
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        // Dapatkan user yang sedang login
        $user = Auth::user();

        // Periksa apakah password lama yang dimasukkan benar
        if (Hash::check($request->old_password, $user->password)) {
            // Jika benar, update password baru
            $user->password = Hash::make($request->new_password);
            $user->save;

            return redirect()->route('home')->with('success', 'Password Berhasil Diperbarui!');
        } else {
            // Jika password lama salah, kembalikan dengan pesan kesalahan
            return back()->with('error', 'Password Lama Salah. Silakan Coba Lagi!');
        }
    }
}
