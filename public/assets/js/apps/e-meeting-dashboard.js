var barTypeChart1 = am4core.create("bartypechart1", am4charts.XYChart);
var barTypeChart2 = am4core.create("bartypechart2", am4charts.XYChart);
var barTypeChart3 = am4core.create("bartypechart3", am4charts.XYChart);
var barTypeChart4 = am4core.create("bartypechart4", am4charts.XYChart);

am4core.useTheme(am4themes_animated);

barTypeChart1.data = [
  {
    type: "บริหารทั่วไป",
    amount: Math.floor(Math.random() * 20) + 70
  },
  {
    type: "โต้ตอบทั่วไป",
    amount: Math.floor(Math.random() * 20) + 78
  },
  {
    type: "การเงิน งบประมาณ",
    amount: Math.floor(Math.random() * 20) + 78
  },
  {
    type: "คำสั่ง มติคณะรัฐมนตรี",
    amount: Math.floor(Math.random() * 20) + 78
  },
  {
    type: "บริหารงานบุคคล",
    amount: Math.floor(Math.random() * 20) + 78
  },
  {
    type: "ประชุม",
    amount: Math.floor(Math.random() * 20) + 78
  },
  {
    type: "การฝึกอบรม/ดูงาน",
    amount: Math.floor(Math.random() * 20) + 78
  }
];

barTypeChart2.data = [
    {
      type: "บริหารทั่วไป",
      amount: Math.floor(Math.random() * 20) + 78
    },
    {
      type: "โต้ตอบทั่วไป",
      amount: Math.floor(Math.random() * 20) + 78
    },
    {
      type: "การเงิน งบประมาณ",
      amount: Math.floor(Math.random() * 20) + 78
    },
    {
      type: "คำสั่ง มติคณะรัฐมนตรี",
      amount: Math.floor(Math.random() * 20) + 78
    },
    {
      type: "บริหารงานบุคคล",
      amount: Math.floor(Math.random() * 20) + 78
    },
    {
      type: "ประชุม",
      amount: Math.floor(Math.random() * 20) + 78
    },
    {
      type: "การฝึกอบรม/ดูงาน",
      amount: Math.floor(Math.random() * 20) + 78
    }
  ];

  barTypeChart3.data = [
    {
      type: "บริหารทั่วไป",
      amount: Math.floor(Math.random() * 20) + 78
    },
    {
      type: "โต้ตอบทั่วไป",
      amount: Math.floor(Math.random() * 20) + 78
    },
    {
      type: "การเงิน งบประมาณ",
      amount: Math.floor(Math.random() * 20) + 78
    },
    {
      type: "คำสั่ง มติคณะรัฐมนตรี",
      amount: Math.floor(Math.random() * 20) + 78
    },
    {
      type: "บริหารงานบุคคล",
      amount: Math.floor(Math.random() * 20) + 78
    },
    {
      type: "ประชุม",
      amount: Math.floor(Math.random() * 20) + 78
    },
    {
      type: "การฝึกอบรม/ดูงาน",
      amount: Math.floor(Math.random() * 20) + 78
    }
  ];

barTypeChart4.data = [
    {
      type: "ห้องอุดร",
      amount: Math.floor(Math.random() * 20) + 78,
      color: "#FFB822",
    },
    {
      type: "ห้องทักษิณ",
      amount: Math.floor(Math.random() * 20) + 78,
      color: "#716ACA",
    },
    {
      type: "ห้องบูรพา",
      amount: Math.floor(Math.random() * 20) + 78,
      color: "#0ABB87",
    },
    {
      type: "ห้องประจิม",
      amount: Math.floor(Math.random() * 20) + 78,
      color: "#F4743B",
    },
    {
      type: "ห้องอีสาน",
      amount: Math.floor(Math.random() * 20) + 78,
      color: "#3E3C4F",
    },
    {
      type: "ห้องอาคเนย์",
      amount: Math.floor(Math.random() * 20) + 78,
      color: "#007AD9",
    },
    {
      type: "ห้องพายัพ",
      amount: Math.floor(Math.random() * 20) + 78,
      color: "#FD397A",
    },
    {
      type: "ห้องหรดี",
      amount: Math.floor(Math.random() * 20) + 78,
      color: "#959CB6",
    },
    {
      type: "ห้องมหาสมุทร",
      amount: Math.floor(Math.random() * 20) + 78,
      color: "#00C5DC",
    },
    {
      type: "ห้องอัญชลี",
      amount: Math.floor(Math.random() * 20) + 78,
      color: "#F33E5C",
    },
  ];

