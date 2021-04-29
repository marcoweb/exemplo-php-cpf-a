<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $resultado = 'Válido';
    $invalidos = [];
    for($i = 1;$i < 10; $i++) {
        $val = '';
        for($j = 0;$j < 11;$j++)
            $val .= $i;
        $invalidos[] = $val;
    }

    $cpf = $_POST['cpf'];
    if(in_array($cpf, $invalidos))
        $resultado = 'Inválido';
    
    if($resultado == 'Válido') {
        foreach(str_split($cpf) as $d)
            if(!is_numeric($d))
                $resultado = 'Inválido';
    }

    if($resultado == 'Válido') {
        $multiplicador = 10;
        $soma = 0;
        for($i = 0;$i < 9;$i++)
            $soma += $cpf[$i] * $multiplicador--;
        
        $resto = ($soma * 10) % 11;

        $digito = 0;
        if($resto < 10)
            $digito = $resto;

        if($cpf[9] != $digito)
            $resultado = 'Inválido';
    }

    if($resultado == 'Válido') {
        $multiplicador = 11;
        $soma = 0;
        for($i = 0;$i < 10;$i++)
            $soma += $cpf[$i] * $multiplicador--;
        
        $resto = ($soma * 10) % 11;

        $digito = 0;
        if($resto < 10)
            $digito = $resto;

        if($cpf[10] != $digito)
            $resultado = 'Inválido';
    }

}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Valida CPF</title>
    </head>
    <body>
        <form action="index.php" method="POST">
            <label for="cpf">CPF: </label>
            <input type="text" name="cpf" />
            <button type="submit">Validar</button>
        </form>
        <?php if(isset($resultado)): ?>
            <hr />
            <p>O CPF "<?= $cpf ?>" é <?= $resultado ?></p>

            <?php if(isset($soma)): ?>
            <p><?= $soma ?></p>
            <p><?= $resto ?></p>
            <?php endif ?>
        <?php endif ?>
    </body>
</html>