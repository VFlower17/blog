<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página inicial</title>
    <link rel="stylesheet" href="lib/bootstrap-4.2.1-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Topo //-->
                <?php
                    include 'INCLUDES/topo.php';
                ?>
            </div>
        </div>
        <div class="row" style="min-height: 500px;">
            <div class="col-md-12">
                <!-- Menu //-->
                <?php
                    include 'INCLUDES/menu.php';
                ?>
            </div>
            <div class="col-md-10" style="padding-top: 50px;">
                <!-- Conteúdo //-->
                <h2>Pagina Inicial</h2>
                <?php 
                    include 'INCLUDES/busca.php';
                ?>

                <?php
                    require_once 'INCLUDES/funcoes.php';
                    require_once 'CORE/conexao_mysql.php';
                    require_once 'CORE/sql.php';
                    require_once 'CORE/mysql.php';

                    foreach($_GET as $indice => $dado){
                        $$indice = limparDados($dado);
                    }

                    $data_atual = date('Y-m-d H:i:s');

                    $criterio = [
                        ['data_postagem','<=',$data_atual]
                    ];

                    if(!empty($busca)){
                        $criterio[] = [
                            'AND',
                            'texto',
                            'like',
                            "%{$busca}%"
                        ];
                    }

                    $posts = buscar(
                        'post',
                        [
                            'titulo',
                            'data_postagem',
                            'id',
                            '(select nome
                                from usuario
                                where usuario.id = post.usuario_id) as nome'
                        ],
                        $criterio,
                        'data_postagem DESC'
                    );
                ?>
                <div>
                    <div class="list-group">
                        <?php 
                        foreach($posts as $post) :
                            $data = date_create($post['data_postagem']);
                            $data = date_format($data, 'd/m/Y H:i:s');
                        ?>
                        <a href="post_detalhe.php?post=<?php echo $post['id']?>" class="list-group-item list-group-item-action">
                            <strong><?php echo $post['titulo']?></strong>
                            [<?php echo $post['nome']?>]
                            <span class="badge badge-dark"><?php echo $data?></span>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Rodapé //-->
                <?php
                    include 'INCLUDES/rodape.php';
                ?>
            </div>
        </div>
    </div>
    <script src="lib/bootstrap-4.2.1-dist/js/bootstrap.min.js"></script>
</body>
</html>