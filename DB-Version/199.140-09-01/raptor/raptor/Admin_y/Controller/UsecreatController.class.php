<?php
namespace Admin\Controller;
use Common\Controller\BaseadminController;
class UsecreatController extends BaseadminController {
    public  $corporate_name = ''; //公司名称
    public $upload_size = ''; //上传文件大小
    public $upload_num = ''; //上传文件数量
    public $nickname = ''; //昵称
    public  $phone = ''; //手机号
    public  $email = ''; //邮箱
    public  $password = ''; //密码
    public  $password_ok = ''; //确认密码
    public  $register_type = ''; //注册类型
    public  $switch_type = '';//是否启用
    public  $content = '';//备注

    public function usecreat(){
        $this->display();
    }
    //获取数据信息
    public function usecreat_data(){
        $Model = M('user');
        $result = $Model->table('__USER__ AS a')->join('__UPLOAD_DATA__ AS b ON a.id = b.user_id')
            ->field('a.id,a.user_name,a.register_type,a.corporate_name,a.email,a.phone,b.upload_num,b.upload_size,a.content,a.switch_type,a.register_time')
            ->select();
        //数据整理
        foreach($result as $res_key => &$res_value){
            $res_value['remark'] = $res_key+1;
            $res_value['caozuo'] = '
                            <span class="opera del btn" data-toggle = "modal"  data-target="#del_modal" title="删除" id='."'{$res_value['id']}'".' user_name='."'{$res_value['user_name']}'".'></span>
                            <span class="opera edit btn" data-toggle = "modal"  data-target="#edit_modal" title="编辑" id='."'{$res_value['id']}'".' user_name='."'{$res_value['user_name']}'".'
                            corporate_name='."'{$res_value['corporate_name']}'".' email='."'{$res_value['email']}'".' phone='."'{$res_value['phone']}'".'
                            register_type='."'{$res_value['register_type']}'".' upload_num='."'{$res_value['upload_num']}'".' upload_size='."'{$res_value['upload_size']}'".'
                            switch_type='."'{$res_value['switch_type']}'".'
                            content='."'{$res_value['content']}'".'>
                            </span>';
            if($res_value['register_type'] == 1){
                $res_value['register_type'] = '个人用户';
            }elseif($res_value['register_type'] == 2){
                $res_value['register_type'] = '企业用户';
            }elseif($res_value['register_type'] == 3){
                $res_value['register_type'] = '系统用户';
            }

            if($res_value['switch_type'] == 1){
                $res_value['switch_type'] = '启用';
            }elseif( $res_value['switch_type'] = 2){
                $res_value['switch_type'] = '未启用';
            }
        }
        $this->ajaxReturn($result,'json');
    }
    //添加用户数据
    public function register(){
        if (IS_POST){
            $this->nickname = trim(!empty($_POST['nickname'])) ? trim($_POST['nickname']) : '';//昵称
            $this->phone = !empty($_POST['phone']) ? trim($_POST['phone']) : '';//手机号
            $this->email = !empty($_POST['email']) ? trim($_POST['email']) : '';//邮箱
            $this->password = !empty($_POST['password']) ? trim($_POST['password']) : '';//密码
            $this->password_ok = !empty($_POST['password_ok']) ? md5(trim($_POST['password_ok'])) : '';//确认密码
            $this->register_type = !empty($_POST['register_type']) ? $_POST['register_type'] : 3;//注册类型 1:个人注册 2：企业注册
            $this->corporate_name = !empty($_POST['corporate_name']) ? trim($_POST['corporate_name']) : ''; //公司名称

            $this->upload_size = !empty($_POST['upload_size']) ? trim($_POST['upload_size']) : ' ';//允许上传大小
            $this->upload_num = !empty($_POST['upload_num']) ? trim($_POST['upload_num']) : ' '; //允许上传次数
            $this->switch_type = $_POST['switch_type'] ? trim($_POST['switch_type']) : 1; //是否启用
            $this->content = !empty($_POST['content']) ? $_POST['content'] : ' '; //备注

            //数据正则判断
            if($reg_result = $this->data_reg()){
                die(json_encode($reg_result));
            }

            //密码验证 .数字，字母，标点
            if(!$this->password || !preg_match("/^[a-zA-Z0-9,，、。?!.'？！@#$%^&*·`~<>；;‘'【】]{6,20}$/",$this->password)){
                $prompt = array('title' => 'password','result_err' => '密码格式不对，请重新输入');
                die(json_encode($prompt));
            }

            //确认密码
            if(md5($this->password) != $this->password_ok){
                $prompt = array('title' => 'password_ok','result_err' => '两次密码不一样，请重新输入');
                die(json_encode($prompt));
            }

            //判断用户信息是否存在
            if($data_result = $this->existence()){
                die(json_encode($data_result));
            }

            //用户数据插入
            die(json_encode($this->cj_user()));
        }else{
            $this->error('非法请求');
        }
    }

