<?php

$json = file_get_contents("bruggen_en_sluizen.json");
$data = json_decode($json, true);
$rs = json_decode('{
  "type": "FeatureCollection",
  "features": []
}', true);
foreach ($data['objecten'] as $object) {
  $r = json_decode("{
    \"type\": \"Feature\",
    \"properties\": {},
    \"geometry\": {
      \"type\": \"Point\",
      \"coordinates\": [
        {$object['coordinaten']['lon']},
        {$object['coordinaten']['lat']}
      ]
    }
  }", true);
  $r["properties"] = $object;
  unset($r["properties"]["coordinaten"]);
  $rs["features"][] = $r;
}
echo json_encode($rs);
