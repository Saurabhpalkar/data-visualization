

var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar', // Change this to the type of chart you want to create
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
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

    
       $(document).ready(function(){
        alert()
       $.ajax({
        url: 'includes/api.php',
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            // res  = JSON.parse(data);
            // console.log(data.data)
            // if (data.success) {
                var res = data;
            console.log(res)
                for (var i = 0; i < res.length; i++) {
                    console.log(res[i])
                    // var row = "<tr>" +
                    //     "<td>" + res[i].firstname + "</td>" +
                    //     "<td>" + res[i].dob + "</td>" +
                    //     "<td>" + res[i].id
                    //     + "</td>" +
                    //     "<td>" + res[i].email + "</td>" +
                    //     "<td>" +
                    //     "<a href='#' class='btn text-primary edit-btn'  data-id='" + res[i].id + "'>EDIT</a> | " +
                    //     "<a href='#' class='btn text-danger delete-btn' data-id='" + res[i].id + "'>DELETE</a>" +
                    //     "</td>" +
                    //     "</tr>";
                    // $('#studentTable').append(row);
                    // $('#name').val(res[i].name);
                }
            // } else {
            //     alert('Error fetching student data');
            // }
        }
       })
    });