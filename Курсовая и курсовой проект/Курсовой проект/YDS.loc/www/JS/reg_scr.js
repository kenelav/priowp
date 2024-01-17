window.addEventListener('DOMContentLoaded', function() {
  document.getElementById('Register').addEventListener('submit', function(event) {
    event.preventDefault();
    validateForm();

  });
});

function validateForm() {
  var login = document.getElementById('login').value;
  var surname = document.getElementById('surname').value;
  var name = document.getElementById('name').value;
  var patronymic = document.getElementById('patronymic').value;
  var email = document.getElementById('email').value;
  var date_of_birth = document.getElementById('date_of_birth').value;
  var tel = document.getElementById('tel').value;
  var password = document.getElementById('password').value;
  var password2 = document.getElementById('password2').value;
  var avatar_img = document.getElementById('avatar_img').value;
  var errors = [];


  loginsigns = /^[a-zA-Z]+$/;
  if (!loginsigns.test(login)) {
    errors.push('Логин должен содержать только латинские буквы');
  }
  
  var fiosigns = /^[а-яА-Яa-zA-Z]+$/;
  if (!fiosigns.test(surname)) {
    errors.push('Фамилия должна содержать только русские или латинские буквы');
  }
  if (!fiosigns.test(name)) {
    errors.push('Имя должно содержать только русские или латинские буквы');
  }
  if (patronymic){
  if (!fiosigns.test(patronymic)) {
    errors.push('Отчество должно содержать только русские или латинские буквы');
  }}
  
  emailsigns = /^[\w]{1}[\w-\.]*@[\w-]+\.[a-z]{2,4}$/i;
  if (!emailsigns.test(email)) {
    errors.push('Проверьте, правильно ли заполнено поле "Электронная почта"');
  }
  if (!date_of_birth) {
    errors.push('Проверьте, правильно ли заполнено поле "Дата рождения"');
  }
  
  var phonesigns = /^(?:\+)?\d(?:[ (]+)?\d{3}(?:[ )]+)?\d{3}(?:[- ]+)?\d{2}(?:[- ]+)?\d{2}$/;
  if (!phonesigns.test(tel)) {
    errors.push('Телефон должен содержать только цифры и соответствовать одному из форматов записи');
  }
  
  var passwordsigns = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

  if (!passwordsigns.test(password)){
    errors.push('Пароль должен содержать цифры, латинские буквы и быть длиной от 8 символов');
  }
  if (password != password2) {
    errors.push('Пароли не совпадают');

  }
  if (avatar_img){
  source = /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;;
  if (!source.test(avatar_img)) {
    errors.push('Указана недействительная ссылка на фотографию');
  }}

  if (errors.length > 0) {
    alert("Ошибки при заполнении");
    document.getElementById("errorDiv").innerHTML = errors.join(". <br>");
    
    // alert(errors.join(", "));

  }
  else{
    document.getElementById('Register').submit();

    
  }
}
  

 