    //用户查询是否已经注册
    private  function existence(){
        //判断昵称是否存在
        $Model = M('user');
        $resultnick = $Model->where("user_name='%s'",$this->nickname)->find();
        if($resultnick['user_name'] == $this->nickname){
            $prompt = array('title' => 'nickname','result_err' => '此用户已存在，不可以注册');
            return $prompt;
        }

        //判断手机号是否存在
        $resultphone =  $Model->where("phone='%s'",$this->phone)->find();
        if($resultphone['phone'] == $this->phone){
            $prompt = array('title' => 'phone','result_err' => '此手机号已存在，不可以注册');
            return $prompt;
        }

        //判断邮箱是否存在
        $resultemail = $Model->where("email='%s'",$this->email)->find();
        if($resultemail['email'] == $this->email){
            $prompt = array('title' => 'email','result_err' => '此邮箱已存在，不可以注册');
            return $prompt;
        }

        //判断公司是否存在
        if($this->corporate_name){
             $resultcorporate = $Model->where("corporate_name='%s'",$this->corporate_name)->find();
             if($resultcorporate['corporate_name'] == $this->corporate_name){
                 $prompt = array('title' => 'corporate_name','result_err' => '此公司已注册，不可以注册');
                 return $prompt;
             }
        }
    }

    //录入用户数据信息
    private function cj_user(){
        //录入用户信息
        $register_time = date('Y-m-d H:i:s'); //获取注册时间
        $register_date = date('Y-m-d'); //获取注册日期
        $Model = M('user');
        $Model->user_name = $this->nickname;
        $Model->corporate_name = $this->corporate_name;
        $Model->phone = $this->phone;
        $Model->email = $this->email;
        $Model->password = $this->password_ok;
        $Model->register_type = $this->register_type;
        $Model->register_time = $register_time;
        $Model->register_date = $register_date;
        $Model->switch_type = $this->switch_type;
        $Model->content = $this->content;
        $user_id =  $Model->add();
        if($user_id){
            //该用户上传文件限制
            $data_model = M('upload_data');
            $data_model->user_id = $user_id;
            $data_model->upload_size = $this->upload_size;
            $data_model->upload_num = $this->upload_num;
            if($data_model->add()){
                $prompt = array('success' => true);
            }else{
                $prompt = array('success' => false);
            }
        }else{
            $prompt = array('success' => false);
        }
        return $prompt;
    }

