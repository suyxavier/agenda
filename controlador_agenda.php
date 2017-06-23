<?php

    function cadastrar(){

        $contatos = file_get_contents("contatos.json", true);
        $contatos = json_decode($contatos, true);


        $contato = [
            "id"        => uniqid (),
            "nome"      => $_POST['nome'],
            "email"     => $_POST['email'],
            "telefone"  => $_POST['telefone']

        ];

        array_push($contatos, $contato);

        $dados_jason = json_encode($contatos, JSON_PRETTY_PRINT);

        file_put_contents("contatos.json", $dados_jason);

        header('Location: index.php');

    } //fim cadastrar()

    function pegarContatos(){

        $contatos = file_get_contents("contatos.json", true);
        $contatos = json_decode($contatos, true);

        return $contatos;

    }

//GERENCIAMENTO DE ROTAS

    if($_GET['acao']== 'cadastrar'){
        cadastrar();
    }