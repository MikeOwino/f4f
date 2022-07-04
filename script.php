<?php

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.telegram.org/bot${{ secrets.chat_id}}/sendPhoto",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"photo\":\"https://res.cloudinary.com/weknow-creators/image/upload/v1645187565/c300_ixeomv.png\",\"disable_notification\":false,\"reply_to_message_id\":null,\"chat_id\":\"${{ secrets.telegram_api }}\"}",
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Content-Type: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

function generateReadme($used, $limit, $cFs, $cTs, $cFg, $cTg) {
    $readme = "# auto-follow-unfollow\n";
    $readme .= "Follow and unfollow users automatically\n\n";

    $readme .=
        "[![Script](https://github.com/mikeyhodl/f4f/actions/workflows/main.yml/badge.svg)](https://github.com/mikeyhodl/f4f/actions/workflows/main.yml)";

    $readme .= "\n### Run details\n";

    $readme .= "- Last run `" . date(DATE_RFC2822) . "`\n";
    $readme .= "- X-RateLimit-Used: `" . $used . "`\n";
    $readme .= "- X-RateLimit-Limit: `" . $limit . "`\n\n";

    $readme .= "|  | Followers | Following |\n";
    $readme .= "| - | --------- | --------- |\n";
    $readme .= "| Current | " . ($cFs + $cTs). " | " . ($cFg + $cTg) . " |\n";
    $readme .= "| Change | " . $cFs . " | " . $cFg . "|\n";

    return $readme;
}

file_put_contents("README.md", generateReadme($used, $limit, $cFs, $cTs, $cFg, $cTg));
