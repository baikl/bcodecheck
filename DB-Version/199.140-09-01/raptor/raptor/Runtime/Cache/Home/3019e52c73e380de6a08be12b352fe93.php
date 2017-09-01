<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <title>匠迪云</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="匠迪云，代码安全，代码检测，匠迪技术">
    <meta name="description" content="匠迪云是一款线上安全服务平台，集产品安全服务展示，体验，交付等多种功能">
    <link rel="shortcut icon" href="images/favicon.ico"/>
    <link rel="stylesheet" href="/Public/Css/bootstrap.css">
    <link rel="stylesheet" href="/Public/Css/common.css">
    <script src="/Public/Js/jquery-3.1.1.min.js"></script>
    <script src="/Public/Js/bootstrap.min.js"></script>
	<style type="text/css">
		#navbar .navbar-nav li a:hover{
			color:#65b6fc;
		}
	</style>
</head>
<body>
<nav class="navbar navbar-default  navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo U('index');?>"><img src="/Public/Images/logo1.png" alt="" title="匠迪云安全"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" >

            <ul class="nav navbar-nav">
                <li><a href="<?php echo U('Index/index');?>" class="index">首页</a></li>
                <li><a href="<?php echo U('Index/index?type=second#second');?>" class="second">产品介绍</a></li>
                <li><a href="<?php echo U('product/product');?>" class="product">产品服务</a></li>
                <li><a href="<?php echo U('Index/index?type=third#third');?>" class="third">联系我们</a></li>
                <li><a href="<?php echo U('Login/login');?>">免费检测</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo U('Login/login');?>" class="login_not">登陆</a></li>
                <li><a href="<?php echo U('Signin/signin');?>" class="signin">注册</a></li>
            </ul>

        </div>
    </div>
</nav>

<script>
	 $(function(){
        var file = "<?php echo ($_SERVER['PATH_INFO']); ?>";
        var type = "<?php echo ($_GET['type'] ? $_GET['type'] : ''); ?>";
        if(file == 'Index/index' && type == ''){
            $('.index').css('border-bottom','4px solid #65b6fc');
        }else if(file == 'product/product'){
            $('.product').css('border-bottom','4px solid #65b6fc');
        }else if(file == '/login_not.html'){
            $('.login_not').css('border-bottom','4px solid #65b6fc');
        }else if(file == '/signin.html'){
            $('.signin').css('border-bottom','4px solid #65b6fc');
        }else if(type == 'second' && file == 'Index/index/type/second'){
			$('.second').css('border-bottom','4px solid #65b6fc');
        }else if(type == 'third' && file == 'Index/index/type/third'){
        	$('.third').css('border-bottom','4px solid #65b6fc');
        }
    });
