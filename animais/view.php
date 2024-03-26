<?php 
    include('functions.php'); 
    view($_GET['id']);
    include(HEADER_TEMPLATE); 
?>

            <h2 class="mt-2">Animal #<?php echo $animals['id']; ?></h2>
            <hr>

            <?php if (!empty($_SESSION['message'])) : ?>
                <div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
            <?php endif; ?>

            <dl class="dl-horizontal">
                <dt>Nome</dt>
                <dd><?php echo $animals['nome']; ?></dd>

                <dt>Tipo</dt>
                <dd><?php echo $animals['tipo']; ?></dd>

                <dt>Data de Nascimento:</dt>
                <dd><?php echo formatadata($animals['dataNasc'],"d/m/Y" ) ?></dd>
            </dl>

            <dl class="dl-horizontal">
                <dt>Tutor:</dt>
                <dd><?php echo $animals['tutor']; ?></dd>

                <dt>Foto</dt>
                <dd>
                    <?php
                        if($animals['foto']){
                            echo '<img width="175px" src="fotos/' . $animals['foto'] . '">';
                        }else{
                            echo '<img width="175px" src="fotos/sem_imagem.jpg">';
                        }
                    ?>
                </dd>
            </dl>

            <div id="actions" class="row">
                <div class="col-md-12">
                <a href="edit.php?id=<?php echo $animals['id']; ?>" class="btn btn-secondary">
                   <i class="fa-solid fa-pencil"></i>Editar
                </a>
                <a href="index.php" class="btn btn-light">
                    <i class="fa-solid fa-circle-arrow-left"></i>Voltar
                </a>
                </div>
            </div>

<?php include(FOOTER_TEMPLATE); ?>