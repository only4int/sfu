<?
$user_id = $_GET["id"];
$error = array();
$edit_user = array();
$has_error = false;
if(isset($_POST["submit"])){
    $edit_user = array(
        "id" => $_POST["id"],
        "login" => $_POST["login"],
        "password" => $_POST["password"],
        "name" => $_POST["name"]
    );
    if($edit_user["login"] == ""){
        $error["login"] = "Поле не заполнено";
        $has_error = true;
    }
    if($edit_user["password"] == ""){
        $error["password"] = "Поле не заполнено";
        $has_error = true;
    }
    if($edit_user["name"] == ""){
        $error["name"] = "Поле не заполнено";
        $has_error = true;
    }
    if($has_error){
        ?>
        <form action="/edit.php?id=<?=$user_id?>" method="POST">
            <input type="hidden" name="id" value="<?=$user_id?>">
            <div>
                <label for="user_login">Логин:</label>
                <input type="text" id="user_login" name="login" value="<?=$edit_user["login"]?>">
                <?if(isset($error["login"]) && $error["login"]!= ""):?><?=$error["login"];?><?endif;?>
            </div>
            <div>
                <label for="user_password">Пароль:</label>
                <input type="password" id="user_password" name="password" value="">
                <?if(isset($error["password"]) && $error["password"] != ""):?><?=$error["password"];?><?endif;?>
            </div>
            <div>
                <label for="user_name">Имя:</label>
                <input type="text" id="user_name" name="name" value="<?=$edit_user["name"]?>">
                <?if(isset($error["name"]) && $error["name"] != ""):?><?=$error["name"];?><?endif;?>
            </div>
            <div>
                <input type="submit" name="submit" value="Сохранить"/>
            </div>
        </form>        
        <?
    } else {
        $pdo =new PDO('mysql:host=localhost;port=3306;dbname=instagram', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->query("UPDATE users 
                             SET login='".$edit_user["login"]."', 
                                 password='".$edit_user["password"]."',
                                 name='".$edit_user["name"]."' 
                            WHERE id=".$user_id);
        header('Location: list.php');
    }
} else {
    $pdo =new PDO('mysql:host=localhost;port=3306;dbname=instagram', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT * FROM users WHERE id=".$user_id);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    if($user = $stmt->Fetch()){
      ?>
        <form action="/edit.php?id=<?=$user_id?>" method="POST">
            <input type="hidden" name="id" value="<?=$user_id?>">
            <div>
                <label for="user_login">Логин:</label>
                <input type="text" id="user_login" name="login" value="<?=$user["login"]?>">
            </div>
            <div>
                <label for="user_password">Пароль:</label>
                <input type="password" id="user_password" name="password" value="">
            </div>
            <div>
                <label for="user_name">Имя:</label>
                <input type="text" id="user_name" name="name" value="<?=$user["name"]?>">
            </div>
            <div>
                <button type="submit" name="submit">Сохранить</button>
            </div>
        </form>      
      <?  
    } else {
        echo "Запись не найдена. <a href='list.php'>Вернуться обратно</a>";
    }
    ?>
<?}?>