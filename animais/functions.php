<?php
    session_start();
    include('../config.php');
    include(DBAPI);

    $animals = null;
    $animal = null;

    /**
     *  Listagem de Clientes
     */
    function index() {
        global $animals;
        $animals = find_all("animal");
    }

    /**
     *  Visualização de um Cliente
     */
    function view($id = null) {
        global $animals;
        $animals = find("animal", $id);
    }

    /**
    *  Cadastro de Clientes
     */
    function add() {
        clear_messages();
        if (!empty($_POST['animal'])) {
            try{
                $animal = $_POST['animal'];

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
                
                    $animal['foto'] = $nomearquivo;
                    if($tipo_arquivo !== "jpg" && $tipo_arquivo !== "jpeg" && $tipo_arquivo !== "png" && $tipo_arquivo !== "webp")
                    {
                        $_SESSION['message'] = 'O arquivo deve ser uma imagem ';
                        $_SESSION['type'] = 'danger';
                    }    
                }   

                save('animal', $animal);
                header('Location: index.php');

            }catch(Exception $e){
                $_SESSION['message'] = 'Aconteceu um erro: ' . $e->getMessage();
		        $_SESSION['type'] = 'danger';
            }
        }
    }

    
    /**
     *	Atualizacao/Edicao de Cliente
    */
    function edit() {
        //$now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
        try {
            if (isset($_GET['id'])) {
            $id = $_GET['id'];
            

            if (isset($_POST['animal'])) {
        
                $animal = $_POST['animal'];
                $old_photo = $_POST['old_photo'];

                if (!empty($_FILES["foto"]["name"])) {
                    // Upload da foto
                    $pasta_destino = "fotos/";
                    

                    $tipo_arquivo = strtolower(pathinfo(basename($_FILES["foto"]["name"]), PATHINFO_EXTENSION)); 

                    $nomearquivo = uniqid() . "." . $tipo_arquivo;  // extensão do arquivo
                    //pasta onde ficam as fotos

                    $arquivo_destino = $pasta_destino . $nomearquivo;

                    $tamanho_arquivo = $_FILES["foto"]["size"]; //tamanho do arquivo em bytes
                    $nome_temp = $_FILES["foto"]["tmp_name"]; // nome e caminho do arquivo no servidor
                   
                    
                    // Chamada do da função upload para gravar uma imagem
                    upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);
                    unlink("./fotos/" . $old_photo);
                
                    $animal['foto'] = $nomearquivo;
                    if($tipo_arquivo !== "jpg" && $tipo_arquivo !== "jpeg" && $tipo_arquivo !== "png" && $tipo_arquivo !== "webp")
                    {
                        $_SESSION['message'] = 'O arquivo deve ser uma imagem ';
                        $_SESSION['type'] = 'danger';
                        header('Location: index.php');
                    }
                }

                update('animal', $id, $animal);
                header('Location: index.php');
                
            } else {
                global $animal;
                $animal = find('animal', $id);
            }
            } else {
            header('location: index.php');
            }
        } catch (Exception $e) {
            $_SESSION['message'] = 'Aconteceu um erro: ' . $e->getMessage();
		    $_SESSION['type'] = 'danger';
            header('Location: index.php');
        }
    }

    function delete($id = null) {

        global $animal;
        $animal_photo = find('animal', $id);
        unlink("./fotos/" . $animal_photo["foto"]);
        $animal = remove('animal', $id);
      
        header('location: index.php');
      }

?>
