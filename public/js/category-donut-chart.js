'use strict';
document.addEventListener('DOMContentLoaded', function () {
  const chartElement = document.querySelector('#ambulance-service-statistics');

  if (chartElement && chartElement.dataset) {
    setTimeout(function () {


      var options = {
        chart: {
          height: 300,
          type: 'donut'
        },
        dataLabels: {
          enabled: false
        },
        legend: {
          show: false,
          position: 'bottom'
        },
        plotOptions: {
          pie: {
            donut: {
              size: '65%'
            }
          }
        },
        labels: ['New', 'Approved', 'Rejected'],
        series: [
          parseInt(chartElement.dataset.new),
          parseInt(chartElement.dataset.approved),
          parseInt(chartElement.dataset.rejected)
        ],
        colors: ['#1c232f', '#2196f3', '#d1cdf6']
      };
      var chart = new ApexCharts(document.querySelector('#ambulance-service-statistics'), options);
      chart.render();
    }, 500);
  }
});