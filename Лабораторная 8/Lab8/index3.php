<!DOCTYPE html>
<html>
<head>
    <title>Регистрация пользователя</title>
</head>
<body>
    <h2>Регистрационная форма</h2>
    <form method="get" action="/labs/lab8/index4.php">
        <label for="surname">Фамилия:</label> 
        <input type="text" id="surname" name="surname" required><br><br>
        <label for="name">Имя:</label> 
        <input type="text" name="name" id="name" required><br><br>
        <label for="patronymic">Отчетство:</label> 
        <input type="text" id="patronymic" name="patronymic" required><br><br>

        <label for="login">Логин:</label>
        <input type="text" id="login" name="login" required><br><br>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="date_of_birth">Дата рождения:</label>
        <input type="date" id="date_of_birth" name="date_of_birth" required><br><br>

        <input type="submit" name="submit-name" value="Зарегистрироваться">
        
    </form>
    <?php
    if(isset($_GET['surname']) && isset($_GET['name']) && isset($_GET['patronymic']) && isset($_GET['login']) && isset($_GET['password']) && isset($_GET['date_of_birth'])){
        $surname = $_GET["surname"];
        $name = $_GET['name'];
        $patronymic = $_GET['patronymic'];
        $login = $_GET['login'];
        $password = $_GET['password'];
        $date_of_birth = $_GET['date_of_birth'];
        echo $name, " ", $patronymic;

        

        
        echo " Вы успешно зарегистрированы!";
    }
    else{
    
        echo "Пожалуйста, заполните все поля формы.";
    }
?>
</body>
</html>


