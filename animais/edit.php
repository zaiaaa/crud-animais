<?php 
require_once('functions.php');
edit();
include(HEADER_TEMPLATE); ?>

            <h2 class="mt-2">Atualizar Cliente</h2>

            <?php
                if(!isset($_SESSION["message"])){
                    var_dump($_SESSION["type"]);
                }
            ?>

            <form action="edit.php?id=<?php echo $animal['id']; ?>" method="post" enctype="multipart/form-data">
                <hr />
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" name="animal[nome]" value="<?php echo $animal['nome']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="campo2">Tutor</label>
                        <input type="text" class="form-control" name="animal['tutor']" value="<?php echo $animal['tutor']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="campo3">Tipo</label>
                        <input type="text" class="form-control" name="animal['tipo']" value="<?php echo $animal['tipo']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="campo3">Data de nascimento</label>
                        <input type="date" class="form-control" name="animal['dataNasc']" value="<?php echo $animal['dataNasc']; ?>">
                    </div>
                </div>
                <div class="row">
                    <?php 
                        $foto = "";
                        if (empty($usuario['foto'])) {
                            $foto = "sem_imagem.jpg";
                        } else {
                            $foto = $usuario['foto'];
                        }
                    ?>
                    <div class="form-group col-md-4">
                        <label for="campo1">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" value="fotos/<?php echo $foto; ?>">
                    </div>
                        
                    <div class="form-group col-md-2">
                        <label for="pre">Pré-Visualização</label>
                        <img class="form-control shadow p-2 mb-2 bg-body rounded" id="imgPreview" src="fotos/<?php echo $foto ;?>" alt="Foto do usuário" srcset="">
                    </div>
                </div>

                    <div class="form-group col-md-2">   
                        <input type="text" class="form-control" name="old_photo" id="secret_input" value="<?php echo $animal['foto']; ?>">
                    </div>
                </div>
                
                <div id="actions" class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-sd-card"></i> Salvar</button>
                        <a href="index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Cancelar</a>
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