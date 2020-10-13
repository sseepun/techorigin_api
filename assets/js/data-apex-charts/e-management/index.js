function getRangeRandom(max, min) {
   return Math.floor(Math.random() * (max - min + 1)) + min;
 }


//spark lines start
window.Apex = {
   dataLabels: {
     enabled: false
   }
 };
 
 var device1 = {
   chart: {
     id: 'sparkline1',
     type: 'area',
     height: 130,
     sparkline: {
       enabled: true
     },
     group: 'sparklines'
   },
   series: [{
     name: 'Mobile',
     data: [825, 866, 941, 850, 944, 1012, 936]
   }],
   labels: ["Sun", "Mun", "The", "Wed", "Thu", "Fri", "Sat"],
   stroke: {
     curve: 'smooth'
   },
   markers: {
     size: 0
   },
   tooltip: {
     fixed: {
       enabled: true,
       position: 'right'
     },
     x: {
       show: true
     }
   },
   colors: ['#1dc9b7'],
   fill: {
     type: "gradient",
     gradient: {
       shadeIntensity: 1,
       opacityFrom: 0.6,
       opacityTo: 0.8,
       stops: [0, 100]
     }
   }
 }
 
 var device2 = {
   chart: {
     id: 'sparkline2',
     type: 'area',
     height: 130,
     sparkline: {
       enabled: true
     },
     group: 'sparklines'
   },
   series: [{
     name: 'Tablet',
     data: [625, 600, 641, 650, 660, 674, 664]
   }],
   labels: ["Sun", "Mun", "The", "Wed", "Thu", "Fri", "Sat"],
   stroke: {
     curve: 'smooth'
   },
   markers: {
     size: 0
   },
   tooltip: {
     fixed: {
       enabled: true,
       position: 'right'
     },
     x: {
       show: true
     }
   },
   colors: ['#2786fb'],
   fill: {
     type: "gradient",
     gradient: {
       shadeIntensity: 1,
       opacityFrom: 0.6,
       opacityTo: 0.8,
       stops: [0, 100]
     }
   }
 }
 
 var device3 = {
   chart: {
     id: 'sparkline3',
     type: 'area',
     height: 130,
     sparkline: {
       enabled: true
     },
     group: 'sparklines'
   },
   series: [{
     name: 'Desktop',
     data: [1665, 1680, 1710, 1700, 1680, 1724, 1754]
   }],
   labels: ["Sun", "Mun", "The", "Wed", "Thu", "Fri", "Sat"],
   stroke: {
     curve: 'smooth'
   },
   markers: {
     size: 0
   },
   tooltip: {
     fixed: {
       enabled: true,
       position: 'right'
     },
     x: {
       show: true
     }
   },
   colors: ['#C42B52'],
   xaxis: {
     crosshairs: {
       width: 1
     },
   },
   fill: {
     type: "gradient",
     gradient: {
       shadeIntensity: 1,
       opacityFrom: 0.6,
       opacityTo: 0.8,
       stops: [0, 100]
     }
   }
 }
 
 new ApexCharts(document.querySelector("#Device1"), device1).render();
 new ApexCharts(document.querySelector("#Device2"), device2).render();
 new ApexCharts(document.querySelector("#Device3"), device3).render();
//sparkline end


