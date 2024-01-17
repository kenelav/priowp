<!DOCTYPE html>
<html><?php session_start(); ?>

<head>
    <title>Личный кабинет</title>
    <style>
        .profile-block {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }

        .avatar {
            width: 150px;
            height: 150px;
            margin: 10px;

        }
        .heig {
            height: 520px;
        }

        
    </style>
    <link rel="stylesheet" href="CSS/normalize.css" />
    <link rel="stylesheet" href="CSS/main.css" />
</head>

<body>
    <div class="row">
        <div class="rez8 rez_m_8 rez_b_7">
            <div class="block-2 col1 logo">
                <!-- Логотип -->
                <img src="img/logo.png" class="logo">
            </div>
        </div>
        <div class="rez5 rez_m_5 rez_b_7">
            <div class="block-2 col1 <?php echo isset($_SESSION['user_id']) ? '' : 'dash' ?>">
                <!-- Статус -->
                <div class="block-2 col1 centrify <?php echo isset($_SESSION['user_id']) ? '' : 'dash' ?>">
                    <?php
                    if (isset($_SESSION['user_id']) && $_SESSION['user_id']) {
                    ?>
                        Вы авторизованы
                    <?php
                    } else { ?>
                        <form action="/YDS.loc/www/login.php" method="post"><button class="custom-btn btn-13">Войти</button>
                        </form>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <!-- Главная -->
        <form action="/YDS.loc/www/main.php" method="post"><button class="btn-new divlike rez9 block-1 rez_m_5 rez_b_5 col2">Главная</button></form>
        <div class="rez9 rez_m_8 rez_b_8">
            <div class="row">
                <!-- Портфолио -->
                <form action="/YDS.loc/www/portfolio.php" method="post"><button class="btn-new divlike block-1 rez7 rez_m_7 rez_b_7 col2">Портфолио</button></form>
                <!-- Профиль -->
                <form action="/YDS.loc/www/profile.php" method="post"><button class="btn-new divlike block-1 rez7 rez_m_7 rez_b_7 col3">Профиль</button></form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="rez9 rez_m_9 rez_b_9 col4 heig centrify">
            <!-- Основная -->
            <?php

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "your_digital_showcase";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                $sql = "SELECT * FROM users WHERE id = $user_id";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();
            ?>
                    <div class="profile-block centrify algn_l col4">
                        <img src="<?php echo $user['photo']; ?>" alt="Аватар пользователя" class="avatar">
                        <div class="profile-block col4 ">
                            <strong>Логин:</strong> <?php echo $user['login']; ?><br>
                            <strong>Фамилия:</strong> <?php echo $user['surname']; ?><br>
                            <strong>Имя:</strong> <?php echo $user['name']; ?><br>
                            <strong>Отчество:</strong> <?php echo $user['patronymic']; ?><br>
                            <strong>Электронная почта:</strong> <?php echo $user['email']; ?><br>
                            <strong>Дата рождения:</strong> <?php echo $user['birth_date']; ?><br>
                            <strong>Номер телефона:</strong> <?php echo $user['tel']; ?><br>
                            <strong>Пароль:</strong> <span style="color:transparent;"><?php echo $user['password']; ?></span>
                        </div><p>
                        <div class="col4">
                        <form action="/YDS.loc/www/edit.php" method="post">
                            <button type="submit" class="regbtn">Редактировать</button>
                        </form>
                        <form action="/YDS.loc/www/profile.php" method="post">
                            <button type="submit" name="delete" class="regbtn" onclick="return confirm('Вы уверены, что хотите удалить свой профиль?')">Удалить</button>
                            <form action="/YDS.loc/www/profile.php" method="post">
                                <button type="submit" class="regbtn" name="logout">Выйти</button>
                            </form></div>
                        </form></p>
                    </div>
                <?php
                } else {
                    echo "Пользователь не найден";
                }
            } else {
                echo "ID пользователя не передан";
                sleep(1);
                header("Location: login.php");
                die();
            }
            $conn->close();
            if (isset($_POST["delete"])) {
                // Подключение к базе данных
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "your_digital_showcase";
                // Получение id пользователя, которого нужно удалить
                if (isset($_SESSION['user_id'])) {
                    $userId = $_SESSION['user_id'];

                    // Удаление пользователя из таблицы users
                    $conn = new mysqli($servername, $username, $password, $dbname);
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
                    $conn_portfolio = new mysqli($servername, $username, $password, $dbname);
                    if ($conn_portfolio->connect_error) {
                        die("Ошибка подключения: " . $conn_portfolio->connect_error);
                    }
                    $sql_portfolio = "DELETE FROM users_portfolio WHERE id = $userId";
                    if ($conn_portfolio->query($sql_portfolio) === true) {
                        echo "<script>alert('Портфолио пользователя успешно удалено!');</script>";
                        session_destroy();
                    } else {
                        echo "Ошибка удаления портфолио пользователя: " . $conn_portfolio->error;
                    }

                    $conn_portfolio->close();

                    // Перенаправление на страницу профиля
                    echo '<script>window.location.href = "/YDS.loc/www/main.php";</script>';
                }
            }
            if (isset($_POST['logout'])) {
                session_unset();
                header('Location: login.php');
            }
                ?>
                    </div>
        </div>
        <div class="row">
            <div class="rez7 rez_m_7 rez_b_7">
                <!-- Подвал -->
                <div class="block-2 col5">
                    <!-- Админ -->
                    <?php
                    if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                    ?>Админ, посмотри сюда:<p></p>
                    <form action="/YDS.loc/www/admin_users.php" method="post"><button class="custom-btn btn-13">Админская
                            панель</button></form>
                <?php
                    } else {
                    }
                ?>
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