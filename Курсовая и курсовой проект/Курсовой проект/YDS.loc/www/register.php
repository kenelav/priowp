<!DOCTYPE html>
<html>
<head><?php session_start(); ?>
    <title>Регистрация пользователя</title>

    <link rel="stylesheet" href="CSS/normalize.css" />
    <link rel="stylesheet" href="CSS/main.css" />

    <style>
        .heig {
            height: 1400px;
        }

        .heig2 {
            height: 300px;
        }

        .full {
            width: 320px;
            height: 30px;
            border-radius: 7px;
        }
    </style>
</head>
<body>
    <?
                        if (isset($_POST['login']) && isset($_POST['surname']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['date_of_birth']) && isset($_POST['tel']) && isset($_POST['password'])) {
                            $login = $_POST['login'];
                            $surname = $_POST['surname'];
                            $name = $_POST['name'];
                            $patronymic = $_POST['patronymic'];
                            $email = $_POST['email'];
                            $date_of_birth = $_POST['date_of_birth'];
                            $tel = $_POST['tel'];
                            $password = $_POST['password'];
                            if (!isset($_POST['avatar_img'])) {
                                $photo = "https://avatars.mds.yandex.net/i?id=24ea928ef83997ec3abeaa5e719aba654499767f-9852567-images-thumbs&ref=rim&n=33&w=200&h=200";
                            }
                            $photo = $_POST['avatar_img'];


                            $pdo = new PDO('mysql:host=localhost;port=3306;dbname=your_digital_showcase', 'root', '');

                            global $pdo;
                            $stmt = $pdo->prepare("INSERT INTO users_portfolio (job, education, resume, vk, tg, bg) VALUES (?, ?, ?, ?, ?, ?)");
                            $stmt->execute(["0", "0", "0", "0", "0", "https://uploads-ssl.webflow.com/5c8d3f1d0fcf5a3ae2c52ba3/5d826e8c2e88f893d9cdd560_texture-p-1600.jpeg"]);
                            $user_id = $pdo->lastInsertId();
                            $stmt = $pdo->prepare("INSERT INTO users (id, login, surname, name, patronymic, email, birth_date, tel, password, photo, IsAdmin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                            if (isset($_POST['patronymic']) && isset($_POST['photo'])) {
                                $stmt->execute([$user_id, $login, $surname, $name, $patronymic, $email, $date_of_birth, $tel, $password, $photo, "0",]);
                                
                                $_SESSION["user_id"] = $user_id;
                                echo $login, ", Вы успешно зарегистрированы! Переадресация...";
                                sleep(3);
                                header("Location: main.php");
                                $pdo = null;
                                exit();
                            } else if (isset($_POST['patronymic'])) {
                                $stmt->execute([$user_id, $login, $surname, $name, $patronymic, $email, $date_of_birth, $tel, $password, "https://avatars.mds.yandex.net/i?id=24ea928ef83997ec3abeaa5e719aba654499767f-9852567-images-thumbs&ref=rim&n=33&w=200&h=200", "0",]);
                                
                                $_SESSION["user_id"] = $user_id;
                                echo $login, ", Вы успешно зарегистрированы! Переадресация...";
                                sleep(3);
                                header("Location: main.php");
                                $pdo = null;
                                exit();
                            } else if (isset($_POST["photo"])) {
                                $stmt->execute([$user_id, $login, $surname, $name, "", $email, $date_of_birth, $tel, $password, $photo, "0",]);
                                
                                $_SESSION["user_id"] = $user_id;
                                echo $login, ", Вы успешно зарегистрированы! Переадресация...";
                                sleep(3);
                                header("Location: main.php");
                                $pdo = null;
                                exit();
                            } else if (!isset($_POST["patronymic"]) && !isset($_POST['photo'])) {
                                $stmt->execute([$user_id, $login, $surname, $name, "", $email, $date_of_birth, $tel, $password, "https://avatars.mds.yandex.net/i?id=24ea928ef83997ec3abeaa5e719aba654499767f-9852567-images-thumbs&ref=rim&n=33&w=200&h=200", "0",]);
                                
                                echo $login, ", Вы успешно зарегистрированы! Переадресация...";
                                $_SESSION["user_id"] = $user_id;
                                sleep(3);
                                header("Location: main.php");
                                $pdo = null;
                                exit();
                            }
                        } else {
                            echo "<br>Пожалуйста, заполните все поля формы.";
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
            <div class="block-2 col1 ">
                <!-- Статус -->
                <div class="block-2 col1 ">
                <div id="errorDiv" class="col5 centrify" style="color: red;"></div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <!-- Главная -->
        <form action="/YDS.loc/www/main.php" method="post"><button class="btn-new  col2  block-1 rez9 rez_m_5 rez_b_5 divlike">Главная</button></form>
        <div class="rez9 rez_m_8 rez_b_8">
            <div class="row">
                <!-- Портфолио -->
                <form action="/YDS.loc/www/portfolio.php" method="post"><button class="  block-1 rez7 rez_m_7 rez_b_7 col2 btn-new divlike">Портфолио</button></form><!-- Профиль -->
                <form action="/YDS.loc/www/profile.php" method="post"><button class="divlike btn-new  block-1 rez7 rez_m_7 rez_b_7 col2">Профиль</button></form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="rez9 rez_m_9 rez_b_9 col4 heig centrify">
            <!-- Основная -->
            <script src="/YDS.loc/www/JS/reg_scr.js"></script>
            <div class="col5 algn_c">
                <h2 class='align_c'>Регистрационная форма</h2>
                <form class="col5 algn_c" method="post" action="" id="Register">
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

                    <label for="2_password"><span class="red_form">*</span>Повторите пароль:</label><br>
                    <input class="full" type="password" id="password2" name="2_password" placeholder="*Пароль еще раз" required><br><br>

                    <label for="avatar_img">Ссылка на аватар:</label><br>
                    <input class="full" type="text" id="avatar_img" name="avatar_img" placeholder="Ссылка на аватар"><br><br>
                    <p class=" centrify"><button class="full algn_c centrify">Зарегистрироваться</button></p>

                    <span class="red_form">*</span> - обязательные поля для заполнения

                    

                </form>
                
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
                <form action="/YDS.loc/www/admin_users.php" method="post"><button class="custom-btn btn-13">Админская панель</button></form>
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