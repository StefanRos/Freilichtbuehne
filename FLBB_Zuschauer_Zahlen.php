<?php
session_start();
date_default_timezone_set("Europe/Berlin");

$totalSeats = 1221;
$today = date("Y-m-d");
$loginError = "";

$adminPasswordHash = getenv('ADMIN_PASSWORD_HASH');
if (!$adminPasswordHash) { die("Konfigurationsfehler: ADMIN_PASSWORD_HASH fehlt."); }

$cacheSeconds = 60;
$staleCacheSeconds = 3600;

// Admin-Session nach 30 Minuten automatisch beenden
$sessionTimeoutSeconds = 1800;

if (isset($_SESSION["is_admin"], $_SESSION["last_activity"])) {
    if (time() - $_SESSION["last_activity"] > $sessionTimeoutSeconds) {
        unset($_SESSION["is_admin"]);
        unset($_SESSION["last_activity"]);
    }
}

if (!empty($_SESSION["is_admin"])) {
    $_SESSION["last_activity"] = time();
}

// Login
if (isset($_POST["admin_password"])) {
    if (password_verify($_POST["admin_password"], $adminPasswordHash)) {
        $_SESSION["is_admin"] = true;
        $_SESSION["last_activity"] = time();
    } else {
        $loginError = "Falsches Passwort.";
    }
}

// Logout
if (isset($_GET["logout"])) {
    unset($_SESSION["is_admin"]);
    unset($_SESSION["last_activity"]);
    header("Location: FLBB_Zuschauer_Zahlen.php");
    exit;
}

$isAdmin = $_SESSION["is_admin"] ?? false;

function safe($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}

function makeEvent($id, $label, $dateText, $time, $dateIso, $url, $referer) {
    return [
        "id" => $id,
        "label" => $label,
        "date" => $dateText,
        "time" => $time,
        "date_iso" => $dateIso,
        "url" => $url,
        "referer" => $referer
    ];
}

