<?php include "header.php"; ?>

<?php

    include_once "conexaoBD.php"; //Inclui o arquivo de conexão com o BD
    $listarVeiculo = "SELECT * FROM carro"; //Query para selecionar TODOS o Produtos
    $res = mysqli_query($conn, $listarVeiculo) or die("Erro ao tentar listar produtos!" . mysqli_error($conn));

    $totalVeiculo = mysqli_num_rows($res); //Retorna o total de registros retornado pela Query

    echo "<h2>Total de Produtos cadastrados: $totalVeiculo</h2>";

    //Monta o cabeçalho da tabela para exibir os registros
    echo "
        <table class='table'>
            <thead class='thead-light'>
                <tr>
                    <th>ID</th>
                    <th>FOTO</th>
                    <th>MARCA</th>
                    <th>MODELO</th>
                    <th>PLACA</th>
                </tr>
            </thead>";

            //Varre a tabela enquanto houverem registros e armazena-os em um array
            while ($registro = mysqli_fetch_assoc($res)){
                //Cria variáveis PHP e armazen os registros nelas
                $idVeiculo           = $registro["idVeiculo"];
                $fotoVeiculo         = $registro["fotoVeiculo"];
                $marcaVeiculo         = $registro["marcaVeiculo"];
                $modeloVeiculo    = $registro["modeloVeiculo"];
                $placaVeiculo    = $registro["placaVeiculo"];

                echo "
                    <tbody>
                        <tr>
                            <td>$idVeiculo</td>
                            <td><img src='$fotoVeiculo' width='100'></td>
                            <td>$marcaVeiculo</td>
                            <td>$modeloVeiculo</td>
                            <td>$placaVeiculo</td>
                        </tr>
                    </tbody>
                ";
            }
        echo "</table>";

?>

<?php include "footer.php"; ?>