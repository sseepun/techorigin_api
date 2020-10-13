var options1 = {
   colors:['#f7a93b'],
      series: [{
      data: [_rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40)]
   }],
   chart: {
      type: 'bar',
      width: '100%',
      height: 80,
      sparkline: {
         enabled: true
      }
   },
   plotOptions: {
      bar: {
      columnWidth: '80%'
      }
   },
   xaxis: {
      crosshairs: {
      width: 1
      },
   },
   tooltip: {
      fixed: {
      enabled: false
      },
      x: {
      show: false
      },
      y: {
      title: {
         formatter: function (seriesName) {
            return ''
         }
      }
      },
      marker: {
      show: false
      }
   }
};

var chart1 = new ApexCharts(document.querySelector("#bartypechart1"), options1);
chart1.render();




var options2 = {
   colors:['#1dc9b7'],
   series: [{
      data: [_rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40)]
   }],
   chart: {
      type: 'bar',
      width: '100%',
      height: 80,
      sparkline: {
         enabled: true
      }
   },
   plotOptions: {
      bar: {
         columnWidth: '80%'
      }
   },
   xaxis: {
      crosshairs: {
         width: 1
      }
   },
   tooltip: {
      fixed: {
       enabled: false
      },
      x: {
         show: false
      },
      y: {
         title: {
            formatter: function (seriesName) {
               return ''
            }
         }
      },
      marker: {
         show: false
      }
   }
};

var chart2 = new ApexCharts(document.querySelector("#bartypechart2"), options2);
chart2.render();



var options3 = {
   colors:['#c42b52'],
   series: [{
      data: [_rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40)]
   }],
   chart: {
   type: 'bar',
   width: '100%',
   height: 80,
   sparkline: {
      enabled: true
   }
   },
   plotOptions: {
      bar: {
      columnWidth: '80%'
   }
   },
   xaxis: {
      crosshairs: {
         width: 1
      },
   },
   tooltip: {
      fixed: {
         enabled: false
      },
      x: {
         show: false
      },
      y: {
         title: {
            formatter: function (seriesName) {
               return ''
            }
         }
      },
      marker: {
         show: false
      }
   }
};

var chart3 = new ApexCharts(document.querySelector("#bartypechart3"), options3);
chart3.render();


var options4 = {
colors:['#FFB822','#FD397A','#5578EB','#5867C3','#D96C06','#00C5DC'],
series: [{
   name: 'รถเก๋ง กข 1234',
   data: [_rdm(160), _rdm(160), _rdm(160)]
}, {
   name: 'รถเก๋ง กข 2345',
   data: [_rdm(140), _rdm(140), _rdm(150)]
}, {
   name: 'รถเก๋ง กข 3456',
   data: [_rdm(140), _rdm(140), _rdm(150)]
}, {
   name: 'รถเก๋ง กข 4567',
   data: [_rdm(140), _rdm(140), _rdm(150)]
}, {
   name: 'รถตู้ กค 1234',
   data: [_rdm(150), _rdm(150), _rdm(150)]
}, {
   name: 'รถตู้ กค 2345',
   data: [_rdm(150), _rdm(150), _rdm(150)]
}],
   chart: {
   type: 'bar',
   height: 430,
   toolbar: {
      show: false,
   }
},
dataLabels: {
   enabled: false
},
stroke: {
   show: true,
   width: 1,
   colors: ['#fff']
},
xaxis: {
   categories: ["Jan", "Feb", "Mar"],
},
legend: {
   position: 'right',
   offsetY: 40
}
};

var chart4 = new ApexCharts(document.querySelector("#bartypechart4"), options4);
chart4.render();


function _rdm(_max){
return Math.floor(Math.random() * _max) + Math.floor(Math.random() * 15);
}