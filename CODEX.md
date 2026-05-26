# CODEX.md

Arbeitsnotizen fuer Codex in diesem Repository.

## Projekt

Single-file PHP-Dashboard fuer die Freilichtbuehne Bad Bentheim. Die App zeigt Live-Sitzplatzdaten aus Pretix pro Vorstellung an.

## Laufzeit

- Hauptdatei: `FLBB_Zuschauer_Zahlen.php`
- Lokal laut Doku: `php -S localhost:8080`
- Docker: `docker compose up -d --build`
- nginx veroeffentlicht Port `3002`
- Erforderliche Env-Datei: `.env.app`
- Erforderliche Env-Variable: `ADMIN_PASSWORD_HASH`

Aktuell sind lokal weder `php` noch `docker` im PATH gefunden worden. Git wurde per winget installiert und liegt unter `C:\Program Files\Git\cmd\git.exe`.

## Arbeitsregel fuer Aenderungen

Bei Aenderungen an diesem Projekt immer den kompletten Ablauf einhalten:

1. Lokal aendern und pruefen, soweit die verfuegbaren Tools es erlauben.
2. Aenderungen committen.
3. Auf dem Server `192.168.178.184` per SSH pullen.
4. Auf dem Server deployen.

Der Server ist die laufende Umgebung fuer dieses Projekt.

SSH-Ziel:

- Alias: `freilichtbuehne-server`
- User/Host: `stefan@192.168.178.184`
- Lokaler Key: `C:\Users\Lasse\.ssh\freilichtbuehne_192_168_178_184`

## Architektur

- Keine Composer-Abhaengigkeiten, kein Build-Step.
- Daten, HTML und CSS liegen in einer Datei.
- `$shows` definiert Stuecke, Bilder und Pretix-Event-URLs.
- `makeEvent()` normalisiert Event-Daten.
- `loadJson()` ruft Pretix `event.json` per cURL mit Referer ab.
- `calculateNumbers()` berechnet freie, belegte und links/rechts freie Plaetze.
- `getStatusText()` bildet die Auslastung auf Statuslabels ab.
- Nicht-Admin-Ansicht blendet vergangene Termine aus und refreshed alle 60 Sekunden.
- Admin-Ansicht zeigt auch Archivdaten und deaktiviert Auto-Refresh.

## Wichtige Annahmen

- Gesamtkapazitaet: `1221` Sitzplaetze.
- Pretix liefert `available_seats`.
- Sitz-IDs beginnen fuer die Blockauswertung mit `Links-` oder `Rechts-`.
- Admin-Login nutzt `password_verify()` gegen `ADMIN_PASSWORD_HASH`.
- Admin-Session laeuft nach 30 Minuten Inaktivitaet ab.

## Vorsichtspunkte

- Ohne `.env.app` stirbt die App direkt mit Konfigurationsfehler.
- Admin-Archiv ruft fuer jede Vorstellung live Pretix ab; das kann langsam sein oder viele Requests erzeugen.
- Fehlerdetails werden nur im Admin-Modus angezeigt.
- PowerShell kann UTF-8-Dateien je nach Version mit Umlaut-Mojibake anzeigen; Browser/PHP lesen wegen `<meta charset="UTF-8">` vermutlich korrekt.
- Bei neuen Vorstellungen immer `date_iso`, Pretix-URL und Referer gemeinsam pflegen.
