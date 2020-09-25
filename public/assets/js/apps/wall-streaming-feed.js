var KTDashboard = (function () {
  var widget1 = function () {
    if (!document.getElementById("linechart1")) {
      return;
    }

    // Main chart
    var max = 80;
    var color = "#E85A5A";
    var ctx = document.getElementById("linechart1").getContext("2d");
    var gradient = ctx.createLinearGradient(0, 0, 0, 120);
    gradient.addColorStop(0, Chart.helpers.color(color).alpha(0.3).rgbString());
    gradient.addColorStop(1, Chart.helpers.color(color).alpha(0).rgbString());

    var data = [30, 35, 45, 65, 35, 50, 40, 60, 35, 45];

    var mainConfig = {
      type: "line",
      data: {
        labels: [
          "January",
          "February",
          "March",
          "April",
          "May",
          "June",
          "July",
          "August",
          "September",
          "October",
        ],
        datasets: [
          {
            label: "Orders",
            borderColor: color,
            borderWidth: 1.3,
            backgroundColor: gradient,
            pointBackgroundColor: KTApp.getStateColor("brand"),
            data: data,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        title: {
          display: false,
          text: "Stacked Area",
        },
        tooltips: {
          enabled: true,
          intersect: false,
          mode: "nearest",
          bodySpacing: 5,
          yPadding: 10,
          xPadding: 10,
          caretPadding: 0,
          displayColors: false,
          backgroundColor: KTApp.getStateColor("brand"),
          titleFontColor: "#ffffff",
          cornerRadius: 4,
          footerSpacing: 0,
          titleSpacing: 0,
        },
        legend: {
          display: false,
          labels: {
            usePointStyle: false,
          },
        },
        hover: {
          mode: "index",
        },
        scales: {
          xAxes: [
            {
              display: false,
              scaleLabel: {
                display: false,
                labelString: "Month",
              },
              ticks: {
                display: false,
                beginAtZero: true,
              },
            },
          ],
          yAxes: [
            {
              display: false,
              scaleLabel: {
                display: false,
                labelString: "Value",
              },
              gridLines: {
                color: "#E85A5A",
                drawBorder: false,
                offsetGridLines: true,
                drawTicks: false,
              },
              ticks: {
                max: max,
                display: false,
                beginAtZero: true,
              },
            },
          ],
        },
        elements: {
          point: {
            radius: 0,
            borderWidth: 0,
            hoverRadius: 0,
            hoverBorderWidth: 0,
          },
        },
        layout: {
          padding: {
            left: 0,
            right: 0,
            top: 0,
            bottom: 0,
          },
        },
      },
    };

    var chart = new Chart(ctx, mainConfig);

    // Update chart on window resize
    KTUtil.addResizeHandler(function () {
      chart.update();
    });
  };

  var widget2 = function () {
    if (!document.getElementById("linechart2")) {
      return;
    }

    // Main chart
    var max = 80;
    var color = "#2786FB";
    var ctx = document.getElementById("linechart2").getContext("2d");
    var gradient = ctx.createLinearGradient(0, 0, 0, 120);
    gradient.addColorStop(0, Chart.helpers.color(color).alpha(0.3).rgbString());
    gradient.addColorStop(1, Chart.helpers.color(color).alpha(0).rgbString());

    var data = [30, 35, 45, 65, 35, 50, 40, 60, 35, 45];

    var mainConfig = {
      type: "line",
      data: {
        labels: [
          "January",
          "February",
          "March",
          "April",
          "May",
          "June",
          "July",
          "August",
          "September",
          "October",
        ],
        datasets: [
          {
            label: "Orders",
            borderColor: color,
            borderWidth: 1.3,
            backgroundColor: gradient,
            pointBackgroundColor: KTApp.getStateColor("brand"),
            data: data,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        title: {
          display: false,
          text: "Stacked Area",
        },
        tooltips: {
          enabled: true,
          intersect: false,
          mode: "nearest",
          bodySpacing: 5,
          yPadding: 10,
          xPadding: 10,
          caretPadding: 0,
          displayColors: false,
          backgroundColor: KTApp.getStateColor("brand"),
          titleFontColor: "#ffffff",
          cornerRadius: 4,
          footerSpacing: 0,
          titleSpacing: 0,
        },
        legend: {
          display: false,
          labels: {
            usePointStyle: false,
          },
        },
        hover: {
          mode: "index",
        },
        scales: {
          xAxes: [
            {
              display: false,
              scaleLabel: {
                display: false,
                labelString: "Month",
              },
              ticks: {
                display: false,
                beginAtZero: true,
              },
            },
          ],
          yAxes: [
            {
              display: false,
              scaleLabel: {
                display: false,
                labelString: "Value",
              },
              gridLines: {
                color: "#E85A5A",
                drawBorder: false,
                offsetGridLines: true,
                drawTicks: false,
              },
              ticks: {
                max: max,
                display: false,
                beginAtZero: true,
              },
            },
          ],
        },
        elements: {
          point: {
            radius: 0,
            borderWidth: 0,
            hoverRadius: 0,
            hoverBorderWidth: 0,
          },
        },
        layout: {
          padding: {
            left: 0,
            right: 0,
            top: 0,
            bottom: 0,
          },
        },
      },
    };

    var chart = new Chart(ctx, mainConfig);

    // Update chart on window resize
    KTUtil.addResizeHandler(function () {
      chart.update();
    });
  };

  var widget3 = function () {
    if (!document.getElementById("linechart3")) {
      return;
    }

    // Main chart
    var max = 80;
    var color = "#1DC9B7";
    var ctx = document.getElementById("linechart3").getContext("2d");
    var gradient = ctx.createLinearGradient(0, 0, 0, 120);
    gradient.addColorStop(0, Chart.helpers.color(color).alpha(0.3).rgbString());
    gradient.addColorStop(1, Chart.helpers.color(color).alpha(0).rgbString());

    var data = [30, 35, 45, 65, 35, 50, 40, 60, 35, 45];

    var mainConfig = {
      type: "line",
      data: {
        labels: [
          "January",
          "February",
          "March",
          "April",
          "May",
          "June",
          "July",
          "August",
          "September",
          "October",
        ],
        datasets: [
          {
            label: "Orders",
            borderColor: color,
            borderWidth: 1.3,
            backgroundColor: gradient,
            pointBackgroundColor: KTApp.getStateColor("brand"),
            data: data,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        title: {
          display: false,
          text: "Stacked Area",
        },
        tooltips: {
          enabled: true,
          intersect: false,
          mode: "nearest",
          bodySpacing: 5,
          yPadding: 10,
          xPadding: 10,
          caretPadding: 0,
          displayColors: false,
          backgroundColor: KTApp.getStateColor("brand"),
          titleFontColor: "#ffffff",
          cornerRadius: 4,
          footerSpacing: 0,
          titleSpacing: 0,
        },
        legend: {
          display: false,
          labels: {
            usePointStyle: false,
          },
        },
        hover: {
          mode: "index",
        },
        scales: {
          xAxes: [
            {
              display: false,
              scaleLabel: {
                display: false,
                labelString: "Month",
              },
              ticks: {
                display: false,
                beginAtZero: true,
              },
            },
          ],
          yAxes: [
            {
              display: false,
              scaleLabel: {
                display: false,
                labelString: "Value",
              },
              gridLines: {
                color: "#E85A5A",
                drawBorder: false,
                offsetGridLines: true,
                drawTicks: false,
              },
              ticks: {
                max: max,
                display: false,
                beginAtZero: true,
              },
            },
          ],
        },
        elements: {
          point: {
            radius: 0,
            borderWidth: 0,
            hoverRadius: 0,
            hoverBorderWidth: 0,
          },
        },
        layout: {
          padding: {
            left: 0,
            right: 0,
            top: 0,
            bottom: 0,
          },
        },
      },
    };

    var chart = new Chart(ctx, mainConfig);

    // Update chart on window resize
    KTUtil.addResizeHandler(function () {
      chart.update();
    });
  };

  return {
    init: function () {
      widget1();
      widget2();
      widget3();
    },
  };
})();

// Class initialization
jQuery(document).ready(function () {
  KTDashboard.init();
});
