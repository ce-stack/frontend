<?php

namespace App\Http\Controllers;

use App\Helpers\FirebaseAuth;
use Illuminate\Http\Request;

class MobileAuthController extends Controller
{
    protected $firebaseAuth;

    public function __construct()
    {
        $this->firebaseAuth = new FirebaseAuth();
    }

    public function showVerificationForm()
    {
        return view('verify');
    }

    public function verifyPhoneNumber(Request $request)
    {
        $phoneNumber = $request->input('phone_number');
        $verificationId = $this->firebaseAuth->signInWithPhoneNumber($phoneNumber);

        if ($verificationId) {
            return redirect()->route('verify-code');
        } else {
            return redirect()->back()->withErrors(['message' => 'Failed to send verification code']);
        }
    }

    public function showVerificationCodeForm()
    {
        return view('verify-code');
    }

    public function signOut()
    {
        $this->firebaseAuth->signOut();

        return redirect()->route('login');
    }

}
