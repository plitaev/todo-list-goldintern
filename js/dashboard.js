function user_exit() { 
 document.cookie="cookie_user_id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
 document.cookie='cookie_user_token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';   
 document.location.href=app;
}

function todo_create() {
 $("#todo-creation-status").text("");
 $("#todo-goldintern-status").text("");
 
 var todo_name=$("#todo_name").val();
 var todo_date=$("#todo_date").val();
 var todo_time=$("#todo_time").val();
 var todo_datetime=todo_date+" "+todo_time;
 
 $.post(api_call("send_goldintern"),{user:cookie_user_id,action:"add"}).done(function(data) {
  if (data!=200) $("#todo-goldintern-status").text(goldintern_error);   
 }); 
 
 if (todo_name!="" && todo_date!="" && todo_time!="") {
  $.post(api_call("todo_create"),{user_id:cookie_user_id,user_token:cookie_token,todo_name:todo_name,todo_date:todo_date,todo_time:todo_time,todo_priority:0,todo_status:0}).done(function(data) {
   var json=$.parseJSON(data);
   if (json.todo_id>0) {
    todo_list_item(json.todo_id,todo_name,todo_datetime,"Обычный",0,2);
   } else $("#todo-creation-status").text("Ошибка: не удалось создать TO-DO!");
  });
 } else $("#todo-creation-status").text("Для создания TO-DO обязательно укажите название, дату и время события!");   
}

function todo_delete(todo_id) {
 $("#todo-goldintern-status").text("");

 $.post(api_call("send_goldintern"),{user:cookie_user_id,action:"delete"}).done(function(data) {
  if (data!=200) $("#todo-goldintern-status").text(goldintern_error);   
 }); 

 $.post(api_call("todo_delete"),{user_id:cookie_user_id,user_token:cookie_token,todo_id:todo_id}).done(function(data) {
  var json=$.parseJSON(data);
  if (json.delete_status==1) $("#todo-item-"+todo_id).remove();
 });
}

function todo_status(todo_id) {
 $("#todo-goldintern-status").text("");

 $.post(api_call("send_goldintern"),{user:cookie_user_id,action:"status-change"}).done(function(data) {
  if (data!=200) $("#todo-goldintern-status").text(goldintern_error);   
 }); 

 $.post(api_call("todo_status"),{user_id:cookie_user_id,user_token:cookie_token,todo_id:todo_id}).done(function(data) {
  var json=$.parseJSON(data);
  if (json.update_status==1) $("#todo-item-"+todo_id).remove();
 });
}

function todo_priority(todo_id,todo_priority) {
 $("#todo-goldintern-status").text("");

 $.post(api_call("send_goldintern"),{user:cookie_user_id,action:"priority-change"}).done(function(data) {
  console.log(data);  
  if (data!=200) $("#todo-goldintern-status").text(goldintern_error);   
 }); 

 $.post(api_call("todo_priority"),{user_id:cookie_user_id,user_token:cookie_token,todo_id:todo_id,todo_priority:todo_priority}).done(function(data) {
  var json=$.parseJSON(data);
  if (json.update_priority==1) $("#todo-item-"+todo_id+"-priority").text(json.priority);
 });
}

function todo_list_item(todo_id,todo_name,todo_datetime,todo_priority,todo_status,direction) {
 var object=$("#todo-list");
 
 if (direction==2) {
  object.prepend(todo_list_item_content(todo_id,todo_name,todo_datetime,todo_priority,todo_status));
 } else {
  object.append(todo_list_item_content(todo_id,todo_name,todo_datetime,todo_priority,todo_status));
 } 
}

function todo_list_item_content(todo_id,todo_name,todo_datetime,todo_priority,todo_status) {
 var chunks=todo_datetime.split(' ');
 var date=chunks[0];
 var time=chunks[1];
 
 var fdate=date.split("-");    
 var formatted_date=[fdate[2],fdate[1],fdate[0]].join(".");
   
 return "<div class='todo-list-item' id='todo-item-"+todo_id+"'><div class='todo-list-item-name'>"+todo_name+" <a href='javascript:void(0);' onClick='todo_status("+todo_id+")' title='Выполнить'>&radic;</a> <a href='javascript:void(0);' onClick='todo_delete("+todo_id+")' title='Удалить'>X</a></div><div class='todo-list-item-datetime'>Дата и время события: "+formatted_date+" "+time+"</div><div class='todo-list-item-priority'>Приоритет: <span id='todo-item-"+todo_id+"-priority'>"+todo_priority+"</span></div><div>Сменить приоритет на: <a href='javascript:void(0);' onClick='todo_priority("+todo_id+",1)'>Низкий</a> <a href='javascript:void(0);' onClick='todo_priority("+todo_id+",0)'>Обычный</a> <a href='javascript:void(0);' onClick='todo_priority("+todo_id+",2)'>Высокий</a></div></div>";
}

function todo_list_get(sort) {
 $("#todo-goldintern-status").text("");
 
 $.post(api_call("todo_get"),{user_id:cookie_user_id,user_token:cookie_token,sort:sort}).done(function(data) {
  $("#todo-list").text("");
  var json=$.parseJSON(data);
  
  $.each(JSON.parse(data),function(i,item) {
   todo_list_item(item.todo_id,item.todo_name,item.todo_datetime,item.todo_priority,item.todo_status,1);
  });  
 });
}

$(document).ready(function() {
 todo_list_get(0);
}); 