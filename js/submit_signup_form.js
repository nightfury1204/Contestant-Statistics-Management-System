$("#signupFormSubmit").submit(function(e){
                
  //alert("sdfds");
  $.ajax({
    type: "POST",
    url: "/Contestant-Statistics-Management-System/php/user_signup_attempt.php",
    data: $("#signupFormSubmit").serialize(),
    success: function(data1){
      if(data1 == true)
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