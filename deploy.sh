#!/bin/bash
set -e
cd /opt/apps/freilichtbuehne
git pull
docker compose build
docker compose up -d
docker compose ps
curl -fsS -I http://localhost:3002/FLBB_Zuschauer_Zahlen.php >/dev/null
echo "Deployed."
