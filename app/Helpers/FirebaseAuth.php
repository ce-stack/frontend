<?php

namespace App\Helpers;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Exception\Auth\PhoneNumberAlreadyExists;
use Kreait\Firebase\Auth\SignIn\FailedToSignIn;
use Kreait\Firebase\Exception\Auth\InvalidPassword;
use Kreait\Firebase\Exception\Auth\UserNotFound;
use Kreait\Firebase\Exception\Auth\EmailNotFound;
use Kreait\Firebase\Exception\Auth\PhoneNumberNotFound;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\Auth\InvalidPhoneNumber;
class FirebaseAuth
{
    protected $auth;

    public function __construct()
    {
        $factory = (new Factory())
            ->withServiceAccount(config('firebase.key_file'))
            ->withDatabaseUri(config('firebase.database_url'));

        $this->auth = $factory->createAuth();
    }

    public function signInWithPhoneNumber(string $phoneNumber): string
    {
        // try {
        //     $verificationId = $this->auth->signInWithPhoneNumberAndCode($phoneNumber);
        //     session(['verificationId' => $verificationId]);

        //     return $verificationId;
        // } catch (FirebaseException $e) {
        //     return '';
        // }


        // Get the user's phone number and verification code from the request
$phoneNumber = '+1234567890'; // Replace with the user's phone number
$verificationCode = '123456'; // Replace with the verification code entered by the user

// Sign in the user using the phone number and verification code
try {
    $user = $auth->signInWithPhoneNumber($phoneNumber, $verificationCode);
    // User has successfully signed in
} catch (InvalidPhoneNumber $e) {
    // The phone number is invalid
} catch (PhoneNumberAlreadyExists $e) {
    // The phone number is already registered with another account
} catch (\Exception $e) {
    // An error occurred while signing in the user
}
    }

    public function signInWithPhoneNumberAndCode(string $verificationId, string $code): string
    {
        try {
            $credential = $this->auth->signInWithPhoneNumberAndVerificationId($verificationId, $code);
            $user = $this->auth->getUser($credential->firebaseUid());

            session(['firebaseUid' => $user->uid]);

            return $user->uid;
        } catch (FailedToSignIn $e) {
            return '';
        }
    }

    public function signOut(): void
    {
        $this->auth->signOut();
        session()->forget(['verificationId', 'firebaseUid']);
    }
}
