## 第1部分：声明每个小组成员所做的工作

* 赵驰昊：负责总管整体项目的把控，实现了login/register模块
* 李朋埕：负责环境配置，实现了dashboard页面
* 李子豪：负责实现了new reservation页面，以及页面的美化
* 侯金成：实现了check-in页面，以及检查重要点

## 第2部分：在新机器上安装系统的说明

*  认为新的机器上已经安装PHP，Composer，MySQL和Git

*https://github.com/haoyeling/login-project此网址为git代码，共计git四次

*  下载项目的zip文件并解压

* 在.env 文件中进行数据库配置，将数据库名称和密码根据机器自建数据库进行调配
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=carnival
   DB_USERNAME=root
   DB_PASSWORD=123456 |


*  运行命令'php artisan migrate'将项目中的数据库表迁移到我们的的数据库中

*  完成之前的操作，win+r打开命令提示符，切到project文件内，可以通过执行命令'php artisan serve'运行程序，之后在浏览器中输入:http://127.0.0.1:8000 即可访问页面