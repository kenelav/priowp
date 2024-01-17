<!DOCTYPE html>
<html>

<head><? session_start(); ?>
    <title>Редактирование профиля</title>

    <style>
        .heig {
            height: 1200px;
        }

        input {
            width: 320px;
            border-radius: 5px;
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
    if (isset($_POST['login']) && isset($_POST['surname']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['date_of_birth']) && isset($_POST['tel']) && isset($_POST['password'])) {
        $user_id = $_SESSION['user_id'];
        $login = $_POST['login'];
        $surname = $_POST['surname'];
        $name = $_POST['name'];

        $email = $_POST['email'];
        $date_of_birth = $_POST['date_of_birth'];
        $tel = $_POST['tel'];
        $password = $_POST['password'];

        if (!isset($_POST['avatar_img'])) {
            $photo = "https://avatars.mds.yandex.net/i?id=24ea928ef83997ec3abeaa5e719aba654499767f-9852567-images-thumbs&ref=rim&n=33&w=200&h=200";
        } else {
            $photo = $_POST["avatar_img"];
        }

        if (!isset($_POST['patronymic'])) {
            $patronymic = "";
        } else {
            $patronymic = $_POST["patronymic"];
        }

        $conn = new mysqli($servername, $username_s, $password_s, $dbname_s);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "UPDATE users SET login=?, surname=?, name=?, patronymic=?, password=?, email=?, birth_date=?, tel=?, photo=? WHERE users.id = ?";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("sssssssssi", $login, $surname, $name, $patronymic, $password, $email, $date_of_birth, $tel, $photo, $user_id);
        $stmt->execute();
        sleep(3);
        header("Location: profile.php");
        $stmt->close();
        exit();
    } else {
        echo "Пожалуйста, заполните все поля формы.";
    }

    $conn = new mysqli($servername, $username_s, $password_s, $dbname_s);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM users WHERE id = $user_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $profile_edit = $result->fetch_assoc();
            $login = $profile_edit['login'];
            $surname = $profile_edit['surname'];
            $name = $profile_edit['name'];
            $patronymic = $profile_edit['patronymic'];
            $email = $profile_edit['email'];
            $date_of_birth = $profile_edit['birth_date'];
            $tel = $profile_edit['tel'];
            $password = $profile_edit['password'];
            $photo = $profile_edit['photo'];
    ?><div class="row">
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
                <div class="centrify heig rez9 rez_m_9 rez_b_9 col4 " style="align-items: column;">
                    <!-- Основная -->
                    <div class="col5 rez9 rez_m_8 rez_b_6  algn_c" style=" border-radius: 10px;">
                        <div id="errorDiv" class="col5" style="color: red;"></div>
                        <script src="/YDS.loc/www/JS/reg_scr.js"></script>
                        <h2>Редактирование данных</h2>
                        <form method="post" action="" id="Register">
                            <label for="login"><span class="red_form">*</span>Логин:</label>
                            <input type="text" id="login" name="login" placeholder="*Логин" value="<?php echo $login; ?>" readonly><br><br>

                            <label for="surname"><span class="red_form">*</span>Фамилия:</label>
                            <input type="text" id="surname" name="surname" value="<?php echo $surname; ?>" placeholder="*Фамилия" required><br><br>

                            <label for="name"><span class="red_form">*</span>Имя:</label>
                            <input type="text" name="name" id="name" value="<?php echo $name; ?>" placeholder="*Имя" required><br><br>

                            <label for="patronymic">Отчетство:</label>
                            <input type="text" id="patronymic" name="patronymic" value="<?php echo $patronymic; ?>" placeholder="Отчество"><br><br>

                            <label for='email'><span class="red_form">*</span>Адрес электронной почты:</label><br>
                            <input type='email' id='email' name='email' value="<?php echo $email; ?>" placeholder="*Адрес вашей электронной почты" class="email" pattern="/^[\w]{1}[\w-\.]*@[\w-]+\.[a-z]{2,4}$/i" /><br>

                            <p class=" algn_l"><span class="red_form">*</span>Дата рождения:</p>
                            <input type="date" name="date_of_birth" id="date_of_birth" value="<?php echo $date_of_birth; ?>" required><br><br>

                            <label for='tel'><span class="red_form">*</span> Номер телефона:</label><br>
                            <input type='tel' id='tel' name='tel' placeholder="* Ваш номер телефона +7(___)___-__-__" class="tel" required value="<?php echo $tel; ?>" pattern="^(?:\+)?\d(?:[ (]+)?\d{3}(?:[ )]+)?\d{3}(?:[- ]+)?\d{2}(?:[- ]+)?\d{2}$" /><br><br>

                            <label for="password"><span class="red_form">*</span>Пароль:</label>
                            <input type="password" id="password" name="password" placeholder="*Пароль" value="<?php echo $password; ?>" required><br><br>

                            <label for="2_password"><span class="red_form">*</span>Повторите пароль:</label>
                            <input type="password" id="password2" name="2_password" placeholder="*Пароль еще раз" required><br><br>

                            <label for="avatar_img">Ссылка на аватар:</label>
                            <input type="text" id="avatar_img" name="avatar_img" value="<?php echo $photo; ?>" placeholder="Ссылка на аватар"><br><br>
                            <input class="hidden" id="id" value="<?php echo $user_id; ?>">
                            <input type="submit" name="submit-name" value="Сохранить" class="regbtn">
                            <p>
                                <span class="red_form">*</span> - обязательные поля для заполнения
                            </p>
                    </div>
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

    <?php
        } else {
            echo "Пользователь не найден";
        }
    } else {
        echo "ID пользователя не передан";
        header("Location: login.php");
    }
    $conn->close();
    ?>
    </form>








</body>

</html>