var chart = am4core.create("chartdiv", am4charts.PieChart);
var chart2 = am4core.create("chartdiv2", am4charts.PieChart);
var chart3 = am4core.create("chartdiv3", am4charts.PieChart);

am4core.useTheme(am4themes_animated);

// Add data
chart.data = [
  {
    book: "หนังสือรับภายใน",
    amount: 345,
    color: am4core.color("#646C9A"),
  },
  {
    book: "หนังสือส่งภายใน",
    amount: 889,
    color: am4core.color("#1DC9B7"),
  },
];

chart2.data = [
  {
    book: "หนังสือรับภายใน",
    amount: 345,
    color: am4core.color("#646C9A"),
  },
  {
    book: "หนังสือส่งภายใน",
    amount: 889,
    color: am4core.color("#1DC9B7"),
  },
];

chart3.data = [
  {
    book: "ปกติ",
    amount: 3016,
    color: am4core.color("#74788D"),
  },
  {
    book: "ด่วน",
    amount: 1624,
    color: am4core.color("#3D60C5"),
  },
  {
    book: "ด่วนมาก",
    amount: 1044,
    color: am4core.color("#F7A93B"),
  },
  {
    book: "ด่วนมากที่สุด",
    amount: 117,
    color: am4core.color("#C42B52"),
  },
];

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "amount";
pieSeries.dataFields.category = "book";

chart.innerRadius = am4core.percent(50);

pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 1;

// Disable ticks and labels
pieSeries.labels.template.disabled = true;
pieSeries.ticks.template.disabled = true;

// Disable tooltips
pieSeries.slices.template.tooltipText = "";

// Change color
pieSeries.slices.template.propertyFields.fill = "color";

chart.legend = new am4charts.Legend();
chart.legend.position = "left";
chart.legend.valueLabels.template.text = "{amount}";

// Add and configure Series
var pieSeries2 = chart2.series.push(new am4charts.PieSeries());
pieSeries2.dataFields.value = "amount";
pieSeries2.dataFields.category = "book";

// Let's cut a hole in our Pie chart the size of 40% the radius
chart2.innerRadius = am4core.percent(50);

pieSeries2.slices.template.stroke = am4core.color("#fff");
pieSeries2.slices.template.strokeWidth = 1;

// Disable ticks and labels
pieSeries2.labels.template.disabled = true;
pieSeries2.ticks.template.disabled = true;

// Disable tooltips
pieSeries2.slices.template.tooltipText = "";

// Change color
pieSeries2.slices.template.propertyFields.fill = "color";

// Add a legend
chart2.legend = new am4charts.Legend();
chart2.legend.position = "left";
chart2.legend.valueLabels.template.text = "{amount}";

// Add and configure Series
var pieSeries3 = chart3.series.push(new am4charts.PieSeries());
pieSeries3.dataFields.value = "amount";
pieSeries3.dataFields.category = "book";

// Let's cut a hole in our Pie chart the size of 40% the radius
chart3.innerRadius = am4core.percent(50);

pieSeries3.slices.template.stroke = am4core.color("#fff");
pieSeries3.slices.template.strokeWidth = 1;

// Disable ticks and labels
pieSeries3.labels.template.disabled = true;
pieSeries3.ticks.template.disabled = true;

// Disable tooltips
pieSeries3.slices.template.tooltipText = "";

// Change color
pieSeries3.slices.template.propertyFields.fill = "color";

// Add a legend
chart3.legend = new am4charts.Legend();
chart3.legend.position = "left";
chart3.legend.valueLabels.template.text = "{amount}";

var lineChart = am4core.create("linechart", am4charts.XYChart);

lineChart.data = [
  {
    type: "บริหารทั่วไป",
    amount: 345
  },
  {
    type: "โต้ตอบทั่วไป",
    amount: 889
  },
  {
    type: "การเงิน งบประมาณ",
    amount: 200
  },
  {
    type: "คำสั่ง มติคณะรัฐมนตรี",
    amount: 345
  },
  {
    type: "บริหารงานบุคคล",
    amount: 596
  },
  {
    type: "ประชุม",
    amount: 254
  },
  {
    type: "การฝึกอบรม/ดูงาน",
    amount: 456
  },
  {
    type: "วัสดุครุภัณฑ์ ที่ดิน",
    amount: 575
  },
  {
    type: "รายงาน สถิติ",
    amount: 680
  },
  {
    type: "เบ็ดเตล็ด",
    amount: 785
  },
];

var categoryAxis = lineChart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "type";
categoryAxis.renderer.labels.template.disabled = true;
var valueAxis = lineChart.yAxes.push(new am4charts.ValueAxis());

var series = lineChart.series.push(new am4charts.LineSeries());
series.dataFields.valueY = "amount";
series.dataFields.categoryX = "type";
series.columns.template.width = am4core.percent(50);

lineChart.legend = new am4charts.Legend();
lineChart.legend.position = "left";
