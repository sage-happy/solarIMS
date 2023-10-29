var jsonData; // Define the variable to hold the JSON data

function poll() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/data.php", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Parse the JSON response into a JavaScript object
            jsonData = JSON.parse(xhr.responseText);

            // Update the chart with the new data
            updateChart();
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
    }/*else if(jsonData.time== new Date("d")){ //must be inside the first if statement to check whether time format before rendering data
        svchart.xAxis[0].setTitle.text('Time(Days)');
        scchart.xAxis[0].setTitle.text('Time(Days)');
        stchart.xAxis[0].setTitle.text('Time(Days)');
        lvchart.xAxis[0].setTitle.text('Time(Days)');
        lcchart.xAxis[0].setTitle.text('Time(Days)');
        socvchart.xAxis[0].setTitle.text('Time(Days)');
    }*/
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
        text: 'Solar temperature against time'
    },
    xAxis: {
        categories: [], // Initialize with an empty array
        title: {
            text: 'Time(hrs)'
        }
    },
    yAxis: {
        title: {
            text: 'Solar temperature (*C)'
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
    function update() {
        poll();
        dataReq();
        console.log('After updating');
        setTimeout(update, 3000);
    }

    update(); // Start the update loop
};
