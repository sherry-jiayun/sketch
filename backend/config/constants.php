<?php

return [
    'homework_channel' => 3,//作业区是三区
    'components_per_page' => 2, //书籍首页显示多少个component
    'books_per_page' => 2,//一页显示多少书
    'threads_per_page' => 2,//一页显示多少书/讨论帖
    'chapters_per_page' => 2, //一页显示多少章节
    'posts_per_page' => 2,//一页显示多少回帖
    'quotes_on_homepage' => 2,//首页一次申请调度多少个题头
    'books_on_homepage' => 2,//首页显示多少本最新图书
    'threads_on_homepage' => 2,//首页显示多少本最新讨论帖
    'statuses_on_homepage' => 2,//首页显示多少个最新原创状态
    'preview_len' => 15,//在预览处显示多少个字符

    // 'vote_info' => [
    //     'attitude_types' => [
    //         1 => 'upvote',
    //         2 => 'downvote',
    //         3 => 'funny',
    //         4 => 'fold',
    //     ],
    //     'item_types' => [
    //         1 => 'post',
    //         2 => 'thread',
    //     ],
    // ],

    // 'items_per_part' => 2,//当一个分区只看一个内容，显示多少内容
    // 'index_per_page' => 5,//当只搜索目录信息的时候，一页显示多少项目
    // 'index_per_part' => 2,//当index用于整合页面的时候，一个分区显示多少项目
    // 'update_min' => 1000, //章节更新必须达到这个水平才能进入排名榜
    // 'longcomment_length' => 200, //“长评”必须达到该字数
    // 'default_user_group' => 10,
    // 'default_majia' => '匿名咸鱼',
    //
    // 'collection_type_info' => [
    //     1 => '书籍收藏单',
    //     2 => '讨论贴收藏单',
    //     3 => '回帖收藏单',
    //     4 => '收藏单的收藏单',
    //     5 => '自己建立的收藏单',
    //     6 => '所有的收藏单'
    // ],

    // 'vote_info' => [
    //     'item_types' => [
    //         'post' => 1,
    //         'thread' =>2,
    //     ],
    //     'attitude_types' => [
    //         'upvote' => 1,
    //         'downvote' => 2,
    //         'funny' => 3,
    //         'fold' => 4,
    //     ],
    // ],

    // 'tag_info' => [
    //     1 => '结局',
    //     2 => '故事气氛',
    //     3 => '整体时代',
    //     4 => '故事观感',
    //     5 => '强弱关系',
    //     6 => '伦理关系',
    //     7 => 'CP关系',
    //     8 => '视角关系',
    //     9 => '床戏性质',
    //     10 => '人物性格',
    //
    //     11 => '执业范围',
    //     12 => '特殊元素',
    //     13 => '具体情节',
    //     14 => '世界设定',
    //     15 => '物种设置',
    //     16 => '风俗环境',
    //     17 => '性癖',
    //     18 => '同人聚类',
    //     19 => '版权相关',
    // ],
    //
    // 'book_info' =>[
    //     'originality_info' => [
    //         0 => '同人',
    //         1 => '原创',
    //     ],
    //     'channel_info' => [
    //         1 => '原创',
    //         2 => '同人',
    //     ],
    //     'book_length_info' => [
    //         '0' => '无篇幅信息',
    //         '1' => '短篇',
    //         '2' => '中篇',
    //         '3' => '长篇',
    //         '4' => '大纲',
    //     ],
    //     'book_status_info' => [
    //         '0' => '无进度信息',
    //         '1' => '连载',
    //         '2' => '完结',
    //         '3' => '暂停',
    //     ],
    //     'sexual_orientation_info' => [ //0:未知，1:BL，2:GL，3:BG，4:GB，5:混合性向，6:无CP，7:其他性向
    //         '0' => '无性向信息',
    //         '1' => 'BL',
    //         '2' => 'GL',
    //         '3' => 'BG',
    //         '4' => 'GB',
    //         '5' => '混合性向',
    //         '6' => '无CP',
    //         '7' => '其他性向',
    //     ],
    //     'rating_info' => [ //1:非边缘, 2:边缘
    //         '1' => '非边限',
    //         '2' => '边限',
    //     ],
    // ],
    // 'administrations' => [
    //     1 => '锁帖主题',
    //     2 => '解锁主题',
    //     3 => '转为私密主题',
    //     4 => '转为公开主题',
    //     5 => '删帖主题',
    //     6 => '恢复主题',
    //     7 => '删除回帖',
    //     8 => '删除点评',
    //     9 => '转移板块',
    //     10 => '修改马甲',
    //     11 => '折叠帖子',
    //     12 => '解折帖子',
    //     13 => '禁言用户',
    //     14 => '解禁用户',
    //     15 => '改为边缘',
    //     16 => '改为非边缘',
    // ],
    // 'activities' => [
    //     '1' => '回复主题',
    //     '2' => '回复帖子',
    //     '3' => '点评帖子',
    //     '4' => '点评点评',
    //     '5' => '喜欢帖子',
    //     '6' => '有人提问',
    // ],

    'word_filter' => [
        'not_in_public' => "|♂|骚浪|骚浪贱|NP|np|Np|nP|高H|高h|强制爱|处男|处女|恋童癖|恋童|3P|骑乘|脐橙|play|普雷|纯肉|滥交|NTR|性癖|扶她|扶他|自慰|强上|啪啪啪|调♂教|调教|鸡巴|J8|撸|双性|产子|淫荡|荡妇|爱液|按摩棒|拔出来|爆草|暴干|暴奸|暴乳|爆乳|暴淫|被操|被插|被干|逼奸|插暴|插爆|操逼|肏|潮吹|抽插|抽送|后穴|淫液|操烂|吞精|春药|发浪|发骚|粉穴|菊穴|干死你|肛交|肛门|龟头|AV|GV|巨屌|口爆|口暴|口活|口交|狂操|浪叫|凌辱|乱交|乱伦|裸陪|轮暴|轮奸|合奸|迷奸|强暴|全裸|人妻|人兽|肉棒|肉具|骚逼|骚水|乳交|乳沟|射颜|颜射|熟女|调教|小穴|小逼|性交|性奴|性虐|胸推|穴口|阳具|体位|舔脚|文爱|文做|要射了|淫贱|淫媚|淫糜|援交|欲火|QJ|qj|lj|LJ|lt|LT|幼幼|TJ|BDSM|艹哭|草哭|操爆|操射|操翻|草射|yj|jy|双龙|双龙入洞|骚货|淫乱|开苞|双穴|嫩穴|插穴|骚穴|子宫|宫口|产乳|喷奶|射精|精液|射niao|射尿|灌肠|rbq|肉便器|肉bq|肉BQ|肉bQ|肉Bq|Y蒂|阴蒂|H图|发情|潮喷|潮吹|失禁|大奶|R18|r18|纯肉|纯H|奶子|小狼狗|腰好肾好|公狗腰|内射|大奶|虐乳|肛塞|骚话|后入|SP|sp|贞操带|喝奶|欲求不满|玩弄|NC-17|NC17|黑车|肉香|香艳|存车|凭票上车|开车|小车车|车|肉|炖肉|燉肉|纯写肉|脑洞肉|含肉|肉文|肉肉|很荤|痴汉|抖m|抖s|抖M|抖S|性转车|约炮|YP|炮友|啪|pa|性福|PWP|群交|群P|群p|",

        'not_in_title' => "|【|】|X|╳|<|>|〈|〉|\[|\]|\/|\||\\\\|（|）|\(|\)|——|\+|\*|\%|《|》|",
    ],
];
