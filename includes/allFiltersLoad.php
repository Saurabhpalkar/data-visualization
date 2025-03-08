<?php
header('Content-Type: application/json');
// if ($_POST['sector'] == "sector") {
//   function sector_data()
//   {
//     $sector = $_POST['sector'];
//     apiCall($sector);

//   }
//   sector_data();
// }

// if ($_POST['insights'] != "insights") {
//   function insights_data()
//   {
//     $sector = $_POST['insights'];
//      apiCall($sector);
//   }
//   insights_data();
// }
function apiCall() {
  $postData = $_POST;

  $url = 'http://localhost/blackcoffer-api/includes/loadfiltersData.php?' . http_build_query($postData);

  $curl = curl_init();
  curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
          'Cookie: PHPSESSID=enp85gfk1sicf0vjrf5gdnafq3'
      ),
  ));

  $response = curl_exec($curl);

  if (curl_errno($curl)) {
      echo 'cURL error: ' . curl_error($curl);
  }

  curl_close($curl);
  echo $response;
}

apiCall();