</script>
<link rel="stylesheet" href="/Public/Css/signin.css">
<link rel="stylesheet" href="/Public/Css/model.css">
<div class="container">
    <div class="row main">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <h2 class="title">欢迎使用<br>匠迪代码安全审查系统</h2>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <form action="" id="form" onsubmit="return false">
                <div class="xddw">
                    <p class="xddw-p">
	                    <input type="radio" name="register_type" value="1" id = "personal" class="xddw-radio" checked = checked>
	                    <label for="personal"></label>
	                    <span>个人用户</span>
                    </p>
                    <p class="xddw-p" style="left: 33%">
	                    <input type="radio" name="register_type" value="2" id = "public" class="xddw-radio">
	                    <label for="public"></label>
	                    <span>企业用户</span>
                    </p>
                    <p class="xddw-p doubt" style="left: 66%" ><a href="<?php echo U('Home/product/product');?>" ><span style="font-size: 14px">用户权益详解</span></a></p>
                </div>

                <div class="xddw message company" style="display: none">
                    <span>公司名称：</span>
                    <input type="text" name="corporate_name" placeholder="请输入企业名称" class="message-input comInp" onblur="comBlur(this)">
                    <p class="warning corporate_name "></p>
                </div>

                <div class="xddw message">
                    <span>用户名：</span>
                    <input type="text" name="nickname" placeholder="请输入用户名 中文 数字 字母（3-15）" class="message-input" onblur="warning(this,0)">
                    <p class="warning nickname sj"></p>
                </div>

                <div class="xddw message">
                    <span>手机号码：</span>
                    <input type="tel" name="phone" placeholder="请输入手机号码"  class="message-input" oninput="checktel(this)"   onblur="warning(this,1)">
                    <p class="warning warningtel phone sj"></p>
                </div>

                <div class="xddw message yz">
                    <span>验证码：</span>
                    <input type="text" name="phone_code" placeholder="请输入验证码" style="width: 40%" class="message-input">
                    <p class="warning phone_code"></p>
                    <button class="send-btn fs_code" type="button" >免费获取验证码</button>
                </div>

                <div class="xddw message">
                    <span>邮箱：</span>
                    <input type="email" name="email" placeholder="请输入正确的E-mail，用于找回密码" class="message-input" onblur="warning(this,2)">
                    <p class="warning email sj"></p>
                </div>

                <div class="xddw message">
                    <span>密码：</span>
                    <input type="password" name="password" placeholder="请输入密码 数字 字母 标点（6-20）" class="message-input" onblur="warning(this,3)">
                    <p class="warning password sj"></p>
                </div>

                <div class="xddw message">
                    <span>确认密码：</span>
                    <input type="password" name="password_ok" placeholder="请再次输入密码" class="message-input" onblur="qrmm(this)">
                    <p class="warning password_ok"></p>
                    <div class="notify" >
                            <input type="checkbox" id="check_box" checked="checked" >
                            <label for="check_box"></label>
                            <span id="notify-text">我已经阅读并同意<a class="btn " data-toggle="modal" data-target="#explain">《相关服务协议》</a></span>
                    </div>
                </div>

                <div class="xddw message">
                    <span>验证码：</span>
                    <input type="text" id="inputCode" placeholder="输入验证码" class="message-input" style="width: 45%">
                    <div class="code" id="checkCode" onclick="createCode()" ></div>
                    <p class="warning login_code"></p>
                </div>

                <div class="xddw message signin_but">
                    <button class="register" type="submit" type = "button">注&nbsp;&nbsp;册</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!---------------相关服务协议弹窗-------------->
