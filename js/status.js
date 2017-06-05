$("#searchUser").click(function(){
	var loadtext="<img src='./images/loading.gif' class='img-rounded' alt='Cinque Terre' width='200' height='196'>";
	
	$("#showSubmission").html(loadtext);
	const username = document.getElementById('userName').value;
	//alert(username);
	const urlName = "http://codeforces.com/api/";
	//alert(urlName);
	$.ajax({ 
   		type: "GET",
   		dataType: "json",
   		url: urlName,
   		success: function(data, status){        
     	//alert(status);
     	if(status=="success")
     	showResult(data);
   },
   error: function(){        
     	$("#showSubmission").html("<h1>No data found</h1>");
   }
   });
	/*
	const allSubmissions = ;
    $("#showSubmission").html(global.nunjucksEnv.render(templates/status.html, {items: allSubmissions}));
	*/
 });

function showResult(allSubmissions)
{
	//nunjucks.configure( { autoescape: true });
   // nunjucks.render('status.html', {items: allSubmissions});
   var text="<table style='text-align: left;' class="+"'table table-striped custab'"+"><thead ><tr><th>Online judge</th><th>Submission id</th><th>Problem name</th><th>Language</th><th>Verdict</th></tr></thead>";
   var items = allSubmissions;
   var cnt = 0;
   for(submission in allSubmissions.result)
   {
   	  //var item=JSON.parse(submission);
   	  //alert(items.result[cnt].id);
   	  text=text +"<tr><td>Codeforces</td> <td>"+items.result[cnt].id+"</td><td>"+items.result[cnt].problem.name+"</td><td>"+items.result[cnt].programmingLanguage+"</td><td>"+items.result[cnt].verdict+"</td></tr>";
      cnt++;
   }
   text = text + "</table>";
	$("#showSubmission").html(text);
}