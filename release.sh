#!/usr/bin/env bash

base=${PWD}
release=/tmp/3N1WebSite-release

# Archive
echo -e "Archive"
echo -e "==================================="
echo -e "==================================="

rm -rf ${release}
mkdir ${release}
git archive --format tar --worktree-attributes HEAD | tar -xC ${release}
echo -e "complete"


# Delete files
cd ${release}
rm -rf ${release}/release.sh


# Install all Composer dependencies
echo -e "\n\n"
echo -e "composer install"
echo -e "==================================="
echo -e "==================================="

cd ${release}
composer install --prefer-dist --optimize-autoloader --ignore-platform-reqs


# Install frontend dependencies
echo -e "\n\n"
echo -e "frontend dependencies install"
echo -e "==================================="
echo -e "==================================="

cd ${release}
bower install
# cnpm install
# gulp
rm -rf ${release}/node_modules


# Finally, create the release archive
echo -e "\n\n"
echo -e "release archive"
echo -e "==================================="
echo -e "==================================="

cd ${release}
find . -type d -exec chmod 0750 {} +
find . -type f -exec chmod 0644 {} +
chmod 0775 .
chmod -R 0775 storage
chmod g+w . bootstrap/cache
cp .env.example .env
chmod g+w .env
zip -r 3n1website-master.zip ./


# Complete
echo -e "\n"
echo -e "Complete !!"

