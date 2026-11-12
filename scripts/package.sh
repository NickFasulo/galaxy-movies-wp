#!/bin/sh
# Builds dist/galaxy-movies-embeds.zip — the wp.org upload artifact.
set -e
cd "$(dirname "$0")/.."
rm -rf dist
mkdir -p dist
zip -rq dist/galaxy-movies-embeds.zip galaxy-movies-embeds -x '.*'
unzip -l dist/galaxy-movies-embeds.zip
