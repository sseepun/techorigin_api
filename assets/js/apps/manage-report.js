var chart = am4core.create("chartdiv", am4charts.PieChart);
am4core.useTheme(am4themes_animated);
chart.data = [
  {
    book: "เอกสาร",
    amount: 3132,
    color: am4core.color("#2786FB"),
  },
  {
    book: "วิดีโอ",
    amount: 1856,
    color: am4core.color("#C42B52"),
  },
  {
    book: "รูปภาพ",
    amount: 580,
    color: am4core.color("#1DC9B7"),
  },
  {
    book: "บีบอัดข้อมูล",
    amount: 233,
    color: am4core.color("#F7A93B"),
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
