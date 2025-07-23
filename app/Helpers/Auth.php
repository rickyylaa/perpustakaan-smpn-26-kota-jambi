<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('AuthAdmin')) {
    function AuthAdmin()
    {
        $user = Auth::user();
        return $user && $user->role === 'admin' ? $user->admin : null;
    }
}

if (!function_exists('AuthPetugas')) {
    function AuthPetugas()
    {
        $user = Auth::user();
        return $user && $user->role === 'petugas' ? $user->petugas : null;
    }
}
