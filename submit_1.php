<?php

$casesName = $_POST['cases-name'];
$descriptionCases = $_POST['description-cases'];
$casesStatus = $_POST['list'];
$dateOpened = $_POST['date-opened'];

$curl = curl_init('https://teknik-2484.capsulecrm.com/api/v2/parties');
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer Wc4/15DxiGnc4+1G/xEbeqtTtOC0dSt9ds7wMrqytvCv6dc2BwzFw1hg7USxvF6D',
    'Content-Type: application/json'
]);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode([
    'party' => [
        'type' => 'organisation',  // Tipe: organisation/person
        'name' => $casesName,
        'about' => $descriptionCases,
        'fields' => [
            [
                'definition' => ['id' => 873519], // Field ID untuk status
                'value' => in_array($casesStatus, ['Open', 'Closed']) ? $casesStatus : 'Open',
            ],
            [
                'definition' => ['id' => 873522], // Field ID untuk tanggal
                'value' => $dateOpened,
            ],
        ],
    ],
]));



$response = curl_exec($curl);
curl_close($curl);

echo 'Response from CRM: ' . $response;

?>