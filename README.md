# custom_nav_walker
wordpress menu nav walker

wordpress的walker有很多种，自定义的walker就是在wordpress自带的walker基础上的延伸。

wp_nav_menu本身自带二级菜单的walker, nav_walker.php是对wp自带的改写和延伸。这里只是一个简单的初级版本的写法

Nav walker是针对wordpress的二级菜单，也只对二级菜单有用。

Menu Walker class主要有四个函数组成：每个函数传递的参数都必须与自带的walker传递的参数一样，不然参数都无效的

1、start_lvl（）函数主要是针对ul部分的html输出。

2、start_el（）函数主要针对li\a\span的开口标签的html输出

3、end_lvl() 函数主要针对ul闭口标签的输出。

4、end_el() 函数主要针对li\a\span闭口标签的html的输出。

end_lvl和end_el()函数如果不在walker定义，就会生成默认的也就是直接关闭的效果。

总得来说walker class就是一项项遍历过来，添加每一项的html输出效果以及class然后最后关闭标签。

$depth变量是你在后台设置多少级导航时候 生成的 ，
比方说你设置了 二级菜单，$depth就是0, 三级菜单的时候$depth 就是1 .  $depth检测所有缩进

$depth 变量会识别出有多少level； 可以自行百度str_repeat()php函数。会生成带空格的结构。\t是tab在正则里。

$depth 检测所有的缩进也就是代码的下一层。  
detect when this new level of submenu starts,when submenu ul is generated . 
如果菜单大过二级， 在子级的子级ul添加 sub-menu 样式，如果只是二级菜单就为空。

\n是 escape里的换行，所有斜杠都代表escape，来避免多个双引号php不知道在哪里结束。 这里是用 在子级上

wordpress主题开发QQ群：706173813

