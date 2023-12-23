<?
try{
$pdo =new PDO('mysql:host=localhost;port=3306;dbname=instagram', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $pdo->query('SELECT * FROM users');
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while($row = $stmt->fetch()){
    print_r($row);
} 
//$stmt->execute();
//$stmt->closeCursor();
$stmt = null;
$pdo = null;
echo "1";
} catch(Exception $e){
    $e->getMessage();
}
?>