$shows = [
    "kater" => [
        "title" => "Der gestiefelte Kater",
        "subtitle" => "Familienstück 2026",
        "image" => "https://cdn.pretix.cloud/1/pub/thumbs/b3f88339e46e8e624a03fc82c2c24327.1170x5000.fef6280ff5ffbf.jpeg",
        "events" => [
            "4749895" => makeEvent("4749895", "So, 24. Mai 2026 · 15:00 Uhr · Premiere", "Sonntag, 24. Mai 2026", "15:00 Uhr", "2026-05-24", "https://tickets.freilichtspiele-badbentheim.de/kater26/seating/4749895/event.json", "https://tickets.freilichtspiele-badbentheim.de/kater26/4749895/"),
            "4749896" => makeEvent("4749896", "So, 31. Mai 2026 · 15:00 Uhr", "Sonntag, 31. Mai 2026", "15:00 Uhr", "2026-05-31", "https://tickets.freilichtspiele-badbentheim.de/kater26/seating/4749896/event.json", "https://tickets.freilichtspiele-badbentheim.de/kater26/4749896/"),
            "4749897" => makeEvent("4749897", "Mi, 10. Juni 2026 · 16:00 Uhr", "Mittwoch, 10. Juni 2026", "16:00 Uhr", "2026-06-10", "https://tickets.freilichtspiele-badbentheim.de/kater26/seating/4749897/event.json", "https://tickets.freilichtspiele-badbentheim.de/kater26/4749897/"),
            "4749898" => makeEvent("4749898", "So, 14. Juni 2026 · 15:00 Uhr", "Sonntag, 14. Juni 2026", "15:00 Uhr", "2026-06-14", "https://tickets.freilichtspiele-badbentheim.de/kater26/seating/4749898/event.json", "https://tickets.freilichtspiele-badbentheim.de/kater26/4749898/"),
            "4749899" => makeEvent("4749899", "So, 21. Juni 2026 · 15:00 Uhr", "Sonntag, 21. Juni 2026", "15:00 Uhr", "2026-06-21", "https://tickets.freilichtspiele-badbentheim.de/kater26/seating/4749899/event.json", "https://tickets.freilichtspiele-badbentheim.de/kater26/4749899/"),
            "4749900" => makeEvent("4749900", "So, 28. Juni 2026 · 15:00 Uhr", "Sonntag, 28. Juni 2026", "15:00 Uhr", "2026-06-28", "https://tickets.freilichtspiele-badbentheim.de/kater26/seating/4749900/event.json", "https://tickets.freilichtspiele-badbentheim.de/kater26/4749900/"),
            "4749901" => makeEvent("4749901", "So, 2. August 2026 · 15:00 Uhr", "Sonntag, 2. August 2026", "15:00 Uhr", "2026-08-02", "https://tickets.freilichtspiele-badbentheim.de/kater26/seating/4749901/event.json", "https://tickets.freilichtspiele-badbentheim.de/kater26/4749901/"),
            "4749902" => makeEvent("4749902", "So, 9. August 2026 · 15:00 Uhr", "Sonntag, 9. August 2026", "15:00 Uhr", "2026-08-09", "https://tickets.freilichtspiele-badbentheim.de/kater26/seating/4749902/event.json", "https://tickets.freilichtspiele-badbentheim.de/kater26/4749902/"),
            "4749903" => makeEvent("4749903", "So, 16. August 2026 · 15:00 Uhr", "Sonntag, 16. August 2026", "15:00 Uhr", "2026-08-16", "https://tickets.freilichtspiele-badbentheim.de/kater26/seating/4749903/event.json", "https://tickets.freilichtspiele-badbentheim.de/kater26/4749903/"),
            "4749904" => makeEvent("4749904", "So, 23. August 2026 · 15:00 Uhr", "Sonntag, 23. August 2026", "15:00 Uhr", "2026-08-23", "https://tickets.freilichtspiele-badbentheim.de/kater26/seating/4749904/event.json", "https://tickets.freilichtspiele-badbentheim.de/kater26/4749904/"),
            "4749905" => makeEvent("4749905", "So, 30. August 2026 · 15:00 Uhr", "Sonntag, 30. August 2026", "15:00 Uhr", "2026-08-30", "https://tickets.freilichtspiele-badbentheim.de/kater26/seating/4749905/event.json", "https://tickets.freilichtspiele-badbentheim.de/kater26/4749905/"),
            "4749906" => makeEvent("4749906", "Sa, 5. September 2026 · 20:00 Uhr · Nacht der Lichter", "Samstag, 5. September 2026", "20:00 Uhr", "2026-09-05", "https://tickets.freilichtspiele-badbentheim.de/kater26/seating/4749906/event.json", "https://tickets.freilichtspiele-badbentheim.de/kater26/4749906/")
        ]
    ],

    "fish" => [
        "title" => "BIG FISH - Das Broadwaymusical",
        "subtitle" => "Musical 2026",
        "image" => "https://cdn.pretix.cloud/2/pub/thumbs/d457f7d9ce337804be9f3666d41b341f.1170x5000.e561f29b7718fb.jpeg",
        "events" => [
            "4776660" => makeEvent("4776660", "Sa, 6. Juni 2026 · 20:00 Uhr · Premiere", "Samstag, 6. Juni 2026", "20:00 Uhr", "2026-06-06", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/seating/4776660/event.json", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/4776660/"),
            "4776661" => makeEvent("4776661", "Sa, 13. Juni 2026 · 20:00 Uhr", "Samstag, 13. Juni 2026", "20:00 Uhr", "2026-06-13", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/seating/4776661/event.json", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/4776661/"),
            "4776662" => makeEvent("4776662", "Sa, 20. Juni 2026 · 20:00 Uhr", "Samstag, 20. Juni 2026", "20:00 Uhr", "2026-06-20", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/seating/4776662/event.json", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/4776662/"),
            "4776663" => makeEvent("4776663", "Fr, 26. Juni 2026 · 20:00 Uhr", "Freitag, 26. Juni 2026", "20:00 Uhr", "2026-06-26", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/seating/4776663/event.json", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/4776663/"),
            "4776664" => makeEvent("4776664", "Sa, 27. Juni 2026 · 20:00 Uhr", "Samstag, 27. Juni 2026", "20:00 Uhr", "2026-06-27", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/seating/4776664/event.json", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/4776664/"),
            "4776665" => makeEvent("4776665", "Sa, 1. August 2026 · 20:00 Uhr", "Samstag, 1. August 2026", "20:00 Uhr", "2026-08-01", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/seating/4776665/event.json", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/4776665/"),
            "4776666" => makeEvent("4776666", "Fr, 7. August 2026 · 20:00 Uhr", "Freitag, 7. August 2026", "20:00 Uhr", "2026-08-07", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/seating/4776666/event.json", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/4776666/"),
            "4776667" => makeEvent("4776667", "Sa, 8. August 2026 · 20:00 Uhr", "Samstag, 8. August 2026", "20:00 Uhr", "2026-08-08", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/seating/4776667/event.json", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/4776667/"),
            "4776668" => makeEvent("4776668", "Sa, 15. August 2026 · 20:00 Uhr", "Samstag, 15. August 2026", "20:00 Uhr", "2026-08-15", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/seating/4776668/event.json", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/4776668/"),
            "4776669" => makeEvent("4776669", "Fr, 21. August 2026 · 20:00 Uhr", "Freitag, 21. August 2026", "20:00 Uhr", "2026-08-21", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/seating/4776669/event.json", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/4776669/"),
            "4776670" => makeEvent("4776670", "Sa, 22. August 2026 · 20:00 Uhr", "Samstag, 22. August 2026", "20:00 Uhr", "2026-08-22", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/seating/4776670/event.json", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/4776670/"),
            "4776671" => makeEvent("4776671", "Fr, 28. August 2026 · 20:00 Uhr", "Freitag, 28. August 2026", "20:00 Uhr", "2026-08-28", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/seating/4776671/event.json", "https://tickets.freilichtspiele-badbentheim.de/bigfish26/4776671/")
        ]
    ],

    "musical" => [
        "title" => "Musical Night 2026",
        "subtitle" => "Sonderveranstaltung",
        "image" => "https://cdn.pretix.cloud/1/pub/thumbs/ce8ddbc1ca5db9efd4cf9c2ceec09138.1170x5000.304ff33a889044.jpeg",
        "events" => [
            "musical26" => makeEvent("musical26", "Fr, 14. August 2026 · 20:00 Uhr", "Freitag, 14. August 2026", "20:00 Uhr", "2026-08-14", "https://tickets.freilichtspiele-badbentheim.de/musical26/seating/event.json", "https://tickets.freilichtspiele-badbentheim.de/musical26/")
        ]
    ],

    "maffay" => [
        "title" => "MAFFAY pur",
        "subtitle" => "Sonderveranstaltung",
        "image" => "https://cdn.pretix.cloud/1/pub/thumbs/3807c4d3f62980fc49049dcaadf075f4.1170x5000.a2e45a8142a1a9.jpeg",
        "events" => [
            "maffay26" => makeEvent("maffay26", "Sa, 12. September 2026 · 20:00 Uhr", "Samstag, 12. September 2026", "20:00 Uhr", "2026-09-12", "https://tickets.freilichtspiele-badbentheim.de/maffay26/seating/event.json", "https://tickets.freilichtspiele-badbentheim.de/maffay26/")
        ]
    ]
];

function dataDirPath() {
    return __DIR__ . "/data";
}

function eventsDataPath() {
    return dataDirPath() . "/events.json";
}

function ensureDataDir() {
    $dataDir = dataDirPath();

    if (!is_dir($dataDir)) {
        @mkdir($dataDir, 0775, true);
    }

    $backupDir = $dataDir . "/backups";

    if (!is_dir($backupDir)) {
        @mkdir($backupDir, 0775, true);
    }
}

function loadEditableShows($fallbackShows) {
    $dataFile = eventsDataPath();

    if (!is_file($dataFile)) {
        return $fallbackShows;
    }

    $data = json_decode((string)@file_get_contents($dataFile), true);

    if (!is_array($data) || !isset($data["shows"]) || !is_array($data["shows"])) {
        return $fallbackShows;
    }

    return $data["shows"];
}

function saveEditableShows($shows) {
    ensureDataDir();
    $dataFile = eventsDataPath();

    if (is_file($dataFile)) {
        @copy($dataFile, dataDirPath() . "/backups/events-" . date("Ymd-His") . ".json");
    }

    $payload = json_encode([
        "updated_at" => date("c"),
        "shows" => $shows
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    if ($payload === false || @file_put_contents($dataFile, $payload, LOCK_EX) === false) {
        return false;
    }

    return true;
}

function slugFromText($text) {
    $slug = strtolower(trim((string)$text));
    $slug = preg_replace("/[^a-z0-9]+/", "-", $slug);
    $slug = trim($slug, "-");

    return $slug !== "" ? $slug : "veranstaltung";
}

function uniqueShowKey($shows, $baseKey) {
    $key = $baseKey;
    $counter = 2;

    while (isset($shows[$key])) {
        $key = $baseKey . "-" . $counter;
        $counter++;
    }

    return $key;
}

function firstRegex($pattern, $text) {
    if (preg_match($pattern, $text, $matches)) {
        return html_entity_decode(trim($matches[1]), ENT_QUOTES, "UTF-8");
    }

    return "";
}

function fetchPretixPage($url) {
    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 12,
        CURLOPT_CONNECTTIMEOUT => 5,
        CURLOPT_HTTPHEADER => [
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)",
            "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8"
        ]
    ]);

    $html = curl_exec($ch);
    $error = $html === false ? curl_error($ch) : null;
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($html === false) {
        return ["ok" => false, "error" => "Pretix-Seite konnte nicht geladen werden: " . $error, "html" => ""];
    }

    if ($httpCode < 200 || $httpCode >= 300) {
        return ["ok" => false, "error" => "Pretix-Seite antwortet mit HTTP-Code " . $httpCode, "html" => ""];
    }

    return ["ok" => true, "error" => null, "html" => $html];
}

