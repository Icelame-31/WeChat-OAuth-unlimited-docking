## 前言

很多H5项目都需要微信授权登录，来获取微信用户的基本信息，实现快速登录，可是微信官方一个微信公众号最多只能授权2个域名。下面将介绍一中可以实现无限对接的方法。

## 实现原理

做一套代理系统，就类似于中间喊话，其他项目需要对接微信授权登录的时候，调用代理系统的接口，传递需要返回的链接地址，代理系统去请求微信的授权登录接口，得到用户的基本信息后，返回给项目，从而实现无限对接。
## 原理图
![在这里插入图片描述](https://img-blog.csdnimg.cn/20200530212522947.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80NTc4NjgxMg==,size_16,color_FFFFFF,t_70#pic_center)
## 源代码
将代理系统的源代码托管到了github，传送门：[https://github.com/Icelame-31/WeChat-OAuth-unlimited-docking](https://github.com/Icelame-31/WeChat-OAuth-unlimited-docking)，有需要的可以下载学习。但是只是基础版。另有功能完善的完整版，包括3种类型的代理系统，及用户系统，可以付费给他人调用。另有技术交流QQ群：1028142470，有兴趣的朋友可以入群交流。
## 使用方法
**一、环境准备**
一台独立的服务器，已解析的域名，服务器配置环境：
操作系统：CentOS7.6 64位
服务器环境：Apache2.4、Mysql5.6、PHP5.6+
**二、安装步骤：**
1、下载源码到项目根目录
2、创建站点，伪静态配置为ThinkPHP修改配置信息。
3、创建数据库，导入sql文件。
4、修改配置信息：Application/Common/Conf/config.php，修改你的数据库信息和微信公众号信息。
**三、使用方法**
**接口请求**
接口地址：http://你的域名/wxlogin（或者：http://你的域名/index.php/Home/Api/wxlogin）
请求方式：GET
请求参数：
|参数名 | 示例 | 说明 |
|--|--|--|
| time| 1580580122| 发起请求的时间戳 |
| return_url | http://www.qq.com/return_url.php | 项目回调地址 |
| sign | ab3aba691a0962a10f9d4ae9a68730de | 数据签名 |
签名算法：` md5(md5($time)."Vxd5zV4o");`
**回调通知**
回调地址：请求接口时传递的return_url参数
请求方式：GET
请求参数：
|参数名 | 示例 | 说明 |
|--|--|--|
| openid| OPENID| 用户的唯一标识 |
| nickname| NICKNAME | 用户昵称 |
| sex| 1| 用户的性别，值为1时是男性，值为2时是女性，值为0时是未知 |
| province| PROVINCE | 用户个人资料填写的省份 |
| city| CITY| 普通用户个人资料填写的城市 |
| country| COUNTRY| 国家，如中国为CN |
| headimgurl| http://www.qq.com/headimgurl.png| 用户头像，最后一个数值代表正方形头像大小（有0、46、64、96、132数值可选，0代表640*640正方形头像），用户没有头像时该项为空。若用户更换头像，原有头像URL将失效。 |
| privilege| PRIVILEGE1| 用户特权信息，json 数组，如微信沃卡用户为（chinaunicom） |
| unionid| o6_bmasdasdsad6_2sgVt7hMZOPfL| 只有在用户将公众号绑定到微信开放平台帐号后，才会出现该字段。 |
## 赞赏码
送人玫瑰，手留余香。喜欢本项目的朋友请多多支持。
![在这里插入图片描述](https://img-blog.csdnimg.cn/20200530213452708.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80NTc4NjgxMg==,size_16,color_FFFFFF,t_70#pic_center)
