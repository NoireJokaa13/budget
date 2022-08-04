<script src="<?=THEME;?>/vendors/chart.js/Chart.min.js"></script>
<!-- End plugin js for this page -->
<!-- Custom js for this page-->

<script>

var colors = [];
var bolds = [];
var options = {
  scales: {
    yAxes: [{
      ticks: {
        beginAtZero: true
      }
    }]
  },
  legend: {
    display: false
  },
  elements: {
    point: {
      radius: 0
    }
  }

};

if ($("#barChart").length) {
  var barChartCanvas = $("#barChart").get(0).getContext("2d");
  // This will get the first returned node in the jQuery collection.
  var barChart = new Chart(barChartCanvas, {
    type: 'bar',
    data: {
      labels: generateLabelsFromTable("#tbl-barchart"),
      datasets: [{
        label: 'Total Application',
        data: generateDataSetsFromTable("#tbl-barchart"),
        backgroundColor: colors,
        borderColor: colors,
        borderWidth: 1,
        fill: false
      }]
    },
    options: options
  });
}

if ($("#barChart2").length) {
  var barChartCanvas = $("#barChart2").get(0).getContext("2d");
  // This will get the first returned node in the jQuery collection.
  console.log(generateLabelsFromTable("#tbl-monthly"));
  var barChart = new Chart(barChartCanvas, {
    type: 'bar',
    data: {
      labels: generateLabelsFromTable("#tbl-monthly"),
      datasets: [{
        label: 'Total Application',
        data: generateDataSetsFromTable("#tbl-monthly"),
        backgroundColor: colors,
        borderColor: colors,
        borderWidth: 1,
        fill: false
      }]
    },
    options: options
  });
}

if ($("#barChart3").length) {
  var barChartCanvas = $("#barChart3").get(0).getContext("2d");
  // This will get the first returned node in the jQuery collection.
  console.log(generateLabelsFromTable("#tbl-faculty"));
  var barChart = new Chart(barChartCanvas, {
    type: 'bar',
    data: {
      labels: generateLabelsFromTable("#tbl-faculty"),
      datasets: [{
        label: 'Total Application',
        data: generateDataSetsFromTable("#tbl-faculty"),
        backgroundColor: colors,
        borderColor: colors,
        borderWidth: 1,
        fill: false
      }]
    },
    options: options
  });
}

if ($("#lineChart").length) {
  var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
  var lineChart = new Chart(lineChartCanvas, {
    type: 'line',
    data: {
      labels: generateLabelsFromTable("#tbl-amount"),
      datasets: [{
        label: 'Total (RM)',
        data: generateDataSetsFromTable("#tbl-amount"),
        backgroundColor: ['rgba(255, 99, 132, 0.2)'],
        borderColor: ['rgba(255,99,132,1)'],
        borderWidth: 2,
        fill: false
      }]
    },
    options: options
  });
}


function generateDarkColorHex() {
  //dark color
  /*let color = "#";
  for (let i = 0; i < 3; i++)
    color += ("0" + Math.floor(Math.random() * Math.pow(16, 2) / 2).toString(16)).slice(-2);
  return color;
  */

  //light color
  let color = "#";
  let warna;
  for (let i = 0; i < 3; i++)
    color += ("0" + Math.floor(((1 + Math.random()) * Math.pow(16, 2)) / 2).toString(16)).slice(-2);
  return color;
}

function generateLabelsFromTable(table) {
    var labels = [];
    var rows = jQuery(table+" tr");
    rows.each(function (index) {
        if (index != 0)
        {
            var cols = $(this).find("td");
            labels.push(cols.first().text());

        }
    });
    return labels;
}
function generateDataSetsFromTable(table) {
    var data;
    var datasets = [];
    var rows = jQuery(table+" tr");
    var data = [];
    rows.each(function (index) {
        if (index != 0)
        {
            var cols = $(this).find("td");
            cols.each(function (innerIndex) {
                if (innerIndex != 0)
                   data.push($(this).text());
                   var warna = generateDarkColorHex();
                   colors.push(warna);
            });
        }
    });
    var dataset = {
      label: 'Application',
      backgroundColor: colors,
      data: data,
      borderWidth: 2,
      fill: true
    }
    datasets.push(dataset);
    return data;
}

</script>
