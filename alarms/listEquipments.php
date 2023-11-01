<?php

// Incluir o arquivo com a conexao com banco de dados

//require "config.php";
require "../core/connection.php";

$nome_equipment = filter_input(INPUT_GET, "nome", FILTER_DEFAULT);

// Acessa o IF quando existe o nome do equipamento no parâmetro enviado pela URL
if (!empty($nome_equipment)) {

    // Criar a variável com % para pesquisar com LIKE
    $pesq_equipments = "%" . $nome_equipment . "%";

    // Buscar no banco de dados os equipments
    $query_equipments = "SELECT id, equipment_name FROM equipment WHERE equipment_name LIKE :nome LIMIT 10";

    // Preparar a QUERY
    $result_equipments = $conn->prepare($query_equipments);

    // Subtituir o link da QUERY pelo valor enviado pela URL
    $result_equipments->bindParam(':nome', $pesq_equipments);

    // Executar a QUERY com PDO
    $result_equipments->execute();

    // Acessa o IF quando encontrou equipamento no banco de dados
    if (($result_equipments) and ($result_equipments->rowCount() != 0)) {

        // Ler os registros retornado do banco de dados
        while ($row_equipment = $result_equipments->fetch(PDO::FETCH_ASSOC)) {

            // Atribuir os dados do equipment para a variável dados
            $dados[] = $row_equipment;
        }

        // Criar o array com o status e retornar os dados
        $retorna = ['status' => true, 'dados' => $dados];
    } else {

        // Criar o array com o status e retornar a mensagem de erro
        $retorna = ['status' => false, 'msg' => "Erro: nenhum equipamento encontrado!"];
    }
} else {
    // Criar o array com o status e retornar a mensagem de erro
    $retorna = ['status' => false, 'msg' => "Erro: nenhum equipamento encontrado!"];
}

// Retornar os dados
echo json_encode($retorna);
