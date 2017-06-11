$("#userEditInfoSubmit").submit(function(e){
                
  //alert("sdfds");
  $.ajax({
    type: "POST",
    url: "/Contestant-Statistics-Management-System/php/user_profile_edit_attempt.php",
    data: $("#userEditInfoSubmit").serialize(),
    success: function(data1){
      if(data1)
      {
        window.location.href = "http://localhost/Contestant-Statistics-Management-System/templates/user-profile.html";
      }
      else{
        alert("Update error");  
      }                
    },
    error: function(e){
      alert("error");
    }
  });
  e.preventDefault();//avoid to execute the actual submit of the form.
});