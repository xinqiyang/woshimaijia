#!/bin/bash
HOST=”v0.ftp.upyun.com”
USER=”username”
PASS=”password”
LCD=”localpath”
RCD=”remotepath”
lftp -c “open ftp://$HOST;
user $USER $PASS;
lcd $LCD;
cd $RCD;
mirror –reverse \
–delete \
–dereference \
–verbose \
–exclude-glob=*.php”