function formatDateText($dateIso) {
    $timestamp = strtotime($dateIso);

    if ($timestamp === false) {
        return $dateIso;
    }

    $days = ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"];
    $months = [1 => "Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"];

    return $days[(int)date("w", $timestamp)] . ", " . (int)date("j", $timestamp) . ". " . $months[(int)date("n", $timestamp)] . " " . date("Y", $timestamp);
}

function formatShortLabel($dateIso, $timeText, $extra = "") {
    $timestamp = strtotime($dateIso);
    $days = ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"];
    $months = [1 => "Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"];

    if ($timestamp === false) {
        $label = trim($dateIso . " · " . $timeText);
    } else {
        $label = $days[(int)date("w", $timestamp)] . ", " . (int)date("j", $timestamp) . ". " . $months[(int)date("n", $timestamp)] . " " . date("Y", $timestamp) . " · " . $timeText;
    }

    return $extra !== "" ? $label . " · " . $extra : $label;
}

function buildPretixShowFromLink($link, $titleOverride = "", $subtitleOverride = "", $imageOverride = "") {
    $link = trim($link);

    if (!filter_var($link, FILTER_VALIDATE_URL)) {
        return ["ok" => false, "error" => "Bitte einen gültigen Pretix-Link eintragen.", "show" => null, "key" => null];
    }

    $page = fetchPretixPage($link);

    if (!$page["ok"]) {
        return ["ok" => false, "error" => $page["error"], "show" => null, "key" => null];
    }

    $html = $page["html"];
    $title = $titleOverride !== "" ? $titleOverride : firstRegex('/<meta property="og:title" content="([^"]+)"/i', $html);
    $image = $imageOverride !== "" ? $imageOverride : firstRegex('/<meta property="og:image" content="([^"]+)"/i', $html);

    if ($title === "") {
        $title = firstRegex('/<title>\s*(.*?)\s*<\/title>/is', $html);
        $title = trim(preg_replace('/\s+/', ' ', $title));
    }

    $subtitle = $subtitleOverride !== "" ? $subtitleOverride : "Veranstaltung";
    $events = [];

    if (preg_match_all('/<article\b.*?<\/article>/is', $html, $articles)) {
        foreach ($articles[0] as $article) {
            $eventLink = firstRegex('/<a[^>]+href="([^"]+)"/i', $article);
            $eventId = firstRegex('/subevent-([^"-]+)-label/i', $article);
            $dateIso = firstRegex('/<time[^>]+datetime="(\d{4}-\d{2}-\d{2})"/i', $article);
            $timeText = firstRegex('/<time[^>]+datetime="\d{4}-\d{2}-\d{2}T[^"]+">([^<]+)<\/time>/i', $article);

            if ($eventId === "" && preg_match('~/([^/]+)/?$~', $eventLink, $matches)) {
                $eventId = $matches[1];
            }

            if ($eventLink === "" || $eventId === "" || $dateIso === "" || $timeText === "") {
                continue;
            }

            $timeText = preg_match('/^\d{1,2}:\d{2}$/', $timeText) ? $timeText . " Uhr" : $timeText;
            $eventJson = rtrim(dirname(rtrim($eventLink, "/")), "/") . "/seating/" . $eventId . "/event.json";
            $events[$eventId] = makeEvent($eventId, formatShortLabel($dateIso, $timeText), formatDateText($dateIso), $timeText, $dateIso, $eventJson, $eventLink);
        }
    }

    if (count($events) === 0) {
        $eventJson = firstRegex('/event="([^"]+event\.json)"/i', $html);
        $dateIso = substr(firstRegex('/"startDate":\s*"([^"]+)"/i', $html), 0, 10);
        $timeText = "";

        if (preg_match('/<time[^>]+datetime="[^"]+T[^"]+">([^<]+)<\/time>/i', $html, $matches)) {
            $timeText = trim($matches[1]);
        }

        if ($eventJson !== "" && $dateIso !== "") {
            $eventId = preg_match('~/seating/([^/]+)/event\.json~', $eventJson, $matches) ? $matches[1] : slugFromText($title);
            $timeText = $timeText !== "" ? $timeText . (str_contains($timeText, "Uhr") ? "" : " Uhr") : "00:00 Uhr";
            $events[$eventId] = makeEvent($eventId, formatShortLabel($dateIso, $timeText), formatDateText($dateIso), $timeText, $dateIso, $eventJson, $link);
        }
    }

    if ($title === "" || $image === "" || count($events) === 0) {
        return ["ok" => false, "error" => "Aus dem Link konnten Titel, Bild oder Vorstellungen nicht automatisch gelesen werden.", "show" => null, "key" => null];
    }

    return [
        "ok" => true,
        "error" => null,
        "key" => slugFromText($title),
        "show" => [
            "title" => $title,
            "subtitle" => $subtitle,
            "image" => $image,
            "events" => $events
        ]
    ];
}

$adminMessage = "";
$adminError = "";
$shows = loadEditableShows($shows);

if ($isAdmin && $_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["admin_action"])) {
    $action = $_POST["admin_action"];

    if ($action === "import_show") {
        $import = buildPretixShowFromLink($_POST["pretix_link"] ?? "", trim($_POST["title"] ?? ""), trim($_POST["subtitle"] ?? ""), trim($_POST["image"] ?? ""));

        if ($import["ok"]) {
            $key = uniqueShowKey($shows, $import["key"]);
            $shows[$key] = $import["show"];

            if (saveEditableShows($shows)) {
                $adminMessage = "Veranstaltung wurde importiert.";
            } else {
                $adminError = "Veranstaltung konnte nicht gespeichert werden.";
            }
        } else {
            $adminError = $import["error"];
        }
    }

    if ($action === "update_show") {
        $showKey = $_POST["show_key"] ?? "";

        if (isset($shows[$showKey])) {
            $shows[$showKey]["title"] = trim($_POST["title"] ?? $shows[$showKey]["title"]);
            $shows[$showKey]["subtitle"] = trim($_POST["subtitle"] ?? $shows[$showKey]["subtitle"]);
            $shows[$showKey]["image"] = trim($_POST["image"] ?? $shows[$showKey]["image"]);

            if (saveEditableShows($shows)) {
                $adminMessage = "Veranstaltung wurde gespeichert.";
            } else {
                $adminError = "Veranstaltung konnte nicht gespeichert werden.";
            }
        }
    }

    if ($action === "delete_show") {
        $showKey = $_POST["show_key"] ?? "";

        if (isset($shows[$showKey])) {
            if (count($shows) <= 1) {
                $adminError = "Die letzte Veranstaltung kann nicht gelöscht werden.";
            } else {
                unset($shows[$showKey]);

                if (saveEditableShows($shows)) {
                    $adminMessage = "Veranstaltung wurde gelöscht.";
                } else {
                    $adminError = "Veranstaltung konnte nicht gelöscht werden.";
                }
            }
        }
    }
}

