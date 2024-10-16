<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="LIB/bootstrap-4.2.1-dist/css/bootstrap.min.css">
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
            <?php include 'INCLUDES/menu.php';?>
            </div>
            <div class="col-md-10" style="padding-top: 50px;">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form action="CORE/usuario_repositorio.php" method="post">
                        <input type="hidden" name="acao" value="login">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="text" name="email" id="email" class="form-control" require="required">
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input type="password" name="senha" id="senha" class="form-control" require="required">
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success">Acessar</button>
                        </div>
                    </form>
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