<?php
include('functions.php');

index();

include(HEADER_TEMPLATE);
?>

<header class="mt-2">
    <div class="row">
        <div class="col-sm-6">
            <h2>Clientes</h2>
        </div>
        <div class="col-sm-6 text-right h2">
            <a class="btn btn-secondary" href="add.php"><i class="fa-solid fa-user-plus"></i> Novo Cliente</a>
            <a class="btn btn-light" href="index.php"><i class="fa-solid fa-refresh"></i> Atualizar</a>
        </div>
    </div>
</header>

<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <!--  clear_messages(); -->
<?php endif; ?>

<hr>
<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th width="30%">Nome</th>
            <th>Tutor</th>
            <th>Tipo</th>
            <th>Data de nascimento</th>
            <th>Foto</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($animals) : ?>
            <?php foreach ($animals as $animal) : 
                      $deleteLink = "delete.php?id=" . $animal['id'];
                
                ?>
                <tr>
                    <td><?php echo $animal['id']; ?></td>
                    <td><?php echo $animal['nome']; ?></td>
                    <td><?php echo $animal['tutor']; ?></td>
                    <td><?php echo $animal['tipo']; ?></td>
                    <td><?php echo formatadata($animal['dataNasc'], "Y-m-d H:i:s"); ?></td>
                    <td><?php echo formatadata($animal['dataNasc'], "Y-m-d H:i:s"); ?></td>
                    <td><?php
                        if($animal['foto']){
                            echo '<img width="100px" src="fotos/'. $animal['foto'] .'"';
                        }else{
                            echo '<img width="100px" src="fotos/sem_imagem.jpg"';
                        }
                    ?></td>
                    <td class="actions text-start">
                        <a href="view.php?id=<?php echo $animal['id']; ?>" class="btn btn-sm btn-light"><i class="fa fa-eye"></i> Visualizar</a>
                        <a href="edit.php?id=<?php echo $animal['id']; ?>" class="btn btn-sm btn-secondary"><i class="fa fa-pencil"></i> Editar</a>

                        <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" 
                        data-bs-custumer="<?php echo $animal['id'];?>" data-bs-target="#exampleModal">
                             <i class="fa fa-trash"></i>Excluir
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="6">Nenhum registro encontrado.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>



<?php
//entao ele quer 1 modal pra todos os links, 
//criar uma function com js pra passar o link do id no http e o modal usar isso?

include('modal.php');
include(FOOTER_TEMPLATE);
?>