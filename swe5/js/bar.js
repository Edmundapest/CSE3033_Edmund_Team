$(document).ready(function(){
  $.ajax({
    url: "http://localhost/swe5/data.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      var player = [];
      var score = [];

      for(var i in data) {
        player.push(data[i].activities);
        score.push(data[i].stressLevel);
      }

      var chartdata = {
        labels: player,
        datasets : [
          {
            label: 'chart',
            backgroundColor: 'rgba(0, 153, 255, 0.75)',
            borderColor: 'rgba(200, 200, 200, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: score 
          
          }
        ]
       
      };

      var ctx = $("#mycanvas");


      var barGraph = new Chart(ctx, {
        type: 'bar',
        data: chartdata,
        options:{
            scales:{
                xAxes:[{stacked:true}],
                yAxes:[{stacked:true}]
            }
        }
      });
    },
    error: function(data) {
      console.log(data);
    }
  });
});