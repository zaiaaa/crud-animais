<?php
    session_start();

    include('../config.php');
    include(DBAPI);

    $usuario = null;
    $usuarios = null;

    /**
     *  Listagem de Usuários
     */
    function index() {
        global $usuarios;
        if(!empty($_POST['users'])) {
            $usuarios = filter("usuarios", "%" . $_POST['users'] . "%");
        } else{
            $usuarios = find_all("usuarios");
        }
    }

    /**  
     *  Visualização de um Usuário
     */
    function view($id = null) {
        global $usuario;
        $usuario = find("usuarios", $id);
    }


    /**
    *  Cadastro de Usuários
     */
    function add() {
        if (!empty($_POST['usuario'])) {
            try{
                $usuario = $_POST['usuario'];

                if (!empty($_FILES["foto"]["name"])) {
                    // Upload da foto
                    $pasta_destino = "fotos/";
                    

                    $tipo_arquivo = strtolower(pathinfo(basename($_FILES["foto"]["name"]), PATHINFO_EXTENSION)); 

                    $nomearquivo = uniqid() . "." . $tipo_arquivo;  // extensão do arquivo
                    //pasta onde ficam as fotos

                    $arquivo_destino = $pasta_destino . $nomearquivo;
                   
                     //Caminho completo até o arquivo que será gravado
                    $tamanho_arquivo = $_FILES["foto"]["size"]; //tamanho do arquivo em bytes
                    $nome_temp = $_FILES["foto"]["tmp_name"]; // nome e caminho do arquivo no servidor
                    
                   
                    
                    // Chamda do da função upload para gravar uma imagem
                    upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);
                
                    $usuario['foto'] = $nomearquivo;
                }   

                //criptografando a senha
                if(!empty($usuario['password'])) {
                    $senha = criptografia($usuario['password']);
                    $usuario['password'] = $senha;
                }

                if($tipo_arquivo !== "jpg" && $tipo_arquivo !== "jpeg" && $tipo_arquivo !== "png" && $tipo_arquivo !== "webp")
                {
                    $_SESSION['message'] = 'O arquivo deve ser uma imagem ';
		            $_SESSION['type'] = 'danger';
                }else{
                    save('usuarios', $usuario);
                    header('Location: index.php');
                }
            }catch(Exception $e){
                $_SESSION['message'] = 'Aconteceu um erro: ' . $e->getMessage();
		        $_SESSION['type'] = 'danger';
            }
        }
    }

    
    /**
     *	Atualizacao/Edicao de Usuario
    */
    function edit() {

        //$now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
        try {
            if (isset($_GET['id'])) {
        
            $id = $_GET['id'];
        
            if (isset($_POST['usuario'])) {
        
                $usuario = $_POST['usuario'];
        
                //criptografando a senha
                if(!empty($usuario['password'])) {
                    $senha = criptografia($usuario['password']);
                    $usuario['password'] = $senha;
                }

                if (!empty($_FILES["foto"]["name"])) {
                    // Upload da foto
                    $pasta_destino = "fotos/";
                    

                    $tipo_arquivo = strtolower(pathinfo(basename($_FILES["foto"]["name"]), PATHINFO_EXTENSION)); 

                    $nomearquivo = uniqid() . "." . $tipo_arquivo;  // extensão do arquivo
                    //pasta onde ficam as fotos

                    $arquivo_destino = $pasta_destino . $nomearquivo;

                    $tamanho_arquivo = $_FILES["foto"]["size"]; //tamanho do arquivo em bytes
                    $nome_temp = $_FILES["foto"]["tmp_name"]; // nome e caminho do arquivo no servidor
                   
                    
                    // Chamda do da função upload para gravar uma imagem
                    upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);
                
                    $usuario['foto'] = $nomearquivo;
                }

                update('usuarios', $id, $usuario);
                header('location: index.php');
            } else {
        
                global $usuario;
                $usuario = find('usuarios', $id);
            } 
            } else {
            header('location: index.php');
            }
        } catch (Exception $e) {
            $_SESSION['message'] = 'Aconteceu um erro: ' . $e->getMessage();
		    $_SESSION['type'] = 'danger';
        }
}

    /**
     * Exclusão de um Usuario
     */
    function delete($id = null) {

        global $usuarios;
        $usuarios = remove('usuarios', $id);
      
        header('Location: index.php');
      }










?>
