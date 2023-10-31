var jsonData; // Define the variable to hold the JSON data
var historyState = false;
$(document).ready(function() {
$("#history").on('click', '#submit',function(e) {
 // Prevent the default form submission
  historyState =true;
  e.preventDefault();
    console.log($("#history"));
  // Make an Ajax request to submit the form data
  $.ajax({
    type: "POST",
    url: "php/data.php",
    data: $("#history").serialize(),
    success: function(data) {
        console.log(data);
        if(historyState ==true){
            updateChartHist(data);
        }
    }
  });
});
});

function poll() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/data.php", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Parse the JSON response into a JavaScript object
            jsonData = JSON.parse(xhr.responseText);

            // Update the chart with the new data
            if (historyState == false){
                console.log('Want to update');
                console.log(historyState);
                updateChart();
            }
        }
    };

    xhr.send(); // Send the request
}

function dataReq() {
    var xmlhr = new XMLHttpRequest();
    xmlhr.open("POST", "./php/table.php", true);

    xmlhr.onreadystatechange = function () {
        if (xmlhr.readyState === 4 && xmlhr.status === 200) {
            // Update the chart with the new data
            document.getElementById("table").innerHTML=xmlhr.responseText;
        }
    };

    xmlhr.send(); // Send the request
}

function updateChart() {
    // Check if jsonData is defined and contains the expected structure
    if (jsonData && jsonData.time && jsonData.solar_voltage) {
        console.log('In update');
        svchart.xAxis[0].setCategories(jsonData.time);
        svchart.series[0].setData(jsonData.solar_voltage);

        scchart.xAxis[0].setCategories(jsonData.time);
        scchart.series[0].setData(jsonData.solar_current);

        stchart.xAxis[0].setCategories(jsonData.time);
        stchart.series[0].setData(jsonData.solar_temperature);

        lvchart.xAxis[0].setCategories(jsonData.time);
        lvchart.series[0].setData(jsonData.load_voltage);

        lcchart.xAxis[0].setCategories(jsonData.time);
        lcchart.series[0].setData(jsonData.load_current);

        socchart.xAxis[0].setCategories(jsonData.time);
        socchart.series[0].setData(jsonData.state_of_charge);     
         
        var capitalised=jsonData.site_name[0].toUpperCase();
        plantName.textContent= capitalised.toUpperCase();
    }
}
//Targeting site name from json data

var plantName=document.getElementById('plant_name');

var svchart = Highcharts.chart('svchart', {
    title: {
        text: 'PV voltage against time'
    },
    xAxis: {
        categories: [], // Initialize with an empty array
        title: {
            text: 'Time(hrs)'
        }
    },
    yAxis: {
        title: {
            text: 'PV voltage (V)'
        },
        lineColor: '#000000',
        lineWidth: 1
    },
    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
        }
    },
    series: [{
        type: 'spline',
        name: '',
        data: [] // Initialize with an empty array
    }]
});

var scchart = Highcharts.chart('scchart', {
    title: {
        text: 'PV charging current against time'
    },
    xAxis: {
        categories: [], // Initialize with an empty array
        title: {
            text: 'Time(hrs)'
        }
    },
    yAxis: {
        title: {
            text: 'PV charging current (mA)'
        },
        lineColor: '#000000',
        lineWidth: 1
    },
    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
        }
    },
    series: [{
        type: 'spline',
        name: '',
        data: [] // Initialize with an empty array
    }]
});

var stchart = Highcharts.chart('stchart', {
    title: {
        text: 'Panel temperature against time'
    },
    xAxis: {
        categories: [], // Initialize with an empty array
        title: {
            text: 'Time(hrs)'
        }
    },
    yAxis: {
        title: {
            text: 'Panel temperature (*C)'
        },
        lineColor: '#000000',
        lineWidth: 1
    },
    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
        }
    },
    series: [{
        type: 'spline',
        name: '',
        data: [] // Initialize with an empty array
    }]
});

var lvchart = Highcharts.chart('lvchart', {
    title: {
        text: 'Load voltage against time'
    },
    xAxis: {
        categories: [], // Initialize with an empty array
        title: {
            text: 'Time(hrs)'
        }
    },
    yAxis: {
        title: {
            text: 'Load Voltage (V)'
        },
        lineColor: '#000000',
        lineWidth: 1
    },
    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
        }
    },
    series: [{
        type: 'spline',
        name: '',
        data: [] // Initialize with an empty array
    }]
});

var lcchart = Highcharts.chart('lcchart', {
    title: {
        text: 'Load current against time'
    },
    xAxis: {
        categories: [], // Initialize with an empty array
        title: {
            text: 'Time(hrs)'
        }
    },
    yAxis: {
        title: {
            text: 'Load current (A)'
        },
        lineColor: '#000000',
        lineWidth: 1
    },
    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
        }
    },
    series: [{
        type: 'spline',
        name: '',
        data: [] // Initialize with an empty array
    }]
});

