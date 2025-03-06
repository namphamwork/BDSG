<!-- <canvas id="myChart" style="width:100%;max-width:570px"></canvas> -->

  <script>
  var xValues = [];
  var yValues = [];
  generateData("Math.sin(x)", 0, 5, 1);
  
  new Chart("myChart", {
    type: "line",
    data: {
      labels: xValues,
      datasets: [{
        fill: false,
        pointRadius: 2,
        borderColor: "rgba(0,0,255,0.5)",
        data: yValues
      }]
    },    
    options: {
      legend: {display: false},
      title: {
        display: true,
        text: "Lượt mua",
        fontSize: 16
      }
    }
  });
  function generateData(value, i1, i2, step = 1) {
    for (let x = i1; x <= i2; x += step) {
      yValues.push(eval(value));
      xValues.push(x);
    }
  }
  </script>
  <canvas id="myChart2" style="width:100%;max-width:550px"></canvas>

  <script>
  var xValues = ["Tuần 1", "Tuần 2", "Tuần 3", "Tuần 4", "Tuần 5"];
  var yValues = [25,35, 40, 37, 55,0];
  var barColors = "rgba(0,0,255,0.5)";
  
  new Chart("myChart2", {
    type: "bar",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      legend: {display: false},
      title: {
        display: true,
        text: "Doanh thu / triệu"
      }
    }
  });
  </script>