<?php
    session_start();

    include('../config.php');
    include(DBAPI);
    include(PDF);


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
                    
                    if($tipo_arquivo !== "jpg" && $tipo_arquivo !== "jpeg" && $tipo_arquivo !== "png" && $tipo_arquivo !== "webp")
                    {
                        $_SESSION['message'] = 'O arquivo deve ser uma imagem ';
                        $_SESSION['type'] = 'danger';
                    }
                    $usuario['foto'] = $nomearquivo;
                }   

                //criptografando a senha
                if(!empty($usuario['password'])) {
                    $senha = criptografia($usuario['password']);
                    $usuario['password'] = $senha;
                }

                save('usuarios', $usuario);
                header('Location: index.php');
                
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
                $old_photo = $_POST['old_photo'];

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
                    unlink('./fotos/' . $old_photo);
                    
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


      function BasicTable($header, $data, $pdf)
        {
            $pdfWidth = $pdf->GetPageWidth();
            $pdfHeight = $pdf->GetPageHeight();
            // Header
            foreach($header as $col)
                $pdf->Cell(50,7,$col,0);
                $pdf->Ln();
            // Data
            foreach($data as $row)
            {
                foreach($row as $col)
                
                if(pathinfo(basename($col), PATHINFO_EXTENSION) == 'jpg' || pathinfo(basename($col), PATHINFO_EXTENSION) == 'png' || pathinfo(basename($col), PATHINFO_EXTENSION) == 'jpeg'  ||  pathinfo(basename($col), PATHINFO_EXTENSION) == 'webp' || $col == null){
                    if($col == null){
                        $imagePath = 'http://' . SERVERNAME . BASEURL.  "usuarios/fotos/sem_foto.png";
                    }else{
                        $imagePath = 'http://' . SERVERNAME . BASEURL.  "usuarios/fotos/". $col;
                    }
                    // Mova para a próxima célula
                    $pdf->Rect($pdf->getX(), $pdf->getY(), 40, 25);
                    $pdf->Cell(50, 25, $pdf->Image($imagePath, $pdf->GetX(), $pdf->GetY(), 40, 25), 0);
                }else{
                    $pdf->Cell(50,25, $col ,1);
                } 
                $pdf->Ln(25);
            }
        }

      function pdf($p = null){
        $pdf = new PDF();

        $pdf->SetTitle('Listagem de Usuários', true);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times', '', 12);
        $pdf->SetMargins(10,10,10);
        $users = null;

        if($p){
            $users = filterWithoutPassword('%'. $p . '%');
        }else{
            $users = findUserWithoutPassword();
        }
        BasicTable(['ID', "Nome", "Username", "Foto"], $users, $pdf);
        

        $pdf->Output();
    }











?>
