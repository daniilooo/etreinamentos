<?php

include(__DIR__ . '/../database/conexao.php');
include(__DIR__ . '/../DAO/DaoEmpresa.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexao = new Conexao();
    $daoEmpresa = new DaoEmpresa($conexao->conectar());

    $idEmpresa = $_POST['idEmpresa'];
    $nomeEmpresa = $_POST['nome'];
    $status = $_POST['status'];

    // Verifique se um arquivo de imagem foi enviado
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $extensao = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
        $nomeArquivo = $idEmpresa . '.' . $extensao; // Nome composto pelo ID da empresa e a extensão original

        // Diretório onde a imagem será salva
        $diretorioLogotipos = __DIR__ . '/../../imagens/logotipos/';

        // Caminho completo do arquivo
        $caminhoArquivo = $diretorioLogotipos . $nomeArquivo;

        // Move o arquivo enviado para o diretório desejado
        if (move_uploaded_file($_FILES['logo']['tmp_name'], $caminhoArquivo)) {
            // Atualize o caminho da foto no registro da empresa no banco de dados
            if ($daoEmpresa->atualizarEmpresa($idEmpresa, $nomeEmpresa, $status)) {
                header("Location: ../../layout/gerenciarEmpresas.php");
                exit();
            } else {
                header("Location: ../../layout/gerenciarEmpresas.php");
            }
        } else {
            echo "Erro ao fazer o upload do arquivo.";
        }
    } else {
        // Caso nenhum arquivo de imagem tenha sido enviado, atualize os outros campos da empresa no banco de dados
        if ($daoEmpresa->atualizarEmpresa($idEmpresa, $nomeEmpresa, $status)) {
            header("Location: ../../layout/gerenciarEmpresas.php");
            exit();
        } else {
            header("Location: ../../layout/gerenciarEmpresas.php");
        }
    }
}
?>