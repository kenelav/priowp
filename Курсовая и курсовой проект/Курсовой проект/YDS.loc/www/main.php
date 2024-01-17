<!DOCTYPE html>
<html>

<head>
  <style>
    .tile {
      width: 250px;
      height: 250px;
      display: inline-block;
      margin: 10px;
      text-align: center;
      color: white;
      border-radius: 10px;
    }

    *,
    *:before,
    *:after {
      box-sizing: border-box;
    }

    body {
      font-family: -apple-system, ".SFNSText-Regular", "Helvetica Neue", "Roboto", "Segoe UI", sans-serif;
    }


    .toggle {
      cursor: pointer;
      display: inline-block;
    }

    .toggle-switch {
      display: inline-block;
      background: #ccc;
      border-radius: 16px;
      width: 58px;
      height: 32px;
      position: relative;
      vertical-align: middle;
      transition: background 0.25s;
    }

    .toggle-switch:before,
    .toggle-switch:after {
      content: "";
    }

    .toggle-switch:before {
      display: block;
      background: linear-gradient(to bottom, #fff 0%, #eee 100%);
      border-radius: 50%;
      box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.25);
      width: 24px;
      height: 24px;
      position: absolute;
      top: 4px;
      left: 4px;
      transition: left 0.25s;
    }

    .toggle:hover .toggle-switch:before {
      background: linear-gradient(to bottom, #fff 0%, #fff 100%);
      box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.5);
    }

    .toggle-checkbox:checked+.toggle-switch {
      background: #56c080;
    }

    .toggle-checkbox:checked+.toggle-switch:before {
      left: 30px;
    }

    .toggle-checkbox {
      position: absolute;
      visibility: hidden;
    }

    .toggle-label {
      margin-left: 5px;
      position: relative;
      top: 2px;
    }
  </style>
  <link rel="stylesheet" href="CSS/normalize.css" />
  <link rel="stylesheet" href="CSS/main.css" />
</head>

