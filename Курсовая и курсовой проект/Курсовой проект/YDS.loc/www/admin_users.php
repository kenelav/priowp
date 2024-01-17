<!DOCTYPE html>
<html><? session_start();?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админская панель - users</title>
    <style>

        .heig3{
            height: 500px;
        }
        .rtable {
  /*!
  // IE needs inline-block to position scrolling shadows otherwise use:
  // display: block;
  // max-width: min-content;
  */
  display: inline-block;
  vertical-align: top;
  max-width: 100%;
  overflow-x: auto;
  white-space: nowrap;
  border-collapse: collapse;
  border-spacing: 0;
}
.two-column {
  column-count: 2;
  column-gap: 20px;
}
.rtable,
.rtable--flip tbody {
  -webkit-overflow-scrolling: touch;
  background: radial-gradient(left, ellipse, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0) 75%) 0 center, radial-gradient(right, ellipse, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0) 75%) 100% center;
  background-size: 10px 100%, 10px 100%;
  background-attachment: scroll, scroll;
  background-repeat: no-repeat;
}

.rtable td:first-child,
.rtable--flip tbody tr:first-child {
  background-image: linear-gradient(to right, white 50%, rgba(255, 255, 255, 0) 100%);
  background-repeat: no-repeat;
  background-size: 20px 100%;
}

.rtable td:last-child,
.rtable--flip tbody tr:last-child {
  background-image: linear-gradient(to left, white 50%, rgba(255, 255, 255, 0) 100%);
  background-repeat: no-repeat;
  background-position: 100% 0;
  background-size: 20px 100%;
}

.rtable th {
  font-size: 18px;
  text-align: left;
  text-transform: uppercase;
  background: #c38d9e;
}

.rtable th,
.rtable td {
  padding: 6px 12px;
  border: 1px solid #d9d7ce;
}

.rtable--flip {
  display: flex;
  overflow: hidden;
  background: none;
}

.rtable--flip thead {
  display: flex;
  flex-shrink: 0;
  min-width: -webkit-min-content;
  min-width: -moz-min-content;
  min-width: min-content;
}

.rtable--flip tbody {
  display: flex;
  position: relative;
  overflow-x: auto;
  overflow-y: hidden;
}

.rtable--flip tr {
  display: flex;
  flex-direction: column;
  min-width: -webkit-min-content;
  min-width: -moz-min-content;
  min-width: min-content;
  flex-shrink: 0;
}

.rtable--flip td,
.rtable--flip th {
  display: block;
}

.rtable--flip td {
  background-image: none !important;
  border-left: 0;
}

.rtable--flip th:not(:last-child),
.rtable--flip td:not(:last-child) {
  border-bottom: 0;
}

/*!
// CodePen house keeping
*/
body {
  margin: 0;
  padding: 25px;
  color: #494b4d;
  font-size: 14px;
  line-height: 20px;
}

h1, h2, h3 {
  margin: 0 0 10px 0;
  color: #1d97bf;
}

h1 {
  font-size: 25px;
  line-height: 30px;
}

h2 {
  font-size: 20px;
  line-height: 25px;
}

h3 {
  font-size: 16px;
  line-height: 20px;
}

table {
  margin-bottom: 30px;
}

a {
  color: #ff6680;
}

code {
  background: #c38d9e;
  font-size: 12px;
}
th {
    color: black;
    font-size: 20px;
}
th {
    color: black;
    font-size: 12px;
}
    </style>
   <link rel="stylesheet" href="CSS/normalize.css" />
    <link rel="stylesheet" href="CSS/main.css" />
