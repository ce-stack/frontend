@extends('layouts.app')

@section('content')
    <form action="{{ route('verify-phone-number') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="phone_number">Phone number</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
        </div>
        <button type="submit" class="btn btn-primary">Send verification code</button>
    </form>
@endsection
