<?php

//require_once "config.php";
require "../core/connection.php";

/* Arranjo das colunas para mostrar na tabela */
$columns = ['id', 'equipment_name', 'serial_number', 'type_eqp', 'created_at'];

/* Nome da tabela */
$table = "equipment";

$id = 'id';

$campo = isset($_POST['campo']) ? $_POST['campo'] : null;

/* Filtrado */
$where = '';

if ($campo != null) {
    $where = "WHERE (";

    $cont = count($columns);
    for ($i = 0; $i < $cont; $i++) {
        $where .= $columns[$i] . " LIKE '%" . $campo . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ")";
}

/* Limit */
$limit = isset($_POST['registros']) ? $_POST['registros'] : 10;
$page = isset($_POST['pagina']) ? $_POST['pagina'] : 0;

if (!$page) {
    $initial = 0;
    $page = 1;
} else {
    $initial = ($page - 1) * $limit;
}

$sLimit = "LIMIT $initial , $limit";

/**
 * Ordenamento
 */

 $sOrder = "";
 if(isset($_POST['orderCol'])){
    $orderCol = $_POST['orderCol'];
    $oderType = isset($_POST['orderType']) ? $_POST['orderType'] : 'asc';
    
    $sOrder = "ORDER BY ". $columns[intval($orderCol)] . ' ' . $oderType;
 } else {
    $sOrder = "ORDER BY ". $id;
 }


/* Consulta */
$sql = "SELECT SQL_CALC_FOUND_ROWS " . implode(", ", $columns) . "
FROM $table
$where
$sOrder
$sLimit";

$resultEquipments = $conn->prepare($sql);

// Executar a QUERY com PDO
$resultEquipments->execute();
$numRows = $resultEquipments->rowCount();

/* Consulta para total de registro filtrados */
$sqlFilter = "SELECT FOUND_ROWS()";
$resFilter = $conn->query($sqlFilter);
$rowFilter = $resFilter->fetch(PDO::FETCH_ASSOC);
$totalFilter = $rowFilter["FOUND_ROWS()"];

/* Consulta para total de registro filtrados */
$sqlTotal = "SELECT count($id) FROM $table ";
$resTotal = $conn->query($sqlTotal);
$rowTotal = $resTotal->fetch(PDO::FETCH_ASSOC);
$totalRegisters = $rowTotal['count(id)'];

/* Mostrado resultados */
$output = [];
$output['totalRegisters'] = $totalRegisters;
$output['totalFilter'] = $totalFilter;
$output['data'] = '';
$output['pagination'] = '';
/*
id	
equipment_name	
serial_number	
type_eqp	
created_at	
modified_at
*/
if (($resultEquipments) and ($numRows != 0)) {
    while ($row = $resultEquipments->fetch(PDO::FETCH_ASSOC)) {
        $output['data'] .= '<tr>';
        $output['data'] .= '<td>' . $row['id'] . '</td>';
        $output['data'] .= '<td>' . $row['equipment_name'] . '</td>';
        $output['data'] .= '<td>' . $row['serial_number'] . '</td>';
        $output['data'] .= '<td>' . $row['type_eqp'] . '</td>';
        $output['data'] .= '<td>' . $row['created_at'] . '</td>';
        $output['data'] .= '<td><a class="btn btn-warning btn-sm" href="formUpEquipment.php?id=' . $row['id'] . '">Editar</a></td>';;
        $output['data'] .= '<td><a class="btn btn-danger btn-sm" href="delEquipment.php?id=' . $row['id'] . '">Excluir</a></td>';
        
        $output['data'] .= '</tr>';
    }
} else {
    $output['data'] .= '<tr>';
    $output['data'] .= '<td colspan="7">Sem resultados</td>';
    $output['data'] .= '</tr>';
}

if ($output['totalRegisters'] > 0) {
    $totalPages = ceil($output['totalRegisters'] / $limit);

    $output['pagination'] .= '<nav>';
    $output['pagination'] .= '<ul class="pagination">';

    $initialNumber = 1;

    if(($page - 4) > 1){
        $initialNumber = $page - 4;
    }

    $finalNumber = $initialNumber + 9;

    if($finalNumber > $totalPages){
        $finalNumber = $totalPages;
    }

    for ($i = $initialNumber; $i <= $finalNumber; $i++) {
        if ($page == $i) {
            $output['pagination'] .= '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
        } else {
            $output['pagination'] .= '<li class="page-item"><a class="page-link" href="#" onclick="nextPage(' . $i . ')">' . $i . '</a></li>';
        }
    }

    $output['pagination'] .= '</ul>';
    $output['pagination'] .= '</nav>';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
