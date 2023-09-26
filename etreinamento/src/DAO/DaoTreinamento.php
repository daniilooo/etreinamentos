<?php   

// include(__DIR__ . '/../database/conexao.php');
include(__DIR__ . '/../model/treinamento.php');
include(__DIR__ . '/../model/presenca.php');

class DaoTreinamento {
    private $TBL_TREINAMENTO = "treinamento";
    private $TBL_LISTA_PRESENCA = "lista_presenca";
    private $conexao;

    function __construct($conexao){
        $this->conexao = $conexao;
    }

    function adicionarTreinamento($descricaoTreinamento, $dataTreinamento, $horarioTreinamento, $instrutorTreinamento, $departamento , $conteudoTreinamento){
        
        $statusTreinamento = 1;
        
        $stmt = $this->conexao->prepare("INSERT INTO {$this->TBL_TREINAMENTO} (DESCRICAO_TREINAMENTO, DATA_TREINAMENTO, HORARIO_TREINAMENTO, INSTRUTOR, DEPARTAMENTO, CONTEUDO, STATUS_TREINAMENTO) VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param("sssiisi", strtoupper($descricaoTreinamento), $dataTreinamento, $horarioTreinamento, $instrutorTreinamento, $departamento, $conteudoTreinamento, $statusTreinamento);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    function selecionarTreinamento($idTreinamento){

        $descricaoTreinamento = null;
        $dataTreinamento = null;
        $horarioTreinamento = null;
        $instrutorTreinamento = null;
        $departamento = null;
        $conteudo = null;
        $statusTreinamento = null;

        $stmt = $this->conexao->prepare("SELECT * FROM {$this->TBL_TREINAMENTO} WHERE ID_TREINAMENTO = ?");
        $stmt->bind_param("i", $idTreinamento);
        $stmt->execute();
        $stmt->bind_result($idTreinamento, $descricaoTreinamento, $dataTreinamento, $horarioTreinamento, $instrutorTreinamento, $departamento, $conteudo, $statusTreinamento);
        $stmt->fetch();

        if($idTreinamento){
            return new Treinamento ($idTreinamento, $descricaoTreinamento, $dataTreinamento, $horarioTreinamento, $instrutorTreinamento, $departamento, $statusTreinamento, $conteudo);
        } else {
            return null;
        }

    }

    function atualizarTreinamento ($idTreinamento, $descricaoTreinamento, $dataTreinamento, $horarioTreinamento, $instrutor, $departamento, $conteudo, $statusTreinamento){
        $stmt = $this->conexao->prepare("UPDATE {$this->TBL_TREINAMENTO} SET DESCRICAO_TREINAMENTO = ?, DATA_TREINAMENTO = ?, HORARIO_TREINAMENTO = ?, INSTRUTOR = ?, DEPARTAMENTO = ?, CONTEUDO = ?, STATUS_TREINAMENTO = ? WHERE ID_TREINAMENTO = ?");
        $stmt->bind_param("sssiiii", strtoupper($descricaoTreinamento), $dataTreinamento, $horarioTreinamento, $instrutor, $departamento, $statusTreinamento, $conteudo, $idTreinamento);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    function excluirTreinamento($idTreinamento){
        $stmt = $this->conexao->prepare("DELETE FROM {$this->TBL_TREINAMENTO} WHERE ID_TREINAMENTO = ?");
        $stmt->bind_param("i", $idTreinamento);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }

    }

    function alterarStatusTreinamento ($idTreinamento, $statusTreinamento){
        $stmt = $this->conexao->prepare("UPDATE {$this->TBL_TREINAMENTO} SET STATUS_TREINAMENTO = ? WHERE ID_TREINAMENTO = ?");
        $stmt->bind_param("ii", $statusTreinamento, $idTreinamento);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }


    function inserirPresencaTreinamento($idTreinamento, $idColaborador, $horaPresenca){        
        $contagem = 0;
        $consulta = $this->conexao->prepare("SELECT COUNT(*) FROM {$this->TBL_LISTA_PRESENCA} WHERE ID_TREINAMENTO = ? AND ID_COLABORADOR = ?");
        $consulta->bind_param("ii", $idTreinamento, $idColaborador);
        $consulta->execute();
        $consulta->bind_result($contagem);
        $consulta->fetch();
        $consulta->close();    
        
        if ($contagem > 0) {
            return false;
        }    
        
        $stmt = $this->conexao->prepare("INSERT INTO {$this->TBL_LISTA_PRESENCA} VALUES (?,?,?)");
        $stmt->bind_param("iis", $idTreinamento, $idColaborador, $horaPresenca);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    

    function gerarListaPresenca($idTreinamento){
        $listaDePresenca = [];
        $idColaborador = null;        
        $horarioPresenca = null;
        
        $stmt = $this->conexao->prepare("SELECT * FROM {$this->TBL_LISTA_PRESENCA} WHERE ID_TREINAMENTO = ?");
        $stmt->bind_param("i", $idTreinamento);
        $stmt->execute();
        $stmt->bind_result($idTreinamento, $idColaborador, $horarioPresenca);

        while($stmt->fetch()){
            $presenca = new Presenca($idTreinamento, $idColaborador, $horarioPresenca);
            $listaDePresenca[] = $presenca;
        }

        $stmt->close();
        return $listaDePresenca;
    }

    function pesquisarTreinamento($descTreinamento){
        $stmt = $this->conexao->prepare("SELECT * FROM {$this->TBL_TREINAMENTO} WHERE DESCRICAO_TREINAMENTO LIKE ?");
        $descTreinamento = "%".$descTreinamento."%";
        $stmt->bind_param("s", $descTreinamento);
        $stmt->execute();

        $resultados = $stmt->get_result();
        $treinamentos = array();

        while($row = $resultados->fetch_assoc()){
            $treinamento = new Treinamento($row['ID_TREINAMENTO'], $row['DESCRICAO_TREINAMENTO'], $row['DATA_TREINAMENTO'], $row['HORARIO_TREINAMENTO'], $row['INSTRUTOR'], $row['DEPARTAMENTO'], $row['CONTEUDO'], $row['STATUS_TREINAMENTO']);
            $treinamentos[] = $treinamento;
        }

        $stmt->close();
        return $treinamentos;

    }

    function gerarListaTreinamentos(){
        $treinamentos = [];
        $idTreinamento = null;
        $descricaoTreinamento = null;
        $dataTreinamento = null;
        $horarioTreinamento = null;
        $instrutor = null;
        $departamento = null;
        $conteudo = null;
        $statusTreinamento = null;

        $stmt = $this->conexao->prepare("SELECT * FROM {$this->TBL_TREINAMENTO}");
        $stmt->execute();
        $stmt->bind_result($idTreinamento, $descricaoTreinamento, $dataTreinamento, $horarioTreinamento, $instrutor, $departamento, $conteudo, $statusTreinamento);

        while($stmt->fetch()){
            $treinamento = new Treinamento($idTreinamento, $descricaoTreinamento, $dataTreinamento, $horarioTreinamento, $instrutor, $departamento, $conteudo, $statusTreinamento);
            $treinamentos[] = $treinamento;
        }

        $stmt->close();

        return $treinamentos;
    }
    
}
?>