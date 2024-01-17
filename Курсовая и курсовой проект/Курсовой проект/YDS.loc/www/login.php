<!DOCTYPE html>
<html><?php session_start(); ?>

<head>
  <title>Авторизация пользователя</title>


  <style>
    .heig {
      height: 550px;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: sans-serif;
      background: linear-gradient(#141e30, #243b55);
    }

    .login-box {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 400px;
      padding: 40px;
      transform: translate(-50%, -50%);
      background: rgba(0, 0, 0, .5);
      box-sizing: border-box;
      box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
      border-radius: 10px;
    }

    .login-box h2 {
      margin: 0 0 30px;
      padding: 0;

      text-align: center;
    }

    .login-box .user-box {
      position: relative;
    }

    .login-box .user-box input {
      width: 100%;
      padding: 10px 0;
      font-size: 16px;

      margin-bottom: 30px;
      border: none;
      border-bottom: 1px solid #fff;
      outline: none;
      background: transparent;
    }

    .login-box .user-box label {
      position: absolute;
      top: 0;
      left: 0;
      padding: 10px 0;
      font-size: 16px;

      pointer-events: none;
      transition: .5s;
    }

    .login-box .user-box input:focus~label,
    .login-box .user-box input:valid~label {
      top: -20px;
      left: 0;
      color: #03e9f4;
      font-size: 12px;
    }

    .login-box form .butto {
      position: relative;
      display: inline-block;
      padding: 10px 20px;
      color: #03e9f4;
      font-size: 16px;
      text-decoration: none;
      text-transform: uppercase;
      overflow: hidden;
      transition: .5s;
      margin-top: 40px;
      letter-spacing: 4px
    }

    .login-box .butto :hover {
      background: #03e9f4;
      color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 5px #03e9f4,
        0 0 25px #03e9f4,
        0 0 50px #03e9f4,
        0 0 100px #03e9f4;
    }

    .login-box .butto span {
      position: absolute;
      display: block;
    }

    .login-box .butto span:nth-child(1) {
      top: 0;
      left: -100%;
      width: 100%;
      height: 2px;
      background: linear-gradient(90deg, transparent, #03e9f4);
      animation: btn-anim1 1s linear infinite;
    }

    @keyframes btn-anim1 {
      0% {
        left: -100%;
      }

      50%,
      100% {
        left: 100%;
      }
    }

    .login-box .butto span:nth-child(2) {
      top: -100%;
      right: 0;
      width: 2px;
      height: 100%;
      background: linear-gradient(180deg, transparent, #03e9f4);
      animation: btn-anim2 1s linear infinite;
      animation-delay: .25s
    }

    @keyframes btn-anim2 {
      0% {
        top: -100%;
      }

      50%,
      100% {
        top: 100%;
      }
    }

    .login-box .butto span:nth-child(3) {
      bottom: 0;
      right: -100%;
      width: 100%;
      height: 2px;
      background: linear-gradient(270deg, transparent, #03e9f4);
      animation: btn-anim3 1s linear infinite;
      animation-delay: .5s
    }

    @keyframes btn-anim3 {
      0% {
        right: -100%;
      }

      50%,
      100% {
        right: 100%;
      }
    }

    .login-box span:nth-child(4) {
      bottom: -100%;
      left: 0;
      width: 2px;
      height: 100%;
      background: linear-gradient(360deg, transparent, #03e9f4);
      animation: btn-anim4 1s linear infinite;
      animation-delay: .75s
    }

    @keyframes btn-anim4 {
      0% {
        bottom: -100%;
      }

      50%,
      100% {
        bottom: 100%;
      }
    }
  </style>
  <link rel="stylesheet" href="CSS/normalize.css" />
  <link rel="stylesheet" href="CSS/main.css" />
</head>

<body><?php
      if (isset($_SESSION['user_id'])) {
        header("Location: main.php");
      } else {
        if (isset($_POST['login']) && isset($_POST['password'])) {
          $login = $_POST['login'];
          $password = $_POST['password'];
          $pdo = new PDO('mysql:host=localhost;port=3306;dbname=your_digital_showcase', 'root', '');
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          global $pdo;
          $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ? AND password = ?");
          $stmt->execute([$login, $password]);
          $IsAuth = $stmt->fetch(PDO::FETCH_ASSOC);
          $stmt = $pdo->prepare("SELECT id, IsAdmin FROM users WHERE login = ?");
          $stmt->execute([$login]);
          $result = $stmt->fetch(PDO::FETCH_ASSOC);
          $id = $result['id'];
          $isAdmin = $result['IsAdmin'];
          if ($IsAuth) {
            echo "Успех";
            if ($result['IsAdmin'] == 1) {
              sleep(1);
              $_SESSION['user_id'] = $id;
              $_SESSION['admin'] = true;
              header("Location: main.php");
              $pdo = null;
              exit();
            }
            sleep(1);
            $_SESSION['user_id'] = $id;
            header("Location: main.php");
            $pdo = null;
            exit();
          } else {
            echo "Логин или пароль введены неправильно. Попробуйте снова.";
            header("Refresh: 3; url=login.php");
            $pdo = null;
            exit();
          }
        } else {
        }
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
        <form action="/YDS.loc/www/profile.php" method="post"><button class="btn-new divlike block-1 rez7 rez_m_7 rez_b_7 col2">Профиль</button></form>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="rez9 rez_m_9 rez_b_9 col4 heig">

      <!-- Основная -->
      <div class="login-box col4 algn_c">
        <h2>Вход в аккаунт</h2>
        <form class="col4" method="post" action="">
          <div class="user-box col4">
            <input type="text" name="login" id="login" required="">
            <label>Логин</label>
          </div>
          <div class="user-box col4">
            <input type="password" name="password" id="password" required="">
            <label>Пароль</label>
          </div>
          <button name="submit-name" class="butto">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Войти
          </button>
        </form>
        <form class="" action="/YDS.loc/www/register.php" method="post"><span></span>
          <span></span>
          <span></span>
          <span></span><button class=" butto">Нет аккаунта? Зарегестрируйтесь</button>
        </form>
      </div>
      <br>
      <div class="col4 ">

      </div>
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

  <? foreach ($_POST as $key => $value) {
    unset($_POST[$key]);
  } ?>
</body>

</html>