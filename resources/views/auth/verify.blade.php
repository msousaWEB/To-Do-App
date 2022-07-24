@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Por favor, verifique o seu email!</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            O email de validação foi enviado novamente, por favor verifique sua caixa de entrada.
                        </div>
                    @endif

                    Antes de continuar, verifique seu e-mail para obter um link de verificação.
                    Caso não tenha recebido o e-mail
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Clique aqui para reenviar</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
