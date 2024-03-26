<?php

include("../config.php");
include(HEADER_TEMPLATE);

?>

<div id="actions" class="mt-5 mb-5">
    <form action="valida.php" method="post">
        <div class="row">
            <!-- user input -->
            <div class="form-floating col-12 mb-2">
                <input type="text" id="log" class="form-control" name="login" placeholder="Usuário">
                <label for="log">Usuário</label>
            </div>

            <!-- password input -->
            <div class="form-floating col-12 mb-2">
                <input type="password" id="pass" class="form-control" name="senha" placeholder="Senha">
                <label for="pass">Password</label>
            </div>

            <!-- Submit button -->
            <div class="col-12 mb-2">
                <button type="submit" class="btn btn-secondary btn-block mb-4">
                    <i class="fa-solid fa-user-check"></i> Conectar
                </button>
                <a href="<?php echo BASEURL;?>" class="btn btn-light btn-block mb-4">
                    <i class="fa-solid fa-rotate-left"></i> Cancelar
                </a>
            </div>
        </div>
    </form>
</div>

<?php include(FOOTER_TEMPLATE)?>