$allShows = $shows;

if (!$isAdmin) {
    foreach ($shows as $showKey => $show) {
        foreach ($show["events"] as $eventKey => $event) {
            if ($event["date_iso"] < $today) {
                unset($shows[$showKey]["events"][$eventKey]);
            }
        }

        if (count($shows[$showKey]["events"]) === 0) {
            unset($shows[$showKey]);
        }
    }
}

function cacheFileForUrl($url) {
    $cacheDir = sys_get_temp_dir() . "/flbb_pretix_cache";

    if (!is_dir($cacheDir)) {
        @mkdir($cacheDir, 0775, true);
    }

    return $cacheDir . "/" . sha1($url) . ".json";
}

function snapshotFileForEvent($event) {
    $snapshotDir = sys_get_temp_dir() . "/flbb_pretix_snapshots";

    if (!is_dir($snapshotDir)) {
        @mkdir($snapshotDir, 0775, true);
    }

    return $snapshotDir . "/" . sha1($event["url"]) . ".json";
}

function readCachedJson($cacheFile) {
    if (!is_file($cacheFile)) {
        return null;
    }

    $payload = json_decode((string)@file_get_contents($cacheFile), true);

    if (!is_array($payload) || !isset($payload["created_at"], $payload["json"])) {
        return null;
    }

    $data = json_decode((string)$payload["json"], true);

    if ($data === null) {
        return null;
    }

    return [
        "created_at" => (int)$payload["created_at"],
        "data" => $data
    ];
}

function writeCachedJson($cacheFile, $json) {
    $payload = json_encode([
        "created_at" => time(),
        "json" => $json
    ]);

    if ($payload !== false) {
        @file_put_contents($cacheFile, $payload, LOCK_EX);
    }
}

function loadJson($url, $referer, $cacheSeconds, $staleCacheSeconds) {
    $cacheFile = cacheFileForUrl($url);
    $cached = readCachedJson($cacheFile);

    if ($cached !== null && time() - $cached["created_at"] <= $cacheSeconds) {
        return [
            "ok" => true,
            "error" => null,
            "warning" => null,
            "data" => $cached["data"],
            "cached" => true,
            "stale" => false,
            "fetchedAt" => $cached["created_at"]
        ];
    }

    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 8,
        CURLOPT_CONNECTTIMEOUT => 4,
        CURLOPT_HTTPHEADER => [
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)",
            "Accept: application/json,text/plain,*/*",
            "Referer: " . $referer
        ]
    ]);

    $json = curl_exec($ch);

    if ($json === false) {
        $error = "cURL Fehler: " . curl_error($ch);
        curl_close($ch);

        if ($cached !== null && time() - $cached["created_at"] <= $staleCacheSeconds) {
            return [
                "ok" => true,
                "error" => null,
                "warning" => $error,
                "data" => $cached["data"],
                "cached" => true,
                "stale" => true,
                "fetchedAt" => $cached["created_at"]
            ];
        }

        return ["ok" => false, "error" => $error, "warning" => null, "data" => null, "cached" => false, "stale" => false, "fetchedAt" => null];
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200) {
        $error = "Server antwortet mit HTTP-Code " . $httpCode;

        if ($cached !== null && time() - $cached["created_at"] <= $staleCacheSeconds) {
            return [
                "ok" => true,
                "error" => null,
                "warning" => $error,
                "data" => $cached["data"],
                "cached" => true,
                "stale" => true,
                "fetchedAt" => $cached["created_at"]
            ];
        }

        return ["ok" => false, "error" => $error, "warning" => null, "data" => null, "cached" => false, "stale" => false, "fetchedAt" => null];
    }

    $data = json_decode($json, true);

    if ($data === null) {
        $error = "JSON konnte nicht gelesen werden.";

        if ($cached !== null && time() - $cached["created_at"] <= $staleCacheSeconds) {
            return [
                "ok" => true,
                "error" => null,
                "warning" => $error,
                "data" => $cached["data"],
                "cached" => true,
                "stale" => true,
                "fetchedAt" => $cached["created_at"]
            ];
        }

        return ["ok" => false, "error" => $error, "warning" => null, "data" => null, "cached" => false, "stale" => false, "fetchedAt" => null];
    }

    writeCachedJson($cacheFile, $json);

    return [
        "ok" => true,
        "error" => null,
        "warning" => null,
        "data" => $data,
        "cached" => false,
        "stale" => false,
        "fetchedAt" => time()
    ];
}

function emptyNumbers($error) {
    return [
        "ok" => false,
        "error" => $error,
        "warning" => null,
        "freeTotal" => 0,
        "blockedSeats" => 0,
        "usagePercent" => 0,
        "freeLeft" => 0,
        "freeRight" => 0,
        "cached" => false,
        "stale" => false,
        "fetchedAt" => null,
        "trendSeats" => null,
        "trendText" => "Keine Daten",
        "forecastText" => "Keine Prognose"
    ];
}

function calculateNumbers($event, $totalSeats, $cacheSeconds, $staleCacheSeconds) {
    $result = loadJson($event["url"], $event["referer"], $cacheSeconds, $staleCacheSeconds);

    if (!$result["ok"]) {
        return emptyNumbers($result["error"]);
    }

    $eventData = $result["data"];

    if (!isset($eventData["available_seats"]) || !is_array($eventData["available_seats"])) {
        return emptyNumbers("Keine available_seats gefunden.");
    }

    $availableSeats = $eventData["available_seats"];

    $freeTotal = count($availableSeats);
    $blockedSeats = $totalSeats - $freeTotal;
    $usagePercent = round(($blockedSeats / $totalSeats) * 100, 1);

    $freeLeft = 0;
    $freeRight = 0;

    foreach ($availableSeats as $seat) {
        if (str_starts_with($seat, "Links-")) {
            $freeLeft++;
        } elseif (str_starts_with($seat, "Rechts-")) {
            $freeRight++;
        }
    }

    return [
        "ok" => true,
        "error" => null,
        "warning" => $result["warning"],
        "freeTotal" => $freeTotal,
        "blockedSeats" => $blockedSeats,
        "usagePercent" => $usagePercent,
        "freeLeft" => $freeLeft,
        "freeRight" => $freeRight,
        "cached" => $result["cached"],
        "stale" => $result["stale"],
        "fetchedAt" => $result["fetchedAt"],
        "trendSeats" => null,
        "trendText" => "Noch kein Vergleich",
        "forecastText" => "Noch nicht genug Daten"
    ];
}

