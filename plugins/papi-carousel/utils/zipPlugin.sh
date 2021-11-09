#!/bin/bash


# Building archive name from plugin name and version

prefix=" \* Plugin Name:       "
PLUGIN_NAME=$(less papi-carousel.php | sed -n 3p | sed -e "s/^$prefix//" | tr ' ' '_')

prefix=" \* Version:           "
PLUGIN_VERSION=$(less papi-carousel.php | sed -n 7p | sed -e "s/^$prefix//")

ARCHIVE_NAME=$(echo "$PLUGIN_NAME"_v"$PLUGIN_VERSION"_plugin.zip)


echo "Building plugin..."
npm run build


# Creating archive

zip -r $ARCHIVE_NAME papi-carousel.php block.json build/

echo "Done!"