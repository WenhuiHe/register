# 医院挂号系统

### 安装

推荐 docker 安装

```
git clone https://github.com/cs1504/register.git
cd register
docker-compose up
```

docker 起来之后可以访问：

项目主页 http://localhost:8088

phpmyadmin http://localhost:8080

mysql 配置在 docker-compose.yml 文件中


### 用到的工具及说明

thinkPHP5 [https://www.kancloud.cn/manual/thinkphp5/118003](https://www.kancloud.cn/manual/thinkphp5/118003)

docker https://www.docker.com/

Twitter bootstrap 3 admin template https://github.com/bopoda/ace


### 数据库设计 


系统管理员 


| 内容 | 字段名 | 类型及大小 | 备注 | 
| --- | --- | --- | --- |
| id | id | bigint(20) | 主键，索引，自增 | 
| 手机号 | phone |  varchar(11) | 唯一，索引 |
| 密码 |  password | varchar(255) | md5加密 |


医院表

| 内容 | 字段名 | 类型及大小 | 备注 | 
| --- | --- | --- | --- |
| id | id | bigint(20) | 主键，索引，自增 | 
| loginname | loginname | varchar(20) | |
| 医院名称 | name | varchar(255) | |
| 密码 |  password | varchar(255) | md5加密 |
| 图片 | pic | image | |


科室表

| 内容 | 字段名 | 类型及大小 | 备注 | 
| --- | --- | --- | --- |
| id | id | bigint(20) | 主键，索引，自增 | 
| 科室名称 | name | varchar(20) | 
| 所属大科室 | 
| 所属医院 | hospital | bigint(20) | 


用户表


| 内容 | 字段名 | 类型及大小 | 备注 | 
| --- | --- | --- | --- |
| id | id | bigint(20) | 主键，索引，自增 | 
| 手机号 | phone |  varchar(11) | 唯一，索引 |
| 密码 |  password | varchar(255) | md5加密 |
| 姓名 | name | varchar(20) | |
身份证


医生表


| 内容 | 字段名 | 类型及大小 | 备注 | 
| --- | --- | --- | --- |
| id | id | bigint(20) | 主键，索引，自增 | 
| 手机号 | phone |  varchar(11) | 唯一，索引 |
| 密码 |  password | varchar(255) | md5加密 |
| 科室编码 | dept | bigint(20) | |
| email | email | varchar(255) | |
| 姓名 | name | varchar(20) | |
| 类型 | type | tinyint(1) | 1主任医师2副主任医师0普通 |
| 可否电话咨询 | ynphone | tinyint(1) | 1可以0不可以 |
| 可否email咨询 | ynemail | tinyint(1) | 1可以0不可以 |
| resume | resume | text | |
| 照片 | photo | image | |


 ID 用户 医生 日期 时间（012） 描述 状态（01） 建议


排班表

id  doc day time regnum 


模块设计 


admin

添加修改医院信息

hospital

添加医师
医师排班

doctor

个人信息

user

按医院挂号hp，按科室挂号dept

挂号，取消挂号

login reg


----



Nginx 配置文件


```conf
server
	{
		listen 80;
		server_name www.csmuseum.xyz ;
		index index.html index.htm index.php default.html default.htm default.php;
		root  /home/wwwroot/www.csmuseum.xyz/think/public;

		location / {
        		try_files $uri $uri/ /index.php?s=$uri&$args;
    		}	

		location ~ .+.php($|/) {
			set $script $uri;
			set $path_info "/";
			if ($uri ~ "^(.+.php)(/.+)") {
				set $script $1;
				set $path_info $2;
			}

			fastcgi_pass  unix:/tmp/php-cgi.sock;
			fastcgi_index index.php?IF_REWRITE=1;
			include fastcgi.conf;
			fastcgi_param PHP_VALUE "open_basedir=/home/wwwroot/default/tp5/public/:/tmp/:/proc/";
			fastcgi_param PATH_INFO $path_info;
			fastcgi_param SCRIPT_FILENAME $root$fastcgi_script_name;
			include fastcgi_params;
		}


		include none.conf;
		#error_page   404   /404.html;

		include enable-php.conf;

		location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$
		{
			expires      30d;
		}

		location ~ .*\.(js|css)?$
		{
			expires      12h;
		}

		location ~ /.well-known {
			allow all;
		}

		location ~ /\.
		{
			deny all;
		}

		access_log off;
	}
```