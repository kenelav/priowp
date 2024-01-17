<!DOCTYPE html>
<html><?php session_start(); ?>

<head>
    <title>Портфолио</title>
    <style>


        body {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }


        .heig {
            height: 1000px;
        }

        input,
        button {
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
    $username = "root";
    $password = "";
    $dbname = "your_digital_showcase";
    if (
        isset($_POST['job_place']) && isset($_POST['job_post']) && isset($_POST['education_place']) && isset($_POST['resume_url'])
        && isset($_POST['vk_url']) && isset($_POST['tg_url']) && isset($_POST['bg'])
    ) {
        $user_id = $_SESSION['user_id'];
        $job_place = $_POST['job_place'];
        $job_post = $_POST['job_post'];
        $education_place = $_POST['education_place'];
        $resume_url = $_POST['resume_url'];
        $vk_url = $_POST['vk_url'];
        $tg_url = $_POST['tg_url'];
        $bg = $_POST['bg'];

        if (!isset($_POST['bg'])) {
            $photo = "https://uploads-ssl.webflow.com/5c8d3f1d0fcf5a3ae2c52ba3/5d826e8c2e88f893d9cdd560_texture-p-1600.jpeg";
        } else {
            $photo = $_POST["bg"];
        }

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "UPDATE users_portfolio SET job_place=?, job_post=?, education_place=?, resume_url=?, vk_url=?, tg_url=?, bg=? WHERE users_portfolio.id = ?";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("sssssssi", $job_place, $job_post, $education_place, $resume_url, $vk_url, $tg_url, $bg, $user_id);
        $stmt->execute();
        sleep(3);
        header("Location: portfolio.php");
        $stmt->close();
        exit();
    } ?>

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
                <form action="/YDS.loc/www/portfolio.php" method="post"><button class="btn-new divlike block-1 rez7 rez_m_7 rez_b_7 col3">Портфолио</button></form>
                <!-- Профиль -->
                <form action="/YDS.loc/www/profile.php" method="post"><button class="btn-new divlike block-1 rez7 rez_m_7 rez_b_7 col2">Профиль</button></form>
            </div>
        </div>
    </div>
    <div class="row col1">
        <div class="heig col1 rez9 rez_m_9 rez_b_9 algn_c portfolio_block" style="align-items: column;  display: flex; width: 100%;">
            <!-- Основная -->
                <div id="errorDiv" class="col5 " style="color: red;"></div>
                <script src="/YDS.loc/www/JS/port_scr.js"></script>
                <?php

                $conn = new mysqli($servername, $username, $password, $dbname);
                $user_id = $_SESSION['user_id'];
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                if (isset($_SESSION['user_id'])) {

                    $sql = "SELECT * FROM users_portfolio WHERE id = $user_id";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $portfolio = $result->fetch_assoc();
                        $job_display = $portfolio['job'] == 1 ? '' : 'hidden';
                        $education_display = $portfolio['education'] == 1 ? '' : 'hidden';
                        $resume_display = $portfolio['resume'] == 1 ? '' : 'hidden';
                        $vk_display = $portfolio['vk'] == 1 ? '' : 'hidden';
                        $tg_display = $portfolio['tg'] == 1 ? '' : 'hidden';
                        $bg = $portfolio['bg'];
                ?>
                        <div class="portfolio_block center rez9 rez_m_8 rez_b_7" style="background-image: url('<?php echo $bg; ?>'); border-radius: 30px;">
                        <h2>Редактирование полей портфолио</h2> 
                            <form action='' method='post' id='Edit' class=" rez9 rez_m_9 rez_b_9 block_port_edit center">
                                <div id='errorDiv' style='color: red;'></div>
                                <div class="<?php echo $job_display; ?> transpar rez9  rez_m_9 rez_b_9">
                                    <h4>Место работы:</h4>
                                    <? echo "<input type='text' id='job_place' name='job_place' value='" . $portfolio["job_place"] . "'>";
                                    echo "<h4>Должность:</h4><input type='text' id='job_post' name='job_post' value='" . $portfolio["job_post"] . "'>"; ?>
                                </div><?
                                        ?>
                                <div class="<?php echo $education_display; ?> transpar rez9  rez_m_9 rez_b_9">
                                    <? echo "<h4>Образование:</h4><input type='text' id='education_place' name='education_place' value='" . $portfolio["education_place"] . "'>"; ?>
                                </div>
                                <div class="<?php echo $resume_display; ?> transpar rez9  rez_m_9 rez_b_9">
                                    <? echo "<h4>Резюме(ссылка):</h4><input type='text' id='resume_url' name='resume_url' value='" . $portfolio["resume_url"] . "'>"; ?>
                                </div><?
                                        ?><div class="<?php echo $vk_display; ?> transpar rez9  rez_m_9 rez_b_9">
                                    <? echo "<h4>Вконтакте(ссылка):</h4><input type='text' id='vk_url' name='vk_url' value='" . $portfolio["vk_url"] . "'>"; ?>
                                </div><?
                                        ?><div class="<?php echo $tg_display; ?> transpar rez9  rez_m_9 rez_b_9">
                                    <? echo "<h4>Телеграмм(ссылка):</h4><input type='text' id='tg_url' name='tg_url' value='" . $portfolio["tg_url"] . "'>"; ?>
                                </div><?
                                        ?><div class="transpar rez9  rez_m_9 rez_b_9">
                                    <? echo "<h4>Фон(ссылка):</h4><input type='text' id='bg' name='bg' value='" . $portfolio["bg"] . "'>"; ?>
                                </div>
                                <div class=" transpar rez9  rez_m_9 rez_b_9 centrify"><button class="regbtn ">Сохранить</button></div>

                            </form>
                        </div>

        </div>



<?php
                    } else {
                        echo "Пользователь не найден";
                    }
                } else {
                    echo "ID пользователя не передан";
                    sleep(1);
                    header("Location: login.php");
                }
                $conn->close();

?>

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