$(document).ready(function() {
    function fetchData() {
        $.ajax({
            url: 'data.php',
            method: 'GET',
            success: function(data) {
                let labels = [];
                let values = [];

                data.forEach(item => {
                    labels.push(item.your_label_column);
                    values.push(item.your_value_column);
                });

                createBarChart(labels, values);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function createBarChart(labels, values) {
        var ctx = document.getElementById('barChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Your Data Label',
                    data: values,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Fetch data on page load
    fetchData();
});
