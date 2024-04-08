<?php

    include("../config.php");
    require_once(DBAPI);

    if(!empty($_POST) AND (empty($_POST['login']) OR empty($_POST['senha']))){
        header("Location: ". BASEURL . "inc/login.php");
        exit;
    }

    $database = open_database();

    try {
        $usuario = $_POST['login'];
        $senha = $_POST['senha'];

        if(!empty($usuario) AND !empty($senha)) {
            $senha = criptografia($_POST['senha']);

            $stmt = $database->prepare("SELECT id, nome, user, password FROM usuarios WHERE (user = ?) AND (password = ?) LIMIT 1");
            $stmt->bindParam(1, $usuario);
            $stmt->bindParam(2, $senha);
            $stmt->execute();
            if($stmt->rowCount() > 0) {
                $dados = $stmt->fetchAll();
                // echo "<b>";
                // var_dump($dados);
                // echo "</b>";

                $id = $dados[0]["id"];
                $nome = $dados[0]["nome"];
                $user = $dados[0]["user"];
                $passwordHash = $dados[0]["password"];

                if(!empty($user)){
                    if(!isset($_SESSION)) session_start();
                    $_SESSION['message'] = "Bem-vindo ". $nome ."!";
                    $_SESSION['type'] = 'info';
                    
                    $_SESSION["id"] = $id;
                    $_SESSION["nome"] = $nome;
                    $_SESSION["user"] = $user;
                    header('Location: ../index.php');
                    // echo "<b>";
                    // var_dump($_SESSION['user']);
                    // echo "</b>";
                }else{
                    throw new PDOException("Não foi possível se conectar! Verifique seu usuário e senha.");
                    header('Location: ./login.php');
                }
            }else{
                throw new PDOException("Não foi possível se conectar! Verifique seu usuário e senha.");
                header('Location: ./login.php');
            }
        }else{
            throw new PDOException("Não foi possível se conectar! Verifique seu usuário e senha.");
            header('Location: ./login.php');
        }
    } catch (PDOException $e) {
        header('Location: ./login.php');
        $_SESSION['message'] = "Ocorreu um erro " . $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
?>

<?php if(empty($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible">
        <?php echo $_SESSION['message']?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php clear_messages(); ?>
<?php endif; ?>

<?php include(FOOTER_TEMPLATE)?>