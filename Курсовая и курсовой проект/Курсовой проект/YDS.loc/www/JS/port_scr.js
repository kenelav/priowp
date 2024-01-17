window.addEventListener('DOMContentLoaded', function() {
    document.getElementById('Edit').addEventListener('submit', function(event) {
      event.preventDefault();
      validateForm1();
    
  });})
function validateForm1() {

    var job_place = document.getElementById('job_place').value;
    var job_post = document.getElementById('job_post').value;

    var education_place = document.getElementById('education_place').value;

    var resume_url = document.getElementById('resume_url').value;

    var vk_url = document.getElementById('vk_url').value;

    var tg_url = document.getElementById('tg_url').value;
    var bg = document.getElementById('bg').value;
    var errors = [];



    


    normsigns = /^[a-zA-Zа-яА-Я0-9]+$/;
    if (job_place){
if (!normsigns.test(job_place)) {
      errors.push('job_place должен содержать только латинские и русские буквы, цифры ');
    }
    }
    if (job_post){
            if (!normsigns.test(job_post)) {
        errors.push('job_post должен содержать только латинские и русские буквы, цифры ');
      }
    }
    if (job_place){
              if (!normsigns.test(job_place)) {
        errors.push('job_place должен содержать только латинские и русские буквы, цифры ');
      }
    }
    if (education_place){
              if (!normsigns.test(education_place)) {
        errors.push('education_place должен содержать только латинские и русские буквы, цифры ');
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
    document.getElementById("errorDiv").innerHTML = errors.join(". <br>");
    //   alert(errors.join(", "));
  
    }
    else{
      document.getElementById('Edit').submit();
  
      
    }}