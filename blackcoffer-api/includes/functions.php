<?php
header('Content-Type: application/json');
include('db.php');
//  print_r($_POST);
//  die();

$jsonArray = [];
if (isset($_POST['topic']) && $_POST['topic'] == "topic") {
    $query = "SELECT topic, COUNT(*) as count  FROM `data`";
    if (isset($_POST['start_year']) && $_POST['start_year'] != "") {
        $query .= " WHERE start_year = '" . $_POST['start_year'] . "'";
    }
    $query .= " GROUP BY topic";
    $res = mysqli_query($conn, $query);
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $jsonArray['topicData'][] = $row;
        }
    }
    // $jsonArray['topics'] = $topics;

}
if (isset($_POST['sector']) && $_POST['sector'] == "sector") {
    $query = "SELECT sector, COUNT(*) as count  FROM `data`";
    if (isset($_POST['start_year']) && $_POST['start_year'] != "") {
        $query .= " WHERE start_year = '" . $_POST['start_year'] . "'";
    }
    $query .= " GROUP BY sector";
    $res = mysqli_query($conn, $query);
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $jsonArray['sectorData'][] = $row;
        }
    }
    // $jsonArray['topics'] = $topics;

}

if (isset($_POST['city']) && $_POST['city'] == "city") {
    $query = "SELECT DISTINCT id, city FROM `data` WHERE city !='' GROUP BY city ";
    $res = mysqli_query($conn, $query);
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $jsonArray['cityData'][] = $row;
        }
    }
}

if (isset($_POST['intensity']) && $_POST['intensity'] == "intensity") {
    // $query = "SELECT DISTINCT id, intensity FROM `data` WHERE intensity !='' GROUP BY intensity ";
    $query = " SELECT end_year, SUM(intensity) AS total_intensity 
        FROM data 
        WHERE end_year IS NOT NULL 
        GROUP BY end_year 
        ORDER BY end_year ASC";
    $res = mysqli_query($conn, $query);
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $jsonArray['intensityData'][] = $row;
        }
    }

}

if (isset($_POST['intensityRegion']) && $_POST['intensityRegion'] == "intensityRegion") {
    // $query = "SELECT DISTINCT id, intensity FROM `data` WHERE intensity !='' GROUP BY intensity ";
    $query = "SELECT sector, SUM(intensity) AS total_intensity 
        FROM data 
        WHERE sector IS NOT NULL 
        GROUP BY sector 
        ORDER BY sector ASC";
    $res = mysqli_query($conn, $query);
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $jsonArray['intensityRegionData'][] = $row;
        }
    }

}

if (isset($_POST['map']) && $_POST['map'] == "map") {
    // $query = "SELECT DISTINCT id, intensity FROM `data` WHERE intensity !='' GROUP BY intensity ";
    $query = "SELECT city, country, region, citylat, citylng 
        FROM data 
        WHERE citylat IS NOT NULL AND citylng IS NOT NULL";
    $res = mysqli_query($conn, $query);
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $jsonArray['mapData'][] = $row;
        }
    }

}

if (isset($_POST['scatterChart']) && $_POST['scatterChart'] == "scatterChart") {
    // $query = "SELECT DISTINCT id, intensity FROM `data` WHERE intensity !='' GROUP BY intensity ";
    $query = "SELECT relevance, likelihood, intensity FROM data";
    $res = mysqli_query($conn, $query);
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $jsonArray['scatterChartData'][] = $row;
        }
    }

}
echo json_encode($jsonArray);

// Perform each query separately and store results in the jsonArray

// // End Year
// $query = "SELECT DISTINCT end_year FROM data";
// $res = mysqli_query($conn, $query);
// $end_years = [];
// if (mysqli_num_rows($res) > 0) {
//     while ($row = mysqli_fetch_assoc($res)) {
//         $end_years[] = $row['end_year'];
//     }
// }
// $jsonArray['end_years'] = $end_years;

// // Start Year
// $query = "SELECT DISTINCT start_year FROM data";
// $res = mysqli_query($conn, $query);
// $start_years = [];
// if (mysqli_num_rows($res) > 0) {
//     while ($row = mysqli_fetch_assoc($res)) {
//         $start_years[] = $row['start_year'];
//     }
// }
// $jsonArray['start_years'] = $start_years;

// // City
// $query = "SELECT DISTINCT city FROM data";
// $res = mysqli_query($conn, $query);
// $cities = [];
// if (mysqli_num_rows($res) > 0) {
//     while ($row = mysqli_fetch_assoc($res)) {
//         $cities[] = $row['city'];
//     }
// }
// $jsonArray['cities'] = $cities;

// // Country
// $query = "SELECT DISTINCT country FROM data";
// $res = mysqli_query($conn, $query);
// $countries = [];
// if (mysqli_num_rows($res) > 0) {
//     while ($row = mysqli_fetch_assoc($res)) {
//         $countries[] = $row['country'];
//     }
// }
// $jsonArray['countries'] = $countries;

// // Sector
// $query = "SELECT DISTINCT sector FROM data";
// $res = mysqli_query($conn, $query);
// $sectors = [];
// if (mysqli_num_rows($res) > 0) {
//     while ($row = mysqli_fetch_assoc($res)) {
//         $sectors[] = $row['sector'];
//     }
// }
// $jsonArray['sectors'] = $sectors;

// // Region
// $query = "SELECT DISTINCT region FROM data";
// $res = mysqli_query($conn, $query);
// $regions = [];
// if (mysqli_num_rows($res) > 0) {
//     while ($row = mysqli_fetch_assoc($res)) {
//         $regions[] = $row['region'];
//     }
// }
// $jsonArray['regions'] = $regions;

// // Source
// $query = "SELECT DISTINCT source FROM data";
// $res = mysqli_query($conn, $query);
// $sources = [];
// if (mysqli_num_rows($res) > 0) {
//     while ($row = mysqli_fetch_assoc($res)) {
//         $sources[] = $row['source'];
//     }
// }
// $jsonArray['sources'] = $sources;

// // SWOT
// $query = "SELECT DISTINCT swot FROM data";
// $res = mysqli_query($conn, $query);
// $swot = [];
// if (mysqli_num_rows($res) > 0) {
//     while ($row = mysqli_fetch_assoc($res)) {
//         $swot[] = $row['swot'];
//     }
// }
// $jsonArray['swot'] = $swot;

// $query = "SELECT DISTINCT topic FROM data";
// $res = mysqli_query($conn, $query);
// $topic = [];
// if (mysqli_num_rows($res) > 0) {
//     while ($row = mysqli_fetch_assoc($res)) {
//         $topic[] = $row['topic'];
//     }
// }
// $jsonArray['topic'] = $topic;
