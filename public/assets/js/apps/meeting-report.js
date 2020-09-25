var chart = am4core.create("chartdiv", am4charts.PieChart);
am4core.useTheme(am4themes_animated);

chart.data = [
    {
      book: "รออนุมัติ",
      amount: 802,
      color: am4core.color("#F7A93B"),
    },
    {
      book: "อนุมัติ",
      amount: 370,
      color: am4core.color("#1DC9B7"),
    },
    {
        book: "ไม่อนุมัติ",
        amount: 62,
        color: am4core.color("#C42B52"),
      }
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