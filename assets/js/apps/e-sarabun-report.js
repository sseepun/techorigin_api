var bookTypeChart = am4core.create("booktypechartdiv", am4charts.XYChart);


am4core.useTheme(am4themes_animated);

bookTypeChart.data = [
  {
    type: "บริหารทั่วไป",
    amount: 345,
    color: "#FFB822",
  },
  {
    type: "โต้ตอบทั่วไป",
    amount: 889,
    color: "#716ACA",
  },
  {
    type: "การเงิน งบประมาณ",
    amount: 889,
    color: "#0ABB87",
  },
  {
    type: "คำสั่ง มติคณะรัฐมนตรี",
    amount: 250,
    color: "#F4743B",
  },
  {
    type: "บริหารงานบุคคล",
    amount: 123,
    color: "#3E3C4F",
  },
  {
    type: "ประชุม",
    amount: 560,
    color: "#007AD9",
  },
  {
    type: "การฝึกอบรม/ดูงาน",
    amount: 485,
    color: "#FD397A",
  },
  {
    type: "วัสดุครุภัณฑ์ ที่ดิน",
    amount: 20,
    color: "#959CB6",
  },
  {
    type: "รายงาน สถิติ",
    amount: 500,
    color: "#00C5DC",
  },
  {
    type: "เบ็ดเตล็ด",
    amount: 470,
    color: "#F33E5C",
  },
];

var categoryAxis = bookTypeChart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "type";
categoryAxis.renderer.labels.template.disabled = true;
var valueAxis = bookTypeChart.yAxes.push(new am4charts.ValueAxis());

var series = bookTypeChart.series.push(new am4charts.ColumnSeries());
series.dataFields.valueY = "amount";
series.dataFields.categoryX = "type";
series.columns.template.width = am4core.percent(50);

bookTypeChart.legend = new am4charts.Legend();
bookTypeChart.legend.position = "left";

var columnTemplate = series.columns.template;
columnTemplate.strokeOpacity = 0;
columnTemplate.propertyFields.fill = "color";
