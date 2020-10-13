var chart = am4core.create("chartdiv", am4charts.PieChart);
var chart2 = am4core.create("chartdiv2", am4charts.PieChart);
var chart3 = am4core.create("chartdiv3", am4charts.PieChart);
var chart4 = am4core.create("chartdiv4", am4charts.PieChart);

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

chart4.data = [
  {
    book: "ปกติ",
    amount: 3132,
    color: am4core.color("#74788D"),
  },
  {
    book: "ด่วน",
    amount: 1856,
    color: am4core.color("#3D60C5"),
  },
  {
    book: "ด่วนมาก",
    amount: 580,
    color: am4core.color("#F7A93B"),
  },
  {
    book: "ด่วนมากที่สุด",
    amount: 233,
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

// Add and configure Series
var pieSeries4 = chart4.series.push(new am4charts.PieSeries());
pieSeries4.dataFields.value = "amount";
pieSeries4.dataFields.category = "book";

// Let's cut a hole in our Pie chart the size of 40% the radius
chart4.innerRadius = am4core.percent(50);

pieSeries4.slices.template.stroke = am4core.color("#fff");
pieSeries4.slices.template.strokeWidth = 1;

// Disable ticks and labels
pieSeries4.labels.template.disabled = true;
pieSeries4.ticks.template.disabled = true;

// Disable tooltips
pieSeries4.slices.template.tooltipText = "";

// Change color
pieSeries4.slices.template.propertyFields.fill = "color";

// Add a legend
chart4.legend = new am4charts.Legend();
chart4.legend.position = "left";
chart4.legend.valueLabels.template.text = "{amount}";

var bookTypeChart = am4core.create("booktypechartdiv", am4charts.XYChart);

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
    amount: 889,
    color: "#F4743B",
  },
  {
    type: "บริหารงานบุคคล",
    amount: 889,
    color: "#3E3C4F",
  },
  {
    type: "ประชุม",
    amount: 889,
    color: "#007AD9",
  },
  {
    type: "การฝึกอบรม/ดูงาน",
    amount: 889,
    color: "#FD397A",
  },
  {
    type: "วัสดุครุภัณฑ์ ที่ดิน",
    amount: 889,
    color: "#959CB6",
  },
  {
    type: "รายงาน สถิติ",
    amount: 889,
    color: "#00C5DC",
  },
  {
    type: "เบ็ดเตล็ด",
    amount: 889,
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