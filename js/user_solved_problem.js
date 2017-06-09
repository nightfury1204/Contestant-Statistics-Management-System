
function solvedProblemInsert(data , blockId)
{
    var datahtml = "";
    var cnt = 0;
    for(x in data)
    {
       if(cnt%15==0)
       {
          if(cnt==0)
          {
            datahtml =datahtml + "<tr>"
          }
          else
          {
            datahtml = datahtml +"</tr><tr>";
          }
       }
       datahtml = datahtml +"<td>"+data[x]+"</td>"
       cnt++;
    }
    if(cnt>0)
    {
       datahtml= datahtml +"</tr>";
    }
    $(blockId).html(datahtml);

}

$.ajax({ 
  type: "GET",
  data:"json",
  url: "/Contestant-Statistics-Management-System/php/user_solved_problem.php",
  success: function(data){        
    var response = JSON.parse(data);
    solvedProblemInsert(response.codeforces,"#codeforcesSolvedProblemList")
    solvedProblemInsert(response.uva,"#uvaSolvedProblemList");
  }
});