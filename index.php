<?php
if(!isset($_SESSION)) session_start();
include 'config.php';
include DBAPI;
include(HEADER_TEMPLATE);
$db = open_database();

?>

            <hr>
            <h1>Dashboard</h1>

            <?php if ($db) : ?>

                <?php if(isset($_SESSION['user'])): ?>
                <div class="row mb-2">
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                        <a href="customers/add.php" class="btn btn-secondary">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <i class="fa fa-user-plus fa-5x"></i>
                                </div>
                                <div class="col-xs-12 text-center">
                                    <p>Novo Cliente</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php else: ?>
                        <div class="row mb-2">
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                        <a href="customers/add.php" class="btn btn-secondary disabled">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <i class="fa fa-user-plus fa-5x"></i>
                                </div>
                                <div class="col-xs-12 text-center">
                                    <p>Novo Cliente</p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                        <a href="customers" class="btn btn-light">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <i class="fa-solid fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-12 text-center">
                                    <p>Clientes</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <?php if(isset($_SESSION['user'])): ?>
                <div class="row mb-2">
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                        <a href="animais/add.php" class="btn btn-secondary">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <i class="fa fa-plus fa-5x"></i>
                                </div>
                                <div class="col-xs-12 text-center">
                                    <p>Novo Animal</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php else: ?>
                        <div class="row mb-2">
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                        <a href="animais/add.php" class="btn btn-secondary disabled">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <i class="fa fa-plus fa-5x"></i>
                                </div>
                                <div class="col-xs-12 text-center">
                                    <p>Novo Animal</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endif; ?> 

                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                        <a href="animais" class="btn btn-light">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <i class="fa-solid fa-paw fa-5x"></i>
                                </div>
                                <div class="col-xs-12 text-center">
                                    <p>Animais</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                 
                <?php if(isset($_SESSION['user'])): ?>
                    <?php if($_SESSION['user'] == "admin"): ?>
                <div class="row mb-2">
                    <div class="col-xs-12 col-sm-12 col3-md-2 col-lg-2">
                        <a href="usuarios/add.php" class="btn btn-secondary">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <i class="fa fa-user-tie fa-5x"></i>
                                </div>
                                <div class="col-xs-12 text-center">
                                    <p>Novo Usuário</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                        <a href="usuarios" class="btn btn-light">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <i class="fa-solid fa-users-gear fa-5x"></i>
                                </div>
                                <div class="col-xs-12 text-center">
                                    <p>Usuários</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>     
            <?php else : ?>
                <!-- <div class="alert alert-danger" role="alert">
                    <p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!</p>
                </div> -->
                <?php if(!empty($_SESSION["message"])): ?>
                    <div class="alert alert-<?php echo $_SESSION['type']?> alert-dismissible" role="alert">
                        <p><strong>ERRO:</strong> Não foi possível conectar no banco de dados!<br>
                        <?php echo $_SESSION['message']; ?></p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                <?php clear_messages();?>
                <?php endif; ?>
            <?php endif; ?>


<?php
include(FOOTER_TEMPLATE);
?>