<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;

class AplicacaoController extends Controller
{
    public function apresentarPaginaInicial(){

        // verifica se a sessão está ativa
        if (!Session::has('login')){
            return redirect('/');
        }

        // apresenta o interior da aplicação
        return view('aplicacao');

    }

}
