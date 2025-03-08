<?php include('templates/header.php') ?>
<style>
    #map {
        height: 600px;
        width: 100%;
    }
</style>
<div class="m-5">
    <div class="row">
        <div>
            <select id="start_year" onchange="startyearFilter(this.value)" class="form-control">
                <option value="--select--">Start Year</option>
            </select>
        </div>

        <div>
            <select id="end_year" class="form-control">
                <option value="--select--">End Year</option>
            </select>
        </div>

        <div>
            <select id="topics" class="form-control">
                <option value="--select--">Topics</option>
            </select>
        </div>

        <div>
            <select id="sector" class="form-control">
                <option value="--select--">Sector</option>
            </select>
        </div>

        <div>
            <select id="region" class="form-control">
                <option value="--select--">Region</option>
            </select>
        </div>

        <div>
            <select id="pest" class="form-control">
                <option value="--select--">PEST</option>
            </select>
        </div>

        <div>
            <select id="source" class="form-control">
                <option value="--select--">Source</option>
            </select>
        </div>

        <div>
            <select id="swot" class="form-control">
                <option value="--select--">SWOT</option>
            </select>
        </div>

        <div>
            <select id="country" class="form-control">
                <option value="--select--">Country</option>
            </select>
        </div>

        <div>
            <select id="city" class="form-control">
                <option value="--select--">City</option>
            </select>
        </div>

        <div class="col-md-2">
            <select id="chartType" class="form-control">
                <option value="bar">Bar</option>
                <option value="line" selected>Line</option>
                <option value="doughnut">Doughnut</option>
                <option value="pie">Pie</option>
                <option value="radar">Radar</option>
                <option value="polarArea">Polar Area</option>
                <option value="bubble">Bubble</option>
                <option value="scatter">Scatter</option>
            </select>
        </div>
    </div>


    <div class="row mb-3">
        <div class="col-md-12">
            <canvas id="sectorChart" width="400" height="150"></canvas>
        </div>
        <div class="col-md-12">
            <canvas id="topicChart" width="400" height="150"></canvas>
        </div>
        <div class="col-md-12">
            <canvas id="intensityChart" width="400" height="150"></canvas>
        </div>
        <div class="col-md-12">
            <canvas id="intensityRegionChart" width="400" height="150"></canvas>
        </div>
        <div class="col-md-12">
            <canvas id="scatterChart" width="400" height="150"></canvas>
        </div>
        <div id="map" class="d-none col-md-12"></div>

        <div class="col-md-2 text-center" style=" border:2px solid grey;">
            <!-- <canvas id="totalcity" width="400" height="150"></canvas> -->
            <div style="margin: 2rem">
                <p>Total Cities</p>
                <p id="totalcity"></p>
            </div>
        </div>
    </div>
</div>

