#!/bin/bash
set -e
cd /opt/apps/freilichtbuehne
git pull
mkdir -p data/backups
chmod -R 777 data
docker compose build
docker compose up -d
docker compose ps
curl -fsS -I http://localhost:3002/FLBB_Zuschauer_Zahlen.php >/dev/null
echo "Deployed."
