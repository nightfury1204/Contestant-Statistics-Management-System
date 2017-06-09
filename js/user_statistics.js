/*var verdictData ={
    00 : "others",
    10 : "Submission error",
    30 : "Compile error",
    40 : "Runtime error",
    50 : "Time limit",
    60 : "Memory limit",
    70 : "Wrong answer",
    80 : "Presentation error",
    90 : "Accepted"
};
*/
function overallStatistics(data, total, ac)
{
	var myCanvas = document.getElementById("overallCanvas");
	myCanvas.width = 200;
	myCanvas.height = 200;

	var myVerdict = {
	    "Accepted": data['90'],
	    "Wrong answer": data['70'],
	    "Presentation error": data['80'],
	    "Memory limit": data['60'],
	    "Time limit":data['50'],
	    "Runtime error":data['40'],
	    "Compile error":data['30'],
	    "Submission error":data['10'],
	    "Others":data['00']
	};

	var myLegend = document.getElementById("overallLegend");
	var myPiechart = new Piechart(
	    {
	        canvas:myCanvas,
	        data:myVerdict,
	        colors:["#3E8F42","#F44336", "#3F51B5","#03A9F4","#9C27B0","#FF9800","#FFEB3B","#795548","#9E9E9E"],
			legend: myLegend
	    }
	);
	myPiechart.draw();
	$("#overallProblemSolved").html(ac);
	$("#overallProblemSubmissions").html(total);
}
function codeforcesStatistics(data, total, ac)
{
	var myCanvas = document.getElementById("codeforcesCanvas");
	myCanvas.width = 200;
	myCanvas.height = 200;

	var myVerdict = {
	    "Accepted": data['90'],
	    "Wrong answer": data['70'],
	    "Presentation error": data['80'],
	    "Memory limit": data['60'],
	    "Time limit":data['50'],
	    "Runtime error":data['40'],
	    "Compile error":data['30'],
	    "Submission error":data['10'],
	    "Others":data['00']
	};

	var myLegend = document.getElementById("codeforcesLegend");
	var myPiechart = new Piechart(
	    {
	        canvas:myCanvas,
	        data:myVerdict,
	        colors:["#3E8F42","#F44336", "#3F51B5","#03A9F4","#9C27B0","#FF9800","#FFEB3B","#795548","#9E9E9E"],
			legend: myLegend
	    }
	);
	myPiechart.draw();
	$("#codeforcesProblemSolved").html(ac);
	$("#codeforcesProblemSubmissions").html(total);
}

function uvaStatistics(data, total , ac)
{
	var myCanvas = document.getElementById("uvaCanvas");
	myCanvas.width = 200;
	myCanvas.height = 200;

	var myVerdict = {
	    "Accepted": data['90'],
	    "Wrong answer": data['70'],
	    "Presentation error": data['80'],
	    "Memory limit": data['60'],
	    "Time limit":data['50'],
	    "Runtime error":data['40'],
	    "Compile error":data['30'],
	    "Submission error":data['10'],
	    "Others":data['00']
	};

	var myLegend = document.getElementById("uvaLegend");
	var myPiechart = new Piechart(
	    {
	        canvas:myCanvas,
	        data:myVerdict,
	        colors:["#3E8F42","#F44336", "#3F51B5","#03A9F4","#9C27B0","#FF9800","#FFEB3B","#795548","#9E9E9E"],
			legend: myLegend
	    }
	);
	myPiechart.draw();
	$("#uvaProblemSolved").html(ac);
	$("#uvaProblemSubmissions").html(total);

}

$.ajax({ 
  type: "GET",
  data:"json",
  url: "/Contestant-Statistics-Management-System/php/user_statistics_attempt.php",
  success: function(data){
  	var resData = JSON.parse(data);
  	var overallTotal = 0;
  	var overallData = [];
  	var cfTotal = 0, cfAc = resData.codeforces['90'];

  	for( x in resData.codeforces )
  	{
  		cfTotal = cfTotal + (resData.codeforces[x]*1);
  		overallData[x]=resData.codeforces[x];
  	}
  	var uvaTotal = 0,uvaAc = resData.uva['90'];
  	for( x in resData.uva )
  	{
  		uvaTotal = uvaTotal + (resData.uva[x]*1);
  		overallData[x] = overallData[x]+(resData.uva[x]*1);
  	}
  	overallTotal = cfTotal + uvaTotal ;
  	if(overallTotal>0)
  	{
  		overallStatistics(overallData, overallTotal ,overallData['90']);
  	}
  	else
  	{
  		$("#overallBlockBody").html("<h1 style='color: #9E9E9E; text-align: center; padding: 20px;' >No Submissions</h1>")
  	}
  	if(cfTotal>0)
  	{
  		codeforcesStatistics(resData.codeforces,cfTotal ,cfAc);
  	}
  	else
  	{
 		$("#codeforcesBlockBody").html("<h1 style='color: #9E9E9E; text-align: center; padding: 20px;' >No Submissions</h1>");	
  	}
  	if(uvaTotal>0)
  	{
  		uvaStatistics(resData.uva,uvaTotal,uvaAc);
  	}
  	else
  	{
  		$("#uvaBlockBody").html("<h1 style='color: #9E9E9E; text-align: center; padding: 20px;' >No Submissions</h1>");
  	}
  }
});