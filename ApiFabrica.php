<?php

class Index
{
    private $action;   //Variável de recebimento GET
    private $conexao;  //Variável de conexão

    public function __construct()
    {
        $this->action = $_GET['action'];

        $this->conexao = new PDO("mysql:host=localhost:3306;dbname=manutencao_faculdade", "root", "");


        if(!empty($this->action))
        {
            if($this->action == 'logar')
            {
                $this->logar();
            }
            else if($this->action == 'registrar')
            {
                $this->registrar();
            }
            else if($this->action == 'regisChamado')
            {
                $this->regisChamado();
            }
            else if($this->action == 'getChamado')
            {
                $this->getChamado();
            }
            else if($this->action == 'getAllChamados')
            {
                $this->getAllChamados();
            }
            else if($this->action == 'regisLocal')
            {
                $this->regisLocal();
            }
            else if($this->action == 'getLocal')
            {
                $this->getLocal();
            }
            else if($this->action == 'getAllLocal')
            {
                $this->getAllLocal();
            }    
        }
    }


    /*
        Função de Login no Sistema
    */
    private function logar()
    {
        $usuario = $_GET['usuario'];
        $senha = $_GET['senha'];
        
        $stmt = $this->conexao->query("SELECT * FROM usuarios WHERE usuario = '" . $usuario . "'");
        foreach($stmt->fetchAll(PDO::FETCH_OBJ) as $linha)
        {
            if($usuario == $linha->usuario && $senha == $linha->senha)
            {
                echo json_encode($linha);
            }
            else
            {
                echo json_encode(array('status' => '500', 'mensagem' => 'Acesso não autorizado!'));
            }
        }

    }

    // Registro de Login-- INICIO

    /*
        Função de Registro de Login no Sistema
    */
    private function registrar()
    {
        $usuario = $_GET['usuario'];
        $senha = $_GET['senha'];
        $email = $_GET['email'];
        $is_admin = 0;

        $stmt = $this->conexao->prepare('INSERT INTO usuarios (usuario, senha, email, is_admin) VALUES (?,?,?,?)');
        $stmt->bindParam(1, $usuario);
        $stmt->bindParam(2, $senha);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $is_admin);

        if($stmt->execute())
        {
            echo json_encode(array('status' => '200', 'mensagem' => 'Registro feito com sucesso!'));
        }
        else
        {
            echo json_encode(array('status' => '500', 'mensagem' => 'Não foi possível registrar esse usuário!'));
        }
    }
    //Registro de Login -- FIM

    //Registro de Chamado -- FIM

    /*
        Função de Registro de Chamado no Sistema
    */
    private function regisChamado()
    {

        $campus     = $_GET['campus'];
        $bloco      = $_GET['bloco'];
        $tipo_local = $_GET['tipo_local'];
        $local      = $_GET['local'];
        $prioridade = $_GET['prioridade'];
        $detalhes   = $_GET['detalhes'];
        $st_chamado = $_GET['st_chamado'];    

        $stmt = $this->conexao->prepare('INSERT INTO chamado (campus, bloco, tipo_local, local, prioridade, detalhes, st_chamado) VALUES (?,?,?,?,?,?,?)');
        
        $stmt->bindParam(1, $campus);
        $stmt->bindParam(2, $bloco);
        $stmt->bindParam(3, $tipo_local);
        $stmt->bindParam(4, $local);
        $stmt->bindParam(5, $prioridade);
        $stmt->bindParam(6, $detalhes);
        $stmt->bindParam(7, $st_chamado);


        if($stmt->execute())
        {
            echo json_encode(array('status' => '200', 'mensagem' => 'Registro feito com sucesso!'));
        }
        else
        {
            echo json_encode(array('status' => '500', 'mensagem' => 'Não foi possível registrar esse usuário!'));
        }
    }

    /*
        Função de Retorno de Chamado específico Registrado no Sistema
    */
    private function getChamado()
    { 
        $id_chamado = $_GET['idChamado'];
        
        $stmt = $this->conexao->query("SELECT * FROM chamado WHERE id_chamado = '" . $id_chamado . "'");
        
        foreach($stmt->fetchAll(PDO::FETCH_OBJ) as $linha)
        {
            if($linha)
            {
                echo json_encode($linha);
            }
            else
            {
                echo json_encode(array('status' => '500', 'mensagem' => 'Acesso não autorizado!'));
            }
        }
    }

    /*
        Função de Retorno de todos os Chamado Registrado no Sistema
    */
    private function getAllChamados()
    {
        $listaChamados = array();

        $limit = $_GET['limite'];
        
        $stmt = $this->conexao->query("SELECT * FROM chamado LIMIT " . $limit);

        foreach($stmt->fetchAll(PDO::FETCH_OBJ) as $linha)
        {
            if($linha)
            {
                $listaChamados[] = $linha;
            }
            else
            {
                echo json_encode(array('status' => '500', 'mensagem' => 'Acesso não autorizado!'));
            }
        }
        
        echo json_encode($listaChamados);

    }

    // Registro -- FIM

    // AreaCampus -- INICIO

    /*
        Função de Registro de Local no Sistema
    */
    private function regisLocal()
    {

        $campus     = $_GET['campus'];
        $bloco      = $_GET['bloco'];
        $andar      = $_GET['andar'];
        $sala       = $_GET['sala'];
        $outro      = $_GET['outro'];   

        $stmt = $this->conexao->prepare('INSERT INTO local (campus, bloco, andar, sala, outro) VALUES (?,?,?,?,?)');
        
        $stmt->bindParam(1, $campus);
        $stmt->bindParam(2, $bloco);
        $stmt->bindParam(3, $andar);
        $stmt->bindParam(4, $sala);
        $stmt->bindParam(5, $outro);


        if($stmt->execute())
        {
            echo json_encode(array('status' => '200', 'mensagem' => 'Registro feito com sucesso!'));
        }
        else
        {
            echo json_encode(array('status' => '500', 'mensagem' => 'Não foi possível registrar esse usuário!'));
        }
    }


    /*
        Função de Retorno de Local específico Registrado no Sistema
    */
    private function getLocal()
    { 
        $id_local = $_GET['idLocal'];
        
        $stmt = $this->conexao->query("SELECT * FROM local WHERE id_local = '" . $id_local . "'");
        
        foreach($stmt->fetchAll(PDO::FETCH_OBJ) as $linha)
        {
            if($linha)
            {
                echo json_encode($linha);
            }
            else
            {
                echo json_encode(array('status' => '500', 'mensagem' => 'Acesso não autorizado!'));
            }
        }
    }


    /*
        Função de Retorno de todos os Locais Registrado no Sistema
    */
    private function getAllLocal()
    {
        $listaLocal = array();

        $limit = $_GET['limite'];
        
        $stmt = $this->conexao->query("SELECT * FROM local LIMIT " . $limit);

        foreach($stmt->fetchAll(PDO::FETCH_OBJ) as $linha)
        {
            if($linha)
            {
                $listaLocal[] = $linha;
            }
            else
            {
                echo json_encode(array('status' => '500', 'mensagem' => 'Acesso não autorizado!'));
            }
        }
        
        echo json_encode($listaLocal);

    }

    // AreaCampus -- FIM
}
