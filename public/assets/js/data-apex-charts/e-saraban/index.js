var options1 = {
   colors: ['#646C9A','#0DA393'],
   series: [{
      name: 'หนังสือรับภายใน',
      data: [_rdm(1150), _rdm(1150), _rdm(1150), _rdm(1150),_rdm(1150), _rdm(1150), _rdm(1150), _rdm(1150)]
   }, {
      name: 'หนังสือส่งภายใน',
      data: [_rdm(1150), _rdm(1150), _rdm(1150), _rdm(1150),_rdm(1150), _rdm(1150), _rdm(1150), _rdm(1150)]
   }],
   chart: {
      height: 150,
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
 var chart1 = new ApexCharts(document.querySelector("#chartdiv"), options1);
 chart1.render();


 var options2 = {
   colors: ['#F7A93B','#2786FB'],
   series: [{
      name: 'หนังสือรับภายนอก',
      data: [_rdm(1150), _rdm(1150), _rdm(1150), _rdm(1150),_rdm(1150), _rdm(1150), _rdm(1150), _rdm(1150)]
   }, {
      name: 'หนังสือส่งภายนอก',
      data: [_rdm(1150), _rdm(1150), _rdm(1150), _rdm(1150),_rdm(1150), _rdm(1150), _rdm(1150), _rdm(1150)]
   }],
   chart: {
      height: 150,
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
 var chart2 = new ApexCharts(document.querySelector("#chartdiv2"), options2);
 chart2.render();



 var options3 = {
   series: [_rdm(1500), _rdm(1500), _rdm(900), _rdm(700)],
   chart: {
      type: 'donut',
      width: 320,
   },
   colors: ['#0DA393','#3D60C5','#F7A93B','#C42B52'],
   labels: ['ปกติ', 'ด่วน','ด่วนมาก', 'ด่วนมากที่สุด'],
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
 var chart3 = new ApexCharts(document.querySelector("#chartdiv3"), options3);
 chart3.render();



 var options4 = {
   series: [_rdm(1500), _rdm(1500), _rdm(900), _rdm(700)],
   chart: {
      type: 'donut',
      width: 320,
   },
   colors: ['#74788D','#716ACA','#00C5DC','#F33E5C'],
   labels: ['ปกติ', 'ลับ','ลับมาก', 'ลับมากที่สุด'],
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
 var chart4 = new ApexCharts(document.querySelector("#chartdiv4"), options4);
 chart4.render();


 var options5 = {
   colors:['#FFB822','#FD397A','#5578EB','#5867C3','#D96C06','#00C5DC','#F33E5C','#0ABB87','#74788D'],
   series: [{
      name: 'บริหารทั่วไป',
      data: [_rdm(160), _rdm(160), _rdm(160), _rdm(150)]
   }, {
      name: 'โต้ตอบทั่วไป',
      data: [_rdm(140), _rdm(140), _rdm(150), _rdm(150)]
   }, {
      name: 'การเงิน งบประมาณ',
      data: [_rdm(140), _rdm(140), _rdm(150), _rdm(150)]
   }, {
      name: 'คำสั่ง มติคณะรัฐมนตรี',
      data: [_rdm(140), _rdm(140), _rdm(150, _rdm(150))]
   }, {
      name: 'ประชุม',
      data: [_rdm(150), _rdm(150), _rdm(150), _rdm(150)]
   }, {
      name: 'การฝึกอบรม/ดูงาน',
      data: [_rdm(150), _rdm(150), _rdm(150), _rdm(150)]
   }, {
      name: 'วัสดุครุภัณฑ์ ที่ดิน',
      data: [_rdm(150), _rdm(150), _rdm(150), _rdm(150)]
   }, {
      name: 'รายงาน สถิติ',
      data: [_rdm(150), _rdm(150), _rdm(150), _rdm(150)]
   }, {
      name: 'เบ็ดเตล็ด',
      data: [_rdm(150), _rdm(150), _rdm(150), _rdm(150)]
   }],
      chart: {
      type: 'bar',
      height: 350,
      width: '100%',
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
      categories: ["Week 1", "Week 2", "Week 3", "Week 4"],
   },
   legend: {
      position: 'right',
      offsetY: 40
   }
 };

 var chart5 = new ApexCharts(document.querySelector("#booktypechartdiv"), options5);
 chart5.render();

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