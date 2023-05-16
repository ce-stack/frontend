@extends('layouts.app')

@section('content')
    <form action="{{ route('verify-phone-number-and-code') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="code">Verification code</label>
            <input type="text" class="form-control" id="code" name="code" required>
        </div>
        <button type="submit" class="btn btn-primary">Verify code</button>
    </form>
@endsection