    //删除呢数据
    public function delete_user(){
        $user_id = $_POST['user_id'];
        $tranDb = new \Think\Model();
        $upload_file = C('UPLOAD_FILE');
        $user_name = $_POST['user_name'];
        $tranDb->startTrans();
        $str_id = '';
        $res_id = $tranDb->table('__UPLOAD_INFO__')->where("user_id = '%s'",$user_id)->field('id')->select();
        //整理数据
        foreach($res_id as $resid_key => $resid_value){
            $str_id .= $resid_value['id'].',';
        }
         $tranDb->table('__SCAN_SUMMARY__')->where(array("upinfo_id" => array('in',trim($str_id,','))))->field('id')->find();

        $user_res = $tranDb->table('__USER__')->where("id = '%s'",$user_id)->delete();
        $upload_res = $tranDb->table('__UPLOAD_DATA__')->where("user_id = '%s'",$user_id)->delete();
        $tranDb->table('__UPLOAD_INFO__')->where("user_id = '%s'",$user_id)->delete();
        $tranDb->table('__SCAN_SUMMARY__')->where(array("upinfo_id" => array('in',trim($str_id,','))))->delete();
        $tranDb->table('__SCAN_DATA__')->where(array("summary_id" => array('in',trim($str_id,','))))->delete();
        $file_info = $upload_file.$user_name;
        exec("sudo rm -rf $file_info", $res, $status);
        if($user_res && $upload_res){
            $res_data = true;
            $tranDb->commit();
        }else{
            $res_data = false;
            $tranDb->rollback();
        }
        $this->ajaxReturn($res_data,'json');
    }
    //修改用户信息
    public function upload_user(){
        $User_model = M('user');
        $Updata_model = M('upload_data');
        $user_id = $_POST['user_id']; //获取用户id
        $this->upload_size = !empty($_POST['upload_size']) ? trim($_POST['upload_size']) : 0; //上传大小限制
        $this->upload_num = !empty($_POST['upload_num']) ? trim($_POST['upload_num']) : 0; //上传数量限制
        $this->switch_type = !empty($_POST['switch_type']) ? trim($_POST['switch_type']) : 1; //是否启用
        $this->content = !empty($_POST['content']) ? $_POST['content'] : ''; //备注
        $register_type = !empty($_POST['register_type']) ? $_POST['register_type'] : ''; //用户类型
        if($register_type != 3){
            //更新数据
            $data['content']    =  $this->content;
            $data['switch_type']    =  $this->switch_type;
            $up_res = $User_model->where("id = '%s'",$user_id)->save($data);
            if($up_res !== false){
                $up_data['upload_size'] =  $this->upload_size;
                $up_data['upload_num'] =  $this->upload_num;
                $updata_res = $Updata_model->where("user_id = '%s'",$user_id)->save($up_data);
                if($updata_res !== false){
                    $prompt = array('success' => true);
                    die(json_encode($prompt));
                }else{
                    $prompt = array('success' => false);
                    die(json_encode($prompt));
                }
            }
        }else{
            $this->nickname = !empty($_POST['nickname']) ? trim($_POST['nickname']) : ''; //用户名
            $this->corporate_name = !empty($_POST['corporate_name']) ? trim($_POST['corporate_name']) : ''; //公司名称
            $this->email = !empty($_POST['email']) ? trim($_POST['email']) :''; //邮箱
            $this->phone = !empty($_POST['phone']) ? trim($_POST['phone']) :''; //手机号
            $this->password = !empty($_POST['password']) ? trim($_POST['password']) : ''; //密码
            $this->password_ok = !empty($_POST['password_ok']) ? md5(trim($_POST['password_ok'])) : ''; //确认密码
            //数据正则判断
            if($reg_result = $this->data_reg()){
                die(json_encode($reg_result));
            }
            //获取用户信息
            $result_info = $User_model->where("id = '%s'",$user_id)->field('user_name,password,corporate_name,email,phone')->find();

            if($this->password || $this->password_ok){
                //密码验证 .数字，字母，标点
                if(!$this->password || !preg_match("/^[a-zA-Z0-9,，、。?!.'？！@#$%^&*·`~<>；;‘'【】]{6,20}$/",$this->password)){
                    $prompt = array('title' => 'password','result_err' => '密码格式不对，请重新输入');
                    die(json_encode($prompt));
                }
                //确认密码
                if(md5($this->password) != $this->password_ok){
                    $prompt = array('title' => 'password_ok','result_err' => '两次密码不一样，请重新输入');
                    die(json_encode($prompt));
                }
                $data['password'] = $this->password_ok;
            }else{
                $data['password'] = $result_info['password'];
            }

            //判断用户名是否重复
            if($result_info['user_name'] !=  $this->nickname){
                $resultnick = $User_model->where("user_name='%s'",$this->nickname)->find();
                if($resultnick['user_name'] == $this->nickname){
                    $prompt = array('title' => 'nickname','result_err' => '此用户已存在，不可以注册');
                    die(json_encode($prompt));
                }
            }
            //判断公司是否存在
            if($result_info['corporate_name'] !=  $this->corporate_name){
                $resultcorporate = $User_model->where("corporate_name='%s'",$this->corporate_name)->find();
                if($resultcorporate['corporate_name'] == $this->corporate_name){
                    $prompt = array('title' => 'corporate_name','result_err' => '此公司已注册，不可以注册');
                    die(json_encode($prompt));
                }
            }
            //判断邮箱是否存在
            if($result_info['email'] !=  $this->email){
                $resultemail = $User_model->where("email='%s'",$this->email)->find();
                if($resultemail['email'] == $this->email){
                    $prompt = array('title' => 'email','result_err' => '此邮箱已存在，不可以注册');
                    die(json_encode($prompt));
                }
            }
            //判断手机号是否存在
            if($result_info['phone'] !=  $this->phone){
                $resultphone =  $User_model->where("phone='%s'",$this->phone)->find();
                if($resultphone['phone'] == $this->phone){
                    $prompt = array('title' => 'phone','result_err' => '此手机号已存在，不可以注册');
                    die(json_encode($prompt));
                }
            }
            //更新数据
            $data['user_name']    =  $this->nickname;
            $data['corporate_name']    =  $this->corporate_name;
            $data['email']    =  $this->email;
            $data['phone']    =  $this->phone;
            $data['switch_type']    =  $this->switch_type;
            $data['content']    =  $this->content;
            $up_res = $User_model->where("id = '%s'",$user_id)->save($data);
            if($up_res !== false){
                $up_data['upload_size'] =  $this->upload_size;
                $up_data['upload_num'] =  $this->upload_num;
                $updata_res = $Updata_model->where("user_id = '%s'",$user_id)->save($up_data);
                if($updata_res !== false){
                    $prompt = array('success' => true);
                    die(json_encode($prompt));
                }else{
                    $prompt = array('success' => false);
                    die(json_encode($prompt));
                }
            }
        }
    }

    //数据正则判断
    private function data_reg(){
        //昵称验证 中文 数字 字母
        if(!$this->nickname || !preg_match("/^[\x7f-\xff0-9a-zA-Z]{3,15}$/",$this->nickname)){
            $prompt = array('title' => 'nickname','result_err' => '用户名格式不对，从重新输入');
            return $prompt;
        }

        //邮箱验证
        if(!$this->email || !preg_match("/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i",$this->email)){
            $prompt = array('title' => 'email','result_err' => '邮箱格式不正确，请重新输入');
            return $prompt;
        }

        //手机号验证
        if(!$this->phone || !preg_match('/^1\d{10}$/',$this->phone)){
            $prompt = array('title' => 'phone','result_err' => '手机号格式不对，请重新输入');
            return $prompt;
        }
    }
}