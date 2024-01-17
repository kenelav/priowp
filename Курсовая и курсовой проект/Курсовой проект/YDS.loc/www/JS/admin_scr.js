window.addEventListener('DOMContentLoaded', function() {
  document.getElementById('Register').addEventListener('submit', function(event) {
    event.preventDefault();
    validateForm();})
  document.getElementById('Edit').addEventListener('submit', function(event) {
    event.preventDefault();
    validateForm1();
  
});})

function validateForm() {
  var login = document.getElementById('login').value;
  var surname = document.getElementById('surname').value;
  var name = document.getElementById('name').value;
  var patronymic = document.getElementById('patronymic').value;
  var email = document.getElementById('email').value;
  var date_of_birth = document.getElementById('date_of_birth').value;
  var tel = document.getElementById('tel').value;
  var password = document.getElementById('password').value;
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

  if (avatar_img){
  source = /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;;
  if (!source.test(avatar_img)) {
    errors.push('Указана недействительная ссылка на фотографию');
  }}

  if (errors.length > 0) {
    document.getElementById("errorDiv").innerHTML = errors.join(". <br>");
    // alert(errors.join(", "));

  }
  else{
    document.getElementById('Register').submit();

    
  }
}

function validateForm1() {
  var id = document.getElementById('id_').value;
  var login = document.getElementById('login_').value;
  var surname = document.getElementById('surname_').value;
  var name = document.getElementById('name_').value;
  var patronymic = document.getElementById('patronymic_').value;
  var email = document.getElementById('email_').value;
  var date_of_birth = document.getElementById('birth_date_').value;
  var tel = document.getElementById('tel_').value;
  var password = document.getElementById('password_').value;
  var avatar_img = document.getElementById('avatar_img_').value;
  var IsAdmin = document.getElementById('IsAdmin_').value;
  var errors = [];

  var phonesigns = /^\d+$/;
  if (!phonesigns.test(id)) {
    errors.push('ID должен содержать только цифры');
  }
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
  

  if (!phonesigns.test(tel)) {
    errors.push('Телефон должен содержать только цифры и соответствовать одному из форматов записи');
  }
  
  if (IsAdmin != 0 && IsAdmin != 1){
    errors.push('IsAdmin должен принимать значения 0 или 1 (истинно/ложно)');
  }

  if (avatar_img){
  var source = /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;;
  if (!source.test(avatar_img)) {
    errors.push('Указана недействительная ссылка на фотографию');
  }}

  if (errors.length > 0) {
    // document.getElementById("errorDiv").innerHTML = errors.join(". <br>");
    alert(errors.join(", "));

  }
  else{
    document.getElementById('Edit').submit();

    
  }
}

 