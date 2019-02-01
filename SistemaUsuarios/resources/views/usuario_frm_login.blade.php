<body style="background: url('{{ asset('images/app.jpg') }}') no-repeat center; background-size: cover">
@extends('layouts.app')
@section('conteudo')
    <div id="div_1" class="" style="display: block; position: initial; left: 35%; width: fit-content; margin: auto">
        <div class="">
            {{-- apresentção de erros de validação... e não só --}}
            @include('inc.erros')
            <form method="post" action="/executar_login"
                  style="width: 356px; background: rgba(0,0,0,0.1); border-radius: 16px; padding: 53px; top: 115px; display: block; position: relative;">
                @csrf





                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="glyphicon glyphicon-user"></span></div>
                    </div>
                    <label for="id_text_usuario"> </label>
                    <input type="text" class="form-control" id="id_text_usuario" name="text_usuario" placeholder="Username">
                </div>

                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="glyphicon glyphicon-lock"></span></div>
                    </div>
                    <label for="id_text_senha"> </label>
                    <input type="password" class="form-control" id="id_text_senha" name="text_senha" placeholder="Password">
                </div>



                <div class="text-center margem-top-30">
                    <button type="submit" class="btn btn-dark">Entrar</button>
                </div>

                <div class="text-center margem-top-10">
                    <a href="/usuario_frm_recuperar_senha" class="btn btn-link">Recuperar senha</a>
                </div>

                <div class="text-center">
                    <a href="/usuario_frm_criar_conta" class="btn btn-link">Criar nova conta</a>
                </div>

            </form>

        </div>

    </div>

@endsection
</body>
