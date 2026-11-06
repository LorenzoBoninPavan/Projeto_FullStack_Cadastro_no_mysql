<?php include("header.php"); ?>

<?php

    //Bloco para declaração das variáveis
    $fotoVeiculo = $marcaVeiculo= $modeloVeiculo = $placaVeiculo ="";
    $dataCadastroVeiculo = date('Y-m-d'); //Utiliza a função date para pegar a data no formato AAAA/MM/DD
    $horaCadastroVeiculo = date('H:i:s'); //Utiliza a função date para pegar as horas no formato HH:MM:SS
    $erroPreenchimento = false; //Variável para controle de erros durante o preenchimento do formulário

    //Verifica o método de envio do FORM
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        //Utiliza a função empty para verificar se o campo nomeProduto(form) está vazio

        //Validação Campo marcaVeiculo
        if(empty($_POST["marcaVeiculo"])){
            echo "<div class='alert alert-warning text-center'>O campo <strong>Marca</strong> é obrigatório!</div>";
            $erroPreenchimento = true;
        } else{
            $marcaVeiculo = filtrar_entrada($_POST["marcaVeiculo"]);
        }

        //Validação do campo modeloVeiculo
        if(empty($_POST["modeloVeiculo"])){
            echo "<div class='alert alert-warning text-center'>O campo <strong>MODELO</strong> é obrigatório!</div>";
            $erroPreenchimento = true;
        } else{
            $modeloVeiculo = filtrar_entrada($_POST["modeloVeiculo"]);
        }

        //Validação do campo placaVeiculo
        if(empty($_POST["placaVeiculo"])){
            echo "<div class='alert alert-warning text-center'>O campo <strong>PLACA</strong> é obrigatório!</div>";
            $erroPreenchimento = true;
        } else{
            $placaVeiculo = filtrar_entrada($_POST["placaVeiculo"]);
        }


        //Início da validação da Foto do Usuário
        $diretorio    = "img/"; //Define para qual diretório do sistema as imagens serão movidas
        $fotoVeiculo  = $diretorio . basename($_FILES["fotoVeiculo"]["name"]); // img/ana.jpg
        $erroUpload   = false; //Variável criada para verificar se houve sucesso no upload
        $tipoDaImagem = strtolower(pathinfo($fotoVeiculo, PATHINFO_EXTENSION));  //Pega tipo do arquivo

        //Verifica se o tamanho da imagem é maior do que ZERO
        if ($_FILES["fotoVeiculo"]["size"] != 0){ //Usa a propriedade "size" para verificar o tamanho 

            if($_FILES["fotoVeiculo"]["size"] > 5000000){ //Verifica o tamanho em BYTES (5MB, nesse caso)
                echo "<div class='alert alert-warning text-center'>A foto não pode ser <strong>maior</strong> do que 5MB!</div>";
                $erroUpload = true;
            }

            //Cria o conjunto de imagens aceitos pelo campo foto do formulário 
            if($tipoDaImagem != "jpg" && $tipoDaImagem != "jpeg" && $tipoDaImagem != "png" && $tipoDaImagem != "webp"){
                echo "<div class='alert alert-warning text-center'>A foto precisa estar nos formatos <strong>JPG, JPEG, PNG ou WEBP</strong>!</div>";
                $erroUpload = true;
            }   

            if($erroUpload){
                echo "<div class='alert alert-warning text-center'>Erro ao tentar fazer o <strong>UPLOAD DA FOTO</strong>!</div>";
                $erroUpload = true;
            }
            else{
                //A função seguinte é responsável por mover o arquivo par ao diretório definido (img/)
                if(!move_uploaded_file($_FILES["fotoVeiculo"]["tmp_name"], $fotoVeiculo)){
                    echo "<div class='alert alert-warning text-center'>Erro ao tentar<strong>MOVER O ARQUIVO para o diretório $diretorio</strong>!</div>";
                    $erroUpload = true;
                }
            }
        }
        else{
            echo "<div class='alert alert-warning text-center'>Erro ao tentar fazer o <strong>UPLOAD DA FOTO</strong>!</div>";
            $erroUpload = true;
        }
        
        //Se NÃO houver erro de preenchimento (caso a variável de controle esteja com o valor 'false')
        if(!$erroPreenchimento && !$erroUpload){

            //Cria a Query para realizar a inserção das informações na tabela Produtos
            $inserirVeiculo = "INSERT INTO carro (fotoVeiculo, marcaVeiculo, modeloVeiculo, placaVeiculo, dataCadastroVeiculo, horaCadastroVeiculo, statusVeiculo)
                            VALUES ('$fotoVeiculo', '$marcaVeiculo', '$modeloVeiculo', '$placaVeiculo','$dataCadastroVeiculo', '$horaCadastroVeiculo', 'disponivel')"; 

            //Inclui o arquivo para conexão com o Banco de Dados
            include("conexaoBD.php");

            //Utiliza a função mysqli_query para executar a QUERY no Banco de Dados
            if(mysqli_query($conn, $inserirVeiculo)){

                echo "
                    <div class='alert alert-success text-center'>Produto cadastrado com sucesso!</div>
                    <div class='container mt-3'>
                        <div class='container mt-3 text-center'>
                            <img src='$fotoVeiculo' style='width: 150px;'>
                        </div>
                        <div class='table-responsive'>
                            <table class='table'>
                                <tr>
                                    <th>Marca</th>
                                    <td>$marcaVeiculo</td>
                                </tr>
                                <tr>
                                    <th>Modelo</th>
                                    <td>$modeloVeiculo</td>
                                </tr>
                                <tr>
                                    <th>Placa</th>
                                    <td>$placaVeiculo</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                ";
            }
            else{
                echo "<div class='alert alert-danger text-center'>Erro ao tentar cadastrar produto!</div>" . mysqli_error($conn);
                echo "<p>$inserirVeiculo</p>";
            }
        }

    }

    //Função para filtrar as entradas de dados do formulário para evitar SQL Injection
    function filtrar_entrada($dado){
        $dado = trim($dado); //Remove espaços desnecessários
        $dado = stripslashes($dado); //Remove as barras invertidas
        $dado = htmlspecialchars($dado); //Converte caracteres especiais em entidades HTML

        return($dado); //Retorna o dado já filtrado
    }

?>

<?php include("footer.php");?>