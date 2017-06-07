$.ajax({ 
  type: "GET",
  data:"json",
  url: "/Contestant-Statistics-Management-System/php/userAuth.php",
  success: function(data){        
  var response = JSON.parse(data);
  	if(response.auth)
  	  {
  	  	$("#userLoginBar").load("/Contestant-Statistics-Management-System/templates/dropdown-user-bar.html",
  	  		function(){
  	  			$("#usernameInNavBar").html(response.username);
  	  	});

  	  }
  }
});