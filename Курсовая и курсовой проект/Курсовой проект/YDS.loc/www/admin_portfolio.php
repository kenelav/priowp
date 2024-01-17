<!DOCTYPE html>
<html><?session_start();?>
<head>
    <title>Админская панель - users_portfolio</title>
    <style>
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

<body>
    
<?php 
        $servername = "localhost";
        $username_s = "root";
        $password_s = "";
        $dbname_s = "your_digital_showcase";


if ($_SESSION['admin'] == true){

    if(isset($_POST['job']) && isset($_POST['education']) && isset($_POST['resume']) && isset($_POST['vk']) 
    && isset($_POST['tg']) && isset($_POST['bg'])){
        $user_id = $_POST['id'];
        $job = $_POST['job'];
        $job_place = $_POST['job_place'];
        $job_post = $_POST['job_post'];
        $education = $_POST['education'];
        $education_place = $_POST['education_place'];
        $resume = $_POST['resume'];
        $resume_url = $_POST['resume_url'];
        $vk = $_POST['vk'];
        $vk_url = $_POST['vk_url'];
        $tg = $_POST['tg'];
        $tg_url = $_POST['tg_url'];
        $bg= $_POST['bg'];

        if (!isset($_POST['bg'])) 
    {
        $photo = "https://uploads-ssl.webflow.com/5c8d3f1d0fcf5a3ae2c52ba3/5d826e8c2e88f893d9cdd560_texture-p-1600.jpeg";
    }
    else{
        $photo = $_POST["bg"];
    }

        $conn = new mysqli($servername, $username_s, $password_s, $dbname_s);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "UPDATE users_portfolio SET job=?, education=?, resume=?, vk=?, tg=?, job_place=?, job_post=?, education_place=?, resume_url=?, vk_url=?, tg_url=?, bg=? WHERE users_portfolio.id = ?";
        $stmt = $conn->prepare($sql);
        
            $stmt->bind_param("ssssssssssssi", $job, $education, $resume, $vk, $tg, $job_place, $job_post, $education_place, $resume_url, $vk_url, $tg_url, $bg, $user_id);
            $stmt->execute();
            sleep(3);
            header("Location: admin_portfolio.php");
            $stmt->close();
            exit();}
        


        if(isset($_POST["delete"])) {
            // Подключение к базе данных
            $servername = "localhost";
            $username_s = "root";
            $password_s = "";
            $dbname_s = "your_digital_showcase";
            // Получение id пользователя, которого нужно удалить
            if (isset($_POST['id'])) {
                $userId = $_POST['id'];     
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
                header("Resresh:2");
            }
            else{
                header('Location: main.php');
                sleep(1);
            }
        }

        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=your_digital_showcase', 'root', '');


        $stmt = $pdo->prepare("SELECT * FROM users_portfolio");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                <form action="/YDS.loc/www/admin_users.php" method="post"><button
                class="btn-new divlike rez9 block-1  col2">admin_users</button></form>

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
            <!-- Основная --><script src="/YDS.loc/www/JS/admin_port_scr.js"></script>
    <h1>Админская панель - users_portfolio</h1>

    <?php
        // Подключение к базе данных


        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=your_digital_showcase', 'root', '');


        $stmt = $pdo->prepare("SELECT * FROM users_portfolio");
        $stmt->execute();
        $portfolio = $stmt->fetchAll(PDO::FETCH_ASSOC);?>

 

        
            <table class="rtable">
            <tr><th>ID</th><th>Job</th><th>Job Place</th><th>Job Post</th><th>Education</th>
            <th>Education Place</th><th>Resume</th><th>Resume URL</th><th>VK</th><th>VK URL</th>
            <th>TG</th><th>TG URL</th><th>BG</th><th>Actions</th></tr>
            <?php if (isset($_POST["edit"])){
                $id = $_POST["id"];
                foreach ($portfolio as $user): 
                if ($user["id"] == $id){?>
                    <form action="/YDS.loc/www/admin_portfolio.php" id="Edit" method="post"><tr>
                    <td><input type="text" id="id" name="id" value="<?php echo $user['id']; ?>"></td>
                    <td><input type="text" id="job" name="job" value="<?php  echo $user['job']; ?>"></td>
                    <td><input type="text" id="job_place" name="job_place" value="<?php  echo $user['job_place']; ?>"></td>
                    <td><input type="text" id="job_post" name="job_post" value="<?php  echo $user['job_post']; ?>"></td>
                    <td><input type="text" id="education" name="education" value="<?php  echo $user['education']; ?>"></td>
                    <td><input type="text" id="education_place" name="education_place" value="<?php  echo $user['education_place']; ?>"></td>
                    <td><input type="text" id="resume" name="resume" value="<?php  echo $user['resume']; ?>"></td>
                    <td><input type="text" id="resume_url" name="resume_url" value="<?php  echo $user['resume_url']; ?>"></td>
                    <td><input type="text" id="vk" name="vk" value="<?php  echo $user['vk']; ?>"></td>
                    <td><input type="text" id="vk_url" name="vk_url" value="<?php  echo $user['vk_url'];?>"></td>
                    <td><input type="text" id="tg" name="tg" value="<?php  echo $user['tg']; ?>"></td>
                    <td><input type="text" id="tg_url" name="tg_url" value="<?php  echo $user['tg_url']; ?>"></td>
                    <td><input type="text" id="bg" name="bg" value="<?php  echo $user['bg'];?>"></td>
                    <td>
                    
                         
                    <button type="submit" name="save">Сохранить</button>
                </form>
                        <form action="/YDS.loc/www/admin_portfolio.php" method="post">
                        <input class="hidden" name="edit" value='<?php echo $user['id']?>'> 
                    <button type="submit" name="delete" onclick="return confirm('Вы уверены, что хотите удалить этот профиль?')">Удалить</button>
                </form>
                    </td>
                </tr>
                <?php }
                else{?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['job']; ?></td>
                    <td><?php echo $user['job_place']; ?></td>
                    <td><?php echo $user['job_post']; ?></td>
                    <td><?php echo $user['education']; ?></td>
                    <td><?php echo $user['education_place']; ?></td>
                    <td><?php echo $user['resume']; ?></td>
                    <td><?php echo $user['resume_url']; ?></td>
                    <td><?php echo $user['vk']; ?></td>
                    <td><?php echo $user['vk_url']; ?></td>
                    <td><?php echo $user['tg']; ?></td>
                    <td><?php echo $user['tg_url']; ?></td>
                    <td><?php echo $user['bg']; ?></td>
                    <td>
                    <form action="/YDS.loc/www/admin_portfolio.php" method="post">
                        <input class="hidden" name="id" value='<?php echo $user['id']?>'> 
                    <button type="submit" name="edit">Редактировать</button>
                </form>
                        <form action="/YDS.loc/www/admin_portfolio.php" method="post">
                        <input class="hidden" name="id" value='<?php echo $user['id']?>'> 
                    <button type="submit" name="delete" onclick="return confirm('Вы уверены, что хотите удалить этот профиль?')">Удалить</button>
                </form>
                    </td>
                </tr>
                <?php } endforeach;
            }
            else{?>
            <?php foreach ($users as $user): ?>
            <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['job']; ?></td>
                    <td><?php echo $user['job_place']; ?></td>
                    <td><?php echo $user['job_post']; ?></td>
                    <td><?php echo $user['education']; ?></td>
                    <td><?php echo $user['education_place']; ?></td>
                    <td><?php echo $user['resume']; ?></td>
                    <td><?php echo $user['resume_url']; ?></td>
                    <td><?php echo $user['vk']; ?></td>
                    <td><?php echo $user['vk_url']; ?></td>
                    <td><?php echo $user['tg']; ?></td>
                    <td><?php echo $user['tg_url']; ?></td>
                    <td><?php echo $user['bg']; ?></td>
                    <td>
                    <form action="/YDS.loc/www/admin_portfolio.php" method="post">
                        <input class="hidden" name="id" value='<?php echo $user['id']?>'> 
                    <button type="submit" name="edit">Редактировать</button>
                </form>
                        <form action="/YDS.loc/www/admin_portfolio.php" method="post">
                        <input class="hidden" name="id" value='<?php echo $user['id']?>'> 
                    <button type="submit" name="delete" onclick="return confirm('Вы уверены, что хотите удалить этот профиль?')">Удалить</button>
                </form>
                    </td>
                </tr>
                <?php endforeach; } ?>
    </table>
<?php } ?>
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