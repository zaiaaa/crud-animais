<?php 
require_once('functions.php');
edit();
include(HEADER_TEMPLATE); 
if(!isset($_SESSION['user'])){
    header("Location: index.php");
}
?>

            <h2 class="mt-2">Atualizar Cliente</h2>

            <form action="edit.php?id=<?php echo $customer['id']; ?>" method="post">
                <hr />
                <div class="row">
                    <div class="form-group col-md-7">
                        <label for="name">Nome / Razão Social</label>
                        <input type="text" class="form-control" name="customer['name']" value="<?php echo $customer['name']; ?>">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="campo2">CNPJ / CPF</label>
                        <input type="text" class="form-control" name="customer['cpf_cnpj']" value="<?php echo $customer['cpf_cnpj']; ?>">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="campo3">Data de Nascimento</label>
                        <input type="text" class="form-control" name="customer['birthdate']" value="<?php echo $customer['birthdate']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-7">
                        <label for="campo1">Endereço</label>
                        <input type="text" class="form-control" name="customer['address']" value="<?php echo $customer['address']; ?>">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="campo2">Bairro</label>
                        <input type="text" class="form-control" name="customer['hood']" value="<?php echo $customer['hood']; ?>">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="campo3">CEP</label>
                        <input type="text" class="form-control" name="customer['zip_code']" value="<?php echo $customer['zip_code']; ?>">
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="campo1">Município</label>
                        <input type="text" class="form-control" name="customer['city']" value="<?php echo $customer['city']; ?>">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="campo2">Telefone</label>
                        <input type="text" class="form-control" id = "telefone" maxlength="15" name="customer['phone']" value="<?php echo $customer['phone']; ?>">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="campo3">Celular</label>
                        <input type="text" class="form-control" id = "celular" maxlength="15" name="customer['mobile']" value="<?php echo $customer['mobile']; ?>">
                    </div>

                    <div class="form-group col-md-1">
                        <label for="campo3">UF</label>
                        <input type="text" class="form-control" name="customer['state']" value="<?php echo $customer['state']; ?>">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="campo3">Inscrição Estadual</label>
                        <input type="text" class="form-control" name="customer['ie']" value="<?php echo $customer['ie']; ?>">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="campo3">UF</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div id="actions" class="row mt-2">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-dark">Salvar</button>
                        <a href="index.php" class="btn btn-light">Cancelar</a>
                    </div>
                </div>
            </form>

<?php include(FOOTER_TEMPLATE); ?>