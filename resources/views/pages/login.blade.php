@extends('hui::layout.auth')

@section('content')
    <form action="{{ route('helium::postLogin') }}"
          method="post">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email"
                   name="email"
                   id="email"
                   required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password"
                   name="password"
                   id="password"
                   required>
        </div>
        <button type="submit">Login</button>
    </form>
@endsection
