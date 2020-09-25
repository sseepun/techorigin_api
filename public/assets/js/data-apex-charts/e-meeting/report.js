
var options4 = {
   colors:['#FFB822','#FD397A','#5578EB','#5867C3','#D96C06','#00C5DC'],
   series: [{
      name: 'ห้องประชุม 1',
      data: [_rdm(160), _rdm(160), _rdm(160)]
   }, {
      name: 'ห้องประชุม 2',
      data: [_rdm(140), _rdm(140), _rdm(150)]
   }, {
      name: 'ห้องประชุม 3',
      data: [_rdm(140), _rdm(140), _rdm(150)]
   }, {
      name: 'ห้องประชุม 4',
      data: [_rdm(140), _rdm(140), _rdm(150)]
   }, {
      name: 'ห้องประชุม 5',
      data: [_rdm(150), _rdm(150), _rdm(150)]
   }, {
      name: 'ห้องประชุม 6',
      data: [_rdm(150), _rdm(150), _rdm(150)]
   }],
      chart: {
      type: 'bar',
      height: 500,
      toolbar: {
         show: false
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

 var chart4 = new ApexCharts(document.querySelector("#chartdiv"), options4);
 chart4.render();


function _rdm(_max){
   return Math.floor(Math.random() * _max) + Math.floor(Math.random() * 15);
}