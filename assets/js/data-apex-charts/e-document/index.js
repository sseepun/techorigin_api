var options1 = {
   series: [27, 73],
   chart: {
      type: 'donut',
      width: 320,
   },
   colors: ['#C42B52','#B8BAC3'],
   labels: ['พื้นที่ใช้ไป', 'พื้นที่เหลือ'],
   legend: {
     position: 'right',
     offsetY: 40
   },
   dataLabels: {
      enabled: false,
   },
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

 var chart1 = new ApexCharts(document.querySelector("#chartdiv"), options1);
 chart1.render();


 var options2 = {
   series: [_rdm(110), _rdm(150), _rdm(150), _rdm(150)],
   chart: {
      type: 'donut',
      width: 320,
   },
   colors: ['#2786FB','#C42B52','#0DA393','#F7A93B'],
   labels: ['เอกสาร', 'วิดีโอ','รูปภาพ', 'บีบอัดข้อมูล'],
   legend: {
     position: 'right',
     offsetY: 30
   },
   dataLabels: {
      enabled: false,
   },
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
 var chart2 = new ApexCharts(document.querySelector("#chartdiv2"), options2);
 chart2.render();


 var options3 = {
   colors:['#FFB822','#FD397A','#5578EB','#5867C3','#D96C06'],
   series: [{
      name: 'ระบบบริหารและจัดการงานเอกสาร',
      data: [_rdm(160), _rdm(160), _rdm(160)]
   }, {
      name: 'ระบบสารบรรณอิเล็กทรอนิกส์',
      data: [_rdm(140), _rdm(140), _rdm(150)]
   }, {
      name: 'การบริหารจัดการประชุม',
      data: [_rdm(140), _rdm(140), _rdm(150)]
   }, {
      name: 'ระบบ Task & Project Management',
      data: [_rdm(140), _rdm(140), _rdm(150)]
   }, {
      name: 'ระบบคลังพัสดุและระบบทะเบียนทรัพย์สิน',
      data: [_rdm(150), _rdm(150), _rdm(150)]
   }],
      chart: {
      type: 'bar',
      height: 235,
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
      categories: ["Week 1", "Week 2", "Week 3"]
   },
   legend: {
      show: false
   }
 };

 var chart3 = new ApexCharts(document.querySelector("#chartdiv3"), options3);
 chart3.render();



 var options4 = {
   colors: ['#2786FB'],
   series: [{
      name: 'อัพโหลด (MB)',
      data: [_rdm(150), _rdm(150), _rdm(150), _rdm(150),_rdm(150), _rdm(110), _rdm(150), _rdm(150)]
   }],
   chart: {
      height: 250,
      type: 'area',
      toolbar: {
         show: false
      },
      sparkline: {
        enabled: true
      }
   },
   dataLabels: {
      enabled: false
   },
   stroke: {
      curve: 'smooth'
   },
   xaxis: {
      categories: ["day 1-4", "day 5-8", "day 9-12", "day 13-16","day 17-20", "day 21-24", "day 25-28", "day 29-31"]
   }
 };
 var chart4 = new ApexCharts(document.querySelector("#linechart"), options4);
 chart4.render();



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