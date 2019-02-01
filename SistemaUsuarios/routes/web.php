<?php

// default
route::get('/', 'UsuariosController@index');

// usuario - login
route::get('/usuario_frm_login','UsuariosController@frmLogin');
route::post('/executar_login','UsuariosController@executarLogin');

// usuario - logout
route::get('/usuario_logout','UsuariosController@Logout');

// usuario - recuperar senha
route::get('/usuario_frm_recuperar_senha','UsuariosController@frmRecuperarSenha');
route::post('/executar_recuperar_senha', 'UsuariosController@executarRecuperarSenha');
route::get('/usuario_email_enviado','UsuariosController@emailEnviado');

// usuario - nova conta
route::get('/usuario_frm_criar_conta','UsuariosController@frmCriarNovaConta');
route::post('/executar_criar_conta','UsuariosController@executarCriarcaoNovaConta');

// interior da aplicação
route::get('/aplicacao_index','AplicacaoController@apresentarPaginaInicial');

