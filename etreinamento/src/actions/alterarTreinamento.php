<?php

include(__DIR__ . '/../database/conexao.php');
include(__DIR__ . '/../DAO/DaoTreinamento.php');

$idTreinamento = $_GET['idTreinamento'];
$descricao = $_GET['descricao'];
$instrutor = $_GET['instrutor'];
$data = $_GET['data'];
$hora = $_GET['horario'];
$departamento = $_GET['departamento'];
$status = $_GET['status'];

$conexao = new Conexao();
$daoTreinamento = new DaoTreinamento($conexao->conectar());

if($daoTreinamento->atualizarTreinamento($idTreinamento, $descricao, $data, $hora, $instrutor, $departamento, $status)){
    header("Location: ../../layout/gerenciarTreinamento.php");
    exit();    
} else {
    header("Location: ../../layout/gerenciarTreinamento.php");
    exit();
}

?>