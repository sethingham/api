#!/bin/sh
echo "Waiting for php-fpm to be ready..."
timeout=30
elapsed=0
while ! nc -z 127.0.0.1 9000; do
  if [ "$elapsed" -ge "$timeout" ]; then
    echo "php-fpm did not become ready in ${timeout}s, exiting."
    exit 1
  fi
  sleep 0.1
  elapsed=$((elapsed + 1))
done
echo "php-fpm is ready, starting nginx..."
exec nginx -g 'daemon off;'
