<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class ForgotPasswordOtpController extends Controller
{

    public function showOtpForm()
    {
        return view('auth.passwords.email');
    }


    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // OTP has check gareko expire
        if (session('otp_expiration') && Carbon::now()->isAfter(session('otp_expiration'))) {
            session()->forget(['otp', 'otp_expiration']);
        }

        if (session('otp') && session('otp_expiration') && Carbon::now()->isBefore(session('otp_expiration'))) {
            $remainingTime = Carbon::now()->diffInSeconds(session('otp_expiration'));
            return redirect()->route('password.otp.form')->with(['error' => 'You can request a new OTP after ' .round($remainingTime). ' seconds.']);
        }

        $otp = rand(100000, 999999);

        session([
            'otp' => $otp,
            'otp_expiration' => Carbon::now()->addMinute(),
            'email' => $request->email,
        ]);

        $user = User::where('email', $request->email)->first();
        Mail::send('auth.emails.otp', ['otp' => $otp], function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Your OTP Code');
        });

        return redirect()->route('password.verifyOtp')->with('success', 'OTP sent! The OTP will expire in 1 minute.');
    }


    public function showOtpVerificationForm()
    {
        return view('auth.passwords.verifyOtp');
    }


    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        if (session('otp_expiration') && Carbon::now()->isAfter(session('otp_expiration'))) {

            session()->forget(['otp', 'otp_expiration']);

            return back()->withErrors(['error' => 'The OTP has expired. Please request a new one.']);
        }

        if ($request->otp == session('otp')) {

            session()->forget(['otp', 'otp_expiration']);

            $email = session('email');

            return redirect()->route('user-password.reset')->with([
                'success' => 'OTP verified!',
                'email' => $email ,
            ]);

        } else {
            return back()->withErrors(['error' => 'Invalid OTP']);
        }
    }


    public function showPasswordResetForm()
    {
        return view('auth.passwords.reset');
    }


    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::login($user);
        return redirect()->route('home')->with('success', 'Password successfully reset.');
    }

}
