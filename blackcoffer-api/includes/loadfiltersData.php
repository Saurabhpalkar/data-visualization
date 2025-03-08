<?php
header('Content-Type: application/json');
include('db.php');

$jsonArray = [];
$queryEndYear = "SELECT DISTINCT end_year FROM data WHERE end_year IS NOT NULL AND end_year != ''";
$resEndYear = mysqli_query($conn, $queryEndYear);
if (mysqli_num_rows($resEndYear) > 0) {
    while ($row = mysqli_fetch_assoc($resEndYear)) {
        $jsonArray['end_year'][] = $row['end_year'];
    }
}


// Query of start_year values
$queryStartYear = "SELECT DISTINCT start_year FROM data WHERE start_year IS NOT NULL AND start_year != ''";
$resStartYear = mysqli_query($conn, $queryStartYear);
if (mysqli_num_rows($resStartYear) > 0) {
    while ($row = mysqli_fetch_assoc($resStartYear)) {
        $jsonArray['start_year'][] = $row['start_year'];
    }
}

// Query of topic values
$queryTopic = "SELECT DISTINCT topic FROM data WHERE topic IS NOT NULL AND topic != ''";
$resTopic = mysqli_query($conn, $queryTopic);
if (mysqli_num_rows($resTopic) > 0) {
    while ($row = mysqli_fetch_assoc($resTopic)) {
        $jsonArray['topic'][] = $row['topic'];
    }
}

// Query of city values
$queryCity = "SELECT DISTINCT city FROM data WHERE city IS NOT NULL AND city != ''";
$resCity = mysqli_query($conn, $queryCity);
if (mysqli_num_rows($resCity) > 0) {
    while ($row = mysqli_fetch_assoc($resCity)) {
        $jsonArray['city'][] = $row['city'];
    }
}

// Query of SWOT values
$querySwot = "SELECT DISTINCT swot FROM data WHERE swot IS NOT NULL AND swot != ''";
$resSwot = mysqli_query($conn, $querySwot);
if (mysqli_num_rows($resSwot) > 0) {
    while ($row = mysqli_fetch_assoc($resSwot)) {
        $jsonArray['swot'][] = $row['swot'];
    }
}

// Query of country values
$queryCountry = "SELECT DISTINCT country FROM data WHERE country IS NOT NULL AND country != ''";
$resCountry = mysqli_query($conn, $queryCountry);
if (mysqli_num_rows($resCountry) > 0) {
    while ($row = mysqli_fetch_assoc($resCountry)) {
        $jsonArray['country'][] = $row['country'];
    }
}

// Query of source values
$querySource = "SELECT DISTINCT source FROM data WHERE source IS NOT NULL AND source != ''";
$resSource = mysqli_query($conn, $querySource);
if (mysqli_num_rows($resSource) > 0) {
    while ($row = mysqli_fetch_assoc($resSource)) {
        $jsonArray['source'][] = $row['source'];
    }
}


// Query of region values
$queryRegion = "SELECT DISTINCT region FROM data WHERE region IS NOT NULL AND region != ''";
$resregion = mysqli_query($conn, $queryRegion);
if (mysqli_num_rows($resregion) > 0) {
    while ($row = mysqli_fetch_assoc($resregion)) {
        $jsonArray['region'][] = $row['region'];
    }
}

// Query of sector values
$querySector = "SELECT DISTINCT sector FROM data WHERE sector IS NOT NULL AND sector != ''";
$resSector = mysqli_query($conn, $querySector);
if (mysqli_num_rows($resSource) > 0) {
    while ($row = mysqli_fetch_assoc($resSource)) {
        $jsonArray['sector'][] = $row['sector'];
    }
}

// Query of pestle values
$querypestle  = "SELECT DISTINCT pestle FROM data WHERE pestle IS NOT NULL AND pestle != ''";
$respestle = mysqli_query($conn, $querypestle);
if (mysqli_num_rows($respestle) > 0) {
    while ($row = mysqli_fetch_assoc($respestle)) {
        $jsonArray['pestle'][] = $row['pestle'];
    }
}

echo json_encode($jsonArray);

?>