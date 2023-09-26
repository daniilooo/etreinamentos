<?php 

include(__DIR__ . '/../database/conexao.php');
include(__DIR__ . '/../DAO/DaoTreinamento.php');

$conexao = new Conexao();
$daoTreinamento = new DaoTreinamento($conexao->conectar());

$descricao = $_POST['descricao'];
$instrutor = $_POST['instrutor'];
$data = $_POST['data'];
$hora = $_POST['horario'];
$departamento = $_POST['departamento'];
$conteudo = $_POST['conteudo'];
$status = $_POST['status'];



// Verifica se um arquivo foi enviado
if (isset($_FILES['material']) && $_FILES['material']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = __DIR__ . '/../../treinamentos/';
    $fileName = $_FILES['material']['name'];

    // Renomeia o arquivo com base na descrição
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $newFileName = $descricao . '.' . $ext;

    $uploadPath = $uploadDir . $newFileName;

    // Move o arquivo para o diretório de destino
    if (move_uploaded_file($_FILES['material']['tmp_name'], $uploadPath)) {
        // O arquivo foi enviado com sucesso
        // Continue com a inserção dos dados no banco de dados
        if ($daoTreinamento->adicionarTreinamento($descricao, $data, $hora, $instrutor, $departamento, $conteudo)) {
            header("Location: ../../layout/gerenciarTreinamento.php");
            exit();
        } 
    } 
} 

?>