</head>
<?php 
        $servername = "localhost";
        $username_s = "root";
        $password_s = "";
        $dbname_s = "your_digital_showcase";


    if(isset($_POST['login_']) && isset($_POST['surname_']) && isset($_POST['name_']) && isset($_POST['email_']) && isset($_POST['birth_date_']) && isset($_POST['tel_']) && isset($_POST['password_']) && isset($_POST['IsAdmin_'])){
        $user_id = $_POST['id_'];
        $login = $_POST['login_'];
        $surname = $_POST['surname_'];
        $name = $_POST['name_'];
        $email = $_POST['email_'];
        $date_of_birth = $_POST['birth_date_'];
        $tel = $_POST['tel_'];
        $password = $_POST['password_'];

        if (!isset($_POST['avatar_img_'])) 
    {
        $photo = "https://avatars.mds.yandex.net/i?id=24ea928ef83997ec3abeaa5e719aba654499767f-9852567-images-thumbs&ref=rim&n=33&w=200&h=200";
    }
else{
    $photo = $_POST["avatar_img_"];
}

    if (!isset($_POST['patronymic_'])) 
    {
        $patronymic = "";
    }
else {
    $patronymic = $_POST["patronymic_"];
}

        $conn = new mysqli($servername, $username_s, $password_s, $dbname_s);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "UPDATE users SET login=?, surname=?, name=?, patronymic=?, email=?, birth_date=?, tel=?, photo=?, IsAdmin=? WHERE users.id = ?";
        $stmt = $conn->prepare($sql);
        
            $stmt->bind_param("sssssssssi", $login, $surname, $name, $patronymic, $email, $date_of_birth, $tel, $photo, $IsAdmin, $user_id);
            $stmt->execute();
            sleep(3);
            header("Location: admin_users.php");
            $stmt->close();
            exit();

    }

if(isset($_POST["delete"])) {

    if (isset($_POST['id'])) {
        $userId = $_POST['id'];    

        // Удаление пользователя из таблицы users
        $conn = new mysqli($servername, $username_s, $password_s, $dbname_s);
        if ($conn->connect_error) {
            die("Ошибка подключения: " . $conn->connect_error);
        }
        $sql = "DELETE FROM users WHERE id = $userId";
        if ($conn->query($sql) === true) {
            echo "<script>alert('Пользователь успешно удален!');</script>";
        } else {
            echo "Ошибка удаления пользователя: " . $conn->error;
        }
        $conn->close();
        // Удаление пользователя из таблицы users_portfolio
        $conn_portfolio = new mysqli($servername, $username_s, $password_s, $dbname_s);
        if ($conn_portfolio->connect_error) {
            die("Ошибка подключения: " . $conn_portfolio->connect_error);
        }
        $sql_portfolio = "DELETE FROM users_portfolio WHERE id = $userId";
        if ($conn_portfolio->query($sql_portfolio) === true) {
            echo "<script>alert('Портфолио пользователя успешно удалено!');</script>";
            
        } else {
            echo "Ошибка удаления портфолио пользователя: " . $conn_portfolio->error;
        }
        
        $conn_portfolio->close();

 
        header("Resresh:2");
    }
    else{

      header('Location: main.php');
    }}

        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=your_digital_showcase', 'root', '');


        $stmt = $pdo->prepare("SELECT * FROM users");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

