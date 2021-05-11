function user_enter() {
 var user_login=$("#user_login").val();
 var user_password=$("#user_password").val();
 
 if (user_login!="" && user_password!="") {
  $("#auth-status").text("");
  $.post(api_call("auth"),{user_login:user_login,user_password:user_password}).done(function(data) {
   var json=$.parseJSON(data);
  
   if (json.user_id>0) {
    var date_expired=json.user_token_expired.split(/[- :]/);
    var date_expired_utc=new Date(Date.UTC(date_expired[0],date_expired[1]-1,date_expired[2],date_expired[3],date_expired[4],date_expired[5]));
          
    document.cookie='cookie_user_id='+json.user_id+'; path=/; expires='+date_expired_utc;
    document.cookie='cookie_user_token='+json.user_token+'; path=/; expires='+date_expired_utc;
    
    document.location.href=app+"dashboard.html";
   } else $("#auth-status").text("Неверный логин или пароль");
  });
 } else $("#auth-status").text("Введите логин и пароль!"); 
}
