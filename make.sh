#!/bin/bash
#
# Install Helper
#
# SPDX-License-Identifier: NONE
#

set -o errexit
set -o errtrace
set -o nounset
set -o pipefail

APP_ROOT=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )

cd "$APP_ROOT"

composer install --no-ansi --no-progress --classmap-authoritative

npm install --no-audit --no-fund

php <<PHP
<?php
define('APP_ROOT', __DIR__);
require_once(APP_ROOT . '/vendor/autoload.php');
\OpenTHC\Make::install_bootstrap();
\OpenTHC\Make::install_fontawesome();
\OpenTHC\Make::install_jquery();
PHP

#
# Tailwind
npx tailwindcss \
	--input sass/base.css \
	--output webroot/css/main.css

OPENTHC_ORIGIN=$(php -r '$x = require_once("etc/config.php"); echo $x["openthc"]["pdb"]["origin"];')
if [ -z "$OPENTHC_ORIGIN" ]
then
	echo "NO ORIGIN"
	# exit 1
else
	curl "$OPENTHC_ORIGIN/home" > webroot/index.html
fi
