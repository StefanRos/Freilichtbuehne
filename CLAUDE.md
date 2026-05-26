# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this project is

A single-file PHP dashboard (`FLBB_Zuschauer_Zahlen.php`) that displays live seat availability for the **Freilichtbühne Bad Bentheim** (1 221 total seats). It pulls JSON data from the Pretix ticketing API and shows free seats, occupancy rate, and left/right block breakdown per performance.

## How to run locally

Requires a PHP server with cURL enabled:

```bash
php -S localhost:8080
# then open http://localhost:8080/FLBB_Zuschauer_Zahlen.php
```

No dependencies, no composer, no build step.

## Architecture

Everything lives in one file with three logical sections:

1. **PHP data layer** (lines 1–271): session/auth handling, show/event definitions, `loadJson()` fetches the Pretix `event.json` via cURL, `calculateNumbers()` counts `available_seats` and splits them by seat prefix (`Links-` / `Rechts-`), `getStatusText()` maps thresholds to status labels.

2. **HTML/CSS view** (lines 273–988): inline CSS, no JavaScript. Non-admin view auto-refreshes every 60 s via `<meta http-equiv="refresh">`. Admin view disables auto-refresh and adds an archive table that re-fetches every event live.

3. **Admin mode**: bcrypt-protected via `$_POST["admin_password"]` against `$adminPasswordHash`. Session expires after 30 minutes of inactivity. Admin sees past events and raw error messages; public users see a friendly error instead.

## Key data structures

- `$shows` — associative array keyed by show slug (`kater`, `fish`, `musical`, `maffay`). Each entry has `title`, `subtitle`, `image`, and an `events` sub-array keyed by Pretix event ID.
- `makeEvent()` — helper that builds a uniform event array with `id`, `label`, `date`, `time`, `date_iso`, `url` (Pretix JSON endpoint), `referer` (ticket page URL passed as HTTP Referer to cURL).
- Past events are stripped from `$shows` for non-admins before any rendering; `$allShows` retains the full set for the admin archive table.

## Pretix API

Data comes from URLs of the form:
```
https://tickets.freilichtspiele-badbentheim.de/<slug>/seating/<eventid>/event.json
```
The response must contain `available_seats` (array of seat IDs). Seat IDs are prefixed `Links-` or `Rechts-` to identify the two seating blocks.

## Status thresholds

| Condition | Label |
|---|---|
| `freeTotal == 0` | Ausverkauft |
| `freeTotal < 50` | Fast ausverkauft |
| `usagePercent >= 80` | Sehr gut gebucht |
| `usagePercent >= 60` | Gut gebucht |
| otherwise | Viele Plätze frei |

## Adding a new show or event

1. Add a new key to `$shows` with `makeEvent()` calls for each date.
2. For special events with a single flat endpoint (no per-event ID in the URL), use a string key like `"musical26"` and a URL of the form `.../seating/event.json`.
3. `$totalSeats` (currently 1 221) is a global constant — adjust if the venue capacity changes.