function enrichNumbersWithTrend($event, $numbers) {
    if (!$numbers["ok"] || empty($numbers["fetchedAt"])) {
        return $numbers;
    }

    $snapshotFile = snapshotFileForEvent($event);
    $history = json_decode((string)@file_get_contents($snapshotFile), true);

    if (!is_array($history)) {
        $history = [];
    }

    $current = [
        "fetchedAt" => (int)$numbers["fetchedAt"],
        "freeTotal" => (int)$numbers["freeTotal"],
        "blockedSeats" => (int)$numbers["blockedSeats"],
        "usagePercent" => (float)$numbers["usagePercent"]
    ];

    $last = isset($history["last"]) && is_array($history["last"]) ? $history["last"] : null;
    $previous = isset($history["previous"]) && is_array($history["previous"]) ? $history["previous"] : null;

    if ($last === null || (int)$last["fetchedAt"] < $current["fetchedAt"]) {
        $previous = $last;
        $last = $current;

        @file_put_contents($snapshotFile, json_encode([
            "previous" => $previous,
            "last" => $last
        ]), LOCK_EX);
    }

    if ($previous === null || (int)$previous["fetchedAt"] >= (int)$last["fetchedAt"]) {
        $numbers["trendText"] = "Noch kein Vergleich";
        $numbers["forecastText"] = "Noch nicht genug Daten";
        return $numbers;
    }

    $soldSinceLastFetch = (int)$previous["freeTotal"] - (int)$last["freeTotal"];
    $seconds = max(1, (int)$last["fetchedAt"] - (int)$previous["fetchedAt"]);
    $numbers["trendSeats"] = $soldSinceLastFetch;

    if ($soldSinceLastFetch > 0) {
        $numbers["trendText"] = "+" . $soldSinceLastFetch . " verkauft seit " . date("d.m. H:i", (int)$previous["fetchedAt"]);
        $soldPerDay = $soldSinceLastFetch / ($seconds / 86400);

        if ($soldPerDay > 0 && $numbers["freeTotal"] > 0) {
            $daysUntilSoldOut = $numbers["freeTotal"] / $soldPerDay;
            $forecastTime = time() + (int)round($daysUntilSoldOut * 86400);
            $numbers["forecastText"] = "bei aktuellem Tempo ca. " . date("d.m.Y", $forecastTime) . " ausverkauft";
        } else {
            $numbers["forecastText"] = "ausverkauft";
        }
    } elseif ($soldSinceLastFetch < 0) {
        $numbers["trendText"] = abs($soldSinceLastFetch) . " Plaetze wieder frei seit " . date("d.m. H:i", (int)$previous["fetchedAt"]);
        $numbers["forecastText"] = "keine Ausverkauft-Prognose";
    } else {
        $numbers["trendText"] = "0 verkauft seit " . date("d.m. H:i", (int)$previous["fetchedAt"]);
        $numbers["forecastText"] = "keine Veraenderung";
    }

    return $numbers;
}

function getAdminRows($allShows, $totalSeats, $cacheSeconds, $staleCacheSeconds) {
    $rows = [];

    foreach ($allShows as $show) {
        foreach ($show["events"] as $event) {
            $numbers = calculateNumbers($event, $totalSeats, $cacheSeconds, $staleCacheSeconds);
            $numbers = enrichNumbersWithTrend($event, $numbers);

            $rows[] = [
                "show" => $show,
                "event" => $event,
                "numbers" => $numbers
            ];
        }
    }

    return $rows;
}

function excelCell($value, $type = "String") {
    if ($type === "Number" && is_numeric($value)) {
        return '<Cell><Data ss:Type="Number">' . $value . '</Data></Cell>';
    }

    return '<Cell><Data ss:Type="String">' . htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8") . '</Data></Cell>';
}

function downloadExcel($rows, $today) {
    $filename = "flbb_zuschauerzahlen_" . date("Y-m-d_H-i") . ".xls";

    header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
    header("Content-Disposition: attachment; filename=\"" . $filename . "\"");
    header("Cache-Control: no-store, no-cache, must-revalidate");

    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<?mso-application progid="Excel.Sheet"?>' . "\n";
    echo '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">' . "\n";
    echo '<Worksheet ss:Name="Zuschauerzahlen"><Table>' . "\n";

    $headers = ["Status", "Stueck", "Vorstellung", "Datum", "Uhrzeit", "Frei", "Belegt", "Auslastung %", "Links frei", "Rechts frei", "Trend", "Prognose", "Datenstand", "Quelle", "Ticketseite"];
    echo "<Row>";
    foreach ($headers as $header) {
        echo excelCell($header);
    }
    echo "</Row>\n";

    foreach ($rows as $row) {
        $event = $row["event"];
        $numbers = $row["numbers"];
        $isPast = $event["date_iso"] < $today;
        $fetchedAt = $numbers["fetchedAt"] ? date("d.m.Y H:i:s", $numbers["fetchedAt"]) : "";

        echo "<Row>";
        echo excelCell($isPast ? "Archiv" : "Aktuell/Zukunft");
        echo excelCell($row["show"]["title"]);
        echo excelCell($event["label"]);
        echo excelCell($event["date"]);
        echo excelCell($event["time"]);
        echo excelCell($numbers["freeTotal"], "Number");
        echo excelCell($numbers["blockedSeats"], "Number");
        echo excelCell($numbers["usagePercent"], "Number");
        echo excelCell($numbers["freeLeft"], "Number");
        echo excelCell($numbers["freeRight"], "Number");
        echo excelCell($numbers["trendText"]);
        echo excelCell($numbers["forecastText"]);
        echo excelCell($fetchedAt);
        echo excelCell($event["url"]);
        echo excelCell($event["referer"]);
        echo "</Row>\n";
    }

    echo "</Table></Worksheet></Workbook>";
    exit;
}

function getStatusText($numbers) {
    if (!$numbers["ok"]) {
        return ["text" => "Datenfehler", "class" => "status-error"];
    }

    if ($numbers["freeTotal"] <= 0) {
        return ["text" => "Ausverkauft", "class" => "status-soldout"];
    }

    if ($numbers["freeTotal"] < 50) {
        return ["text" => "Fast ausverkauft", "class" => "status-hot"];
    }

    if ($numbers["usagePercent"] >= 80) {
        return ["text" => "Sehr gut gebucht", "class" => "status-good"];
    }

    if ($numbers["usagePercent"] >= 60) {
        return ["text" => "Gut gebucht", "class" => "status-medium"];
    }

    return ["text" => "Viele Plätze frei", "class" => "status-free"];
}

if (count($shows) === 0) {
    die("Keine aktuellen Veranstaltungen vorhanden.");
}

$selectedShowKey = $_GET["show"] ?? array_key_first($shows);

if (!isset($shows[$selectedShowKey])) {
    $selectedShowKey = array_key_first($shows);
}

$selectedShow = $shows[$selectedShowKey];

