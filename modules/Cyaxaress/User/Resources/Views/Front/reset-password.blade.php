@extends('User::Front.master')

@section('content')
    <form action="" class="form" method="post">
        <a class="account-logo" href="index.html">
            <img src="/img/Hemn_ORG.png" alt="">
        </a>
        <div class="form-content form-account">
            <input type="text" class="txt-l txt" placeholder="Email">
            <br>
            <button class="btn btn-recoverpass">Recover</button>
        </div>
        <div class="form-footer">
            <a href="login.html">Login Page</a>
        </div>
    </form>
@endsection
