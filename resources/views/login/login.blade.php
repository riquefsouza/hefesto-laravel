@extends('layout')

@section('title')
Login
@endsection

@section('content')

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" id="anchorHomePage" href="~/login">
        <span>{{ $messages["main.framework"] }}</span>&nbsp;
        <span>{{ $messages["main.app.title"] }}</span>
    </a>
</nav>

@if ($loginError)
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{ $messages["login.wrongUser"] }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@include('shared.alertMessages', ['alertMessage' => $alertMessage])

<div class="container-fluid" style="margin: 0 auto; width:400px; position: float;">
    <div id="tela-login" style="margin-top: 20px;">
        <div class="card" id="tela-login">
            <div class="card-header" style="font-weight: normal;">{{ $messages["login.title"] }}</div>
            <div class="card-body">

                <form name="formLogin" method="post" action="/login/login">

                    <div asp-validation-summary="ModelOnly" class="text-danger"></div>
                    <input type="hidden" asp-for="Id" />

                    <div class="form-group">
                        <label for="login">{{ $messages["login.username"] }}</label>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" disabled="disabled">
                                    <i class="fas fa-user fa-sm"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control" id="login" name="login"
                                autofocus required="required" maxlength="64"
                                placeholder="{{ $messages["login.username.placeholder"] }}" />
                        </div>
                        <span asp-validation-for="Login" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="password">{{ $messages["login.password"] }}</label>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" disabled="disabled">
                                    <i class="fas fa-lock fa-sm"></i>
                                </button>
                            </div>
                            <input type="password" class="form-control" id="password" name="password"
                                required="required" maxlength="64"
                                placeholder="{{ $messages["login.password.placeholder"] }}" autocomplete="off" />
                        </div>
                        <span asp-validation-for="Password" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <div style="margin: 0 auto; width:25%">
                            <button type="submit" class="btn btn-success btn-icon-split" id="btnLogin">
                                <span class="icon text-white-50">
                                    <i class="fa fa-sign-in" aria-hidden="true"></i>
                                </span>
                                {{ $messages["login.button"] }}
                            </button>
                        </div>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

@endsection
