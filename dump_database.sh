#!/bin/bash

pg_dump  \
  --host=localhost \
  --port=5432 \
  --username=web4all \
  --format=plain \
  --file=web4all.sql \
  --create \
  --blobs \
  --no-owner \
  --verbose \
  web4all
