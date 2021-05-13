<?php
// CHANGE THIS TO MATCH YOUR ENVIRONMENT
const DB_HOST = "localhost";
const DB_DATABASE = "spotify"; // the name of your database
const DB_USER = "shivam";        // the user or your database
const DB_PASSWORD = "200244885";   // the password of your database

// THE SPOTIFY CREDENTIALS
// TO CREATE NEW CREDENTIALS GO TO: https://developer.spotify.com/dashboard/
const API_CLIENT_ID = 'a328bb571f644b7ba3493b75a74b4f88';
const API_CLIENT_SECRET = 'fb301c94b4a44f8286a26a268163f8c2';

// Variables
$redirect_uri = 'http://localhost:8888/callback';

// Helper functions
function encode($client_id, $client_secret) {
    return base64_encode("$client_id:$client_secret");
}

function MakeAuthorizationHeaders($authorization) {
    return [
        "Authorization: Basic {$authorization}",
        "Content-Type: application/x-www-form-urlencoded"
    ];
}

function CallApi($token_url, $token_headers, $token_content, $method) {
    $curl = curl_init();

    switch ($method){
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($token_content) curl_setopt($curl, CURLOPT_POSTFIELDS, $token_content);
            break;
        default:
            if ($token_content) $token_url = sprintf("%s?%s", $token_url, http_build_query($token_content));
    }

    curl_setopt($curl, CURLOPT_URL, $token_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $token_headers);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = json_decode(curl_exec($curl));

    curl_close($curl);

    return $response;
}

// API Calls
function AuthorizeWithCode($client_id, $client_secret, $authorization_code, $redirect_uri) {
    $tokenUrl = 'https://accounts.spotify.com/api/token';
    $tokenContent = "grant_type=authorization_code&code=${authorization_code}&redirect_uri=${redirect_uri}";
    $authorization = encode($client_id, $client_secret);
    $tokenHeaders = MakeAuthorizationHeaders($authorization);
    $response = CallApi($tokenUrl, $tokenHeaders, $tokenContent, 'POST');
    if (property_exists($response, "error_description")) {
        die('Connection failed: The authorization code expired.');
    }
    file_put_contents('authorization.json', serialize($response));
    return $response;
}

function AuthorizeWithRefreshToken($client_id, $client_secret, $refresh_token) {
    $tokenUrl = 'https://accounts.spotify.com/api/token';
    $tokenContent = "grant_type=refresh_token&refresh_token=${refresh_token}";
    $authorization = encode($client_id, $client_secret);
    $tokenHeaders = MakeAuthorizationHeaders($authorization);
    $response = CallApi($tokenUrl, $tokenHeaders, $tokenContent, 'POST');
    if (property_exists($response, "error_description")) {
        die('Connection failed: Refresh token revoked. Delete authorization.json file and go to http://localhost:88888 to fix it.');
    }
    return $response;
}

function GetRecentTracks($access_token, $timestamp = null) {
    $url = 'https://api.spotify.com/v1/me/player/recently-played';
    $query_string = ['limit' => 50];
    if ($timestamp) {
        $query_string['after'] = $timestamp;
    }
    $headers = ["Authorization: Bearer ${access_token}"];
    return CallApi($url, $headers, $query_string, 'GET');
}

function GetCurrentProfile($access_token) {
    $url = 'https://api.spotify.com/v1/me';
    $headers = ["Authorization: Bearer ${access_token}"];
    return CallApi($url, $headers, null, 'GET');
}

function SaveToDatabase($username, $tracks) {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    foreach ($tracks as $track) {
        $name = $track['name'];
        $played_at = $track['played_at'];
        $sql = "INSERT INTO trackhistory(username, track_name, played_at) VALUES ('${username}', '${name}', ${played_at})";
        if (! mysqli_query($conn, $sql)) {
            die("Error: " . $sql . "" . mysqli_error($conn));
        }
    }
    mysqli_close($conn);
}

function GetLastPlayedTimeStamp() {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT played_at FROM trackhistory ORDER BY played_at DESC";
    $result = mysqli_query($conn, $sql);
    if (! $result) {
        die("Error: " . $sql . "" . mysqli_error($conn));
    }
    $row = $result->fetch_assoc();
    mysqli_close($conn);
    $timestamp = null;
    if ($row) {
        $timestamp = strtotime($row['played_at']);
    }
    return $timestamp;
}

function GetListeningHistory() {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM trackhistory";
    $result = mysqli_query($conn, $sql);
    if (! $result) {
        die("Error: " . $sql . "" . mysqli_error($conn));
    }
    $rows = mysqli_num_rows($result);
    $history = [];
    if ($rows) {
        while ($row = mysqli_fetch_assoc($result)) {
            $history[] = ['track_name' => $row['track_name'], 'username' => $row['username']];
        }
    }
    mysqli_close($conn);
    return $history;
}

function SaveRecentTracks($client_id, $client_secret, $authorization) {
    $token = AuthorizeWithRefreshToken($client_id, $client_secret, $authorization->refresh_token);

    $profile = GetCurrentProfile($token->access_token);
    $user_name = $profile->display_name;

    $timestamp = GetLastPlayedTimeStamp();

    $recent_tracks = GetRecentTracks($token->access_token, $timestamp)->items;
    $tracks = [];
    foreach ($recent_tracks as $item) {
        $tracks[] = [
            'name' => $item->track->name,
            'played_at' => strtotime($item->played_at)
        ];
    }

    if (! empty($tracks)) {
        SaveToDatabase($user_name, $tracks);
    }
}

if (file_exists('authorization.json')) {
    $tokens = unserialize(file_get_contents('authorization.json'));
} else {
    if (! $_GET['authorization_code']) {
        header("Location: /");
        exit;
    }
    $authorization_code = $_GET['authorization_code'];
    $tokens = AuthorizeWithCode(API_CLIENT_ID, API_CLIENT_SECRET, $authorization_code, $redirect_uri);
}

SaveRecentTracks(API_CLIENT_ID, API_CLIENT_SECRET, $tokens);

$history = GetListeningHistory();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listening History</title>
</head>
<body>
<table>
    <tr>
        <th>Track name</th>
        <th>Username</th>
    </tr>
    <?php foreach ($history as $track) { ?>
    <tr>
        <td><?php echo $track['track_name']; ?></td>
        <td><?php echo $track['username']; ?></td>
    </tr>
    <?php } ?>
</table>
</body>
</html>


