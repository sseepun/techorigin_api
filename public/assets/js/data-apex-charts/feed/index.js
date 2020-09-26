
if($("#linechart1").length){
   var options1 = {
      colors:['#c42b52'],
         series: [{
            data: [_rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40),_rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40)]
      }],
         chart: {
         type: 'area',
         width: '100%',
         height: 120,
         sparkline: {
            enabled: true
         }
      },
      stroke: {
      curve: 'smooth'
      },
      fill: {
      opacity: 0.3
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

   var chart1 = new ApexCharts(document.querySelector("#linechart1"), options1);
   chart1.render();
}


if($("#linechart2").length){
   var options2 = {
      colors:['#f7a93b'],
      series: [{
         data: [_rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40),_rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40)]
   }],
      chart: {
      type: 'area',
      width: '100%',
      height: 120,
      sparkline: {
         enabled: true
      }
   },
   stroke: {
   curve: 'smooth'
   },
   fill: {
   opacity: 0.3
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

   var chart2 = new ApexCharts(document.querySelector("#linechart2"), options2);
   chart2.render();
}


if($("#linechart3").length){
   var options3 = {
      colors:['#1dc9b7'],
      series: [{
         data: [_rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40),_rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40), _rdm(40)]
   }],
      chart: {
      type: 'area',
      width: '100%',
      height: 120,
      sparkline: {
         enabled: true
      }
   },
   stroke: {
     curve: 'smooth'
   },
   fill: {
     opacity: 0.3
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
   
   var chart3 = new ApexCharts(document.querySelector("#linechart3"), options3);
   chart3.render();
}


if($("#projectprogress").length){
   var options4 = {
      series: [{
      data: [_rdm(60), _rdm(70), _rdm(50), _rdm(55), _rdm(66), _rdm(77), _rdm(56)]
   }],
      chart: {
      type: 'bar',
      height: 350,
      toolbar: {
         show: false
      }
   },
   plotOptions: {
      bar: {
      horizontal: true,
      }
   },
   dataLabels: {
      enabled: false
   },
   xaxis: {
      categories: ['โครงการ 1', 'โครงการ 2', 'โครงการ 3', 'โครงการ 4', 'โครงการ 5', 'โครงการ 6', 'โครงการ 7'],
   }
   };
   
   var chart4 = new ApexCharts(document.querySelector("#projectprogress"), options4);
   chart4.render();
}


if($("#staticlogin").length){
   var options5 = {
     series: [
        {
        data: [_rdm(2360), _rdm(3260), _rdm(4260), _rdm(3860), _rdm(5460), _rdm(3460), _rdm(5460)]
        }
     ],
     chart: {
        height: 350,
        type: 'line',
        toolbar: {
        show: false
        }
     },
     colors: ['#5578eb'],
     dataLabels: {
        enabled: true,
     },
     stroke: {
        curve: 'smooth'
     },
     markers: {
        size: 1
     },
     xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        title: {
        text: 'เดือน'
        }
     },
     yaxis: {
        title: {
        text: 'จำนวนเข้าใช้งานระบบ'
        }
     }
   };
  
   var chart5 = new ApexCharts(document.querySelector("#staticlogin"), options5);
   chart5.render();
}


if($("#diskspace").length){
   var options6 = {
     series: [27, 73],
     chart: {
     type: 'donut',
   },
   colors: ['#C42B52','#B8BAC3'],
   labels: ['พื้นที่ใช้ไป', 'พื้นที่เหลือ'],
   responsive: [{
     breakpoint: 480,
     options: {
       chart: {
         width: 200
       },
       legend: {
         position: 'bottom'
       }
     }
   }]
   };
  
   var chart6 = new ApexCharts(document.querySelector("#diskspace"), options6);
   chart6.render();
}


function _rdm(_max){
   var re = _max;
   if(_max>2000){
      re = (_max/2)+ (Math.floor(Math.random() * 50)+345 * Math.floor(Math.random() * 10)+120);
   }else if(_max>1000){
      re = (_max/2)+Math.floor(Math.random() * _max) + Math.floor(Math.random() * 15);
   }else{
      re = Math.floor(Math.random() * _max) + Math.floor(Math.random() * 15);
   } 
   return re;
}
