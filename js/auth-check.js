if (cookie_user_id==undefined || cookie_token==undefined || cookie_user_id=="" || cookie_token=="") {  
 document.location.href=app+"auth.html";
} else {
 if (document.location.href!=app+"dashboard.html") document.location.href=app+"dashboard.html";
} 