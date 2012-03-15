
Sphinx Console Command

/usr/local/coreseek/bin/indexer -c /home/wwwroot/woshimaijia2/woshimaijia/src/service/coreseek/csft_mysql.conf --all
/usr/local/coreseek/bin/searchd -c /home/wwwroot/woshimaijia2/woshimaijia/src/service/coreseek/csft_mysql.conf --console

DEV
/usr/local/coreseek/bin/indexer -c /home/xinqiyang/wwwroot/woshimaijia2/woshimaijia/src/service/coreseek/group_mysql.conf --all
/usr/local/coreseek/bin/searchd -c /home/xinqiyang/wwwroot/woshimaijia2/woshimaijia/src/service/coreseek/group_mysql.conf --console

/usr/local/coreseek/bin/indexer -c /home/xinqiyang/wwwroot/woshimaijia2/woshimaijia/env/dev/coreseek/post_mysql.conf --all
/usr/local/coreseek/bin/searchd -c /home/xinqiyang/wwwroot/woshimaijia2/woshimaijia/env/dev/service/coreseek/post_mysql.conf --console


CoreSeek 4.1 compile

##前提：需提前安装操作系统基础开发库及mysql依赖库以支持mysql数据源和xml数据源
##安装mmseg
$ cd mmseg-3.2.14
$ ./bootstrap    #输出的warning信息可以忽略，如果出现error则需要解决
$ ./configure --prefix=/usr/local/mmseg3
$ make && make install
$ cd ..

##安装coreseek
$ cd csft-3.2.14 或者 cd csft-4.0.1 或者 cd csft-4.1
$ sh buildconf.sh    #输出的warning信息可以忽略，如果出现error则需要解决

./configure --prefix=/usr/local/coreseek  --without-unixodbc --with-mmseg --with-mmseg-includes=/usr/local/mmseg3/include/mmseg/ --with-mmseg-libs=/usr/local/mmseg3/lib/ --with-mysql --without-iconv
make CFLAGS=-liconv
make install

