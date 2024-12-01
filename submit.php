<?php

$projectName = $_POST['project-name'];
$description = $_POST['description'];
$startDate = $_POST['start-date'];
$endDate = $_POST['end-date'];

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
        'type' => 'organisation',  // Atur tipe sebagai 'organisation' atau 'person'
        'name' => $projectName,
        'about' => $description,
        'fields' => [  // Pastikan array ditutup dengan benar
            [
                'definition' => ['id' => 873504],
                'value' => $startDate,
            ],
            [
                'definition' => ['id' => 873505],
                'value' => $endDate,
            ],
        ],
    ],
]));


$response = curl_exec($curl);
curl_close($curl);

echo 'Response from CRM: ' . $response;

?>