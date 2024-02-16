var myChart = '';

function initializeGraphic() {
"use strict";

var stepOffset = Math.round(((start_weight / 100) / 2) * 10);

function calculateOffset(goal_weight, stepOffset)
{
  var offset = 0
  var count = 0;
  while (offset < goal_weight) {
    offset = offset + stepOffset;
    count++;
  }
  count--;

  return count;
}

let settingsChart = {
  data: dates_weight,
  startDate: startDate,
  endDate: endDate,
  maxVal: start_weight + stepOffset,
  goal: goal_weight,
  stepSize: stepOffset,
  offsetStep: calculateOffset(goal_weight, stepOffset),
};

function dateRange(startDate, endDate, steps = 1) {
  const dateArray = [];
  let currentDate = new Date(startDate);
  let i = 1;
  while (currentDate <= new Date(endDate)) {
    var m = currentDate.toLocaleString('en-us', {
        month: 'short'
      })
      // var month = currentDate.getUTCMonth() + 1;
    var day = currentDate.getUTCDate();
    var year = currentDate.getUTCFullYear();
    dateArray.push([i + ':', m + ' ' + day + ', ' + year]);
    currentDate.setUTCDate(currentDate.getUTCDate() + steps);
    i++;
  }

  return dateArray;
}

const dates = dateRange(settingsChart.startDate, settingsChart.endDate);

// var arrDays = [...Array(days).keys()].map(i => i + 1);



const colors = {
  color1: {
    half: "rgba(250, 107, 181, 0.5)",
    quarter: "rgba(250, 107, 181, 0.38)",
    zero: "rgba(250, 107, 181, .03)"
  },
};

const ctx = document.getElementById('myChart').getContext('2d');

/*const chart_watermark = {
  id: 'chart_watermark',
  afterDraw: (chart) => {
    const image = new Image();
      image.src = settingsChart.watermarkSrc;
    if (image.complete) {
      const image_height = 142; // Or you can use image.naturalHeight;
      const image_width = 380; // Or you can use image.naturalWidth;
      const ctx = chart.ctx;
      // const x = (chart.chartArea.width / 2) - (image_width/2) + chart.chartArea.left;
      // const y = 30;
      // const x = chart.chartArea.width - image_width;
      // const y = chart.chartArea.height - image_height;
      ctx.globalAlpha = 1;
      // ctx.drawImage(image, x, y, image_width, image_height);

      var scale = Math.min(chart.chartArea.width / image.width, chart.chartArea.height / image.height);
      scale = window.innerWidth > 767 ? scale/2.5 : scale/2;
      const x = ((chart.chartArea.width / 2) - (image.width * (scale/2)) ) + chart.chartArea.left;
      const y = 30;
      ctx.drawImage(image, x, y, image.width * (scale), image.height * (scale));


      ctx.globalAlpha = 1;
    } else {
      image.onload = () => chart.draw();
    }
  }
};*/


var horizonalLinePlugin = {
  id: 'horizontalLine',
  afterDraw: function(chartInstance) {
    // var yScale = chartInstance.scales["y-axis-0"];
    var yScale = chartInstance.scales['y'];
    // var canvas = chartInstance.chart;
    var canvas = chartInstance.canvas;
    var ctx = chartInstance.ctx;
    var index;
    var line;
    var style;
    var yValue;

    if (chartInstance.config._config.options.horizontalLine) {
      for (index = 0; index < chartInstance.config._config.options.horizontalLine.length; index++) {
        line = chartInstance.config._config.options.horizontalLine[index];

        if (!line.style) {
          style = "rgba(169,169,169, .6)";
        } else {
          style = line.style;
        }

        if (line.y) {
          yValue = yScale.getPixelForValue(line.y);
        } else {
          yValue = 0;
        }

        ctx.lineWidth = 1;

        if (yValue) {
          ctx.beginPath();
          // ctx.moveTo(30, yValue);
          ctx.moveTo(chartInstance.chartArea.left, yValue);
          ctx.lineTo(chartInstance.chartArea.width + chartInstance.chartArea.left, yValue);
          ctx.strokeStyle = style;
          ctx.stroke();
        }

        var wCanvas = chartInstance.chartArea.left + 20;

        if (line.text) {
          ctx.font = "bold 16px Poppins";
          ctx.fillStyle = "#646d84";
          ctx.fillText(line.text, wCanvas, yValue + ctx.lineWidth + 22);
        }
      }
      return;
    }
  }
};
//Chart.register(chart_watermark);
Chart.register(horizonalLinePlugin);

const gradient = ctx.createLinearGradient(0, 25, 0, 300);
gradient.addColorStop(0, colors.color1.half);
gradient.addColorStop(0.05, colors.color1.quarter);
gradient.addColorStop(1, colors.color1.zero);

var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
gradientStroke.addColorStop(0, "#bf9ce6");
gradientStroke.addColorStop(1, "#fa6bb5");

  var stylePoin = settingsChart.data.map(function(item, i) {
    if (i === 0) return gradientStroke
    return 'transparent';
  });

  myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: dates,
      datasets: [{
        lineTension: 0.4,
        data: settingsChart.data,
        fill: true,
        backgroundColor: gradient,
        borderColor: gradientStroke,
        pointBorderColor: stylePoin,
        pointBackgroundColor: stylePoin,
        pointHoverBackgroundColor: gradientStroke,
        pointHoverBorderColor: gradientStroke,
        borderWidth: 3
      }]
    },
    options: {
      maintainAspectRatio: false,
      horizontalLine: [{
        y: settingsChart.goal,
        style: "#8bcd0b",
        text: "YOUR GOAL!"
      }],
      interaction: {
        mode: 'index',
        intersect: false,
      },
      plugins: {
        legend: {
          display: false,
        },
        tooltip: {

          // xAlign: "center",
          // yAlign: 'bottom',

          // Disable the on-canvas tooltip
          enabled: false,
          external: function(context) {
            // Tooltip Element
            let tooltipEl = document.getElementById('chartjs-tooltip');

            // Create element on first render
            if (!tooltipEl) {
              tooltipEl = document.createElement('div');
              tooltipEl.id = 'chartjs-tooltip';
              tooltipEl.innerHTML = '<table></table>';
              document.body.appendChild(tooltipEl);
            }

            // Hide if no tooltip
            const tooltipModel = context.tooltip;
            if (tooltipModel.opacity === 0) {
              tooltipEl.style.opacity = 0;
              return;
            }

            // Set caret Position
            tooltipEl.classList.remove('above', 'below', 'no-transform');
            if (tooltipModel.yAlign) {
              tooltipEl.classList.add(tooltipModel.yAlign);
            } else {
              tooltipEl.classList.add('no-transform');
            }

            function getBody(bodyItem) {
              return bodyItem.lines;
            }

            // Set Text
            if (tooltipModel.body) {
              const titleLines = tooltipModel.title || [];
              const bodyLines = tooltipModel.body.map(getBody);

              let innerHtml = '<tr>';

              bodyLines.forEach(function(body, i) {
                innerHtml += '<td>' + body + ' lbs' + '</td>';
              });


              titleLines.forEach(function(title) {
                var date = title.split(':');
                innerHtml += '<td>' + 'Day ' + date[0] + '</td>';
              });
              innerHtml += '</tr><tr>';
              titleLines.forEach(function(title) {
                var date = title.split(':');
                innerHtml += '<td>' + date[1].slice(1) + '</td><td></td>';
              });
              innerHtml += '</tr>';

              let tableRoot = tooltipEl.querySelector('table');
              tableRoot.innerHTML = innerHtml;
            }

            const position = context.chart.canvas.getBoundingClientRect();
            const bodyFont = Chart.helpers.toFont(tooltipModel.options.bodyFont);

            // Display, position, and set styles for font
            tooltipEl.style.opacity = 1;
            tooltipEl.style.position = 'absolute';

            var htmlEl = document.querySelector("html");
            var htmlElStyle = htmlEl.currentStyle || window.getComputedStyle(htmlEl);
            var mtValue = parseInt(htmlElStyle.marginTop);


            tooltipEl.style.left = position.left + window.pageXOffset + tooltipModel.caretX + 'px';
            tooltipEl.style.top = (position.top - mtValue) + window.pageYOffset + tooltipModel.caretY + 'px';
            tooltipEl.style.font = bodyFont.string;
            tooltipEl.style.padding = tooltipModel.padding + 'px ' + tooltipModel.padding + 'px';
            tooltipEl.style.pointerEvents = 'none';
          },

          // boxWidth: 180,
          // boxHeight: 82,
          boxPadding: 15,
          backgroundColor: 'rgb(144, 95, 221)',
        }
      },
      scales: {
        x: {
          ticks: {
            callback: function(val, index) {
              var numb = this.getLabelForValue(val)[0].slice(0, -1);
              return index % 2 === 0 ? numb : '';
            },
            color: '#646d84',
          },
          grid: {
            display: false,
            borderColor: 'rgba(0, 0, 0, 0.2)',
            borderWidth: 1,
          }
        },
        y: {
          min: settingsChart.offsetStep ? (settingsChart.offsetStep - 1) * settingsChart.stepSize : 0,
          max: settingsChart.maxVal,
          ticks: {
            color: '#646d84',
            callback: function(val, index) {
              // var numb = this.getLabelForValue(val)[0].slice(0, -1);
              if (settingsChart.offsetStep && index > 0) {
                return this.getLabelForValue(val);
              }
              if (!settingsChart.offsetStep) {
                return this.getLabelForValue(val);
              }

            },
            stepSize: settingsChart.stepSize
          },
          beginAtZero: true,
          grid: {
            lineWidth: 1,
            display: true,
            borderColor: 'rgba(0, 0, 0, 0.2)',
            color: 'rgba(0,0,0, .05',
            borderWidth: 1,
          }
        }
      }
    }
  });

Chart.defaults.font.size = 14;
Chart.defaults.font.family = "'Manrope'";
myChart.update();

}

if(jQuery('#myChart').length) {
  initializeGraphic();
}