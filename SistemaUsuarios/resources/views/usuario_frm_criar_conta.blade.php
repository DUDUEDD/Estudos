<body style="background: url('{{ asset('images/cadastro.jpeg') }}') no-repeat center; background-size: cover;">
@extends('layouts.app')

@section('conteudo')
    <div class="" style="display: block; position: initial; left: 35%; width: fit-content; margin: auto">

        <div class="">

            {{-- apresentção de erros de validação... e não só --}}
            @include('inc.erros')

            <form method="post" action="/executar_criar_conta" style="width: 356px; background: rgba(0,0,0,0.1); border-radius: 16px; padding: 23px; top: 115px; display: block; position: relative;">
                @csrf

                {{-- Usuario --}}
                <div class="form-group">
                    <label for="text_usuario">Usuário: </label>
                    <input type="text" class="form-control" id="text_usuario" name="text_usuario"
                           placeholder="5 a 30 caracteres">
                </div>

                {{-- Senha --}}
                <div class="form-group">
                    <label for="text_senha">Senha: </label>
                    <input type="password" class="form-control" id="text_senha" name="text_senha" placeholder="Senha">
                </div>

                {{-- Repetir Senha --}}
                <div class="form-group">
                    <label for="text_senha_repetida">Confirmar senha: </label>
                    <input type="password" class="form-control" id="text_senha_repetida" name="text_senha_repetida"
                           placeholder="Senha">
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label for="text_email">Email: </label>
                    <input type="email" class="form-control" id="text_email" name="text_email" placeholder="Email">
                </div>

                {{-- Repetir Email --}}
                <div class="form-group">
                    <label for="text_email_repetido">Confirmar email </label>
                    <input type="email" class="form-control" id="text_email_repetido" name="text_email_repetido"
                           placeholder="Email">
                </div>

                {{-- check box --}}
                <div class="form-group text-center">
                    <label for="id_text_check">
                        Sim, Concordo com os Termos:
                        <input type="checkbox" id="id_text_check" name="text_check" value="1">
                    </label>
                </div>

                {{-- botão de cadastro --}}
                <div class="text-center">
                    <button type="submit" class="btn btn-dark">Cadastrar conta</button>
                </div>

                {{-- botão de voltar --}}
                <div class="text-center">
                    <a href="/" class="btn btn-link">Voltar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
</body>
