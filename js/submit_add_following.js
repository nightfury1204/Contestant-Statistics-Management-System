$("#addFollowingUser").submit(function(e){
                
  //alert("sdfds");
  $.ajax({
    type: "POST",
    url: "/Contestant-Statistics-Management-System/php/user_following_add_attempt.php",
    data: $("#addFollowingUser").serialize(),
    success: function(data1){
      if(data1 == true)
      {
        window.location.href = "http://localhost/Contestant-Statistics-Management-System/templates/following-list.html";
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