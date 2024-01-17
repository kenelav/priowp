window.addEventListener('DOMContentLoaded', function() {
    document.getElementById('Edit').addEventListener('submit', function(event) {
      event.preventDefault();
      validateForm1();
    
  });})
function validateForm1() {
    var id = document.getElementById('id').value;
    var job = document.getElementById('job').value;
    var job_place = document.getElementById('job_place').value;
    var job_post = document.getElementById('job_post').value;
    var education = document.getElementById('education').value;
    var education_place = document.getElementById('education_place').value;
    var resume = document.getElementById('resume').value;
    var resume_url = document.getElementById('resume_url').value;
    var vk = document.getElementById('vk').value;
    var vk_url = document.getElementById('vk_url').value;
    var tg = document.getElementById('tg').value;
    var tg_url = document.getElementById('tg_url').value;
    var bg = document.getElementById('bg').value;
    var errors = [];

    var phonesigns = /^\d+$/;
    if (!phonesigns.test(id)) {
      errors.push('ID должен содержать только цифры');
    }

    if (job != 0 && job != 1){
        errors.push('job должен принимать значения 0 или 1 (истинно/ложно)');
      }
    
      if (education != 0 && education != 1){
        errors.push('education должен принимать значения 0 или 1 (истинно/ложно)');
      }
      if (resume != 0 && resume != 1){
        errors.push('resume должен принимать значения 0 или 1 (истинно/ложно)');
      }
      if (vk != 0 && vk != 1){
        errors.push('vk должен принимать значения 0 или 1 (истинно/ложно)');
      }
      if (tg != 0 && tg != 1){
        errors.push('tg должен принимать значения 0 или 1 (истинно/ложно)');
      }
    


    normsigns = /^[a-zA-Zа-яА-Я0-9]+$/;
    if (job_place){
if (!normsigns.test(job_place)) {
      errors.push('job_place должен содержать только латинские буквы, ');
    }
    }
    if (job_post){
            if (!normsigns.test(job_post)) {
        errors.push('job_post должен содержать только латинские буквы, ');
      }
    }
    if (job_place){
              if (!normsigns.test(job_place)) {
        errors.push('job_place должен содержать только латинские буквы, ');
      }
    }
    if (education_place){
              if (!normsigns.test(education_place)) {
        errors.push('education_place должен содержать только латинские буквы, ');
      }
    }


    var source = /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
  

    if(resume_url){
        if (!source.test(resume_url)) {
            errors.push('Указана недействительная ссылка на резюме "resume_url"');
          }
    }
    if(vk_url){
        if (!source.test(vk_url)) {
            errors.push('Указана недействительная ссылка на Вконтакте "vk_url"');
          }
    }
    if(tg_url){
        if (!source.test(tg_url)) {
            errors.push('Указана недействительная ссылка на Телеграмм "tg_url"');
          }
    }

    if (bg){
    if (!source.test(bg)) {
      errors.push('Указана недействительная ссылка на фон "bg"');
    }}
  
    if (errors.length > 0) {
      // document.getElementById("errorDiv").innerHTML = errors.join(". <br>");
      alert(errors.join(", "));
  
    }
    else{
      document.getElementById('Edit').submit();
  
      
    }}