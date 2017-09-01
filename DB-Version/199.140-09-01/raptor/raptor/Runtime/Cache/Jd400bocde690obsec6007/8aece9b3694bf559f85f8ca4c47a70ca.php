<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <title>匠迪云</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="/Public/admin/Images/favicon.ico"/>
    <link rel="stylesheet" href="/Public/admin/Css/bootstrap.css">
    <link rel="stylesheet" href="/Public/admin/Css/iframe-useview.css">
    <link rel="stylesheet" href="/Public/admin/Css/table.css">
    <link rel="stylesheet" href="/Public/admin/Css/pop-up.css">

    <script type="text/javascript" src="/Public/admin/Js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="/Public/admin/Js/bootstrap-table.js"></script>
    <script type="text/javascript" src="/Public/admin/Js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Public/admin/Js/echarts.js"></script>

</head>
<body class="modal-open">

<div class="ecmap" id = "main"></div>

<!--------------滚动条----------->
<div class="scroll-container">
    <div class="scroll">
        <table class="table table-bordered" id = "table">
        </table>
    </div>
</div>

<!--编辑用户弹窗-->
<div class="modal fade" id="edit_modal"  aria-labelledby="edit_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="edit_title">
                    编辑
                </h4>
            </div>
            <form action="" type="" id = "form" onsubmit="return false">
                <div class="modal-body" style="margin-top: 20px">
                    <p class="scan_cs">
                        <span>扫描次数</span>
                        <input type="hidden" class="user_id" name="user_id" value="">
                        <input type="number" name="upload_num" value="" placeholder="(次/天)" class="upload_num">

                    </p>
                    <p>
                        <span>扫描大小</span>
                        <input type="number" name="upload_size" value="" placeholder="(M/次)" class="upload_size">
                    </p>
                    <p>
                        <span>是否启用</span>
                        <select name="switch_type">
                            <option value="1" class="switch_type_y">是</option>
                            <option value="2" class="switch_type_n">否</option>
                        </select>
                    </p>
                    <div class="remark">
                        <span >备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注</span>
                        <textarea name="content" class="content"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-pri-def user_form">
                        确定
                    </button>
                    <button type="button" class="btn btn-default btn-pri-def" data-dismiss="modal">
                        取消
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--删除弹框-->
<div class="modal fade" id="del_modal"  aria-labelledby="del_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="del_title">
                    信息提示
                </h4>
            </div>
            <form action="" type=""  onsubmit="return false">
                <div class="modal-body" style="margin-top: 20px">
                    <p>
                        是否删除该用户？
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-pri-def del_ok">
                        确定
                    </button>
                    <button type="button" class="btn btn-default btn-pri-def" data-dismiss="modal">
                        取消
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="/Public/admin/Js/userview.js"></script>

<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('main'),'dark');
    option = {
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['企业用户','个人用户'],
            itemWidth:50,
            textStyle:{
                color:'#fff'

            }
        },
        xAxis : [
            {
                type : 'category',
                boundaryGap : false,
                data : [<?php echo ($date_str); ?>],
                axisLabel: {
                    show: true,
                    textStyle: {
                        color: '#fff'
                    }
                }
            }
        ],
        yAxis : [
            {
                type: 'value',
                axisLabel: {
                    formatter: '{value} 人',
                    show: true,
                    textStyle: {
                        color: '#fff'
                    }
                }
            }
        ],
        series : [
            {
                name:'个人用户',
                type:'line',
                stack: '总量',
                smooth: true,
                symbolSize: 8,
                symbol:'circle',
                itemStyle: {
                    normal: {
                        color: "#0b613c",
                        lineStyle: {
                            color: '#0b613c'
                        }
                    }
                },
                areaStyle : {
                    normal : {
                        color : new echarts.graphic.LinearGradient(0, 0, 0, 1,
                                [
                                    {
                                        offset : 0,
                                        color : 'rgba(29, 65, 73,1)'
                                    },
                                    {
                                        offset : 1,
                                        color : 'rgba(43, 84, 92,0.5)'
                                    } ], false)
                    }
                },
                data:[<?php echo ($user_type1); ?>]
            },
            {
                name:'企业用户',
                type:'line',
                stack: '总量',
                symbolSize: 8,
                symbol:'circle',
                itemStyle: {
                    normal: {
                        color: '#10a0b5'
                    }
                },
                data:[ <?php echo ($user_type2); ?>]
            }

        ]
    };
    myChart.setOption(option);
</script>
</body>
</html>