
#### ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC

1. DELAY_KEY_WRITE=1是指在表关闭之前，将对表的update操作zhigenxin数据到磁盘，而不更新索引到磁盘，把对索引的更改记录在内存。这样MyISAM
表可以使索引更新更快。在关闭表的时候一起更新索引到磁盘。这个参数只对MyISAM引擎表有作用
使用：create table的时候，指定DELAY_KEY_WRITE。
当表已经存在的时候：ALTER TABLE table_name DELAY_KEY_WRITE= 1。
适用范围：表有update操作，这个参数的优势会很好的体现出来。因为这个参数能延迟更新索引到表关闭。当我们需要经常跟新一个大表的时候，可以
考虑使用这个参数.
说明：表关闭会在什么时候发生？
你可以理解成当flash table的时候，表将关闭。那么有2种情况将会发生flush table：
当cache 满了一个新的thread试图打开一个表的时候，那个表没有在cache；
当cache里的表数比table_cache多时thread不在使用表；
这个2种情况将会flush table。
当然，你也可以直接设置启动参数flush_time ，设置每多少时间flush table一次。
需要注意的是：当DELAY_KEY_WRITE使用的时候，如果出现重启或者掉电等情况，会导致在cache的索引update没来得及更新，所以必须在启动参数
加上 --myisam-recover，这样在你启动mysql的时候会检查你的表并同步表和索引.或者在重启服务器之前运行myisamchk。(然而，即使在这种情况
下，应通过使用DELAY_KEY_WRITE保证不丢失数据，因为关键字信息总是可以从数据行产生）。如果你使用该特性，你应用--myisam-recover选项启
动服务器，为所有MyISAM表添加自动检查。

2.CHECKSUM=1主要对表数据传输前和传输后进行比较


####
review  ----> 影评