var socchart = Highcharts.chart('socchart', {
    title: {
        text: 'Battery State of charge against time'
    },
    xAxis: {
        categories: [], // Initialize with an empty array
        title: {
            text: 'Time(hrs)'
        }
    },
    yAxis: {
        title: {
            text: 'Battery State of charge (%)'
        },
        lineColor: '#000000',
        lineWidth: 1
    },
    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
        }
    },
    series: [{
        type: 'spline',
        name: '',
        data: [] // Initialize with an empty array
    }]
});

window.onload = function () {
    if(historyState==false){
        function update() {
            poll();
            dataReq();
            console.log('After updating');
            setTimeout(update, 3000);
        }
    
        update(); // Start the update loop
    }
    
};

function updateChartHist(data) {
    // Check if jsonData is defined and contains the expected structure
    console.log('data=======================');
    console.log(data);
    if (data && data.time && data.solar_voltage) {
        svchart.xAxis[0].setCategories(data.time);
        svchart.series[0].setData(data.solar_voltage);

        scchart.xAxis[0].setCategories(data.time);
        scchart.series[0].setData(data.solar_current);

        stchart.xAxis[0].setCategories(data.time);
        stchart.series[0].setData(data.solar_temperature);

        lvchart.xAxis[0].setCategories(data.time);
        lvchart.series[0].setData(data.load_voltage);

        lcchart.xAxis[0].setCategories(data.time);
        lcchart.series[0].setData(data.load_current);

        socchart.xAxis[0].setCategories(data.time);
        socchart.series[0].setData(data.state_of_charge);     
         
        var capitalised=data.site_name[0].toUpperCase();
        plantName.textContent= capitalised.toUpperCase();
    }
}
//Targeting site name from json data

var plantName=document.getElementById('plant_name');

var svchart = Highcharts.chart('svchart', {
    title: {
        text: 'PV voltage against time'
    },
    xAxis: {
        categories: [], // Initialize with an empty array
        title: {
            text: 'Time(hrs)'
        }
    },
    yAxis: {
        title: {
            text: 'PV voltage (V)'
        },
        lineColor: '#000000',
        lineWidth: 1
    },
    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
        }
    },
    series: [{
        type: 'spline',
        name: '',
        data: [] // Initialize with an empty array
    }]
});

var scchart = Highcharts.chart('scchart', {
    title: {
        text: 'PV charging current against time'
    },
    xAxis: {
        categories: [], // Initialize with an empty array
        title: {
            text: 'Time(hrs)'
        }
    },
    yAxis: {
        title: {
            text: 'PV charging current (mA)'
        },
        lineColor: '#000000',
        lineWidth: 1
    },
    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
        }
    },
    series: [{
        type: 'spline',
        name: '',
        data: [] // Initialize with an empty array
    }]
});

var stchart = Highcharts.chart('stchart', {
    title: {
        text: 'Panel temperature against time'
    },
    xAxis: {
        categories: [], // Initialize with an empty array
        title: {
            text: 'Time(hrs)'
        }
    },
    yAxis: {
        title: {
            text: 'Panel temperature (*C)'
        },
        lineColor: '#000000',
        lineWidth: 1
    },
    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
        }
    },
    series: [{
        type: 'spline',
        name: '',
        data: [] // Initialize with an empty array
    }]
});

var lvchart = Highcharts.chart('lvchart', {
    title: {
        text: 'Load voltage against time'
    },
    xAxis: {
        categories: [], // Initialize with an empty array
        title: {
            text: 'Time(hrs)'
        }
    },
    yAxis: {
        title: {
            text: 'Load Voltage (V)'
        },
        lineColor: '#000000',
        lineWidth: 1
    },
    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
        }
    },
    series: [{
        type: 'spline',
        name: '',
        data: [] // Initialize with an empty array
    }]
});

var lcchart = Highcharts.chart('lcchart', {
    title: {
        text: 'Load current against time'
    },
    xAxis: {
        categories: [], // Initialize with an empty array
        title: {
            text: 'Time(hrs)'
        }
    },
    yAxis: {
        title: {
            text: 'Load current (A)'
        },
        lineColor: '#000000',
        lineWidth: 1
    },
    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
        }
    },
    series: [{
        type: 'spline',
        name: '',
        data: [] // Initialize with an empty array
    }]
});

var socchart = Highcharts.chart('socchart', {
    title: {
        text: 'Battery State of charge against time'
    },
    xAxis: {
        categories: [], // Initialize with an empty array
        title: {
            text: 'Time(hrs)'
        }
    },
    yAxis: {
        title: {
            text: 'Battery State of charge (%)'
        },
        lineColor: '#000000',
        lineWidth: 1
    },
    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
        }
    },
    series: [{
        type: 'spline',
        name: '',
        data: [] // Initialize with an empty array
    }]
});

