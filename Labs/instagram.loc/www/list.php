<?
$pdo =new PDO('mysql:host=localhost;port=3306;dbname=instagram', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $pdo->query('SELECT * FROM users');
$stmt->setFetchMode(PDO::FETCH_ASSOC);
?>
<table border="1">
<?while($row = $stmt->fetch()):?>
    <tr>
        <td><?=$row["id"]?></td>
        <td><?=$row["login"]?></td>
        <td><?=$row["password"]?></td>
        <td><?=$row["name"]?></td>
        <td>
            <a href="/edit.php?id=<?=$row["id"]?>">Редактировать</a>
        </td>
    </tr>
<?endwhile;?>
</table>