// browser
 var browser = {
   series: [getRangeRandom(890,567), getRangeRandom(590,267), getRangeRandom(590,267), getRangeRandom(390,167), getRangeRandom(290,167), getRangeRandom(290,67), getRangeRandom(190,67)],
   chart: {
   type: 'donut',
 },
 legend: {
   position: 'bottom'
 },
 dataLabels: {
   enabled: true
 },
 labels: ["Chrome", "Edge", "IE", "Firefox", "Safari", "Chrome (In-app)", "Android Browser"],
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

 new ApexCharts(document.querySelector("#browser"), browser).render();
// browser end

// Os
var oschart = {
   series: [getRangeRandom(3890,567), getRangeRandom(3590,267), getRangeRandom(3590,267), getRangeRandom(2345,167), getRangeRandom(1234,167), getRangeRandom(456,167)],
   chart: {
   type: 'donut',
 },
 legend: {
   position: 'bottom'
 },
 dataLabels: {
   enabled: true
 },
 colors: ['#FFB822','#FD397A','#5578EB','#5867C3','#D96C06','#00C5DC'],
 labels: ["Windows", "iOs", "Android", "Macintosh","iPad","Linux"],
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

 new ApexCharts(document.querySelector("#oschart"), oschart).render();
// Os end


//static user 
var visitor1 = {
   series: [{
      name: 'จำนวนผู้ใช้งาน',
      data: [getRangeRandom(1890,1567), getRangeRandom(1890,1567), getRangeRandom(1890,1567), getRangeRandom(1890,1567), getRangeRandom(1890,1567), getRangeRandom(1890,1567), getRangeRandom(1890,1567), getRangeRandom(1890,1567)]
   }],
   chart: {
      id: 'fb',
      group: 'social',
      type: 'line',
      height: 170,
      toolbar: {
         show: false
      }
   },
   grid: {
      show: false
   },
	yaxis: [{
		labels: {
			show: false,
		},
      title: {
        text: 'จำนวนผู้ใช้งาน'
      }
	}],
   tooltip: {
     enabled: true,
     x: {
       show: false
     }
   },
   dataLabels: {
      enabled: true
   },
   colors: ['#C42B52'],
   fill: {
     type: 'gradient',
     gradient: {
       shade: 'dark',
       gradientToColors: ['#70021e'],
       shadeIntensity: 1,
       type: 'horizontal',
       opacityFrom: 0.7,
       opacityTo: 1,
       stops: [20, 100]
     },
   },
   stroke: {
      width: 5,
      curve: 'smooth'
   },
   legend: {
      show: false,
   },
   xaxis: {
		labels: {
			show: false,
		},
      categories: ["day 1-4", "day 5-8", "day 9-12", "day 13-16","day 17-20", "day 21-24", "day 25-28", "day 29-31"]
   }
   };
 new ApexCharts(document.querySelector("#visitor1"), visitor1).render();

 var visitor2 = {
   series: [{
      name: 'จำนวนการเปิดหน้าจอ',
      data: [getRangeRandom(3890,3567), getRangeRandom(3890,3567), getRangeRandom(3890,3567), getRangeRandom(3890,3567), getRangeRandom(3890,3567), getRangeRandom(3890,3567), getRangeRandom(3890,3567), getRangeRandom(3890,3567)]
   }],
   chart: {
      id: 'tw',
      group: 'social',
      type: 'line',
      height: 170,
      toolbar: {
         show: false
      }
   },
   grid: {
      show: false
   },
	yaxis: [{
		labels: {
			show: false,
		},
      title: {
        text: 'จำนวนการเปิดหน้าจอ'
      }
	}],
   tooltip: {
     enabled: true,
     x: {
       show: false
     }
   },
   dataLabels: {
      enabled: true
   },
   colors: ['#056056'],
   fill: {
     type: 'gradient',
     gradient: {
       shade: 'dark',
       gradientToColors: ['#1dc9b7'],
       shadeIntensity: 1,
       type: 'horizontal',
       opacityFrom: 1,
       opacityTo: 1,
       stops: [20, 100]
     },
   },
   stroke: {
      width: 5,
      curve: 'smooth'
   },
   xaxis: {
		labels: {
			show: false,
		},
      categories: ["day 1-4", "day 5-8", "day 9-12", "day 13-16","day 17-20", "day 21-24", "day 25-28", "day 29-31"]
   }
   };
 new ApexCharts(document.querySelector("#visitor2"), visitor2).render();

 var visitor3 = {
   series: [{
      name: 'เวลาเฉลี่ยที่ใช้งานระบบ (นาที)',
      data: [getRangeRandom(10.5,4.8), getRangeRandom(11.2,4.5), getRangeRandom(11.5,4.9), getRangeRandom(12.2,4.5), getRangeRandom(12.1,4.5), getRangeRandom(12.1,5.6), getRangeRandom(12.9,6.2), getRangeRandom(12.3,5.4)]
   }],
   chart: {
      id: 'yt',
      group: 'social',
      type: 'line',
      height: 170,
      toolbar: {
         show: false
      }
   },
   grid: {
      show: false
   },
	yaxis: [{
		labels: {
			show: false,
		},
      title: {
        text: 'เวลาเฉลี่ยที่ใช้งานระบบ (นาที)'
      }
	}],
   tooltip: {
     enabled: true,
     x: {
       show: false
     }
   },
   dataLabels: {
      enabled: true
   },
   colors: ['#2C1A6B'],
   fill: {
     type: 'gradient',
     gradient: {
       shade: 'dark',
       gradientToColors: ['#724aff'],
       shadeIntensity: 1,
       type: 'horizontal',
       opacityFrom: 1,
       opacityTo: 1,
       stops: [20, 100]
     },
   },
   stroke: {
      width: 5,
      curve: 'smooth'
   },
   xaxis: {
		labels: {
			show: false,
		},
      categories: ["day 1-4", "day 5-8", "day 9-12", "day 13-16","day 17-20", "day 21-24", "day 25-28", "day 29-31"]
   }
 };
new ApexCharts(document.querySelector("#visitor3"), visitor3).render();
 // static user end


 // App
 var appchart = {
   series: [{
   name: 'ระบบที่เข้าใช้งานมากที่สุด',
   data: [getRangeRandom(5890,3567), getRangeRandom(4090,2667), getRangeRandom(3890,2067), getRangeRandom(2890,1067), getRangeRandom(2890,1067)]
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
     horizontal: false,
   }
 },
 tooltip: {
   enabled: true,
   x: {
     show: true
   }
 },
 dataLabels: {
   enabled: false
 },
 colors: ['#090737'],
 fill: {
   type: 'gradient',
   gradient: {
     shade: 'dark',
     gradientToColors: ['#724aff'],
     shadeIntensity: 1,
     type: 'vertical',
     opacityFrom: 1,
     opacityTo: 1,
     stops: [20, 100]
   },
 },
 xaxis: {
   categories: ['ระบบ Wall Streaming', 'ระบบจองห้องประชุม', 'จัดการงานเอกสาร', 'ระบบสารบรรณอิเล็กทรอนิกส์', 'ระบบสวัสดิการ'],
 }
 };
new ApexCharts(document.querySelector("#appchart"), appchart).render();
 // app end

 // Resolution
 var resolution = {
   series: [{
   name: 'ขนาดหน้าจอ',
   data: [5820,4536,3541,2134,1487,1393,1130,904]
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
 tooltip: {
   enabled: true,
   x: {
     show: true
   }
 },
 colors: ['#dd0edf'],
 fill: {
   type: 'gradient',
   gradient: {
     shade: 'dark',
     gradientToColors: ['#6b066c'],
     shadeIntensity: 1,
     type: 'horizontal',
     opacityFrom: 1,
     opacityTo: 1,
     stops: [20, 100]
   },
 },
 dataLabels: {
   enabled: true
 },
 xaxis: {
   categories: ['1024x768', '1280x800', '1280x1024', '1440x900', '1680x1050','1152x864','1366x768','1920x1200','1280x768'],
 }
 };
new ApexCharts(document.querySelector("#resolution"), resolution).render();

 // Resolution end


 // Timeused
 var timeused = {
   series: [{
   name: 'ช่วงเวลา',
   data: [getRangeRandom(5890,3567), getRangeRandom(4090,2667), getRangeRandom(3890,2067), getRangeRandom(2890,1067), getRangeRandom(2890,1067), getRangeRandom(2890,1067), getRangeRandom(2890,1067), getRangeRandom(2890,1067), getRangeRandom(2890,1067)]
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
     horizontal: false,
   }
 },
 tooltip: {
   enabled: true,
   x: {
     show: true
   }
 },
 dataLabels: {
   enabled: false
 },
 colors: ['#05544c'],
 fill: {
   type: 'gradient',
   gradient: {
     shade: 'dark',
     gradientToColors: ['#1dc9b7'],
     shadeIntensity: 1,
     type: 'vertical',
     opacityFrom: 1,
     opacityTo: 1,
     stops: [20, 100]
   },
 },
 xaxis: {
   categories: ['08:00-09:00', '09:01-10:00', '10:01-11:00', '11:01-12:00', '12:01-13:00', '13:01-14:00', '14:01-15:00', '15:01-16:00', '16:01-17:00'],
 }
 };
new ApexCharts(document.querySelector("#timeused"), timeused).render();
 // app end

 // Devices
var device = {
   series: [getRangeRandom(3890,2567), getRangeRandom(2590,1267), getRangeRandom(1456,167)],
   chart: {
   type: 'donut',
 },
 legend: {
   position: 'bottom'
 },
 dataLabels: {
   enabled: true
 },
 colors: ['#C42B52','#5867dd','#ffb822'],
 labels: ["Desktop", "Mobile", "Tablet"],
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

 new ApexCharts(document.querySelector("#device"), device).render();
// Devices end