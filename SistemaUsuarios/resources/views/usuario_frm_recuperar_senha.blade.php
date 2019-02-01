<body style="background: url('{{ asset('images/recuperrar_senha.jpg') }}') no-repeat center; background-size: cover;">
@extends('layouts.app')

@section('conteudo')
    <div class="" style="display: block; position: initial; left: 35%; width: fit-content; margin: auto">

        <div class="">


            {{-- apresentção de erros de validação... --}}
            @include('inc.erros')

            <form method="post" action="/executar_recuperar_senha" style="width: 356px; background: rgba(0,0,0,0.1); border-radius: 16px; padding: 23px; top: 115px; display: block; position: relative;">
                @csrf


                <div class="form-group">
                    <label for="id_text_email">Email: </label>
                    <input type="email" class="form-control" id="id_text_email" name="text_email" placeholder="Email">
                </div>


                <div class="text-center">
                    <button type="submit" class="btn btn-dark">Recuperar conta</button>
                </div>

                <div class="text-center">
                    <a href="/" class="btn btn-link" style="color: black">Voltar</a>
                </div>

            </form>

        </div>

    </div>

@endsection
