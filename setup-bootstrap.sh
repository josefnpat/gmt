#!/bin/sh

VERSION="3.2.0"
TARGET_DIR="bootstrap-$VERSION-dist"
TARGET_FILE=$TARGET_DIR.zip

wget https://github.com/twbs/bootstrap/releases/download/v$VERSION/bootstrap-$VERSION-dist.zip
unzip $TARGET_FILE
mv $TARGET_DIR src/bootstrap
