<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Таблица умножения</title>
    <link rel="stylesheet" href="/labs/lab8/style1.css">
</head>
<body>
<table>
    <tr>
        <?for($i=1;$i<=5;$i++):?>
        <td>
            <?for($j=1;$j<=10;$j++):?>
                <div><?=$i?>x<?=$j?>=<?=$i*$j?></div>
            <?endfor;?>
        </td>
        <?endfor;?>
    </tr>
    <tr>
        <?for($i=6;$i<=10;$i++):?>
        <td>
            <?for($j=1;$j<=10;$j++):?>
                <div><?=$i?>x<?=$j?>=<?=$i*$j?></div>
            <?endfor;?>
        </td>
        <?endfor;?>
    </tr>
</table>
</body>
</html>