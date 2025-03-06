

const revenueChart = document.getElementById('revenueChart');


fetch("./include/revenue.php")
    .then(res => res.json())
    .then(data => {
        myRevenueChart(data)
    })

    function myRevenueChart(data){
        let dataLabels = []
        let dataChart = []
        const month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
        
        data.map(order =>{
            const mydate = new Date(order.purchase_time);
            var date = new Date(), y = date.getFullYear(), m = date.getMonth();
            var lastDay = new Date(y, m + 1, 0);

            const d = new Date();
            let thisdate = d.getDate();

            for(let i =0; i<lastDay.getDate(); i++){
                thisLabel = i+1 +`/` + (m + 1)
                if(dataLabels[i] == thisLabel && i+1 == mydate.getDate()){
                    dataChart[i] += order.total_cost
                }else if(mydate.getDate() == i+1){
                    dataLabels.push(thisLabel)
                    dataChart.push(order.total_cost)
                }
                else if(dataLabels[i] != thisLabel){
                    
                    dataLabels[i] = (thisLabel)
                    dataChart[i] = 0
                } 
            }
        })
        if(revenueChart)
        new Chart("revenueChart", {
          type: 'line',
          data: {
            labels: dataLabels,
            datasets: [{
              label: 'Doanh thu (VNĐ)',
              data: dataChart,
              borderWidth: 2,
              fill: true,
            //   borderColor: 'rgb(75, 192, 192)',
              backgroundColor: 'rgb(45, 156, 219, 0.5)'
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
    }