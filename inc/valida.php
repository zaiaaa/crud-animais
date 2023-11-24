<?php

    include("../config.php");
    require_once(DBAPI);

    if(!empty($_POST) AND (empty($_POST['login']) OR empty($_POST['senha']))){
        header("Location: ". BASEURL . "index.php");
        exit;
    }

    $bd = open_database();

    try {
        $bd -> select_db(DB_NAME);

        $usuario = $_POST['login'];
        $senha = $_POST['senha'];

        if(!empty($usuario) AND !empty($senha)) {
            $senha = criptografia($_POST['senha']);

            $sql = "SELECT id, nome, user, password FROM usuarios WHERE (user = '". $usuario . "') LIMIT 1";
            $query = $bd -> query($sql);
            if($query->num_rows > 0) {
                $dados = $query->fetch_assoc();
                // echo "<b>";
                // var_dump($dados);
                // echo "</b>";

                $id = $dados["id"];
                $nome = $dados["nome"];
                $user = $dados["user"];
                $password = $dados["password"];

                if(!empty($user)){
                    if(!isset($_SESSION)) session_start();
                    $_SESSION['message'] = "Bem-vindo ". $nome ."!";
                    $_SESSION['type'] = 'info';
                    
                    $_SESSION["id"] = $id;
                    $_SESSION["nome"] = $nome;
                    $_SESSION["user"] = $user;
                    echo "<b>";
                    var_dump($_SESSION['user']);
                    echo "</b>";
                }else{
                    throw new Exception("Não foi possível se conectar! Verifique seu usuário e senha.");
                }
            }else{
                throw new Exception("Não foi possível se conectar! Verifique seu usuário e senha.");
            }
        }else{
            throw new Exception("Não foi possível se conectar! Verifique seu usuário e senha.");
        }
    } catch (Exception $e) {
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

<header>
    <a href="<?php echo BASEURL?>index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Voltar</a>
</header>

<?php include(FOOTER_TEMPLATE)?>