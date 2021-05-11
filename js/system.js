var app="https://xsolla.svoiludi.club/";
var api=app+"api/";
var goldintern_error="Произошла ошибка при отправке данных на сервер https://todo.goldintern.space/";

var cookie_user_id=checkCookie("cookie_user_id");
var cookie_token=checkCookie("cookie_user_token");

function api_call(method) {
 return api+method+"/";
}

function checkCookie(name) {
 var matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, "\\$1") + "=([^;]*)"));
 return matches ? decodeURIComponent(matches[1]) : undefined;
}