#!/bin/bash


# Building archive name from theme name and version

prefix="Theme Name: "
THEME_NAME=$(less style.css | sed -n 2p | sed -e "s/^$prefix//" | tr ' ' '_')

prefix="Version: "
THEME_VERSION=$(less style.css | sed -n 9p | sed -e "s/^$prefix//")

ARCHIVE_NAME=$(echo "$THEME_NAME"_v"$THEME_VERSION"_theme.zip)


# Creating archive

zip -r $ARCHIVE_NAME * --exclude=README.md --exclude=*utils*