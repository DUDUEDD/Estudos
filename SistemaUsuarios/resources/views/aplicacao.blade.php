@extends('layouts.app')

M.Y - H.Y.D.R.A -
        {{ session('usuario')}}

<ul class="nav nav-pills bg-dark justify-content-end">

    <li style="display: block; position: relative; right: 83%">
        <a class="nav-link dropdown-toggle text-success bg-dark" data-toggle="dropdown" href="#" role="button"
           aria-haspopup="true" aria-expanded="false">
            <span class="glyphicon glyphicon-tasks"></span> Perfil
        </a>
        <div class="dropdown-menu bg-dark">
            <a class="dropdown-item text-light" href="#">Ação</a>
            <a class="dropdown-item text-light" href="#">Outra ação</a>
            <a class="dropdown-item text-light" href="#">Algo mais aqui</a>
            {{--↓ outra aba ↓--}}
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-light" href="#">Link isolado</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link text-success" href="#">
            Link
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link disabled dropdown-item text-danger" href="/usuario_logout">
            Logout
        </a>
    </li>
</ul>
@section('conteudo')
    <div style="background: #9d9d9d; text-align: center">

    </div>
@endsection

