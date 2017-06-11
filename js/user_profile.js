
function showUserProfile(data)
{
	Html="";
	Html = Html + "<tr>";
	Html = Html + "<td>Name</td>";
	Html = Html +"<td>"+ data.firstname+" "+data.lastname+"</td>";
	Html = Html +"</tr><tr>";
	Html = Html + "<td>Country</td>";
	Html = Html +"<td>"+data.country +"</td>";
	Html = Html +"</tr><tr>";
	Html = Html + "<td>Institute</td>";
	Html = Html +"<td>"+ data.institute+"</td>";
	Html = Html +"</tr><tr>";
	Html = Html + "<td>Codeforces username</td>";
	Html = Html +"<td>"+ data.codeforcesuser+"</td>";
	Html = Html +"</tr><tr>";
	Html = Html + "<td>Uva username</td>";
	Html = Html +"<td>"+data.uvauser+"</td>";
	Html = Html +"</tr><tr>";
	Html = Html + "<td>Email</td>";
	Html = Html + "<td>"+data.email+"</td>";
	Html = Html +"</tr>";

	$("#userProfileUsername").text(data.username);
	$("#userProfileInfoTable").html(Html);
}
function setEditUserValue(data)
{
	$("#userFirstname").val(data.firstname);
	$("#userLastname").val(data.lastname);
	$("#userCountry").val(data.country);
	$("#userInstitute").val(data.institute);
	$("#userCodeforces").val(data.codeforcesuser);
	$("#userUva").val(data.uvauser);

}

$.ajax({ 
  type: "GET",
  data:"json",
  url: "/Contestant-Statistics-Management-System/php/user_profile_attempt.php",
  success: function(data){        
    var response = JSON.parse(data);
    if(data)
    {
    	showUserProfile(response);
    	setEditUserValue(response);
    }
  }
});