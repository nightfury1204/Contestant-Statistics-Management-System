$("#userLoginFormSubmit").submit(function(e){
                
  //alert("sdfds");
  $.ajax({
    type: "POST",
    url: "/Contestant-Statistics-Management-System/php/user_login_attempt.php",
    data: $("#userLoginFormSubmit").serialize(),
    success: function(data1){
      if(data1 == "success")
      {
        window.location.href = "http://localhost/Contestant-Statistics-Management-System/";
      }
      else{
        alert(data1);  
      }
                    
    },
    error: function(e){
      alert("error");
    }
  });
  e.preventDefault();//avoid to execute the actual submit of the form.
});