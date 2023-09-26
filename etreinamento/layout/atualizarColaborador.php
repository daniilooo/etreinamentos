<?php
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION["user_id"])) {
    // O usuário não está logado, redirecione para a página de login
    header("Location: ../index.php");
    exit();
}

// O usuário está logado, continue exibindo o conteúdo da página protegida
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Cadastro do Colaborador</title>
    <link rel="icon" href="../imagens/favicon.ico" type="image/x-icon">
    <!-- Inclua o link para o Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../estilo/estilo.css"> -->
    <style>
        .thumbColad,
        img {
            height: 100px;
            width: auto;
        }
    </style>
</head>
<?php

include(__DIR__ . '/../src/database/conexao.php');
include(__DIR__ . '/../src/DAO/DaoColaborador.php');
include(__DIR__ . '/../src/DAO/DaoDepartamento.php');
include(__DIR__ . '/../src/DAO/DaoEmpresa.php');
include(__DIR__ . '/../src/Util/Util.php');

$idColaborador = null;
if (isset($_GET['idColaborador'])) {
    $idColaborador = $_GET['idColaborador'];
}

$conexao = new Conexao();
$daoColaborador = new DaoColaborador($conexao->conectar());
$daoDepartamento = new DaoDepartamento($conexao->conectar());
$daoEmpresa = new DaoEmpresa($conexao->conectar());

$colaborador = $daoColaborador->selecionarColaborador($idColaborador);
$listaDeDepartamentos = $daoDepartamento->gerarListaDepartamentos();
$listaDeEmpresas = $daoEmpresa->gerarListaEmpresas();

function retornarNomeDepartamento($daoDepartamento, $idDepartamento){
    $departamento = $daoDepartamento->selecionarDepartamento($idDepartamento);
    return $departamento->getNomeDepartamento();
}

function retornarNomeEmpresa($daoEmpresa, $idEmpresa){
    $empresa = $daoEmpresa->selecionarEmpresa($idEmpresa);
    return $empresa->getNomeEmpresa();
}

$util = new Util();
?>

<body>
    <div id="menu-container">
        <!-- O menu será carregado aqui -->
    </div>

    <div class="container mt-5">
        <h1>Alterar Cadastro do Colaborador</h1>
        <div class="row">
            <!-- Coluna para a foto -->
            <div class="col-md-4">
                <img src="<?php echo $util->montarCaminhoFoto("../imagens/colaboradores/", $colaborador->getMatriculadoColaborador()); ?>"
                    alt="<?php echo $colaborador->getNomeColaborador(); ?>" class="img-fluid">
            </div>
            <!-- Coluna para o formulário -->
            <div class="col-md-8">
                <form action="../src/actions/processarAtualizacao.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto do Colaborador:</label>
                        <input type="file" class="form-control" name="foto" id="foto">
                    </div>
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" name="nome" id="nome"
                            value="<?php echo $colaborador->getNomeColaborador() ?>">
                    </div>
                    <div class="mb-3">
                        <label for="matricula" class="form-label">Matrícula:</label>
                        <input type="text" class="form-control" name="matricula" id="matricula"
                            value="<?php echo $colaborador->getMatriculadoColaborador() ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="cargo" class="form-label">Cargo:</label>
                        <input type="text" class="form-control" name="cargo" id="cargo"
                            value="<?php echo $colaborador->getCargo() ?>">
                    </div>
                    <div class="mb-3">
                        <label for="departamento" class="form-label">Departamento:</label>
                        <select name="departamento" id="departamento" class="form-control">
                            <option value="<?php echo $colaborador->getDepartamentoColaborador()?>" select><?php echo retornarNomeDepartamento($daoDepartamento, $colaborador->getDepartamentoColaborador())?></option>
                            <?php foreach($listaDeDepartamentos as $departamento){
                                if($departamento->getStatusDepartamento() == 1) {?>
                                <option value="<?php echo $departamento->getIdDepartamento()?>"><?php echo $departamento->getNomeDepartamento()?></option>
                            <?php }}?>     
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="empresa" class="form-label">Empresa:</label>
                        <select name="empresa" id="empresa" class="form-control">
                            <option value="<?php echo $colaborador->getIdEmpresaColaborador()?>" select><?php echo retornarNomeEmpresa($daoEmpresa, $colaborador->getIdEmpresaColaborador())?></option>
                            <?php foreach($listaDeEmpresas as $empresa){
                                if($empresa->getStatusEmpresa() == 1){?>
                                <option value="<?php echo $empresa->getIdEmpresa()?>"><?php echo $empresa->getNomeEmpresa()?></option>   
                            <?php } }?>        
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cracha" class="form-label">Crachá:</label>
                        <input type="text" class="form-control" name="cracha" id="cracha"
                            value="<?php echo $colaborador->getCrachaColaborador() ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    <a href="gerenciarColaboradores.php" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>


    <!-- Inclua os scripts do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</body>
<script>
    // Use JavaScript para carregar o conteúdo do menu.html no elemento com o ID "menu-container"
    fetch('menusuperior.html')
        .then(response => response.text())
        .then(menuHTML => {
            document.getElementById('menu-container').innerHTML = menuHTML;
        })
        .catch(error => {
            console.error('Erro ao carregar o menu:', error);
        });
</script>

</html>