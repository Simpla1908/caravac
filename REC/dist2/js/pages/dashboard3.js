$(function () {
  'use strict'

  // GET SALES FROM BDD
  $.ajax({
    
    url: './dist2/js/pages/sales.php',
    type: 'POST',
    success: function (data) {
      console.log(data);
      var totMoisEncours='$'+data.totMoisEncours;
      var totMoisPrec='$'+data.totMoisPrec;
      var totCouvertMoisEncours=data.totCouvertMoisEncours;
      var totCouvertMoisPrec=data.totCouvertMoisPrec;
      $('#totMoisEncours').text(totMoisEncours);
      $('#totMoisPrec').text(totMoisPrec);
      $('#totCouvertMoisEncours').text(totCouvertMoisEncours);
      $('#totCouvertMoisPrec').text(totCouvertMoisPrec);
      
      var mois =data.mois;
      var venteencours =data.encours;
      var venteprec =data.prec;

      
      console.log(mois);
      'use strict';

      var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
      };

      var mode      = 'index';
      var intersect = true;

      var $salesChart = $('#sales-chart')
     var salesChart  = new Chart($salesChart, {
    type   : 'bar',
    data   : {
      labels  :mois,
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor    : '#007bff',
          data           : venteencours
        },
        {
          backgroundColor: '#ced4da',
          borderColor    : '#ced4da',
          data           : venteprec
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value, index, values) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }
              return '$' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })

  var $visitorsChart = $('#visitors-chart')
  var visitorsChart  = new Chart($visitorsChart, {
    data   : {
      labels  :mois,
      datasets: [{
        type                : 'line',
        data                : data.couvertencours,
        backgroundColor     : 'transparent',
        borderColor         : '#007bff',
        pointBorderColor    : '#007bff',
        pointBackgroundColor: '#007bff',
        fill                : false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      },
        {
          type                : 'line',
          data                : data.couvertprec,
          backgroundColor     : 'tansparent',
          borderColor         : '#ced4da',
          pointBorderColor    : '#ced4da',
          pointBackgroundColor: '#ced4da',
          fill                : false
          // pointHoverBackgroundColor: '#ced4da',
          // pointHoverBorderColor    : '#ced4da'
        }]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero : true,
            suggestedMax: 200
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })
        
    },dataType: 'json'
    
  });
})
