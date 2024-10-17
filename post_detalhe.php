<!DOCTYPE html>
<?php
    require_once 'INCLUDES/funcoes.php';
    require_once 'CORE/conexao_mysql.php';
    require_once 'CORE/sql.php';
    require_once 'CORE/mysql.php';

    foreach($_GET as $indice => $dado){
        $$indice = limparDados($dado);
    }

    $posts = buscar(
        'post',
        [
            'titulo',
            'data_postagem',
            'texto',
            '(select nome from usuario where usuario.id = post.id_usuario) as nome'
        ],
        [
            ['id','=',$post]
        ]
    );
    $post = $posts[0];
    $data_post = date_create($post['data_postagem']);
    $data_post = date_format($data_post, 'd/m/Y H:i:s');

?>
<html lang="pt-br">
<head>
    <title><?php echo $post['titulo']?></title>
    <link rel="stylesheet" href="LIB/bootstrap-4.2.1-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    include 'INCLUDES/topo.php';
                ?>
            </div>
        </div>
        <div class="row" style="min-height: 500px;">
            <div class="col-md-12">
                <?php include 'INCLUDES/menu.php'; ?>
            </div>
            <div class="col-md-10" style="padding-top: 50px;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $post['titulo'] ?></h5>
                    <h5 class="card-subtilte mb-2 text-muted">
                        <?php echo $data_post ?> Por <?php $post['nome'] ?>
                    </h5>
                    <div class="card-text">
                        <?php echo html_entity_decode($post['texto']) ?>
                    </div>
                </div>
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