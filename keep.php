<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include jQuery library -->
    <script>
    $(document).ready(function () {
        // Handle form submission
        $('#search-form').submit(function (e) {
            e.preventDefault(); // Prevent the form from submitting via the default method

            // Get the search query
            var searchQuery = $('#search-input').val();

            // Send an AJAX request to fetch data for the selected site
            $.ajax({
                type: 'POST',
                url: 'php/data.php', // Replace with the correct URL
                data: { search: searchQuery },
                dataType: 'json',
                success: function (jsonData) {
                    // Update the charts with the new data
                    updateCharts();

                    // Update the default value of $pid based on the search
                    var defaultPid = jsonData.site_id; // Assuming you return the site_id from data.php

                    // Optionally, update the site name or other relevant information
                    $('#site-name').html('<h2 style="text-align: center; font-weight: bold; text-decoration: underline">' + searchQuery + '</h2>');
                },
                error: function () {
                    alert('Error fetching data for the selected site.');
                }
            });
        });
    });