<div class="modal fade" id="explain" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                   用户服务协议
                </h4>
            </div>
            <div class="modal-body">
                请务必认真阅读和理解本《匠迪代码审计用户服务协议》
				（以下简称《协议》）中规定的所有权利和限制。除非您接受本《协议》条款，
				否则您无权注册、登录或使用本协议所涉及的相关服务。您一旦注册、登录、使用或以任何方式使用本
				《协议》所涉及的相关服务的行为将视为对本《协议》的接受，即表示您同意接受本《协议》各项条款的约束。
				如果您不同意本《协议》中的条款，请不要注册、登录或使用本《协议》相关服务。
				本《协议》是用户与北京匠迪技术有限公司（下称“匠迪”）之间的法律协议。
				
				<ul>
				<li class = "leave1-li">1. 服务内容
				    <ul class = "leave2">
					    <li>
						1.1 匠迪代码审计是匠迪为用户提供的源代码缺陷检测服务平台，所提供的服务包括但不限于：源代码缺陷检测服务、开源项目检测计划发布等。<br>
                                源代码缺陷检测服务：对用户提供的Java语言、PHP语言、C语言等源代码安全检测，并提供检测结果供用户在线查看。<br>
                                开源项目检测计划发布：发布开源代码的检测结果，供用户进行结果查询与分析。
						</li>
						<li>
						1.2 匠迪代码审计主要包括开源项目检测和私人代码检测两种业务，开源代码的检测对象主要是互联网上可以公开下载的开源项目源代码，
						开源代码的检测结果对所有用户公开。私人代码的检测对象是用户个人上传的源代码，检测结果仅对代码上传者开放。
						</li>
					</ul>		
				</li>
				<li class = "leave1-li">2. 用户使用规则
					<ul class = "leave2">
						<li>
						2.1 用户在申请使用匠迪代码审计的网络服务时，必须向匠迪代码审计网站提供真实、准确的个人信息，如个人信息有任何变动，必须及时更新。
						因用户提供个人资料不真实、不准确而引发的一切后果由用户承担。
						</li>
						<li>
						2.2使用本匠迪代码审计平台需要您注册成为用户，您需要对自己在账户中的所有活动和事件负全责。
						如发现任何非法使用用户账号或账号出现安全漏洞的情况，应立即通告匠迪。
						如果由于您的过失导致您的账号和密码脱离您的控制，则由此造成的对您、匠迪或任何第三方的损害，您将承担全部责任。
						</li>
						<li>
						2.3 用户承诺：
						
							<ul class = "leave3">
							    <li>
								2.3.1拥有所提交代码的包括著作权在内的所有知识产权或合法授权，对匠迪代码审计检测结果完整合法使用，不得宣传、拆分、
								修改所提交代码的检测结果，不得损害任何第三方的知识产权及其他合法权益。对第三方造成任何损害的，由用户承担全部赔偿责任。
								
								</li>
								<li>
								2.3.2 遵守中国有关的法律和法规；
								</li>
								<li>
								2.3.3 遵守所有与网络服务有关的网络协议、规定和程序；
								</li>
								<li>
								2.3.4 不得为任何非法目的而使用网络服务系统；
								</li>
								<li>
								2.3.5 不得利用匠迪代码审计网络服务系统进行任何可能对互联网或移动网络正常运转造成不利影响的行为；
								</li>
								<li>
								2.3.6 不得利用匠迪代码审计提供的网络服务上传、展示或传播任何虚假的、骚扰性的、中伤他人的、辱骂性的、恐吓性的、庸俗淫秽的或其他任何非法的信息资料；
								</li>
								<li>
								2.3.7 不得侵犯匠迪和其他任何第三方的专利权、著作权、商标权、名誉权或其他任何合法权益；
								</li>
								<li>
								2.3.8 不得利用匠迪代码审计网络服务系统进行任何不利于匠迪的行为。
								</li>
						
							</ul>
						</li>
						
						<li>
						2.4 如用户在使用网络服务时违反任何上述规定，匠迪或其授权的人有权要求用户改正或直接采取一切必要的措施
						（包括但不限于更改或删除用户创建的检测项目等、暂停或终止用户使用网络服务的权利）以减轻用户不当行为造成的影响。
						
						
						</li>
					</ul>
				</li>
				<li class = "leave1-li">3. 知识产权
				    <ul class = "leave2">
						<li>
						3.1匠迪提供的网络服务中包含的任何文本、图片、图形、音频和/或视频资料均受版权、商标和/或其它财产所有权法律的保护，
						未经相关权利人同意，上述资料均不得用于任何商业目的。
						</li>
						<li>
						3.2匠迪为免费用户提供的检测结果知识产权归匠迪所有，未经匠迪同意，检测结果不得用于任何商业目的。
						</li>
						<li>
						3.3 任何人不得擅自以非法的方式传播、修改和使用本网站所提供的内容。
						</li>
			
					</ul>
				
				
				</li>
				<li class = "leave1-li">4. 隐私保护
				    <ul class = "leave2">
					    <li>4.1匠迪保证不对外公开或向第三方提供用户的注册资料及用户在使用网络服务时存储在匠迪的非公开内容（如用户上传的个人代码），但下列情况除外：
						    <ul class = "leave3">
							    <li>4.1.1 事先获得用户的明确授权；</li>
								<li>4.1.2 根据有关的法律法规要求；</li>
							    <li>4.1.3 按照相关政府主管部门的要求；</li>
							
							    <li>4.1.4 为维护社会公众的利益；</li>

							    <li>4.1.5 为维护匠迪的合法权益。</li>
							
							
					
							</ul>
						
						
						
						
						</li>
						 <li>4.2匠迪可能会与第三方合作向用户提供相关的网络服务，在此情况下，如该第三方同意承担与匠迪同等的保护用户隐私的责任，则匠迪有权将用户的注册资料提供给该第三方。</li>
						  <li>4.3 在不透露单个用户隐私资料的前提下，匠迪有权对整个用户数据库（不包括用户上传的个人代码）进行分析并对用户数据库进行商业上的利用。</li>
						   <li>4.4 匠迪会对用户上传的个人代码的检测结果进行严格保密。在不公布个人代码详细检测结果的前提下，匠迪有权对个人代码的检测结果进行统计分析和发布统计结果。</li>
					
					
					</ul>
				
				
				</li>
				<li class = "leave1-li">5. 免责声明
					<ul class = "leave2">
						<li>5.1 鉴于网络服务的特殊性，用户同意匠迪有权根据业务发展情况随时变更、中断或终止部分或全部的网络服务，匠迪终止服务前需通知用户；</li>
						<li>5.2 用户理解，匠迪需要定期或不定期地对提供网络服务的平台（如互联网网站、移动网络等）或相关的设备进行检修或者维护，如因此类情况而造成网络服务在合理时间内的中断，匠迪无需为此承担任何责任，但匠迪应尽可能事先进行通告。</li>
						<li>5.3 如发生下列任何一种情形，匠迪有权随时中断或终止向用户提供本《协议》项下的网络服务（包括收费网络服务）而无需对用户或任何第三方承担任何责任：
						    <ul class = "leave3">
							    <li>5.3.1 用户提供的个人资料不真实；</li>
								<li>5.3.2 用户违反本《协议》中规定的使用规则。</li>
							
							</ul>
						
						
						</li>
						<li>5.4匠迪不保证为向用户提供便利而设置的外部链接的准确性和完整性，同时，对于该等外部链接指向的不由匠迪实际控制的任何网页上的内容，匠迪不承担任何责任。</li>
						<li>5.5用户知悉并理解，匠迪匠迪代码审计经过详细的测试，但不能保证与所有的软硬件系统完全兼容，不能保证本服务完全没有错误，如果出现不兼容及服务错误的情况，用户可寻求技术支持以解决问题。匠迪就此情形不承担任何责任。</li>
						<li>5.6 用户明确同意其免费使用"匠迪匠迪代码审计"服务所存在的风险将完全由其自己承担；在适用法律允许的最大范围内，对因使用或不能使用"匠迪代码审计"服务所产生的损害及风险，包括但不限于直接或间接的个人损害、商业赢利的丧失、贸易中断、商业信息的丢失或任何其它经济损失，匠迪不承担任何责任。</li>
						<li>5.7对于因运营商系统或互联网网络故障、计算机故障或病毒、信息损坏或丢失、计算机系统问题或其它任何不可抗力原因而产生损失， 匠迪不承担任何责任。</li>
						<li>5.8 用户违反本协议规定，匠迪有权采取包括但不限于中断使用许可、停止提供服务、限制使用、法律追究等措施。</li>
					
					</ul>
				</li>
				<li class = "leave1-li">6. 法律及争议解决
				    <ul class = "leave2">
					   <li>6.1 本协议适用中华人民共和国法律。</li>
					   <li>6.2 因本协议引起的或与本协议有关的任何争议，各方应友好协商解决；协商不成的，任何一方均可将有关争议提交至北京仲裁委员会并按照其届时有效的仲裁规则仲裁；仲裁裁决是终局的，对各方均有约束力。</li>
					
					</ul>
				
				
				</li>
				<li class = "leave1-li">7. 其他条款
				    <ul class = "leave2">
					   <li>7.1 如果本协议中的任何条款无论因何种原因完全或部分无效或不具有执行力，或违反任何适用的法律，则该条款被视为删除，但本协议的其余条款仍应有效并且有约束力。</li>
					    <li>7.2 匠迪有权随时根据有关法律、法规的变化以及公司经营状况和经营策略的调整等修改本协议。</li>
						 <li>7.3 如果用户不同意匠迪对本协议相关内容所做的修改，有权停止使用匠迪匠迪代码审计服务。如果用户继续使用匠迪匠迪代码审计服务，则视为接受匠迪对本协议相关内容所做的修改。</li>
						  <li>7.4 匠迪在法律允许最大范围对本协议拥有解释权与修改权。</li>
					
					</ul>
				
				
				
				</li>
				
				</ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                </button>
            </div>
        </div>
    </div>
</div>
<script src="/Public/Js/signin.js"></script>
</body>
</html>