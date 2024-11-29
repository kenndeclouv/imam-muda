<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmailMail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
    // halaman pemberitahuan
    public function notice()
    {
        $user = Auth::user();

        // if (!$user->hasVerifiedEmail()) {
        //     $this->sendVerificationEmail();
        // }
        return view('auth.verify-email'); // hanya tampilkan view
    }

    // proses verifikasi email
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill(); // tandai email sebagai terverifikasi
        return redirect('/account')->with('success', 'Email kamu berhasil diverifikasi!');
    }

    // kirim ulang link verifikasi
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect('/account')->with('success', 'Email sudah diverifikasi.');
        }

        // kirim email verifikasi
        $this->sendVerificationEmail();

        return back()->with('success', 'Link verifikasi telah dikirim ulang ke email kamu!');
    }

    // fungsi untuk mengirim email verifikasi
    public function sendVerificationEmail()
    {
        $user = Auth::user(); // ambil data user saat ini
        Mail::to($user->email)->send(new VerifyEmailMail($user)); // kirim email
    }
}
