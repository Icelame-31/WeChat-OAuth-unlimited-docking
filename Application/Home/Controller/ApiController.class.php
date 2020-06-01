<?php
namespace Home\Controller;
use Think\Controller;
class ApiController extends Controller {
    
    //初始化函数
	protected function _initialize(){
    	header('Access-Control-Allow-Methods:OPTIONS, GET, POST');
		header('Access-Control-Allow-Headers: *');
		header("Access-Control-Allow-Credentials:true");
		header('Access-Control-Allow-Origin: *');
	}
	
	//登录请求接口
    public function wxlogin(){
        $return_url = trim(I('return_url',''));
        //验证sign
        $sign = trim(I('sign',''));
        $salt = 'Vxd5zV4o';
        $time = trim(I('time',''));
        $_sign = md5(md5($time).$salt);
        if(empty($return_url)){
            die('return_url不可为空');
        }
        if($sign !== $_sign){
            die('sign拼接不正确');
        }
        //清理数据库中过期的请求信息
        $this -> clearTimeoutInfo();
        //检测sign是否存在
        $infoList = M('info') -> where(array('sign'=>$sign)) -> find();
        if(!empty($infoList)){
            die('sign已经存在，不能重复发起请');
        }
        //添加数据库
        $addData['sign'] = $sign;
        $addData['return_url'] = $return_url;
        $addData['addtime'] = $time;
        $res = M('info') -> add($addData);
        if($res===false){
            die('数据保存失败');
        }
        //发送微信登录请求
        //获取code
        $appid = C('APP_ID');
        $redirect_uri = urlencode("http://".$_SERVER['SERVER_NAME']."/index.php/Home/Api/getWxCode.html");
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinfo&state=".$sign."#wechat_redirect"; 
        echo "<script>window.location.href='".$url."';</script>";
        die;
    }
    
    //获取用户信息
    public function getWxCode(){
        $appid = C('APP_ID');
        $appsecrt = C('APP_SECRET');
        $code = $_GET['code'];
        $sign = $_GET['state'];
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecrt&code=$code&grant_type=authorization_code";
        $rjson = $this -> http_curl($url);
        $access_token = $rjson['access_token'];
        $openId = $rjson['openid'];
        $userInfoUrl = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openId&lang=zh_CN";
        $result = $this -> http_curl($userInfoUrl);
        if(empty($result['openid'])){
            die('用户授权失败');
        }
        //查询用户的return_url
        $infoList = M('info') -> where(array('sign'=>$sign)) -> find();
        if(empty($infoList)){
            die('用户记录不存在');
        }
        $url = $infoList['return_url'].'?openid='.$result['openid'].'&nickname='.$result['nickname'].'&sex='.$result['sex'].'&province='.$result['province'].'&city='.$result['city'].'&country='.$result['country'].'&headimgurl='.$result['headimgurl'].'&privilege='.$result['privilege'].'&unionid='.$result['unionid'];
        echo "<script>window.location.href='".$url."';</script>";
        die;
    }
    
    //发送http请求
    public function http_curl($url){
        $curl = curl_init();//初始化
        curl_setopt($curl,CURLOPT_URL,$url);//设置抓取的url
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);// https请求 不验证证书和hosts
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($curl,CURLOPT_HEADER,0);// 设置头文件的信息作为数据流输出 设置为1 的时候，会把HTTP信息打印出来 不要http header 加快效率
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);//设置获取的信息以文件流的形式返回，而不是直接输出。 如果设置是0，打印信息就是true
        $data = curl_exec($curl);//执行命令
        $result = json_decode($data,true);
        if ($data == false) {
            echo "Curl Error:" . curl_error($curl);exit();
        }
        curl_close($curl);//关闭URL请求
        return $result;
    }
    
    //清理5分钟前发起请求的数据库信息
    public function clearTimeoutInfo(){
        $time = time() - 300;
        $where['addtime'] = array('LT',$time);
        M('info') -> where($where) -> delete();
    }
    
    
}