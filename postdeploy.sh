#!/bin/bash
set -eo pipefail;

# Create storage paths if missing in persistent storage.
mkdir -p storage/app/public
mkdir -p storage/framework/{cache,sessions,testing,views}
mkdir -p storage/logs

# Link already created in predeploy.
# Run for a confirmation message that it was created successfully.
php artisan storage:link
