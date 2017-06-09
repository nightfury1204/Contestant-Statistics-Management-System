$.ajax({ 
  type: "GET",
  data:"json",
  url: "/Contestant-Statistics-Management-System/php/user_submission_attempt.php",
  success: function(data){        
  var response = JSON.parse(data);
  	if(response.status)
  	  {
        var verdictData ={
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
        //alert(verdictData["10"]);
        var htmlData = "";
        for(submission in response.subs)
        {
          submissionData = response.subs[submission];
          htmlData = htmlData +"<tr style ='text-align: center;'>";
          htmlData = htmlData + "<td>"+ submissionData.username +"</td>";
          htmlData = htmlData + "<td>"+ submissionData.oj +"</td>";
          htmlData = htmlData + "<td>"+ timeConverter(submissionData.submissionTime) +"</td>";
          htmlData = htmlData + "<td>"+ submissionData.problemId +"</td>";
          htmlData = htmlData + "<td>"+ submissionData.language +"</td>";
          if(submissionData.verdict == "90")
          {
            htmlData = htmlData + "<td style='color:green;'>"+ verdictData[submissionData.verdict] +"</td>";
          }
          else
          {
            htmlData = htmlData + "<td style='color:red;'>"+ verdictData[submissionData.verdict] +"</td>";
          }
          
          htmlData = htmlData + "<td>"+ submissionData.runtime +"</td>";
          htmlData = htmlData +"</tr>";
        }
  	  	$("#userSubmissionTableBody").html(htmlData);
  	  }
    else
    {
       $("#userSubmissionTableBody").html(""); 
    }
  }
});