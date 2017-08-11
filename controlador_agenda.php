<?php
    function MandarCodigoJSON($contatosAuxiliar){

        $contatosJson = json_encode($contatosAuxiliar, JSON_PRETTY_PRINT); //A variavel $contatosJson vai receber tudo que tem na variavel $contatosAuxiliar e tranformar JSON.

        file_put_contents('contatos.json', $contatosJson); //manda tudo que há na variavel $contatosJSON para o arquivo contatos.json

        header("Location: index.phtml"); //vai redirecionar para a pagina index.phtml

    }

    function decodificarCodigoJSON(){
         $contatosAuxiliar = file_get_contents('contatos.json'); //A variavel $contatosAuxiliar irá receber tudo que está em contatos.json

         $contatosAuxiliar = json_decode($contatosAuxiliar, true); //vai tranformar o json em um array PHP.

         return $contatosAuxiliar; // retornar o que está em $contatosAuxiliar.s

    }

    function cadastrar($nome,$email,$telefone){

        $contatosAuxiliar = decodificarCodigoJSON();// essa função vai decodificar o código JSON

        $contato = [ 
            'id'      => uniqid(), 
            'nome'    => $nome, 
            'email'   => $email,
            'telefone'=> $telefone 
        ];

        array_push($contatosAuxiliar, $contato); // o array_push vai adicionar o contato novo na ultima posição

        MandarCodigoJSON    ($contatosAuxiliar); // vai enviar o código JSON para contatos.json

    }

    function pegarContatos2($nome){
            $contatosAuxiliar = decodificarCodigoJSON(); // essa função vai decodificar o código JSON 
            foreach ($contatosAuxiliar as $posicao => $contato){ // o foreach vai percorrer $contatosAuxiliar até encontrar o nome buscado
                if($nome == $contato['nome']) { 
                    return ($contatosAuxiliar[$posicao]);
                }


        }
    }
    function pegarContatos(){
        $contatosAuxiliar = decodificarCodigoJSON(); // essa função vai decodificar o código JSON

        return $contatosAuxiliar; 
    }
  



    function excluirContato($id){

        $contatosAuxiliar = decodificarCodigoJSON(); // essa função vai decodificar o código JSON

        foreach ($contatosAuxiliar as $posicao => $contato){ // o foreach vai percorrer $contatosAuxiliar até encontrar o id buscado
            if($id == $contato['id']) {
                unset($contatosAuxiliar[$posicao]); 
            }
        }

         MandarCodigoJSON($contatosAuxiliar); //codiicar o php em json e manda para o arquivo contatos.json.
    }

    function editarContato($id){

        $contatosAuxiliar = decodificarCodigoJSON();// essa função vai decodificar o código JSON

        foreach ($contatosAuxiliar as $contato){
            // o foreach vai percorrer $contatosAuxiliar até encontrar o id buscado
            if ($contato['id'] == $id){
                return $contato;
            }
        }
    }

    function salvarContatoEditado($id,$nome,$email,$telefone){
        $contatosAuxiliar = decodificarCodigoJSON();// essa função vai decodificar o código JSON

        foreach ($contatosAuxiliar as $posicao => $contato){ // o foreach vai percorrer $contatosAuxiliar até encontrar o id buscado
            if ($contato['id'] == $id){ 

                $contatosAuxiliar[$posicao]['nome'] = $nome;

                $contatosAuxiliar[$posicao]['email'] = $email;

                $contatosAuxiliar[$posicao]['telefone'] = $telefone;

                break;
            }
        }
        MandarCodigoJSON($contatosAuxiliar);//codiicar o php em json e manda para o arquivo contatos.json.  

    }

    //ROTAS
        if ($_GET['acao'] == 'cadastrar'){
            cadastrar($_POST['nome'],$_POST['email'],$_POST['telefone']);


        } elseif ($_GET['acao'] == 'excluir'){
            excluirContato($_GET['id']);
        }
        elseif ($_GET['acao'] == 'salvar'){
            salvarContatoEditado($_POST['id'],$_POST['nome'], $_POST['email'],$_POST['telefone']);
        }