//
var categoryAxis1 = barTypeChart1.xAxes.push(new am4charts.CategoryAxis());
categoryAxis1.dataFields.category = "type";
categoryAxis1.renderer.labels.template.disabled = true;
categoryAxis1.renderer.grid.template.strokeOpacity = 0;

var valueAxis1 = barTypeChart1.yAxes.push(new am4charts.ValueAxis());
valueAxis1.renderer.baseGrid.strokeOpacity = 0;
valueAxis1.renderer.labels.template.fillOpacity = 0;
valueAxis1.renderer.grid.template.strokeOpacity = 0;

var series1 = barTypeChart1.series.push(new am4charts.ColumnSeries());
series1.dataFields.valueY = "amount";
series1.dataFields.categoryX = "type";
series1.hiddenState.animationDuration = 1000;
series1.columns.template.fill = am4core.color("#F7A93B");

var columnTemplate1 = series1.columns.template;
columnTemplate1.strokeOpacity = 0;
columnTemplate1.column.cornerRadiusTopLeft = 4;
columnTemplate1.column.cornerRadiusTopRight = 4;
columnTemplate1.column.cornerRadiusBottomLeft = 4;
columnTemplate1.column.cornerRadiusBottomRight = 4;

//
var categoryAxis2 = barTypeChart2.xAxes.push(new am4charts.CategoryAxis());
categoryAxis2.dataFields.category = "type";
categoryAxis2.renderer.labels.template.disabled = true;
categoryAxis2.renderer.grid.template.strokeOpacity = 0;

var valueAxis2 = barTypeChart2.yAxes.push(new am4charts.ValueAxis());
valueAxis2.renderer.baseGrid.strokeOpacity = 0;
valueAxis2.renderer.labels.template.fillOpacity = 0;
valueAxis2.renderer.grid.template.strokeOpacity = 0;

var series2 = barTypeChart2.series.push(new am4charts.ColumnSeries());
series2.dataFields.valueY = "amount";
series2.dataFields.categoryX = "type";
series2.columns.template.fill = am4core.color("#1DC9B7");

var columnTemplate2 = series2.columns.template;
columnTemplate2.strokeOpacity = 0;
columnTemplate2.column.cornerRadiusTopLeft = 4;
columnTemplate2.column.cornerRadiusTopRight = 4;
columnTemplate2.column.cornerRadiusBottomLeft = 4;
columnTemplate2.column.cornerRadiusBottomRight = 4;

//
var categoryAxis3 = barTypeChart3.xAxes.push(new am4charts.CategoryAxis());
categoryAxis3.dataFields.category = "type";
categoryAxis3.renderer.labels.template.disabled = true;
categoryAxis3.renderer.grid.template.strokeOpacity = 0;

var valueAxis3 = barTypeChart3.yAxes.push(new am4charts.ValueAxis());
valueAxis3.renderer.baseGrid.strokeOpacity = 0;
valueAxis3.renderer.labels.template.fillOpacity = 0;
valueAxis3.renderer.grid.template.strokeOpacity = 0;

var series3 = barTypeChart3.series.push(new am4charts.ColumnSeries());
series3.dataFields.valueY = "amount";
series3.dataFields.categoryX = "type";
series3.columns.template.fill = am4core.color("#C42B52");

var columnTemplate3 = series3.columns.template;
columnTemplate3.strokeOpacity = 0;
columnTemplate3.column.cornerRadiusTopLeft = 4;
columnTemplate3.column.cornerRadiusTopRight = 4;
columnTemplate3.column.cornerRadiusBottomLeft = 4;
columnTemplate3.column.cornerRadiusBottomRight = 4;

//
var categoryAxis4 = barTypeChart4.xAxes.push(new am4charts.CategoryAxis());
categoryAxis4.dataFields.category = "type";
categoryAxis4.renderer.grid.template.location = 0;
categoryAxis4.renderer.minGridDistance = 30;
categoryAxis4.renderer.labels.template.horizontalCenter = "right";
categoryAxis4.renderer.labels.template.verticalCenter = "middle";
categoryAxis4.renderer.labels.template.rotation = 270;

var valueAxis4 = barTypeChart4.yAxes.push(new am4charts.ValueAxis());
valueAxis4.renderer.baseGrid.strokeOpacity = 0;

var series4 = barTypeChart4.series.push(new am4charts.ColumnSeries());
series4.dataFields.valueY = "amount";
series4.dataFields.categoryX = "type";

var columnTemplate4 = series4.columns.template;
columnTemplate4.strokeOpacity = 0;
columnTemplate4.propertyFields.fill = "color";