<body><?
if ($_SESSION['admin'] == true){
if(isset($_POST['login']) && isset($_POST['surname']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['date_of_birth']) && isset($_POST['tel']) && isset($_POST['password'])){
    $login = $_POST['login'];
    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $patronymic = $_POST['patronymic'];
    $email = $_POST['email'];
    $date_of_birth = $_POST['date_of_birth'];
    $tel = $_POST['tel'];
    $password = $_POST['password'];
    if (!isset($_POST['avatar_img'])) 
{
    $photo = "https://avatars.mds.yandex.net/i?id=24ea928ef83997ec3abeaa5e719aba654499767f-9852567-images-thumbs&ref=rim&n=33&w=200&h=200";
}
    $photo = $_POST['avatar_img'];

    
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=your_digital_showcase', 'root', '');
    
    global $pdo;            
    $stmt = $pdo->prepare("INSERT INTO users_portfolio (job, education, resume, vk, tg, bg) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute(["0", "0", "0", "0", "0","https://uploads-ssl.webflow.com/5c8d3f1d0fcf5a3ae2c52ba3/5d826e8c2e88f893d9cdd560_texture-p-1600.jpeg"]);
$user_id = $pdo->lastInsertId();
    $stmt = $pdo->prepare("INSERT INTO users (id, login, surname, name, patronymic, email, birth_date, tel, password, photo, IsAdmin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (isset($_POST['patronymic']) && isset($_POST['photo'])){
        $stmt->execute([$user_id, $login, $surname, $name, $patronymic, $email, $date_of_birth, $tel, $password, $photo, "0",]);
        $pdo = null; 
    }
    else if (isset($_POST['patronymic'])){
        $stmt->execute([$user_id, $login, $surname, $name, $patronymic, $email, $date_of_birth, $tel, $password, "https://avatars.mds.yandex.net/i?id=24ea928ef83997ec3abeaa5e719aba654499767f-9852567-images-thumbs&ref=rim&n=33&w=200&h=200", "0",]);

        $pdo = null; 
        
    }
    else if (isset($_POST["photo"])){
        $stmt->execute([$user_id, $login, $surname, $name, "", $email, $date_of_birth, $tel, $password, $photo, "0",]);

        $pdo = null; 
        
    }
    else if ( !isset($_POST["patronymic"]) && !isset($_POST['photo'])){
        $stmt->execute([$user_id, $login, $surname, $name, "", $email, $date_of_birth, $tel, $password, "https://avatars.mds.yandex.net/i?id=24ea928ef83997ec3abeaa5e719aba654499767f-9852567-images-thumbs&ref=rim&n=33&w=200&h=200", "0",]);
        $pdo = null; 
    }
    header('Refresh: 2');
    exit();
}
?>
    <div class="row">
        <div class="rez8 rez_m_8 rez_b_7">
            <div class="block-2 col1 logo">
                <!-- Логотип -->
                <img src="img/logo.png" class="logo">
            </div>
        </div>
        <div class="rez5 rez_m_5 rez_b_7">
            <div class="block-2 col1 <?php echo isset($_SESSION['user_id']) ? '' : 'dash'?>">
                <!-- Статус -->
                <div class="block-2 col1 centrify <?php echo isset($_SESSION['user_id']) ? '' : 'dash'?>">
                <form action="/YDS.loc/www/admin_portfolio.php" method="post"><button
                class="btn-new divlike rez9 block-1  col2">admin_portfolio</button></form>

                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <!-- Главная -->
        <form action="/YDS.loc/www/main.php" method="post"><button
                class="btn-new divlike rez9 block-1 rez_m_5 rez_b_5 col2">Главная</button></form>
        <div class="rez9 rez_m_8 rez_b_8">
            <div class="row">
                <!-- Портфолио -->
                <form action="/YDS.loc/www/portfolio.php" method="post"><button
                        class="btn-new divlike block-1 rez7 rez_m_7 rez_b_7 col2">Портфолио</button></form>
                <!-- Профиль -->
                <form action="/YDS.loc/www/profile.php" method="post"><button
                        class="btn-new divlike block-1 rez7 rez_m_7 rez_b_7 col2">Профиль</button></form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="rez9 rez_m_9 rez_b_9 col4 heig">
            <!-- Основная -->
    <script src="/YDS.loc/www/JS/admin_scr.js"></script>





    <h1 >Админская панель - users</h1>

    <!-- Таблица с пользователями -->
    <table class="rtable ">
        <tr>
            <th>ID</th>
            <th>Login</th>
            <th>Surname</th>
            <th>Name</th>
            <th>Patronymic</th>
            <th>Email</th>
            <th>Birth Date</th>
            <th>Tel</th>
            <th>Password</th>
            <th>Photo</th>
            <th>IsAdmin</th>
            <th>Actions</th>
        </tr>
    <?php if (isset($_POST["edit"])){
        $id = $_POST["id_"];
        foreach ($users as $user): 
        if ($user["id"] == $id){?>
            <form action="/YDS.loc/www/admin_users.php" method="post" id="Edit"><tr>
            <td><input type="text" id="id_" name="id_" value="<?php echo $user['id']; ?>"></td>
            <td><input type="text" id="login_" name="login_" value="<?php  echo $user['login']; ?>"></td>
            <td><input type="text" id="surname_" name="surname_" value="<?php  echo $user['surname']; ?>"></td>
            <td><input type="text" id="name_" name="name_" value="<?php  echo $user['name']; ?>"></td>
            <td><input type="text" id="patronymic_" name="patronymic_" value="<?php  echo $user['patronymic']; ?>"></td>
            <td><input type="text" id="email_" name="email_" pattern="^[\w]{1}[\w\-\.]*@[\w\-]+\.[a-z]{2,4}$" value="<?php  echo $user['email']; ?>"></td>
            <td><input type="text" id="birth_date_" name="birth_date_" value="<?php  echo $user['birth_date']; ?>"></td>
            <td><input type="text" id="tel_" name="tel_" pattern="^(?:\+)?\d(?:[ \(]+)?\d{3}(?:[ \)]+)?\d{3}(?:[- ]+)?\d{2}(?:[- ]+)?\d{2}$" value="<?php  echo $user['tel']; ?>"></td>
            <td><input type="text" id="password_" name="password_" value="<?php  echo $user['password']; ?>"></td>
            <td><input type="text" id="avatar_img_" name="avatar_img_" value="<?php  echo $user['photo'];?>"></td>
            <td><input type="text" id="IsAdmin_" name="IsAdmin_" value="<?php  echo $user['IsAdmin']; ?>"></td>
            <td>
            
                 
            <button type="submit" name="save">Сохранить</button>
        </form>
                <form action="/YDS.loc/www/admin_users.php" method="post">
                <input class="hidden" name="edit" value='<?php echo $user['id']?>'> 
            <button type="submit" name="delete" onclick="return confirm('Вы уверены, что хотите удалить этот профиль?')">Удалить</button>
        </form>
            </td>
        </tr>
        <?php }
        else{?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['login']; ?></td>
            <td><?php echo $user['surname']; ?></td>
            <td><?php echo $user['name']; ?></td>
            <td><?php echo $user['patronymic']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['birth_date']; ?></td>
            <td><?php echo $user['tel']; ?></td>
            <td><?php echo $user['password']; ?></td>
            <td><?php echo $user['photo']; ?></td>
            <td><?php echo $user['IsAdmin']; ?></td>
            <td>
            <form action="/YDS.loc/www/admin_users.php" method="post">
                <input class="hidden" name="id" value='<?php echo $user['id']?>'> 
            <button type="submit" name="edit">Редактировать</button>
        </form>
                <form action="/YDS.loc/www/admin_users.php" method="post">
                <input class="hidden" name="id" value='<?php echo $user['id']?>'> 
            <button type="submit" name="delete" onclick="return confirm('Вы уверены, что хотите удалить этот профиль?')">Удалить</button>
        </form>
            </td>
        </tr>
        <?php } endforeach;
    }
    else{
    ?>


        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['login']; ?></td>
            <td><?php echo $user['surname']; ?></td>
            <td><?php echo $user['name']; ?></td>
            <td><?php echo $user['patronymic']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['birth_date']; ?></td>
            <td><?php echo $user['tel']; ?></td>
            <td><?php echo $user['password']; ?></td>
            <td><?php echo $user['photo']; ?></td>
            <td><?php echo $user['IsAdmin']; ?></td>
            <td>
            <form action="/YDS.loc/www/admin_users.php" method="post">
                <input class="hidden" name="id_" value='<?php echo $user['id']?>'> 
            <button type="submit" name="edit">Редактировать</button>
        </form>
                <form action="/YDS.loc/www/admin_users.php" method="post">
                <input class="hidden" name="id" value='<?php echo $user['id']?>'> 
            <button type="submit" name="delete" onclick="return confirm('Вы уверены, что хотите удалить этот профиль?')">Удалить</button>
        </form>
            </td>
        </tr>
        <?php endforeach; }?>
    </table>

    <!-- Форма для добавления нового пользователя -->
    <h2 class='align_c col4 rez9 dash algn_c centrify'>Добавить нового пользователя</h2>
    <div class="col4 rez9 algn_c centrify dash heig3" style="opacity: 0.9;">
                
                <form class="col4 algn_c two-column dash " method="post" action="/YDS.loc/www/admin_users.php" id="Register">
                <label for="login"><span class="red_form">*</span>Логин:</label><br>
                    <input class="full" type="text" id="login" name="login" placeholder="*Логин" required><br><br>

                    <label for="surname"><span class="red_form">*</span>Фамилия:</label><br>
                    <input class="full" type="text" id="surname" name="surname" placeholder="*Фамилия" required><br><br>

                    <label for="name"><span class="red_form">*</span>Имя:</label><br>
                    <input class="full" type="text" name="name" id="name" placeholder="*Имя" required><br><br>

                    <label for="patronymic">Отчетство:</label><br>
                    <input class="full" type="text" id="patronymic" name="patronymic" placeholder="Отчество"><br><br>

                    <label for='email'><span class="red_form">*</span>Адрес электронной почты:</label><br>
                    <input class="full" type='email' id='email' name='email' placeholder="*Адрес вашей электронной почты" class="email" pattern="^[\w]{1}[\w\-\.]*@[\w\-]+\.[a-z]{2,4}$" required /><br>
                    <p class=" algn_l">

                        <span class="red_form">*</span>Дата рождения:<br>
                    </p>
                    <input class="full" type="date" name="date_of_birth" id="date_of_birth" required><br><br>

                    <label for='tel'><span class="red_form">*</span> Номер телефона:</label><br>
                    <input class="full" type='tel' id='tel' name='tel' placeholder="* Ваш номер телефона +7(___)___-__-__" class="tel" required pattern="^(?:\+)?\d(?:[ \(]+)?\d{3}(?:[ \)]+)?\d{3}(?:[- ]+)?\d{2}(?:[- ]+)?\d{2}$" /><br><br>

                    <label for="password"><span class="red_form">*</span>Пароль:</label><br>
                    <input class="full" type="password" id="password" name="password" placeholder="*Пароль" required><br><br>

                    <label for="avatar_img">Ссылка на аватар:</label><br>
                    <input class="full" type="text" id="avatar_img" name="avatar_img" placeholder="Ссылка на аватар"><br><br>
                    <p class=" centrify"><button class="full algn_c centrify">Добавить</button></p>

                    <span class="red_form">*</span> - обязательные поля для заполнения
        <?}
        ?></div>
    </form>
    
    </div>
    </div>
    <div class="row">
        <div class="rez7 rez_m_7 rez_b_7">
            <!-- Подвал -->
            <div class="block-2 col5">
                <!-- Админ -->

                <div id="errorDiv" style="color: red;"></div>

            </div>
        </div>
        <div class="rez7 rez_m_7 rez_b_7">
            <div class="block-2 col5 algn_r">
                <!-- О разработчике -->
                <p>Сайт написан для курсовой работы по дисциплине
                    <br>"Проектирование, разработка и оптимизация web-приложений"
                    <br>Автор сайта - Кене Л.Н., гр. УБ22-09Б
                    <br>Сибирский Федеральный Университет
                    <br>Институт управления бизнес-процессами
                    <br>Кафедра Бизнес-информатики и моделирования бизнес-процессов
            </div>
        </div>
    </div>

</body>

</html>