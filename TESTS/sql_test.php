<?php
    require_once '../CORE/sql.php';

    $id = 1;
    $nome = 'murilo';
    $email = 'murilo@gmail.com';
    $senha = '123mudar';
    $dados = ['nome' => $nome,
              'email' => $email,
              'senha' => $senha];
    
    $entidade = 'usuario';
    $criterio = [['id','=', $id]];
    $campos = ['id','nome','email'];
    print_r($dados);
    echo "<br>";
    print_r($campos);
    echo "<br>";
    print_r($criterio);
    echo "<br>";

    //  Teste geracao INSERT
    $instrucao = insert($entidade, $dados);
    echo $instrucao.'<br>';

    //  Teste geracao UPDATE
    $instrucao = update($entidade, $dados);
    echo $instrucao.'<br>';

    //  Teste geracao SELECT
    $instrucao = select($entidade, $dados);
    echo $instrucao.'<br>';

    //  Teste geracao DELETE
    $instrucao = delete($entidade, $dados);
    echo $instrucao.'<br>';
?>