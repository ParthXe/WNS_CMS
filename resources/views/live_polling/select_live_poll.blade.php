
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KONE</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
  <script src="{{ asset('dist/js/xlsx.core.min.js') }}"></script>
  <script src="{{ asset('dist/js/FileSaver.js') }}"></script>
  <script src="{{ asset('dist/js/jhxlsx.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
    var live_poll;
    var poll_sessions;
    Array.prototype.unique = Array.prototype.unique || function() {
          var arr = [];
  	this.reduce(function (hash, num) {
  		if(typeof hash[num] === 'undefined') {
  			hash[num] = 1;
  			arr.push(num);
  		}
  		return hash;
  	}, {});
  	return arr;
  }
    function accumulator(arr) {
        var a = [], b = [], prev;

        arr.sort();
        for ( var i = 0; i < arr.length; i++ ) {
            if ( arr[i] !== prev ) {
                a.push(arr[i]);
                b.push(1);
            } else {
                b[b.length-1]++;
            }
            prev = arr[i];
        }

        return [a, b];
    }
    $('#polls_id').change(function(){
        var poll_id = $('#polls_id').val();
        //alert(poll_id);
         $('#graph-container').empty();
         $.when(
            $.ajax({
              type: "GET",
              url: "/generate_live_poll_report/"+poll_id,
              headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              success: function(data){
                //console.log("live_poll: "+data);
                    live_poll=data;

                }
        }),
        $.ajax({
              type: "GET",
              url: "/get_poll_sessions/"+poll_id,
              headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              success: function(data1){
                //console.log("poll_session: "+data1);
                poll_sessions=data1;
              }
        })
        ).then(function() {
              var live_polling_ids=[];
              var live_polling_sessions_qa=[];
              var live_polling_sessions_unique_q;
              var live_polling_sessions_unique_a=[];
              var live_polling_sessions_unique_qanda=[];
              var session_qid,qid;
              var answers=[];
              var result=[];
              var total=[];
              var uniquea=[];
              var uniqueacount=[];
              var live_pollings = [];
              var percentages=[];
              var optionA=0;
              var optionB=0;
              var optionC=0;
              var optionD=0;
              var optionE=0;
              var optionF=0;
              var A=[];
              var B=[];
              var C=[];
              var D=[];
              var E=[];
              var F=[];
              var t1=0;
              var t2=0;
              var t3=0;
              var t4=0;
              var t5=0;
              var t6=0;
              var labelA=[];
              var labelB=[];
              var labelC=[];
              var labelD=[];
              var labelE=[];
              var labelF=[];
              var question=[];
              var counter=0;
              var qid=[];
              var qid_length;
              var cId;
              var one_three_percentage=[]; 
              
             for(var i=0;i<live_poll.length;i++){
                 live_polling_ids.push(live_poll[i]['id']);
             }
             for(var j=0;j<poll_sessions.length;j++){
                live_polling_sessions_qa.push(poll_sessions[j]['question_id']+','+poll_sessions[j]['answer']);
             }
             
                //console.log(" then: "+live_polling_ids+" "+live_polling_sessions_qa);
            
                var live_polling_sessions_q=(live_polling_sessions_qa.map(function (live_polling_sessions_qa) {
                  return live_polling_sessions_qa[0];
                }));
            
               
            
                var live_polling_sessions_a=(live_polling_sessions_qa.map(function (live_polling_sessions_qa) {
                  return live_polling_sessions_qa[2];
                }));
                
                //console.log("live_polling_sessions_q "+live_polling_sessions_q+"  live_polling_sessions_a "+live_polling_sessions_a)
                if(poll_id == "1")
                {
                         for(var p=0;p<live_polling_sessions_qa.length;p++)
                         {
                            //console.log(live_polling_sessions_qa[p]);
                            var temp_str=live_polling_sessions_qa[p];
                            qid.push(temp_str.charAt(0));
                            var temp_ans=temp_str.substring(2);
                            //console.log(temp_ans);
                            two=temp_ans.split(',');
                            if(qid[qid.length-1]==2)
                            {
                                //console.log(two);
                                
                                if(two[0] == 1){
                                    t1=t1+1;
                                }
                                else if(two[0] == 2){
                                    t2=t2+1;
                                }
                                else if(two[0] == 3){
                                    t3=t3+1;
                                }
                                else if(two[0] == 4){
                                    t4=t4+1;
                                }
                                else if(two[0] == 5){
                                    t5=t5+1;
                                }
                                else if(two[0] == 6){
                                    t6=t6+1;
                                }
                                counter=counter+1;
                            }
                            else
                            {
                                live_polling_sessions_unique_q=live_polling_sessions_q.unique();
                                
                                function arrayRemove(arr, value) {
                                   return arr.filter(function(ele){
                                       return ele != value;
                                   });
                                }
                                live_polling_sessions_unique_q = arrayRemove(live_polling_sessions_unique_q, 2);
                                //console.log(live_polling_sessions_unique_q);
                                var unique_length=live_polling_sessions_unique_q.length;
                                //console.log(live_polling_sessions_unique_q+' '+unique_length);
                                var temp_arr=[];
                                for(var i=0;i<unique_length;i++)
                                {
                                  for(var j=0;j<live_polling_sessions_qa.length;j++)
                                  {
                                   // console.log("i: "+i+' j: '+j+" "+live_polling_sessions_qa[j][0]+' '+live_polling_sessions_unique_q[i]);
                                    if(live_polling_sessions_qa[j][0] === live_polling_sessions_unique_q[i])
                                    {
                                      temp_arr.push(live_polling_sessions_qa[j][2]);
                                    }
                                  }
                                  live_polling_sessions_unique_qanda.push(temp_arr);
                                  temp_arr=[];
                                }
                            
                                //console.log("r"+live_polling_sessions_unique_qanda.length);
                                  function accumulator(arr) {
                                    var a = [], b = [], prev;
                            
                                    arr.sort();
                                    for ( var i = 0; i < arr.length; i++ ) {
                                        if ( arr[i] !== prev ) {
                                            a.push(arr[i]);
                                            b.push(1);
                                        } else {
                                            b[b.length-1]++;
                                        }
                                        prev = arr[i];
                                    }
                            
                                    return [a, b];
                                }
                            
                            
                                for(var i=0;i<unique_length;i++)
                                {
                                  //console.log(live_polling_sessions_unique_qanda[i]);
                                  total.push(live_polling_sessions_unique_qanda[i].length);
                                  result=accumulator(live_polling_sessions_unique_qanda[i]);
                                  //console.log(result);
                            
                                  for(var k=0;k<result.length;k++){
                                    if(k==0)
                                    {
                                      uniquea.push(result[k]);
                                    }
                                    else{
                                      uniqueacount.push(result[k]);
                                    }
                                  }
                            
                                  //
                                }
                                
                                 for(var k=0;k<result.length;k++)
                                 {
                                    //console.log("uniquea "+uniquea[k]);
                                    //console.log("uniqueacount "+uniqueacount[k]);
                                    optionA=0;
                                    optionB=0;
                                    optionC=0;
                                    optionD=0;
                                    optionE=0;
                                    optionF=0;
                                    var count=uniqueacount[k].toString().split(',');
                                    var count1=uniquea[k].toString().split(',');
                                    for(var l=0;l<count.length;l++)
                                    {
                                        //console.log("uniquea"+count1[l]);
                                        //console.log(count1[l]+"->"+parseInt((count[l])*100/total));
                                        if(count1[l]==1){
                                          optionA=(optionA+parseFloat(count[l])/total[k]*100).toFixed(2);
                                          //console.log("optionA "+optionA);
                                        }
                                        else if (count1[l]==2) {
                                          optionB=(optionB+parseFloat(count[l])/total[k]*100).toFixed(2);
                                          //console.log("optionB "+optionB);
                                        }
                                        else if (count1[l]==3) {
                                          optionC=(optionC+parseFloat(count[l])/total[k]*100).toFixed(2);
                                          //console.log("optionC "+optionC);
                                        }
                                        else if (count1[l]==4) {
                                          optionD=(optionD+parseFloat(count[l])/total[k]*100).toFixed(2);
                                          //console.log("optionD "+optionD);
                                        }
                                        else if (count1[l]==5) {
                                          optionE=(optionE+parseFloat(count[l])/total[k]*100).toFixed(2);
                                          //console.log("optionD "+optionD);
                                        }
                                    }
                                    /* A.push(optionA); 
                                     B.push(optionB);
                                     C.push(optionC);
                                     D.push(optionD);
                                     E.push(optionE);*/
                                     //console.log(optionA+" "+optionB+" "+optionC+" "+optionD+" "+optionE)
                                      one_three_percentage.push(optionA+" "+optionB+" "+optionC+" "+optionD+" "+optionE+" "+optionF);
                                }
                            
                         }
                
                    }
                    
                            var poll_one_result=parseFloat((t1/counter)*100).toFixed(2)+' '+parseFloat((t2/counter)*100).toFixed(2)+' '+parseFloat((t3/counter)*100).toFixed(2)+' '+parseFloat((t4/counter)*100).toFixed(2)+' '+parseFloat((t4/counter)*100).toFixed(2)+' '+parseFloat((t5/counter)*100).toFixed(2);
                           
                            var temp_unique_one_three=one_three_percentage.unique();
                            var temp_unique_one_three_str=temp_unique_one_three.toString();
                            var temp_unique_one_three_str_split = temp_unique_one_three_str.split(',')
                            var one_str=temp_unique_one_three_str_split[0];
                            var three_str=temp_unique_one_three_str_split[1];
                            var one_answers= one_str.split(" ");
                            var three_answers= three_str.split(" ");
                            var two_answers= poll_one_result.split(" ");
                            /*console.log("one_answer"+one_answers[0]);
                            console.log("two_answers"+two_answers);
                            console.log("three_answers"+three_answers);
                            /*answers.push(one_answers);
                            answers.push(two_answers);
                            answers.push(three_answers);
                            console.log(answers);*/
                                A=[one_answers[0],two_answers[0],three_answers[0]]; 
                                B=[one_answers[1],two_answers[1],three_answers[1]]; 
                                C=[one_answers[2],two_answers[2],three_answers[2]]; 
                                D=[one_answers[3],two_answers[3],three_answers[3]]; 
                                E=[one_answers[4],two_answers[4],three_answers[4]];
                                F=[one_answers[5],two_answers[5],three_answers[5]];
                            
                            /*console.log("A "+A);
                            console.log("B "+B);
                            console.log("C "+C);
                            console.log("D "+D);
                            console.log("E "+E);
                            console.log("F "+F);*/
                            live_pollings=live_poll;
                            var len=live_pollings.length;
                           
                            for(var k=0;k<len;k++)
                            {
                                var j=k+1;
                                labelA.push(live_pollings[k]['optionA']);
                                labelB.push(live_pollings[k]['optionB']);
                                labelC.push(live_pollings[k]['optionC']);
                                labelD.push(live_pollings[k]['optionD']);
                                labelE.push(live_pollings[k]['optionE']);
                                labelF.push(live_pollings[k]['optionF']);
                                question.push(live_pollings[k]['question']);
                                drawGraph(A[k],B[k],C[k],D[k],E[k],F[k],labelA[k],labelB[k],labelC[k],labelD[k],labelE[k],labelF[k],question[k],cId);
                                cId='charts'+j;
                                //console.log(A[k],B[k],C[k],D[k],E[k],F[k],labelA[k],labelB[k],labelC[k],labelD[k],labelE[k],labelF[k],question[k],cId);
                            }
         function drawGraph(A,B,C,D,E,F,LA,LB,LC,LD,LE,LF,Q,CanvasID)
         {
           //alert(Q);
            var g =document.createElement('div');
            g.setAttribute('id', "div"+CanvasID);
            g.setAttribute('class','col-md-12 center');
            var canvas = document.createElement('canvas');
            canvas.setAttribute('id', CanvasID);
            g.appendChild(canvas);
            document.getElementById('graph-container').appendChild(g);
            var ctx = document.getElementById(CanvasID).getContext('2d');
            var h =document.createElement('div');
            h.setAttribute('class','col-md-12 center');
            h.setAttribute('style','color:#ccc');
            h.innerHTML="<hr style='border-bottom: 2px solid rgba(0, 0, 0,0.1);margin-bottom:2%;'>";
            document.getElementById("div"+CanvasID).appendChild(h);

           //alert(labelA+" "+labelB+" "+labelC+" "+labelD+" "+labelE);

                     var myChart = new Chart(ctx, {
                         type: 'horizontalBar',
                         data: {
                             labels: [LA,LB,LC,LD,LE,LF],
                             datasets: [{
                                 label: Q,
                                 data: [A,B,C,D,E,F],
                                 backgroundColor: [
                                     'rgba(255, 99, 132, 0.2)',
                                     'rgba(54, 162, 235, 0.2)',
                                     'rgba(255, 206, 86, 0.2)',
                                     'rgba(75, 192, 192, 0.2)',
                                     'rgba(153, 102, 255, 0.2)',
                                     'rgba(54, 162, 235, 0.2)',
                                     'rgba(255, 159, 64, 0.2)'
                                 ],
                                 borderColor: [
                                     'rgba(255, 99, 132, 1)',
                                     'rgba(54, 162, 235, 1)',
                                     'rgba(255, 206, 86, 1)',
                                     'rgba(75, 192, 192, 1)',
                                     'rgba(153, 102, 255, 1)',
                                     'rgba(54, 162, 235, 0.2)',
                                     'rgba(255, 159, 64, 1)'
                                 ],
                                 borderWidth: 2
                             }]
                         },
                         options: {
                             scales: {
                                 yAxes: [{
                                     ticks: {
                                         beginAtZero: true
                                     }
                                 }]
                             }
                         }
                     });
                   }
                  }
                  else 
                  {
                    function accumulator(arr) {
                        var a = [], b = [], prev;
                
                        arr.sort();
                        for ( var i = 0; i < arr.length; i++ ) {
                            if ( arr[i] !== prev ) {
                                a.push(arr[i]);
                                b.push(1);
                            } else {
                                b[b.length-1]++;
                            }
                            prev = arr[i];
                        }
                
                        return [a, b];
                    }
                    
                    live_polling_sessions_unique_q=live_polling_sessions_q.unique();
                    var unique_length=live_polling_sessions_unique_q.length;
               
                    var temp_arr=[];
                    for(var i=0;i<unique_length;i++)
                    {
                      for(var j=0;j<live_polling_sessions_qa.length;j++)
                      {
                      
                        if(live_polling_sessions_qa[j][0] === live_polling_sessions_unique_q[i])
                        {
                          temp_arr.push(live_polling_sessions_qa[j][2]);
                        }
                      }
                      live_polling_sessions_unique_qanda.push(temp_arr);
                      temp_arr=[];
                    }
    
    
                    for(var i=0;i<unique_length;i++)
                    {
                     
                      total.push(live_polling_sessions_unique_qanda[i].length);
                      result=accumulator(live_polling_sessions_unique_qanda[i]);
                     
                      for(var k=0;k<result.length;k++){
                        if(k==0)
                        {
                          uniquea.push(result[k]);
                        }
                        else{
                          uniqueacount.push(result[k]);
                        }
                      }
                
                      //
                    }
                      for(var k=0;k<=result.length;k++){
                        var j=k+1;
                        optionA=0;
                        optionB=0;
                        optionC=0;
                        optionD=0;
                        optionE=0;
                        optionF=0;
                        var count=uniqueacount[k].toString().split(',');
                        var count1=uniquea[k].toString().split(',');
                        for(var l=0;l<count.length;l++){
                        if(count1[l]==1){
                          optionA=(optionA+parseFloat(count[l])/total[k]*100).toFixed(2);
                          //console.log("optionA "+optionA);
                        }
                        else if (count1[l]==2) {
                          optionB=(optionB+parseFloat(count[l])/total[k]*100).toFixed(2);
                          //console.log("optionB "+optionB);
                        }
                        else if (count1[l]==3) {
                          optionC=(optionC+parseFloat(count[l])/total[k]*100).toFixed(2);
                          //console.log("optionC "+optionC);
                        }
                        else if (count1[l]==4) {
                          optionD=(optionD+parseFloat(count[l])/total[k]*100).toFixed(2);
                          //console.log("optionD "+optionD);
                        }
                         else if (count1[l]==5) {
                          optionE=(optionE+parseFloat(count[l])/total[k]*100).toFixed(2);
                          //console.log("optionD "+optionD);
                        }
                        else if (count1[l]==6) {
                          optionF=(optionF+parseFloat(count[l])/total[k]*100).toFixed(2);
                          //console.log("optionD "+optionD);
                        }
                      }
                      //console.log("optionA "+optionA+" optionB "+optionB+" optionC "+optionC+" optionD "+optionD+" optionE "+optionE);
                      live_pollings=live_poll;
                        //for(var x=0; x<unique_length;x++) {
                        labelA=live_pollings[k]['optionA'];
                        labelB=live_pollings[k]['optionB'];
                        labelC=live_pollings[k]['optionC'];
                        labelD=live_pollings[k]['optionD'];
                        labelE=live_pollings[k]['optionE'];
                        labelF=live_pollings[k]['optionF'];
                        question=live_pollings[k]['question'];
                        cId='charts'+j;
                        //console.log(optionA,optionB,optionC,optionD,optionE,labelA,labelB,labelC,labelD,labelE,question,cId);
                        drawGraph(optionA,optionB,optionC,optionD,optionE,optionF,labelA,labelB,labelC,labelD,labelE,labelF,question,cId);
                    }
                
                  function drawGraph(A,B,C,D,E,F,LA,LB,LC,LD,LE,LF,Q,CanvasID)
                  {
                    var g =document.createElement('div');
                    g.setAttribute('id', "div"+CanvasID);
                    g.setAttribute('class','col-md-12 center');
                    var canvas = document.createElement('canvas');
                    canvas.setAttribute('id', CanvasID);
                    g.appendChild(canvas);
                    document.getElementById('graph-container').appendChild(g);
                    var ctx = document.getElementById(CanvasID).getContext('2d');
                    var h =document.createElement('div');
                    h.setAttribute('class','col-md-12 center');
                    h.setAttribute('style','color:#ccc');
                    h.innerHTML="<hr style='border-bottom: 2px solid rgba(0, 0, 0,0.1);margin-bottom:2%;'>";
                    document.getElementById("div"+CanvasID).appendChild(h);
                
                    //alert(labelA+" "+labelB+" "+labelC+" "+labelD+" "+labelE);
                
                  var myChart = new Chart(ctx, {
                      type: 'horizontalBar',
                      data: {
                          labels: [LA,LB,LC,LD,LE,LF],
                          datasets: [{
                              label: Q,
                              data: [A,B,C,D,E,F],
                              backgroundColor: [
                                  'rgba(255, 99, 132, 0.2)',
                                  'rgba(54, 162, 235, 0.2)',
                                  'rgba(255, 206, 86, 0.2)',
                                  'rgba(75, 192, 192, 0.2)',
                                  'rgba(153, 102, 255, 0.2)',
                                  'rgba(255, 159, 64, 0.2)',
                                  'rgba(75, 192, 192, 0.2)'
                              ],
                              borderColor: [
                                  'rgba(255, 99, 132, 1)',
                                  'rgba(54, 162, 235, 1)',
                                  'rgba(255, 206, 86, 1)',
                                  'rgba(75, 192, 192, 1)',
                                  'rgba(153, 102, 255, 1)',
                                  'rgba(255, 159, 64, 1)',
                                  'rgba(75, 192, 192, 1)'
                              ],
                              borderWidth: 2
                          }]
                      },
                      options: {
                          scales: {
                              yAxes: [{
                                  ticks: {
                                      beginAtZero: true
                                  }
                              }]
                          }
                      }
                  });
                }
            }
    });
});
    