<script>
    function startyearFilter(start_year) {
        fetchChartData(start_year)
    }
    var sectorChart;
    var topicChart;
    var totalcity;
    var intensityChart;
    var intensityRegionChart;
    var mapData;
    var scatterChart;

    function getSectorChart(sectors, counts) {
        var ctx = document.getElementById('sectorChart').getContext('2d');
        if (sectorChart) {
            sectorChart.destroy();
        }
        sectorChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: sectors,
                datasets: [{
                    label: 'Sectors',
                    data: counts,
                    backgroundColor: ['rgba(54, 162, 235, 0.2)'
                        //   'rgba(255, 99, 132, 0.2)',
                        // 'rgba(54, 162, 235, 0.2)',
                        // 'rgba(255, 206, 86, 0.2)',
                        // 'rgba(75, 192, 192, 0.2)',
                        // 'rgba(153, 102, 255, 0.2)',
                        // 'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: 'rgba(54, 162, 235, 1)',
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

    function getTopicChart(topics, counts) {
        var ctx = document.getElementById('topicChart').getContext('2d');
        if (topicChart) {
            topicChart.destroy();
        }
        topicChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: topics,
                datasets: [{
                    label: 'Topics',
                    data: counts,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'
                        // 'rgba(54, 162, 235, 0.2)',
                        // 'rgba(255, 206, 86, 0.2)',
                        // 'rgba(75, 192, 192, 0.2)',
                        // 'rgba(153, 102, 255, 0.2)',
                        // 'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)'
                        // 'rgba(54, 162, 235, 1)',
                        // 'rgba(255, 206, 86, 1)',
                        // 'rgba(75, 192, 192, 1)',
                        // 'rgba(153, 102, 255, 1)',
                        // 'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            }

        });
    }

    function getintensityChart(intensitys, counts) {
        var ctx = document.getElementById('intensityChart').getContext('2d');
        if (intensityChart) {
            intensityChart.destroy();
        }
        intensityChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: intensitys,
                datasets: [{
                    label: 'Trend of Intensity over Years',
                    data: counts,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1,
                    fill: true
                }]
            },
            // options:{
            //     scales:{
            //         x:{
            //             beginAtZero: true,
            //             title: {
            //                 display: true,
            //                 text: 'Year'
            //             },
            //         },
            //         y:{

            //         }
            //     }
            // }

        });
    }

    function getintensityRegionChart(intensityRegions, counts) {
        var ctx = document.getElementById('intensityRegionChart').getContext('2d');
        if (intensityRegionChart) {
            intensityRegionChart.destroy();
        }
        intensityRegionChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: intensityRegions,
                datasets: [{
                    label: 'Trend of Intensity Region over Years',
                    data: counts,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1,
                    fill: true
                }]
            },


        });
    }
    var dataPoint = [];

    function scatterChartFun(scatterChartData) {
        dataPoint = scatterChartData.map(function(data) {
            return {
                x: parseFloat(data.relevance), // X-axis: Relevance
                y: parseFloat(data.likelihood), // Y-axis: Likelihood
                r: parseFloat(data.intensity) // Radius: Intensity (if needed)
            };
        });
        var ctx = document.getElementById('scatterChart').getContext('2d');
        if (scatterChart) {
            scatterChart.destroy();
        }
        scatterChart = new Chart(ctx, {
            type: 'bubble',
            data: {
                // labels: scatterChartData,
                datasets: [{
                    label: 'Relevance vs Likelihood',
                    data: dataPoint,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1,
                    fill: true
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Relevance'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Likelihood'
                        }
                    }
                }
            }


        });
    }


    function map(mapData) {
        const locations = mapData;
        const map = L.map('map').setView([20.5937, 78.9629], 2); // Centered on India (example), zoom level 2

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        mapData.forEach(function(location) {
            // console.log(location)
            const marker = L.marker([location.citylat, location.citylng]).addTo(map);
            marker.bindPopup("<b>" + location.city + "</b><br>" + location.region + ", " + location.country);
        });
    }

    function getTotalCity(counts) {
        $('#totalcity').text(counts);
    }

    function fetchChartData(start_year) {
        $.ajax({
            url: 'includes/api.php',
            type: 'POST',
            data: {
                topic: 'topic',
                insights: 'insights',
                sector: 'sector',
                city: 'city',
                intensity: 'intensity',
                intensityRegion: 'intensityRegion',
                map: 'map',
                start_year: start_year,
                scatterChart: 'scatterChart'
            },

            dataType: 'json',
            success: function(data) {
                // console.log(data)
                var sectors = [];
                var sectorCounts = [];
                var topics = [];
                var topicCounts = [];
                var city = [];
                var cityCounts = [];
                var intensity = [];
                var intensityCounts = [];
                var intensityCounts = [];
                var intensityRegion = [];
                var intensityRegionCounts = [];
                var mapData = [];
                var mapData = [];
                var mapData = [];
                var mapData = [];
                var relevanceX = [];
                var likelihoodY = [];
                var intensityR = [];

                $.each(data.sectorData, function(key, value) {
                    if (value.sector != "") {
                        sectors.push(value.sector);
                        sectorCounts.push(value.count);
                    }
                });

                $.each(data.topicData, function(key, value) {
                    if (value.topic != "") {
                        topics.push(value.topic);
                        topicCounts.push(value.count);
                    }
                });

                $.each(data.cityData, function(key, value) {
                    if (value.city != "") {
                        city.push(key);
                        cityCounts.push(value.count);
                    }
                });
                var citycount = city.length;

                $.each(data.intensityData, function(key, value) {
                    if (value.intensity != "") {
                        intensity.push(value.end_year);
                        intensityCounts.push(value.total_intensity);
                    }
                });


                $.each(data.intensityRegionData, function(key, value) {
                    // console.log(value)
                    if (value.intensity != "") {
                        intensityRegion.push(value.sector);
                        intensityRegionCounts.push(value.total_intensity);
                    }
                });

                $.each(data.intensityRegionData, function(key, value) {
                    // console.log(value)
                    if (value.intensity != "") {
                        intensityRegion.push(value.sector);
                        intensityRegionCounts.push(value.total_intensity);
                    }
                });

                $.each(data.mapData, function(key, value) {
                    if (value.intensity != "") {
                        mapData.push(value);
                        // intensityRegionCounts.push(value.total_intensity);
                    }
                });
                // $.each(data.scatterChartData, function(key, value) {
                //     if (value.intensity != "") {
                //         relevanceX.push(value.relevance);
                //         likelihoodY.push(value.likelihood);
                //         intensityR.push(value.intensity);
                //     }
                // });
                getSectorChart(sectors, sectorCounts);
                getTopicChart(topics, topicCounts);
                getTotalCity(citycount);
                getintensityChart(intensity, intensityCounts)
                getintensityRegionChart(intensityRegion, intensityRegionCounts);
                map(mapData);
                scatterChartFun(data.scatterChartData, )
            }
        });
    }

    $(document).ready(function() {

        fetchChartData();

        $('#chartType').change(function() {
            fetchChartData();
        });

        $.ajax({
            url: 'includes/allFiltersLoad.php',
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                $.each(data['end_year'], function(index, val) {
                    $('#end_year').append('<option value="' + val + '">' + val + '</option>');
                });
                $.each(data['start_year'], function(index, val) {
                    $('#start_year').append('<option value="' + val + '">' + val + '</option>');
                });
                $.each(data['city'], function(index, val) {
                    $('#city').append('<option value="' + val + '">' + val + '</option>');
                });
                $.each(data['country'], function(index, val) {
                    $('#country').append('<option value="' + val + '">' + val + '</option>');
                });
                $.each(data['source'], function(index, val) {
                    $('#source').append('<option value="' + val + '">' + val + '</option>');
                });
                $.each(data['swot'], function(index, val) {
                    $('#swot').append('<option value="' + val + '">' + val + '</option>');
                });
                $.each(data['topic'], function(index, val) {
                    $('#topics').append('<option value="' + val + '">' + val + '</option>');
                });
                $.each(data['region'], function(index, val) {
                    $('#region').append('<option value="' + val + '">' + val + '</option>');
                });
                $.each(data['pest'], function(index, val) {
                    $('#pest').append('<option value="' + val + '">' + val + '</option>');
                });
                $.each(data['sector'], function(index, val) {
                    $('#sector').append('<option value="' + val + '">' + val + '</option>');
                });
            }
        });
    });
</script>

</body>

</html>