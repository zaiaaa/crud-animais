<?php
include('functions.php');


if(isset($_GET['pdf'])){
    if($_GET['pdf'] == "ok"){
        pdf();
    }else{
        pdf($_GET['pdf']);
    }
}
index();

include(HEADER_TEMPLATE);
?>

<header class="mt-2">
    <div class="row">
        <div class="col-sm-6">
            <h2>Clientes</h2>
        </div>
        <div class="col-sm-6 text-right h2">
            <?php if(isset($_SESSION['user'])): ?>
            <a class="btn btn-secondary" href="add.php"><i class="fa-solid fa-user-plus"></i> Novo Cliente</a>
            <?php else: ?>
            <a class="btn btn-secondary disabled" href="add.php"><i class="fa-solid fa-user-plus"></i> Novo Cliente</a>
            <?php endif; ?>
            <?php if($_SERVER['REQUEST_METHOD'] == "POST"): ?>
            <a class="btn btn-danger" href="index.php?pdf=<?php echo $_POST['customers']; ?>" download>Listagem</a>
            <?php else: ?>
            <a class="btn btn-danger" href="index.php?pdf=ok" download>Listagem</a>
            <?php endif;?>


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
            <th>CPF/CNPJ</th>
            <th>Telefone</th>
            <th>Atualizado em</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($customers) : ?>
            <?php foreach ($customers as $customer) : 
                      $deleteLink = "delete.php?id=" . $customer['id'];
                
                ?>
                <tr>
                    <td><?php echo $customer['id']; ?></td>
                    <td><?php echo $customer['name']; ?></td>
                    <td><?php echo $customer['cpf_cnpj']; ?></td>
                    <td><?php echo $customer['mobile']; ?></td>
                    <td><?php echo formatadata($customer['modified'], "d/m/Y H:i:s"); ?></td>
                    <td class="actions text-start">
                        <?php if(isset($_SESSION['user'])): ?>
                            <a href="view.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-light"><i class="fa fa-eye"></i> Visualizar</a>
                            <a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-secondary"><i class="fa fa-pencil"></i> Editar</a>

                            <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" 
                            data-bs-custumer="<?php echo $customer['id'];?>" data-bs-target="#exampleModal">
                                <i class="fa fa-trash"></i>Excluir
                            </button>
                        <?php else: ?>
                        <p>login necessário para ter acesso.</p>
                        <?php endif; ?>
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