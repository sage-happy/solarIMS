function data_req() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/table.php", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Update the chart with the new data
            document.getElementById("table").innerHTML=xhr.responseText;
        }
    };

    xhr.send(); // Send the request
}