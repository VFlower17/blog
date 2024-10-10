<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POST | PpW PHP</title>
    <link rel="stylesheet" href="LIB/bootstrap-4.2.1-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    include 'INCLUDES/topo.php';
                    include 'INCLUDES/valida_login.php';
                ?>

            </div>
        </div>
        <div class="row" style="min-height: 500px;">
            <div class="col-md-12">
                <?php include 'INCLUDES/menu.php'; ?>
            </div>
            <div class="col-md-10" style="padding-top: 50px;">
                <?php
                    require_once 'INCLUDES/funcoes.php';
                    require_once 'CORE/conexao_mysql.php';
                    require_once 'CORE/sql.php';
                    require_once 'CORE/mysql.php';

                    foreach($_GET as $indice => $dado){
                        $$indice = limparDados($dado);
                    }

                    if(!empty($id)){
                        $id = (int)$id;

                        $criterio = [
                            ['id', '=', $id]
                        ];

                        $retorno = buscar(
                            'post',
                            ['*'],
                            $criterio
                        );

                        $entidade = $retorno[0];
                    }
                ?>
                <h2>Post</h2>
                <form action="CORE/post_repositorio.php" method="post">
                    <input type="hidden" name="acao" value="<?php echo empty($id) ? 'insert' : 'update' ?>">
                    <input type="hidden" name="id" value="<?php echo $entidade['id'] ?? '' ?>">
                    <div class="form-group">
                        <label for="titulo">Titulo</label>
                        <input type="text" class="form-control" require="required" id="titulo" name="titulo" value="<?php echo $entidade['titulo'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="texto">Texto</label>
                        <textarea type="text" require="required" id="texto" name="texto" rows="5" class="form-control">
                            <?php echo $entidade['texto'] ?? '' ?>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="texto">Postar em</label>
                        <?php
                            $data = (!empty($entidade['data_postagem']))?
                                explode(' ', $entidade['data_postagem'])[0] : '';
                            $hora = (!empty($entidade['data_postagem']))?
                                explode(' ', $entidade['data_postagem'])[1] : '';

                        ?>
                        <div class="row">
                            <div class="col-md-3">
                                <input type="date" require="required"
                                name="data_postagem"
                                id="data_postagem"
                                class="form-control"
                                value="<?php echo $data ?>">
                            </div>
                            <div class="col-md-3">
                                <input type="time" require="required"
                                name="hora_postagem"
                                id="hora_postagem"
                                class="form-control"
                                value="<?php echo $hora ?>">
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                    include 'INCLUDES/rodape.php';
                ?>
            </div>
        </div>
    </div>
    <script src="LIB/bootstrap-4.2.1-dist/js/bootstrap.min.js"></script>
</body>
</html>