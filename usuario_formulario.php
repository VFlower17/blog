<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
    <link rel="stylesheet" href="lib/bootstrap-4.2.1-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php include 'INCLUDES/topo.php';?>
            </div>
        </div>
        <div class="row" style="min-height: 500px;">
            <div class="col-md-12">
                <?php include'INCLUDES/menu.php';?>
            </div>
            <div class="col-md-10" style="padding-top: 50px;">
                <?php 
                    require_once 'INCLUDES/funcoes.php';
                    require_once 'CORE/conexao_mysql.php';
                    require_once 'CORE/sql.php';
                    require_once 'CORE/mysql.php';

                    if(isset($_SESSION['login'])){
                        $id = (int) $_SESSION['login']['usuario']['id'];

                        $criterio = [
                            ['id','=',$id]
                        ];

                        $retorno = buscar(
                            'usuario',
                            ['id','nome','email'],
                            $criterio
                        );

                        $entidade = $retorno[0];
                    }
                ?>
                <h2>Usuário</h2>
                <form action="CORE/usuario_repositorio.php" method="post">
                    <input type="hidden" name="acao" value="<?php echo empty($id) ? 'insert' : 'update' ?>">
                    <input type="hidden" name="id" value="<?php echo $entidade['id'] ?? '' ?>">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control" require="required" value="<?php echo $entidade['nome'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="text" name="email" id="email" class="form-control" require="required" value="<?php echo $entidade['email'] ?? '' ?>">
                    </div>
                    <?php if(!isset($_SESSION['login'])): ?>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" class="form-control" require="required">
                    </div>
                    <?php endif; ?>
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
    <script src="lib/bootstrap-4.2.1-dist/js/bootstrap.min.js"></script>
</body>
</html>