<?php
include('functions.php');
session_start();
add();
include(HEADER_TEMPLATE);
?>

            <h2 class="mt-2">Novo animal</h2>

            <?php if (!empty($_SESSION['message'])) : ?>
                <div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
            <?php endif; ?>
            
            <form action="add.php" method="post" enctype="multipart/form-data">
                <!-- area de campos do form -->
                <hr />
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="animal[nome]" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="tipo">Tipo</label>
                        <input type="text" class="form-control" id="tipo" name="animal[tipo]" required>
                    </div>
                </div>
                
                <div class="row">

                    <div class="form-group col-md-4">
                        <label for="senha">Tutor</label>
                        <input type="text" class="form-control" id="tutor" name="animal[tutor]" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="dataNasc">Data de nascimento</label>
                        <input type="date" class="form-control" id="dataNasc" name="animal[dataNasc]" required>
                    </div>


                </div>

                <div class="row">

                    <div class="form-group col-md-4">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" >
                    </div>

                    <div class="form-group col-md-2">
                        <label for="imgPreview">Pré visualização</label>
                        <img class="form-control rounded" id="imgPreview" src="./fotos/sem_imagem.jpg" alt="" srcset="">
                    </div>

                </div>

                <div id="actions" class="row mt-2">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-sd-card"></i> Salvar</button>
                        <a href="index.php" class="btn btn-light"><i class="fa-solid fa-circle-arrow-left"></i> Cancelar</a>
                    </div>
                </div>
            </form>

<?php include(FOOTER_TEMPLATE); ?>
        <script>
            $(document).ready(() => {
                $("#foto").change(function () {
                    const file = this.files[0];
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function (event) {
                            $("#imgPreview").attr("src", event.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        </script>