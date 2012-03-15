#!/bin/bash
# powered by www.freebsdsystem.org
# author:coralzd
# set crontab 
# 00 00 * * * /usr/local/sbin/cutlog.sh 2>&1 >/dev/null &

# The Nginx logs path
logs_path="/data0/logs"
logs_dir=${logs_path}/$(date -d "yesterday" +"%Y")/$(date -d "yesterday" +"%m")
logs_file=$(date -d "yesterday" +"%Y%m%d")
mkdir -p /data0/backuplogs/$(date -d "yesterday" +"%Y")/$(date -d "yesterday" +"%m")
tar -czf ${logs_path}/${logs_file}.tar.gz ${logs_path}/*.log
rm -rf ${logs_path}/*.log
mv ${logs_path}/${logs_file}.tar.gz /data0/backuplogs/$(date -d "yesterday" +"%Y")/$(date -d "yesterday" +"%m")

/usr/local/nginx/sbin/nginx -s reload

for oldfiles in `find /data0/backuplogs/$(date -d "30 days ago" +"%Y")/$(date -d "30 days ago" +"%m")/  -type f -mtime +30`
do
     rm -f $oldfiles
done