<body>
  <?php session_start(); ?>
  <div class="row">
    <div class="rez8 rez_m_8 rez_b_7">
      <div class="block-2 col1 logo">
        <!-- Логотип -->
        <img src="img/logo.png" class="logo">
      </div>
    </div>
    <div class="rez5 rez_m_5 rez_b_7"> <!-- Статус -->
      <div class="block-2 col1 centrify <?php echo isset($_SESSION['user_id']) ? '' : 'dash' ?>">
        <?php
        if (isset($_SESSION['user_id']) && $_SESSION['user_id']) {
        ?>
          Вы авторизованы
        <?php
        } else { ?>
          <form action="/YDS.loc/www/login.php" method="post"><button class="custom-btn btn-13">Войти</button></form>

        <?php }
        ?>

      </div>
    </div>
  </div>
  <div class="row">

    <!-- Главная -->
    <form action="/YDS.loc/www/main.php" method="post"><button class="btn-new divlike rez9 block-1 rez_m_5 rez_b_5 col3">Главная</button></form>
    <div class="rez9 rez_m_8 rez_b_8">
      <div class="row">
        <!-- Портфолио -->
        <form action="/YDS.loc/www/portfolio.php" method="post"><button class="btn-new divlike block-1 rez7 rez_m_7 rez_b_7 col2">Портфолио</button></form>
        <!-- Профиль -->
        <form action="/YDS.loc/www/profile.php" method="post"><button class="btn-new divlike block-1 rez7 rez_m_7 rez_b_7 col2">Профиль</button></form>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="rez9 rez_m_9 rez_b_9">
      <div class="col4">
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
        if (isset($_POST['id'])) {
          $id = $_POST['id'];
          if (!empty($_POST)) {
            if (!empty($_POST['job'])) {
              $job = '1';
            } else {
              $job = '0';
            }
            if (!empty($_POST['education'])) {
              $education = '1';
            } else {
              $education = '0';
            }
            if (!empty($_POST['resume'])) {
              $resume = '1';
            } else {
              $resume = '0';
            }
            if (!empty($_POST['vk'])) {
              $vk = '1';
            } else {
              $vk = '0';
            }
            if (!empty($_POST['tg'])) {
              $tg = '1';
            } else {
              $tg = '0';
            }
            $sql = "UPDATE users_portfolio SET job=?, education=?, resume=?, vk=?, tg=? WHERE users_portfolio.id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iiiiii", $job, $education, $resume, $vk, $tg, $id);
            $stmt->execute();
            $stmt->close();
          }
        }


        $conn->close();
        ?><?php
            $id = 0;
            if (isset($_SESSION['user_id'])) {
              $id = $_SESSION['user_id'];
              $conn = new mysqli($servername, $username, $password, $dbname);
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }
              $sql = "SELECT * FROM users_portfolio WHERE id = " . $id;
              $result = $conn->query($sql);
              $row = $result->fetch_assoc();
              $conn->close();
            ?>
        <form id="save-form" action="/YDS.loc/www/main.php" method="POST">
          <div class="tile tile1">
            <h2>Фамилия и Имя</h2>
            <p>Установлено по умолчанию</p><label class="toggle">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="checkbox" checked onclick="return false" class="toggle-checkbox">
              <div class="toggle-switch"></div>
              <span class="toggle-label"></span>
            </label>
          </div>
          <div class="tile tile2">
            <h2>Электронная почта</h2>
            <p>Установлено по умолчанию</p><label class="toggle">
              <input type="checkbox" checked onclick="return false" class="toggle-checkbox">
              <div class="toggle-switch"></div>
              <span class="toggle-label"></span>
            </label>
          </div>
          <div class="tile tile3">
            <h2>Работа</h2>
            <p></p><label class="toggle">
              <input type="checkbox" name="job" <?php if ($row['job'] == 1) echo "checked"; ?> class="toggle-checkbox">
              <div class="toggle-switch"></div>
              <span class="toggle-label"></span>
            </label>
          </div>
          <div class="tile tile4">
            <h2>Образование</h2>
            <p></p><label class="toggle">
              <input type="checkbox" name="education" <?php if ($row['education'] == 1) echo "checked"; ?> class="toggle-checkbox">
              <div class="toggle-switch"></div>
              <span class="toggle-label"></span>
            </label>
          </div>
          <div class="tile tile5">
            <h2>Резюме</h2>
            <p></p><label class="toggle">
              <input type="checkbox" name="resume" <?php if ($row['resume'] == 1) echo "checked"; ?> class="toggle-checkbox">
              <div class="toggle-switch"></div>
              <span class="toggle-label"></span>
            </label>
          </div>
          <div class="tile tile6">
            <h2>Вконтакте</h2>
            <p></p><label class="toggle">
              <input type="checkbox" name="vk" <?php if ($row['vk'] == 1) echo "checked"; ?> class="toggle-checkbox">
              <div class="toggle-switch"></div>
              <span class="toggle-label"></span>
            </label>
          </div>
          <div class="tile tile7">
            <h2>Телеграмм</h2>
            <p></p><label class="toggle">
              <input type="checkbox" name="tg" <?php if ($row['tg'] == 1) echo "checked"; ?> class="toggle-checkbox">
              <div class="toggle-switch"></div>
              <span class="toggle-label"></span>
            </label>
          </div>
          <div class="tile tile8">
            <h2>Фон</h2>
            <p>Установлено по умолчанию</p><label class="toggle">
              <input type="checkbox" checked onclick="return false" class="toggle-checkbox">
              <div class="toggle-switch"></div>
              <span class="toggle-label"></span>
            </label>
          </div>
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <button class="tile divlike col5">Сохранить</button>

        </form><?php

              } else { ?>
        <form id="save-form" action="/YDS.loc/www/main.php" method="POST">
          <div class="tile tile1">
            <h2>Фамилия и Имя</h2>
            <p>Установлено по умолчанию</p>
            <label class="toggle">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="checkbox" checked onclick="return false" class="toggle-checkbox">
              <div class="toggle-switch"></div>
              <span class="toggle-label"></span>
            </label>
          </div>
          <div class="tile tile2">
            <h2>Электронная почта</h2>
            <p>Установлено по умолчанию</p><label class="toggle">
              <input type="checkbox" checked onclick="return false" class="toggle-checkbox">
              <div class="toggle-switch"></div>
              <span class="toggle-label"></span>
            </label>
          </div>
          <div class="tile tile3">
            <h2>Работа</h2>
            <p></p><label class="toggle">
              <input type="checkbox" name="job" class="toggle-checkbox">
              <div class="toggle-switch"></div>
              <span class="toggle-label"></span>
            </label>
          </div>
          <div class="tile tile4">
            <h2>Образование</h2>
            <p></p><label class="toggle">
              <input type="checkbox" name="education" class="toggle-checkbox">
              <div class="toggle-switch"></div>
              <span class="toggle-label"></span>
            </label>
          </div>
          <div class="tile tile5">
            <h2>Резюме</h2>
            <p></p><label class="toggle">
              <input type="checkbox" name="resume" class="toggle-checkbox">
              <div class="toggle-switch"></div>
              <span class="toggle-label"></span>
            </label>
          </div>
          <div class="tile tile6">
            <h2>Вконтакте</h2>
            <p></p><label class="toggle">
              <input type="checkbox" name="vk" class="toggle-checkbox">
              <div class="toggle-switch"></div>
              <span class="toggle-label"></span>
            </label>
          </div>
          <div class="tile tile7">
            <h2>Телеграмм</h2>
            <p></p><label class="toggle">
              <input type="checkbox" name="tg" class="toggle-checkbox">
              <div class="toggle-switch"></div>
              <span class="toggle-label"></span>
            </label>
          </div>
          <div class="tile tile8">
            <h2>Фон</h2>
            <p>Установлено по умолчанию</p><label class="toggle">
              <input type="checkbox" checked onclick="return false" class="toggle-checkbox">
              <div class="toggle-switch"></div>
              <span class="toggle-label"></span>
            </label>
          </div>
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <button class="tile divlike col5">Сохранить</button>
        </form>


      <?php
              } ?>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="rez7 rez_m_7 rez_b_7">

      <div class="block-2 col5">
        <!-- Админ -->
        <?php
        if (isset($_SESSION['admin']) && $_SESSION['admin']) {
        ?>Админ, посмотри сюда:<p>
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