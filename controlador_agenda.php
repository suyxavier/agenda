<?php //controlador agenda


    function cadastrar(){

    $contatos = file_get_contents("contatos.json", true); //guardando os resultados
    $contatos = json_decode($contatos, true); // convertendo para um array
    $contato = [
        "id"       => uniqid(), //gerar um id novo e diferente de todos cada vez que atualizar
        "nome"     => $_POST['nome'],
        "email"    => $_POST['email'],
        "telefone" => $_POST['telefone']
    ];

    array_push($contatos, $contato);
    $dados_json = json_encode($contatos, JSON_PRETTY_PRINT); //arrumar na hora de executar

    file_put_contents("contatos.json", $dados_json);
    header('Location: index.php');
}

    function pegarContatos()
    {
        $contatos = file_get_contents("contatos.json", true); //guardando os resultados
        $contatos = json_decode($contatos, true); // convertendo para um array
        return $contatos;
    }


function editarContato($valorBuscado){


        $contatos = file_get_contents("contatos.json", true);
        $contatos = json_decode($contatos, true);

        foreach ($contatos as $contato) {

            if ($contato ['nome'] == $valorBuscado) {


                echo $contato ['nome'];
                echo "\n";
                echo $contato['email'];
                sleep(1);


            }

        }

    }




    function excluirContato($idContato)
    {

        $contatos = file_get_contents("contatos.json, true"); //guardando os resultados
        $contatos = json_decode($contatos, true); // convertendo para um array

        foreach ($contatos as $posicao => $contato) {

            if ($contato ['nome'] == $idContato) {
                unset($contatos[$posicao]);
                break;

            }

        }

        $contatos = json_decode($contatos, JSON_PRETTY_PRINT);
        file_put_contents("contatos.json", $contatos);

        header('Location:index.php');
    }



    // Geranciamento de rotas
//    if ($_GET['acao'] == 'cadastrar'){
//        cadastrar();
//    }elseif ($_GET['acao']== 'excluir'){
//        excluirContato($_GET['id']);
//    }

