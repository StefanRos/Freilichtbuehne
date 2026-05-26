#!/bin/bash
set -e
cd /opt/apps/freilichtbuehne
git pull
docker compose build
docker compose up -d
echo "Deployed."
