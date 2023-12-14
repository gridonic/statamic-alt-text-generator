#!/usr/bin/env bash

# Update environment during development
#
# This script is a workaround for the command npm run dev not working.
# It will execute some commands to update the frontend and clear the cache so that changes made in
# frontend components are registered and shown in the browser.
#
# The following steps are being done by this script:
#   * delete public/vendor/alt-text-generator if still exists
#   * Run command npm run build
#   * Run command composer install
#   * Clear cache and static cache
#
npm install
npm run build

cd ../..
composer update

cd public/vendor
if [ -d "alt-text-generator" ]; then
  rm -rf alt-text-generator
else
  echo "Directory doesn't exist"
fi

cd ../addon/statamic-alt-text-generator
npm run build

cd ../..
composer install

php please cache:clear
php please stache:clear
