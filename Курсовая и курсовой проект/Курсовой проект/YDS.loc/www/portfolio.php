<!DOCTYPE html>
<html><? session_start(); ?>

<head>
    <title>Портфолио</title>
    <style>
        .heig {
            height: 800px;
        }

        h4 {
            background: rgba(0, 0, 0, 0.0);
        }
        br {
            align-self: center;
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


    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $sql_u = "SELECT * FROM users WHERE id = $user_id";
        $result_u = $conn->query($sql_u);
        $portfolio_u = $result_u->fetch_assoc();
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
            <div class="row portfolio-block col5">
                <div class="rez9 rez_m_9 rez_b_9 col5 port_block centrify" style="background-image: url('<?php echo $bg; ?>');     background-size: cover;
                        background-position: center; display: flex; height: 100%;">
                    <!-- Основная -->
                    <div class="transpar algn_c rez9 rez_m_7 rez_b_7 ">
                        <h2> <?php echo $portfolio_u['surname'] . ' ' . $portfolio_u['name']; ?>
                        </h2>
                    </div>

                    <div class="transpar algn_c rez9 rez_m_7 rez_b_7 ">
                        <h4 rez9>
                            <?php echo $portfolio_u['email']; ?>
                        </h4>
                    </div>

                    <div class="<?php echo $job_display; ?> transpar centrify rez9 rez_m_7 rez_b_7 ">
                        <div class="algn_c transpar" style="flex-direction: column;">
                            <h4 class="algn_c rez9">
                                Место работы
                                <br>
                                <div class="algn_c transpar">
                                    <?php echo $portfolio['job_place'] ? $portfolio['job_place'] : 'Пусто'; ?>
                                </div>
                            </h4><br>
                            <h4 class="algn_c rez9">Должность
                            <br>
                                <div class="algn_c transpar">
                                    <?php echo $portfolio['job_post'] ? $portfolio['job_post'] : 'Пусто'; ?>
                                </div>
                            </h4>
                        </div>
                    </div>
                    <div class="<?php echo $education_display; ?>transpar algn_c rez9 rez_m_7 rez_b_7 ">
                        <h4 class="algn_c transpar">Образование:</h4>

                        <?php echo $portfolio['education_place'] ? $portfolio['education_place'] : ' Пусто'; ?>

                    </div>
                    <div class="<?php echo $resume_display; ?> rez9 rez_m_7 rez_b_11 ">
                        <div class=" tile5 rez9 centrify">
                            <h4>
                                <a href="<?php echo $portfolio['resume_url'] ? $portfolio['resume_url'] : '#'; ?>">Резюме</a>
                            </h4>
                        </div>
                    </div>
                    <div class="<?php echo $vk_display; ?> rez9 rez_m_7 rez_b_11 ">
                        <div class="tile6  rez9 centrify">
                            <h4>
                                <a href="<?php echo $portfolio['vk_url'] ? $portfolio['vk_url'] : '#'; ?>">Вконтакте</a>
                            </h4>
                        </div>
                    </div>
                    <div class="<?php echo $tg_display; ?> rez9 rez_m_7 rez_b_11  center">
                        <div class="tile7 rez9 centrify">
                            <h4>
                                <a href="<?php echo $portfolio['tg_url'] ? $portfolio['tg_url'] : '#'; ?>">Телеграмм</a>
                            </h4>
                        </div>
                    </div>

                    <div style="background: rgba(0, 0, 0, 0)">
                        <form action="/YDS.loc/www/port_edit.php" method="post">
                            <button class="regbtn">Редактировать</button>
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
        sleep(1);
        header("Location: login.php");
    }
    $conn->close();
    ?>
</body>

</html>

