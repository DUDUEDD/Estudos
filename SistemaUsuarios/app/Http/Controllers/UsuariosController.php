<?php

namespace App\Http\Controllers;


use App\usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\classes\minhaClasse;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailRecuperarSenha;



class UsuariosController extends Controller
{
    //========================================================
    public function index()
    {
        // verificar se existe sessão
        if (!Session::has('login')){
            // se nao existe, apresentar formulário de login
            return $this->frmLogin();
        }else{
            return view('aplicacao');
        }

        /*
         * se o usuário tem sessão ativa
         * IF
         *
         * if(sessão = ativa)
         * {
         *      interior da aplicação
         * }
         * else{
         * //AQUI - formulário de login
         * }
         * */

    }



    //========================================================
    // LOGIN
    //========================================================
    public function frmLogin()
    {
        // apresentar o formulário de login
        return view('usuario_frm_login');
    }

    //========================================================
    public function executarLogin(Request $request)
    {

        /*
         * 1 - verificar se os dados foram preenchidos corretamente (Validation)
         * 2 - ir à procura do usuário na bd (Eloquent ORM)
         * 3 - verificar se usuário e senha correspondem a usuário e senha inserido no frm (Hashing)
         * 4 - ultrapassadas as fases todas, criar sessão de usuário (Sessions)
        */

        // Validação
        $this->validate($request, [
            'text_usuario' => 'required|between:5,30',
            'text_senha' => 'required|between:6,15'
        ]);

        // verificar se o usuário existe
        $usuario = usuarios::where('usuario', $request->text_usuario)->first();

        //verificar se existe usuário

        /*
         * if (count($usuario)==0){
        }*/


        if ($usuario == false) {
            $erros_bd = ['Essa conta de usuário não existe'];
            return view('usuario_frm_login', compact('erros_bd'));
        }
        // verificar se a senha corresponde ao guardado na bd
        if (!Hash::check($request->text_senha, $usuario->senha)) {
            $erros_bd = ['Usuário ou Senha invalida !'];
            return view('usuario_frm_login', compact('erros_bd'));
        }

        // abrir sessao de usuário
        Session::put('login','sim');
        Session::put('id_usuario', $usuario->id_usuario);
        Session::put('usuario', $usuario->usuario);

        return redirect('/');

        /*
         * para chamar a função {{ session('usuario')} {{ session('pegar_senha')} ele ira retorna o nome de usuario e a senha
         * Session::put('nome para chamar no echo a função', função a ser chamada)
         * Session::put('chave','validado');
         * Session::put('id_usuario', $usuario->id_usuario);
         * Session::put('usuario', $usuario->usuario);
         * Session::put('pegar_senha', $usuario->senha);
        */
    }

    //========================================================
    // LOGOUT
    //========================================================
    public function logout()
    {
        // logout da sessão (destruir a sessão e redirecionar para o quadro de login)

        // Destruir a sessão
        Session::flush();
        return redirect('/');
    }
    //========================================================


    //========================================================
    // RECUPERAR SENHA
    //========================================================
    public function frmRecuperarSenha()
    {
        return view('usuario_frm_recuperar_senha');
    }

    //========================================================
    public function executarRecuperarSenha(Request $request)
    {
        //validação
        $this->validate($request, [
            'text_email' => 'required|email'
        ]);

        // buscar o usuário
        $usuario = usuarios::where('email', $request->text_email)->get()->first();

        if ($usuario == false){
            $erros_bd = ['O Email não está associado a nenhuma conta de usuário.'];
            return view('usuario_frm_recuperar_senha', compact('erros_bd'));
        }

        // atualizar a senha do usuário para a nova senha (senha de recuperação)
        //criar uma nova senha aleatória
        $nova_senha = minhaClasse::criarCodigo();
        //$usuario->senha = Hash::make(minhaClasse::criarCodigo());
        $usuario->senha = Hash::make($nova_senha);
        $usuario->save();

        // enviar email ao usuário com a nova senha
        Mail::to($usuario->email)->send(new EmailRecuperarSenha($nova_senha));

        return view('/usuario_email_enviado');






       /*
       --------- validação - 1 - ter usuário com email válido
       --------- buscar o usuario e comprar ao input - 2 - verificar se o email inserido corresponde ao do usuário
       --------- 3 - sistema cria senha aleatória
       4 - enviar email com a nova senha para o email do usuário
       5 - informar (view) o usuário que foi enviada nova senha para o email dele.
       */




    }

    public function emailEnviado()
    {
        return view('usuario_email_enviado');
    }



    //========================================================
    // CRIAÇÃO DE NOVA CONTA
    //========================================================
    public function frmCriarNovaConta()
    {
        // apresentar o formulario de criação de nova conta
        return view('usuario_frm_criar_conta');
    }

    //========================================================
    public function executarCriarcaoNovaConta(Request $request)
    {
        //executar os procedimentos e verificações para criação de uma nova conta


        //validação
        $this->validate($request, [
            'text_usuario' => 'required|Between:5,30',
            'text_senha' => 'required|Between:6,15',
            'text_senha_repetida' => 'required|same:text_senha',
            'text_email' => 'required|email',
            'text_email_repetido' => 'required|same:text_email',
            'text_check' => 'Accepted'

        ]);

        /*
                 accepted
                        The field under validation must be yes, on, 1,
                 or true. This is useful for validating "Terms of Service" acceptance.

                between:min,max
                The field under validation must have a size between the given min and max.
                Strings, numerics, arrays, and files are evaluated in the same fashion as the size rule.

                same:text_senha'
                o valor que voce inserir na senha repetida é igual same
                : o valor de inserido em text_senha      name input
                */


        // verifica se já existe um usuário com o mesmo nome ou com o mesmo email

        $dados = usuarios::where('usuario', '=', $request->text_usuario)
            ->orWhere('email', '=', $request->text_email)
            ->get();
        if ($dados->count() != 0) {
            $erros_bd = ['Já existe um usuário do HIDRA com o mesmo nome ou com o mesmo email.'];
            return view('usuario_frm_criar_conta', compact('erros_bd'));
        }
        /*
         *
        */

        // inserir o novo usuario da base de dados
        $novo = new usuarios;
        $novo->usuario = $request->text_usuario;
        $novo->senha = Hash::make($request->text_senha);
        //↑↑↑↑↑↑↑↑Senha encriptada
        //↓↓↓↓↓↓↓Senha não encriptada↓
        //$novo->senha = $request->text_senha;
        $novo->email = $request->text_email;
        $novo->save();

        return redirect('/');
    }


}

