<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <link rel="stylesheet" href="LIB/bootstrap-4.2.1-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    include 'INCLUDES/topo.php';
                    include 'INCLUDES/valida_login.php';
                    if($_SESSION['login']['usuario']['adm'] !==1){
                        header('Location: index.php');
                    }
                ?>
            </div>
        </div>
        <div class="row" style="min-height: 500px;">
            <div class="col-md-12">
                <?php include 'INCLUDES/menu.php'; ?>
            </div>
            <div class="col-md-10" style="padding-top: 50px;">
                <h2>Usuários</h2>
                <?php include 'INCLUDES/busca.php'; ?>
                <?php
                    require_once 'INCLUDES/funcoes.php';
                    require_once 'CORE/conexao_mysql.php';
                    require_once 'CORE/sql.php';
                    require_once 'CORE/mysql.php';

                    foreach($_GET as $indice => $dado){
                        $$indice = limparDados($dado);
                    }

                    $data_atual = date('Y-m-d H:i-s');

                    $criterio = [];

                    if(!empty($busca)){
                        $criterio[] = ['nome', 'like', "%{$busca}%"];
                    }

                    $result = buscar(
                        'usuario',
                        [
                            'id',
                            'nome',
                            'email',
                            'data_criacao',
                            'ativo',
                            'adm'
                        ],
                        $criterio,
                        'data_criacao DESC, nome ASC'
                    );

                ?>
                <table class="table table-bordered table-hover table-striped table-responsive{-sm|-md|-lg|-xl}">
                    <thead>
                        <tr>
                            <td>Nome</td>
                            <td>E-mail</td>
                            <td>Data cadastro</td>
                            <td>Ativo</td>
                            <td>Administrador</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($result as $entidade) :
                                $data = date_create($entidade['data_criacao']);
                                $data = date_format($data, 'd/m/Y H:i:s');
                        ?>
                        <tr>
                            <td><?php echo $entidade['nome'] ?></td>
                            <td><?php echo $entidade['email'] ?></td>
                            <td><?php echo $data ?></td>
                            <td><a href='CORE/usuario_repositorio.php?acao=status&id=<?php echo $entidade['id']?>
                            &valor=<?php echo !$entidade['ativo'] ?>'><?php echo ($entidade['ativo']==1) ? 'Desativar' : 'Ativar'; ?></a></td>
                            <td><a href='CORE/usuario_repositorio.php?acao=status&id=<?php echo $entidade['id']?>
                            &valor=<?php echo !$entidade['adm'] ?>'><?php echo ($entidade['adm']==1) ? 'Rebaixar' : 'Promover'; ?></a></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>