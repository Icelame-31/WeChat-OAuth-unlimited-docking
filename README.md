## 前言

很多H5项目都需要微信授权登录，来获取微信用户的基本信息，实现快速登录，可是微信官方一个微信公众号最多只能授权2个域名。下面将介绍一中可以实现无限对接的方法。

## 实现原理

做一套代理系统，就类似于中间喊话，其他项目需要对接微信授权登录的时候，调用代理系统的接口，传递需要返回的链接地址，代理系统去请求微信的授权登录接口，得到用户的基本信息后，返回给项目，从而实现无限对接。
## 原理图
![在这里插入图片描述](https://img-blog.csdnimg.cn/20200530212522947.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80NTc4NjgxMg==,size_16,color_FFFFFF,t_70#pic_center)
## 源代码
将代理系统的源代码托管到了github，传送门：[https://github.com/Icelame-31/WeChat-OAuth-unlimited-docking](https://github.com/Icelame-31/WeChat-OAuth-unlimited-docking)，有需要的可以下载学习。但是只是基础版。另有功能完善的完整版，包括3种类型的代理系统，及用户系统，可以付费给他人调用。另有技术交流QQ群：1028142470，有兴趣的朋友可以入群交流。
## 赞赏码
送人玫瑰，手留余香。喜欢本项目的朋友请多多支持。
![在这里插入图片描述](https://img-blog.csdnimg.cn/20200530213452708.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3dlaXhpbl80NTc4NjgxMg==,size_16,color_FFFFFF,t_70#pic_center)
