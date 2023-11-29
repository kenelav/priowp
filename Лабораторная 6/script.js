

function issurornam(phrase) {
  let nums = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
  let signs = /^[.,?!@#$%{}()*^<>]+$/;
  for (let i=0; i < phrase.length;i++) {
    if (phrase[i] in nums) {
      let err1 = "Не должно содержать цифры";
      return err1;
    }
    else {
      if (signs.test(phrase[i]))
      {
        let err2 = "Не должно содержать спецсимволы";
        return err2;
      }
      else {}
    }
  }
  return phrase;
}

function correctdate(date) {
  if (isblank(date)) {
    return "Дата рождения некорректна";
  }
  date = date.toString();
  let massiv = date.split("-");
  if (parseInt(massiv[1]) < 10) {
    massiv[1] = '0' + parseInt(massiv[1]);
  }
  else{}
  if (parseInt(massiv[2]) < 10) {
    massiv[2] = '0' + parseInt(massiv[2]);
  }
  else{}
  return "Ваша дата рождения:" + massiv[2] + "." + massiv[1] + "." + massiv[0];
  
}


function valid() {
    const output = document.getElementById('output_here');
    const form = document.getElementById('for_form');
    const book_number1 = document.getElementById('book_number1');
    const book_number2 = document.getElementById('book_number2');
    const book_number3 = document.getElementById('book_number3');
    const book_number4 = document.getElementById('book_number4');
    const book_number5 = document.getElementById('book_number5');
    const lend_year1 = document.getElementById('lend_year1');
    const lend_year2 = document.getElementById('lend_year2');
    const lend_year3 = document.getElementById('lend_year3');
    const lend_year4 = document.getElementById('lend_year4');
    const lend_year5 = document.getElementById('lend_year5');
    const surnameInput = document.getElementById('surname');
    const nameInput = document.getElementById('name');
    const patronymicInput = document.getElementById('patronymic');
    const birthdateInput = document.getElementById('birth_date');
    const selectInput = document.getElementById('select');
    const telInput = document.getElementById('tel');
    const emailInput = document.getElementById('email');
    const pers_dataInput = document.getElementById('pers_data');
    const debtInput = document.getElementById('debt');
    const newsInput = document.getElementById('news');
  
    let tooutput = [];
    let book_num1 = book_number1.value;
    let book_num2 = book_number2.value;
    let book_num3 = book_number3.value;
    let book_num4 = book_number4.value;
    let book_num5 = book_number5.value;
    let lend_y1 = lend_year1.value;
    let lend_y2 = lend_year2.value;
    let lend_y3 = lend_year3.value;
    let lend_y4 = lend_year4.value;
    let lend_y5 = lend_year5.value;
    let sur = surnameInput.value;
    let nam = nameInput.value;
    let pat = patronymicInput.value;
    let birt = birthdateInput.value;
    let sel = selectInput.value;
    let tel = telInput.value;
    let email = emailInput.value;
    let pers_data = pers_dataInput.value;
    let debt = debtInput.value;
    let news = newsInput.value;


    
    if (isblank(book_num1)){}
    else {
      tooutput.push("Номер книги 1: " + onlynums(book_num1));
    }
    if (isblank(book_num2)){}
    else {
      tooutput.push("Номер книги 2: " + onlynums(book_num2));
    }
    if (isblank(book_num3)){}
    else {
      tooutput.push("Номер книги 3: " + onlynums(book_num3));
    }
    if (isblank(book_num4)){}
    else {
      tooutput.push("Номер книги 4: " + onlynums(book_num4));
    }
    if (isblank(book_num5)){}
    else {
      tooutput.push("Номер книги 5: " + onlynums(book_num5));
    }
    tooutput.push("<br>");
    if (isblank(lend_y1)){}
    else {
      tooutput.push("Год заема 1: " + onlynums(lend_y1));
    }
    if (isblank(lend_y2)){}
    else {
      tooutput.push("Год заема 2: " + onlynums(lend_y2));
    }
    if (isblank(lend_y3)){}
    else {
      tooutput.push("Год заема 3: " + onlynums(lend_y3));
    }
    if (isblank(lend_y4)){}
    else {
      tooutput.push("Год заема 4: " + onlynums(lend_y4));
    }
    if (isblank(lend_y5)){}
    else {
      tooutput.push("Год заема 5: " + onlynums(lend_y5));
    }
    tooutput.push("<br>");
    tooutput.push("Ваша фамилия: " + issurornam(sur) + "<br>");
    tooutput.push("Ваше имя: " + issurornam(nam) + "<br>");
    if (isblank(pat)) {}
    else {
      tooutput.push("Ваше отчество: " + issurornam(pat) + "<br>");
    }
    tooutput.push(correctdate(birt) + "<br>");
    tooutput.push("Образование: " + sel + "<br>");
    tooutput.push("Ваш номер телефона: " + correcttel(tel) + "<br>");
    if (isblank(email)) {}
    else {
      tooutput.push("Ваша электронная почта: " + correctemail(email) + "<br>");
    }
    if (pers_dataInput.checked) {
      tooutput.push(pers_data + "<br>")
      }
    else {
      tooutput.push("Укажите согласие на обработку персональных данных <br>")
    }
    if (debtInput.checked) {tooutput.push(debt + "<br>")}
    else {
      
    }
    if (newsInput.checked) {tooutput.push(news + "<br>")}
    else {
      
    }





    output.outerHTML = tooutput;
    tooutput = [];
}

function isblank(elem){
  if (elem.toString() == ''){
    return true;
  }
  else {return false;}
}




function correcttel(telnum) {
    let pattern = /^(?:\+)?\d(?:[ (]+)?\d{3}(?:[ )]+)?\d{3}(?:[- ]+)?\d{2}(?:[- ]+)?\d{2}$/;
    let isvalid = pattern.test(telnum);
    if (valid) return telnum;
    else {return 'введен неправильно!';}

}

function correctemail(email) {
  let pattern = /^(?:\+)?\d(?:[ (]+)?\d{3}(?:[ )]+)?\d{3}(?:[- ]+)?\d{2}(?:[- ]+)?\d{2}$/;
  let email_val = pattern.test(email);
  if (valid) return email;
  else {return 'введена неправильно!';}

}

function onlynums(str) {
  let count = 0;
  let nums = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
  for (let i=0; i < str.length;i++) {
    if (str[i] in nums) {
      count++;
    }
    else {
      let err1 = "Должно содержать только цифры";
      return err1;
    }
  }
  if (count == str.length){
    return str;
  }
}