$selectedEventKey = $_GET["event"] ?? array_key_first($selectedShow["events"]);

if (!isset($selectedShow["events"][$selectedEventKey])) {
    $selectedEventKey = array_key_first($selectedShow["events"]);
}

$selectedEvent = $selectedShow["events"][$selectedEventKey];
$numbers = calculateNumbers($selectedEvent, $totalSeats, $cacheSeconds, $staleCacheSeconds);
$numbers = enrichNumbersWithTrend($selectedEvent, $numbers);
$status = getStatusText($numbers);

$lastUpdate = $numbers["fetchedAt"] ? date("d.m.Y H:i:s", $numbers["fetchedAt"]) : date("d.m.Y H:i:s");
$showArchive = $isAdmin && isset($_GET["archive"]) && $_GET["archive"] === "1";

if ($isAdmin && isset($_GET["download"]) && $_GET["download"] === "excel") {
    downloadExcel(getAdminRows($allShows, $totalSeats, $cacheSeconds, $staleCacheSeconds), $today);
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>FLBB Zuschauer Zahlen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php if (!$isAdmin): ?>
        <meta http-equiv="refresh" content="60">
    <?php endif; ?>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #f4f7fb;
            color: #111827;
            font-family: Arial, sans-serif;
            padding: 24px;
        }

        .page {
            max-width: 1500px;
            margin: 0 auto;
        }

        .selector-box,
        .header,
        .card,
        .admin-box {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.08);
        }

        .selector-box,
        .admin-box {
            border-radius: 22px;
            padding: 22px;
            margin-bottom: 20px;
        }

        .admin-corner {
            position: fixed;
            top: 12px;
            right: 12px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 6px;
        }

        .admin-mini-form {
            display: flex;
            gap: 6px;
            background: rgba(255, 255, 255, 0.94);
            border: 1px solid #e5e7eb;
            border-radius: 999px;
            padding: 6px;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.12);
            backdrop-filter: blur(8px);
        }

        .admin-mini-form input {
            width: 92px;
            border: none;
            outline: none;
            background: transparent;
            font-size: 12px;
            padding: 6px 4px;
        }

        .admin-mini-form button {
            border: none;
            border-radius: 999px;
            background: #111827;
            color: white;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 10px;
            cursor: pointer;
        }

        .admin-status {
            background: #ecfdf5;
            color: #166534;
            border: 1px solid #bbf7d0;
            border-radius: 999px;
            padding: 7px 11px;
            font-size: 12px;
            font-weight: 800;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.10);
        }

        .admin-small-button {
            text-decoration: none;
            border-radius: 999px;
            background: #111827;
            color: white;
            font-size: 12px;
            font-weight: 700;
            padding: 7px 11px;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.10);
        }

        .logout-small {
            background: #dc2626;
        }

        .login-error-mini {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            border-radius: 999px;
            padding: 6px 10px;
            font-size: 12px;
            font-weight: 700;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.10);
        }

        .admin-note {
            background: #ecfdf5;
            border: 1px solid #bbf7d0;
            color: #166534;
            padding: 12px;
            border-radius: 14px;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .selector-title {
            font-size: 21px;
            font-weight: 800;
            margin-bottom: 14px;
        }

        .show-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 14px;
            margin-bottom: 18px;
        }

        .show-button {
            display: grid;
            grid-template-columns: 74px 1fr;
            gap: 14px;
            align-items: center;
            text-decoration: none;
            color: #111827;
            background: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 18px;
            padding: 12px;
            min-height: 102px;
            transition: 0.15s;
        }

        .show-button:hover {
            border-color: #16a34a;
            transform: translateY(-1px);
        }

        .show-button.active {
            border-color: #16a34a;
            background: #ecfdf5;
        }

        .show-thumb {
            width: 74px;
            height: 74px;
            object-fit: cover;
            border-radius: 14px;
            background: #e5e7eb;
        }

        .show-name {
            font-size: 16px;
            font-weight: 800;
            margin-bottom: 5px;
            line-height: 1.15;
        }

        .show-subtitle {
            font-size: 13px;
            color: #6b7280;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 180px;
            gap: 12px;
        }

        select {
            width: 100%;
            font-size: 16px;
            padding: 13px 14px;
            border-radius: 14px;
            border: 1px solid #d1d5db;
            background: #ffffff;
            color: #111827;
        }

        .submit-button {
            border: none;
            border-radius: 14px;
            background: #209900;
            color: white;
            font-size: 16px;
            font-weight: 800;
            cursor: pointer;
        }

        .submit-button:hover {
            background: #177500;
        }

        .header {
            border-radius: 22px;
            padding: 22px;
            display: grid;
            grid-template-columns: 1fr 500px;
            gap: 26px;
            align-items: center;
            margin-bottom: 20px;
        }

        .title {
            font-size: 38px;
            font-weight: 800;
            margin-bottom: 10px;
            color: #111827;
            line-height: 1.1;
        }

        .info {
            font-size: 18px;
            color: #374151;
            line-height: 1.45;
        }

        .update {
            font-size: 13px;
            color: #6b7280;
            margin-top: 14px;
        }

        .event-image {
            width: 100%;
            height: 220px;
            object-fit: contain;
            object-position: center center;
            background: #f3f4f6;
            border-radius: 18px;
            display: block;
        }

        .header-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 18px;
            align-items: center;
        }

        .ticket-link {
            display: inline-block;
            background: #111827;
            color: white;
            text-decoration: none;
            border-radius: 999px;
            padding: 10px 16px;
            font-size: 14px;
            font-weight: 800;
        }

        .status-pill {
            display: inline-block;
            border-radius: 999px;
            padding: 10px 16px;
            font-size: 14px;
            font-weight: 800;
        }

        .status-soldout {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .status-hot {
            background: #ffedd5;
            color: #9a3412;
            border: 1px solid #fed7aa;
        }

        .status-good {
            background: #dbeafe;
            color: #1e40af;
            border: 1px solid #bfdbfe;
        }

        .status-medium {
            background: #fef9c3;
            color: #854d0e;
            border: 1px solid #fde68a;
        }

        .status-free {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .status-error {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 18px;
        }

        .card {
            border-radius: 20px;
            padding: 20px;
            min-height: 138px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .label {
            font-size: 14px;
            color: #4b5563;
            line-height: 1.25;
        }

        .number {
            font-size: 50px;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -1px;
        }

        .green {
            color: #16a34a;
        }

        .red {
            color: #dc2626;
        }

        .blue {
            color: #2563eb;
        }

        .dark {
            color: #111827;
        }

        .error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            border-radius: 16px;
            padding: 16px;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .friendly-error {
            background: #fff7ed;
            border: 1px solid #fed7aa;
            color: #9a3412;
            border-radius: 16px;
            padding: 16px;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .source {
            margin-top: 14px;
            font-size: 12px;
            color: #9ca3af;
            word-break: break-all;
        }

        .admin-table-wrap {
            overflow-x: auto;
            margin-top: 12px;
        }

        .admin-table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
            font-size: 14px;
        }

        .admin-table th,
        .admin-table td {
            border-bottom: 1px solid #e5e7eb;
            padding: 10px;
            text-align: left;
        }

        .admin-table th {
            background: #f9fafb;
            color: #374151;
        }

        .admin-management {
            display: grid;
            grid-template-columns: minmax(280px, 420px) 1fr;
            gap: 18px;
            align-items: start;
        }

        .admin-form {
            display: grid;
            gap: 10px;
        }

        .admin-form label {
            display: grid;
            gap: 5px;
            font-size: 12px;
            font-weight: 800;
            color: #4b5563;
        }

        .admin-form input {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 14px;
            color: #111827;
            background: #ffffff;
        }

        .admin-show-list {
            display: grid;
            gap: 12px;
        }

        .admin-show-edit {
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 14px;
            background: #f9fafb;
        }

        .admin-show-edit-header {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 12px;
            color: #4b5563;
            font-size: 12px;
            font-weight: 800;
        }

        .admin-actions-row {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }

        .admin-danger-button {
            border: none;
            border-radius: 999px;
            background: #dc2626;
            color: #ffffff;
            font-size: 13px;
            font-weight: 800;
            padding: 10px 14px;
            cursor: pointer;
        }

        .admin-success-message {
            background: #ecfdf5;
            border: 1px solid #bbf7d0;
            color: #166534;
            border-radius: 14px;
            padding: 12px;
            font-weight: 800;
            margin-bottom: 14px;
        }

        .past {
            color: #6b7280;
            background: #f9fafb;
        }

        .future {
            color: #111827;
        }

        @media (max-width: 1050px) {
            body {
                padding: 14px;
            }

            .header {
                display: block;
                text-align: center;
            }

            .event-image {
                height: 180px;
                margin-top: 14px;
            }

            .title {
                font-size: 28px;
            }

            .info {
                font-size: 15px;
            }

            .show-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .submit-button {
                padding: 14px;
            }

            .grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .admin-management {
                grid-template-columns: 1fr;
            }

            .card {
                min-height: 112px;
                padding: 16px 14px;
            }

            .number {
                font-size: 40px;
            }

            .header-actions {
                justify-content: center;
            }
        }

        @media (max-width: 520px) {
            .show-grid {
                grid-template-columns: 1fr;
            }

            .number {
                font-size: 36px;
            }

            .title {
                font-size: 22px;
            }

            .admin-corner {
                top: 8px;
                right: 8px;
            }

            .admin-mini-form input {
                width: 72px;
            }

            .admin-mini-form button,
            .admin-small-button,
            .admin-status {
                font-size: 11px;
            }
        }
    </style>
</head>
<body>

<div class="admin-corner">
    <?php if ($isAdmin): ?>
        <span class="admin-status">Admin aktiv</span>
        <a class="admin-small-button logout-small" href="?logout=1">Abmelden</a>
    <?php else: ?>
        <form method="post" class="admin-mini-form">
            <input type="password" name="admin_password" placeholder="Admin">
            <button type="submit">Login</button>
        </form>

        <?php if (!empty($loginError)): ?>
            <div class="login-error-mini"><?= safe($loginError) ?></div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<div class="page">

    <?php if ($isAdmin): ?>
        <div class="admin-note">
            Admin-Modus aktiv: Vergangene Vorstellungen und Archivdaten werden angezeigt. Auto-Refresh ist im Admin-Modus deaktiviert.
        </div>

        <?php if (!empty($adminMessage)): ?>
            <div class="admin-success-message"><?= safe($adminMessage) ?></div>
        <?php endif; ?>

        <?php if (!empty($adminError)): ?>
            <div class="error"><?= safe($adminError) ?></div>
        <?php endif; ?>

        <div class="admin-box">
            <div class="selector-title">Veranstaltungen verwalten</div>
            <div class="admin-management">
                <form method="post" class="admin-form">
                    <input type="hidden" name="admin_action" value="import_show">

                    <label>
                        Neuer Pretix-Link
                        <input type="url" name="pretix_link" placeholder="https://tickets.freilichtspiele-badbentheim.de/.../" required>
                    </label>

                    <label>
                        Titel überschreiben
                        <input type="text" name="title" placeholder="optional, sonst aus Pretix">
                    </label>

                    <label>
                        Untertitel
                        <input type="text" name="subtitle" placeholder="z. B. Familienstück 2027">
                    </label>

                    <label>
                        Bild überschreiben
                        <input type="url" name="image" placeholder="optional, sonst aus Pretix">
                    </label>

                    <button class="submit-button" type="submit" style="padding: 12px 14px;">Aus Pretix importieren</button>
                </form>

                <div class="admin-show-list">
                    <?php foreach ($allShows as $editShowKey => $editShow): ?>
                        <div class="admin-show-edit">
                            <div class="admin-show-edit-header">
                                <span><?= safe($editShow["title"]) ?></span>
                                <span><?= safe(count($editShow["events"])) ?> Vorstellung<?= count($editShow["events"]) === 1 ? "" : "en" ?></span>
                            </div>

                            <form method="post" class="admin-form">
                                <input type="hidden" name="admin_action" value="update_show">
                                <input type="hidden" name="show_key" value="<?= safe($editShowKey) ?>">

                                <label>
                                    Titel
                                    <input type="text" name="title" value="<?= safe($editShow["title"]) ?>" required>
                                </label>

                                <label>
                                    Untertitel
                                    <input type="text" name="subtitle" value="<?= safe($editShow["subtitle"]) ?>">
                                </label>

                                <label>
                                    Bild-Link
                                    <input type="url" name="image" value="<?= safe($editShow["image"]) ?>" required>
                                </label>

                                <div class="admin-actions-row">
                                    <button class="submit-button" type="submit" style="padding: 10px 14px;">Speichern</button>
                                </div>
                            </form>

                            <form method="post" onsubmit="return confirm('Diese Veranstaltung wirklich löschen?');" style="margin-top: 8px;">
                                <input type="hidden" name="admin_action" value="delete_show">
                                <input type="hidden" name="show_key" value="<?= safe($editShowKey) ?>">
                                <button class="admin-danger-button" type="submit">Löschen</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="selector-box">
        <div class="selector-title">Stück auswählen</div>

        <div class="show-grid">
            <?php foreach ($shows as $showKey => $show): ?>
                <?php $firstEventKey = array_key_first($show["events"]); ?>
                <a
                    class="show-button <?= $showKey === $selectedShowKey ? 'active' : '' ?>"
                    href="?show=<?= safe($showKey) ?>&event=<?= safe($firstEventKey) ?>"
                >
                    <img class="show-thumb" src="<?= safe($show["image"]) ?>" alt="<?= safe($show["title"]) ?>">
                    <div>
                        <div class="show-name"><?= safe($show["title"]) ?></div>
                        <div class="show-subtitle"><?= safe(count($show["events"])) ?> Termin<?= count($show["events"]) === 1 ? "" : "e" ?></div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <form method="get">
            <input type="hidden" name="show" value="<?= safe($selectedShowKey) ?>">

            <div class="selector-title">Vorstellung auswählen</div>

            <div class="form-row">
                <select name="event" onchange="this.form.submit()">
                    <?php foreach ($selectedShow["events"] as $eventKey => $event): ?>
                        <option value="<?= safe($eventKey) ?>" <?= $eventKey === $selectedEventKey ? "selected" : "" ?>>
                            <?= safe($event["label"]) ?>
                            <?= $event["date_iso"] < $today ? " · Archiv" : "" ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button class="submit-button" type="submit">Anzeigen</button>
            </div>
        </form>
    </div>

    <div class="header">
        <div>
            <div class="title"><?= safe($selectedShow["title"]) ?></div>
            <div class="info">
                <?= safe($selectedEvent["date"]) ?> · <?= safe($selectedEvent["time"]) ?><br>
                Freilichtbühne Bad Bentheim
            </div>

            <div class="header-actions">
                <span class="status-pill <?= safe($status["class"]) ?>">
                    <?= safe($status["text"]) ?>
                </span>

                <a class="ticket-link" href="<?= safe($selectedEvent["referer"]) ?>" target="_blank" rel="noopener">
                    Zur Ticketseite
                </a>
            </div>

            <div class="update">
                Datenstand: <?= safe($lastUpdate) ?>
                <?php if ($numbers["cached"]): ?>
                    · aus Zwischenspeicher
                <?php endif; ?>
                <?php if (!$isAdmin): ?>
                    · Aktualisierung alle 60 Sekunden
                <?php endif; ?>
            </div>
        </div>

        <img
            class="event-image"
            src="<?= safe($selectedShow["image"]) ?>"
            alt="<?= safe($selectedShow["title"]) ?>"
        >
    </div>

    <?php if (!$numbers["ok"]): ?>
        <?php if ($isAdmin): ?>
            <div class="error">
                Fehler: <?= safe($numbers["error"]) ?>
            </div>
        <?php else: ?>
            <div class="friendly-error">
                Die Sitzplatzdaten konnten gerade nicht geladen werden. Bitte später erneut versuchen.
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($numbers["ok"] && $numbers["stale"]): ?>
        <div class="<?= $isAdmin ? "error" : "friendly-error" ?>">
            Pretix ist gerade nicht erreichbar. Angezeigt wird der zwischengespeicherte Stand von <?= safe($lastUpdate) ?>.
            <?php if ($isAdmin && !empty($numbers["warning"])): ?>
                Ursache: <?= safe($numbers["warning"]) ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="grid">
        <div class="card">
            <div class="label">Freie Sitzplätze</div>
            <div class="number green"><?= safe($numbers["freeTotal"]) ?></div>
        </div>

        <div class="card">
            <div class="label">Belegt / nicht verfügbar</div>
            <div class="number red"><?= safe($numbers["blockedSeats"]) ?></div>
        </div>

        <div class="card">
            <div class="label">Auslastung</div>
            <div class="number blue"><?= safe($numbers["usagePercent"]) ?>%</div>
        </div>

        <div class="card">
            <div class="label">Gesamtplätze</div>
            <div class="number dark"><?= safe($totalSeats) ?></div>
        </div>

        <div class="card">
            <div class="label">Links frei</div>
            <div class="number green"><?= safe($numbers["freeLeft"]) ?></div>
        </div>

        <div class="card">
            <div class="label">Rechts frei</div>
            <div class="number green"><?= safe($numbers["freeRight"]) ?></div>
        </div>

        <?php if ($isAdmin): ?>
            <div class="card">
                <div class="label">Trend seit letztem Abruf</div>
                <div class="number blue" style="font-size: 22px; line-height: 1.25;"><?= safe($numbers["trendText"]) ?></div>
            </div>

            <div class="card">
                <div class="label">Prognose</div>
                <div class="number dark" style="font-size: 22px; line-height: 1.25;"><?= safe($numbers["forecastText"]) ?></div>
            </div>
        <?php endif; ?>
    </div>

    <div class="source">
        Datenquelle: <?= safe($selectedEvent["url"]) ?><br>
        <?php if ($isAdmin): ?>
            Admin-Modus: Auch vergangene Vorstellungen sichtbar. Session läuft nach 30 Minuten Inaktivität ab.
        <?php else: ?>
            Vergangene Vorstellungen werden ab dem Folgetag automatisch ausgeblendet.
        <?php endif; ?>
    </div>

    <?php if ($isAdmin): ?>
        <div class="admin-box" style="margin-top: 22px;">
            <div class="selector-title">Admin-Archiv aller Vorstellungen</div>
            <div class="source">
                Die Tabelle nutzt den Zwischenspeicher und wird erst auf Klick geladen.
            </div>

            <div class="header-actions" style="margin-bottom: 16px;">
                <a class="ticket-link" href="?download=excel">
                    Excel herunterladen
                </a>
            </div>

            <?php if (!$showArchive): ?>
                <a class="ticket-link" href="?show=<?= safe($selectedShowKey) ?>&event=<?= safe($selectedEventKey) ?>&archive=1">
                    Archiv laden
                </a>
            <?php else: ?>
            <?php $adminRows = getAdminRows($allShows, $totalSeats, $cacheSeconds, $staleCacheSeconds); ?>
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Stück</th>
                            <th>Vorstellung</th>
                            <th>Frei</th>
                            <th>Belegt</th>
                            <th>Auslastung</th>
                            <th>Links frei</th>
                            <th>Rechts frei</th>
                            <th>Trend</th>
                            <th>Prognose</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($adminRows as $adminRow): ?>
                            <?php
                                $adminShow = $adminRow["show"];
                                $adminEvent = $adminRow["event"];
                                $adminNumbers = $adminRow["numbers"];
                                $isPast = $adminEvent["date_iso"] < $today;
                            ?>
                            <tr class="<?= $isPast ? "past" : "future" ?>">
                                <td><?= $isPast ? "Archiv" : "Aktuell/Zukunft" ?></td>
                                <td><?= safe($adminShow["title"]) ?></td>
                                <td><?= safe($adminEvent["label"]) ?></td>
                                <td><?= safe($adminNumbers["freeTotal"]) ?></td>
                                <td><?= safe($adminNumbers["blockedSeats"]) ?></td>
                                <td><?= safe($adminNumbers["usagePercent"]) ?>%</td>
                                <td><?= safe($adminNumbers["freeLeft"]) ?></td>
                                <td><?= safe($adminNumbers["freeRight"]) ?></td>
                                <td><?= safe($adminNumbers["trendText"]) ?></td>
                                <td><?= safe($adminNumbers["forecastText"]) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
