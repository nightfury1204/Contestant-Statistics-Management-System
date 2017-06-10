
function showFollowingList(data)
{
	Html="";
	for(x in data)
	{
		Html = Html + "<tr>";
		Html = Html +"<td>"+ data[x].username+"</td>";
		Html = Html +"<td>"+ data[x].codeforces['solved']+" | "+data[x].codeforces['subs']+"</td>";
		Html = Html +"<td>"+ data[x].uva['solved']+" | "+data[x].uva['subs']+"</td>";
		Html = Html +"<td>"+ data[x].total['solved']+" | "+data[x].total['subs']+"</td>";
		userId = "removeUser"+data[x].username;
		Html = Html +"<td><a id ='"+userId+"' href='#' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#delete-following-modal'>Remove</a></td>";
		Html = Html +"<script> $('#"+userId+"').click(function(){ $('#deleteFollowingUsername').val('"+data[x].username+"');})</script>"
		Html = Html +"</tr>";
	}

	$("#userFollowingListTable").html(Html);
}

$.ajax({ 
  type: "GET",
  data:"json",
  url: "/Contestant-Statistics-Management-System/php/user_following_attempt.php",
  success: function(data){        
    var response = JSON.parse(data);
    if(data)
    {
    	showFollowingList(response);
    }
  }
});