$('#downloadpdfbtn').click(function(){
      html2canvas($("#graph-container"), {
            onrendered: function (canvas) {
                var imgData = canvas.toDataURL("image/png");
                var pdf = new jsPDF();
                pdf.addImage(imgData, 'PNG', 0, 0, -180, -180);
                pdf.save("Live_poll_Report.pdf");
                /*var reportPageHeight = $('#container').innerHeight();
                  var reportPageWidth = $('#container').innerWidth();
                  console.log(reportPageHeight+" "+reportPageWidth);
                  // create a new canvas object that we will populate with all other canvas objects
                  var pdfCanvas = $('<canvas />').attr({
                    id: "canvaspdf",
                    width: reportPageWidth,
                    height: reportPageHeight
                  });
                  
                  // keep track canvas position
                  var pdfctx = $(pdfCanvas)[0].getContext('2d');
                  var pdfctxX = 0;
                  var pdfctxY = 0;
                  var buffer = 100;
                  
                  // for each chart.js chart
                  $("canvas").each(function(index) {
                    // get the chart height/width
                    var canvasHeight = $(this).innerHeight();
                    var canvasWidth = $(this).innerWidth();
                    console.log(canvasHeight+" "+canvasWidth+" "+index+" pdfctx:"+pdfctxX);
                    // draw the chart into the new canvas
                    pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
                    pdfctxX += canvasWidth + buffer;
                    
                    // our report page is in a grid pattern so replicate that in the new canvas
                    if (index % 2 === 1) {
                      pdfctxX = 0;
                      pdfctxY += canvasHeight + buffer;
                    }
                   
                    console.log("pdfctxX: "+pdfctxX+" pdfctxY"+pdfctxY+" index"+index);
                  });
                  
                  // create new pdf and add our new canvas as an image
                  var pdf = new jsPDF('p', 'pt',[reportPageWidth,reportPageHeight]);
                  pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);
                  
                  // download the pdf
                  pdf.save('Live_Poll_Report.pdf');*/
            }
        });
    });
  $('#downloadxlsxbtn').click(function(){
       var id=0;
       var poll_data,data2;
       var live_polling_sessions=[];
       live_polling_sessions.push([{"text":"ID"},{"text":"Email ID"},{"text":"Poll ID"},{"text":"Question ID"},{"text":"Answer"}]);
       $.when(
       $.ajax({
              type: "GET",
              url: "/get_poll_sessions/"+id,
              dataType: "json",          
              headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              success: function(data1){
                poll_data=data1;  
               
              }
        }),
        $.ajax({
              type: "GET",
              url: "/live_polling_question_api/"+id,
              headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              success: function(data1){
                //console.log("poll_session: "+data1);
                data2=data1;
               // console.log(data2);
              }
        })
        ).then(function() {
                //console.log("data2: "+data2)
                var poll_id,question,answer,email,id,item,i=1;
                var item2=new Array();
                var answers=new Array();
                for(var prop2 in data2) 
                {   
                    item2.push(data2[prop2]);
                }

                 answers.push(item2[1]["optionA"],item2[1]["optionB"],item2[1]["optionC"],item2[1]["optionD"],item2[1]["optionE"],item2[1]["optionF"]);
                //console.log(poll_data.length)
                for(var prop in poll_data) 
                {
                    //console.log(prop);
                    if(prop =="unique"){
                        console.log("unique");
                        continue;
                    }
                    item = poll_data[prop];
       
                    if((item["poll_id"] == 1) && (item["question_id"]==1) && (item["answer"]==1)){
                             poll_id=item2[0]["poll_id"];
                             question=item2[0]["question"];
                             answer=item2[0]["optionA"];
                    }
                    else if((item["poll_id"] == 1) && (item["question_id"]==1) && (item["answer"]==2)){
                             poll_id=item2[0]["poll_id"];
                             question=item2[0]["question"];
                             answer=item2[0]["optionB"];
                        
                    }
                    else if((item["poll_id"] == 1) && (item["question_id"]==2)){
                             var temp_string=item["answer"];
                             var first=temp_string.charAt(0)-1;
                             var second=temp_string.charAt(2)-1;
                             var third=temp_string.charAt(4)-1;
                             var four=temp_string.charAt(6)-1;
                             var fifth=temp_string.charAt(8)-1;
                             var six=temp_string.charAt(10)-1;
                             poll_id=item2[1]["poll_id"];
                             question=item2[1]["question"];
                             answer=answers[first]+","+answers[second]+","+answers[third]+","+answers[four]+","+answers[fifth]+","+answers[six];
                             //console.log(answer);
                    }
                    else if((item["poll_id"] == 1) && (item["question_id"]==3) && (item["answer"]==1)){
                             poll_id=item2[2]["poll_id"];
                             question=item2[2]["question"];
                             answer=item2[2]["optionA"];
                    }
                    else if((item["poll_id"] == 1) && (item["question_id"]==3) && (item["answer"]==2)){
                             poll_id=item2[2]["poll_id"];
                             question=item2[2]["question"];
                             answer=item2[2]["optionB"];
                        
                    }
                    else if((item["poll_id"] == 1) && (item["question_id"]==3) && (item["answer"]==3)){
                             poll_id=item2[2]["poll_id"];
                             question=item2[2]["question"];
                             answer=item2[2]["optionC"];
                        
                    }
                    else if((item["poll_id"] == 2) && (item["question_id"]==1) && (item["answer"]==1)){
                             poll_id=item2[3]["poll_id"];
                             question=item2[3]["question"];
                             answer=item2[3]["optionA"];
                        
                    }
                    else if((item["poll_id"] == 2) && (item["question_id"]==1) && (item["answer"]==2)){
                             poll_id=item2[3]["poll_id"];
                             question=item2[3]["question"];
                             answer=item2[3]["optionB"];
                        
                    }
                    else if((item["poll_id"] == 2) && (item["question_id"]==1) && (item["answer"]==3)){
                             poll_id=item2[3]["poll_id"];
                             question=item2[3]["question"];
                             answer=item2[3]["optionC"];
                        
                    }
                    else if((item["poll_id"] == 2) && (item["question_id"]==1) && (item["answer"]==4)){
                             poll_id=item2[3]["poll_id"];
                             question=item2[3]["question"];
                             answer=item2[3]["optionD"];
                        
                    }
                    else if((item["poll_id"] == 2) && (item["question_id"]==1) && (item["answer"]==5)){
                             poll_id=item2[3]["poll_id"];
                             question=item2[3]["question"];
                             answer=item2[3]["optionE"];
                        
                    }
                    else if((item["poll_id"] == 2) && (item["question_id"]==2) && (item["answer"]==1)){
                             poll_id=item2[4]["poll_id"];
                             question=item2[4]["question"];
                             answer=item2[4]["optionA"];
                        
                    }
                    else if((item["poll_id"] == 2) && (item["question_id"]==2) && (item["answer"]==2)){
                             poll_id=item2[4]["poll_id"];
                             question=item2[4]["question"];
                             answer=item2[4]["optionB"];
                    }
                    else if((item["poll_id"] == 2) && (item["question_id"]==2) && (item["answer"]==3)){
                             poll_id=item2[4]["poll_id"];
                             question=item2[4]["question"];
                             answer=item2[4]["optionC"];
                    }
                    else if((item["poll_id"] == 2) && (item["question_id"]==2) && (item["answer"]==4)){
                             poll_id=item2[4]["poll_id"];
                             question=item2[4]["question"];
                             answer=item2[4]["optionD"];
                        
                    }
                    else if((item["poll_id"] == 2) && (item["question_id"]==2) && (item["answer"]==5)){
                             poll_id=item2[4]["poll_id"];
                             question=item2[4]["question"];
                             answer=item2[4]["optionE"];
                    }
                    else if((item["poll_id"] == 2) && (item["question_id"]==3) && (item["answer"]==1)){
                             poll_id=item2[5]["poll_id"];
                             question=item2[5]["question"];
                             answer=item2[5]["optionA"];
                        
                    }
                    else if((item["poll_id"] == 2) && (item["question_id"]==3) && (item["answer"]==2)){
                             poll_id=item2[5]["poll_id"];
                             question=item2[5]["question"];
                             answer=item2[5]["optionB"];
                        
                    }
                    else if((item["poll_id"] == 2) && (item["question_id"]==3) && (item["answer"]==3)){
                             poll_id=item2[5]["poll_id"];
                             question=item2[5]["question"];
                             answer=item2[5]["optionC"];
                    }
                    else if((item["poll_id"] == 2) && (item["question_id"]==3) && (item["answer"]==4)){
                             poll_id=item2[5]["poll_id"];
                             question=item2[5]["question"];
                             answer=item2[5]["optionD"];
                        
                    }
                    else if((item["poll_id"] == 2) && (item["question_id"]==3) && (item["answer"]==5)){
                             poll_id=item2[5]["poll_id"];
                             question=item2[5]["question"];
                             answer=item2[5]["optionE"];
                        
                    }
                    else if((item["poll_id"] == 3) && (item["question_id"]==1) && (item["answer"]==1)){
                             poll_id=item2[6]["poll_id"];
                             question=item2[6]["question"];
                             answer=item2[6]["optionA"];
                        
                    }
                    else if((item["poll_id"] == 3) && (item["question_id"]==1) && (item["answer"]==2)){
                             poll_id=item2[6]["poll_id"];
                             question=item2[6]["question"];
                             answer=item2[6]["optionB"];
                        
                    }
                    else if((item["poll_id"] == 3) && (item["question_id"]==1) && (item["answer"]==3)){
                             poll_id=item2[6]["poll_id"];
                             question=item2[6]["question"];
                             answer=item2[6]["optionC"];
                        
                    }
                    else if((item["poll_id"] == 3) && (item["question_id"]==1) && (item["answer"]==4)){
                             poll_id=item2[6]["poll_id"];
                             question=item2[6]["question"];
                             answer=item2[6]["optionD"];
                        
                    }
                    else if((item["poll_id"] == 3) && (item["question_id"]==1) && (item["answer"]==5)){
                             poll_id=item2[6]["poll_id"];
                             question=item2[6]["question"];
                             answer=item2[6]["optionE"];
                        
                    }
                    else if((item["poll_id"] == 3) && (item["question_id"]==2) && (item["answer"]==1)){
                          poll_id=item2[7]["poll_id"];
                          question=item2[7]["question"];
                          answer=item2[7]["optionA"];
                    }
                    else if((item["poll_id"] == 3) && (item["question_id"]==2) && (item["answer"]==2)){
                          poll_id=item2[7]["poll_id"];
                          question=item2[7]["question"];
                          answer=item2[7]["optionB"];
                        
                    }
                    else if((item["poll_id"] == 3) && (item["question_id"]==3) && (item["answer"]==1)){
                          poll_id=item2[8]["poll_id"];
                          question=item2[8]["question"];
                          answer=item2[8]["optionA"];
                        
                    }
                    else if((item["poll_id"] == 3) && (item["question_id"]==3) && (item["answer"]==2)){
                          poll_id=item2[8]["poll_id"];
                          question=item2[8]["question"];
                          answer=item2[8]["optionB"];
                        
                    }
                    else if((item["poll_id"] == 3) && (item["question_id"]==3) && (item["answer"]==3)){
                          poll_id=item2[8]["poll_id"];
                          question=item2[8]["question"];
                          answer=item2[8]["optionC"];
                    }
                    else if((item["poll_id"] == 3) && (item["question_id"]==3) && (item["answer"]==4)){
                          poll_id=item2[8]["poll_id"];
                          question=item2[8]["question"];
                          answer=item2[8]["optionD"];
                        
                    }
                    else if((item["poll_id"] == 3) && (item["question_id"]==3) && (item["answer"]==5)){
                          poll_id=item2[8]["poll_id"];
                          question=item2[8]["question"];
                          answer=item2[8]["optionE"];
                    }
                    email=item['email'];
                    id=i;
                    live_polling_sessions.push([{"text":id},{"text":email},{"text":poll_id},{"text":question},{"text":answer}]);
                    i++;
                }
                
                //console.log(live_polling_sessions);
                var tabularData = [{
                "sheetName": "Sheet1",
                "data":live_polling_sessions
                }];
            
                var options = {
                    fileName: "Live_Polling_Report1",
                    extension: ".xlsx",
                    header: true,
                    maxCellWidth: 50
                };
                Jhxlsx.export(tabularData, options);
            });
    });
});
</script>
<body class="hold-transition sidebar-mini" style="text-align:center;">
<div id="content" class="wrapper" style="background:#fff!important;justify-content: center;
    align-items: center;">
  <div class="wrapper" style="margin-left:0!important;min-height: 100px !important;background: #f4f6f9!important;">
    <div class="pull-left" style="line-height: 36px;z-index: 999;cursor: pointer;margin-left:2%!important;margin-top:1%!important;">
      <img src="../dist/img/KONE_Logo.png" alt="" width="50%">
    </div>
  </div>
  <div id="homediv" class="pull-left" style="line-height: 36px;z-index: 999;cursor: pointer;margin-left:2.5%!important;margin-top:2%!important;">
      <a id="homebtn" class="btn" style="background: #0071b9;color: #fff;" href="{{ route('show_live_polling')}}">Home</a>
  </div>
  <div id="downloadiv" class="pull-right" style="line-height: 36px;z-index: 999;cursor: pointer;margin-right:2.5%!important;margin-top:2%!important;">
      <a id="downloadpdfbtn" class="btn" style="background: #0071b9;color: #fff;" href="#">Download PDF</a>
       <a id="downloadxlsxbtn" class="btn" style="background: #0071b9;color: #fff;" href="#">Download Excel</a>
       <input type="hidden" id="poll_id" value=""/>
  </div>
  <div id="container" class="container" style="min-height: 595px;">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><b>Select Live Poll</b></div>
    
                    <div class="card-body">
                        <form method="POST">
                            @csrf
    
                            <div class="form-group row">
                                <label for="poll_id" class="col-md-4 col-form-label text-md-right">{{ __('Live Poll') }}</label>
    
                                <div class="col-md-6" style='margin-top:1%;'>
                                    <Select id="polls_id" class="form-control @error('poll_id') is-invalid @enderror" name="poll_id" value="" required autocomplete="name" autofocus>
                                        <option value="0">-Select-</option>
                                        @foreach($live_pollings as $live_polling)
                                         <option value="{{$live_polling->poll_id}}">
                                           Live Poll {{$live_polling->poll_id}}
                                        </option>
                                       @endforeach
                                    </Select>
                                    @error('poll_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="graph-container" class="container col-md-12"></div>
  </div>
  <footer id="footer" class="main-footer" style="margin-left:0!important;bottom:0!important;">
    <strong>Copyright &copy; 2019-2020 <a href="#">Kone</a>.</strong>
    All rights reserved.
  </footer>
</div>
