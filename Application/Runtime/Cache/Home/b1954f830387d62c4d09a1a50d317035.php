<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <script type="text/javascript" src="/thinkphp/Public/js/jquery-1.10.2.min.js"></script>
    <!--<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->
    <script type="text/javascript" src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js" />
    <script type="text/javascript" src="/thinkphp/Public/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="/thinkphp/Public/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/thinkphp/Public/js/bootstrap-datepicker.js"></script>

    <!--<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.10/api/fnReloadAjax.js"></script>-->
    <script type="text/javascript" src="/thinkphp/Public/js/nbos.js"></script>
    <script type="text/javascript" src="/thinkphp/Public/js/layer.js"></script>
    <script type="text/javascript" src="http://cdn.hcharts.cn/highcharts/highcharts.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/css/datepicker.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/css/nbos.css">
    <title><?php echo ($title); ?></title>


</head>
<body class="dt-example">

<div class="row">
    <div class="col-md-4">
        <h1><?php echo ($title); ?></h1>
    </div>
    <div class="col-md-4 col-md-offset-4">
        
    <script>
        $(function(){
            $('.ddos_datetime').datepicker(
                    {
                        format: 'yyyy-mm-dd',
                    }
            );
        });
    </script>
    <script>
        $(function()
        {
            $("#nbos_maintable tbody").on("click",'tr td:nth-child(11) button',function(e)
            {
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['420px', '240px'], //宽高
                    content: $(this).attr('iplist').replace(/,/g,"<br/>")
                });
            });
        })
    </script>
    <script>
        $(function()
        {
            $("#nbos_maintable tbody").on("click",'tr td:nth-child(14) button',function(e)
            {
                var rowiems = $(this).parent().parent()[0].children;
                $('#ticket_id').attr('value',rowiems[0].innerHTML);
                $('#ticket_attack_type').attr('value',rowiems[3].innerHTML);
                $('#ticket_process_status').attr('value',rowiems[12].innerHTML);
                $('#ticket_victim_ip').attr('value',rowiems[1].innerHTML);
                $('#ticket_create_time').attr('value',(new Date()).toLocaleTimeString());
                $('#tickform').attr('style','display:block');
            });
        })
        $(function()
        {
            $("#nbos_maintable tbody").on("click",'tr td:nth-child(13) button',function(e)
            {
                var rowiems = $(this).parent().parent()[0].children;
                $('#ticket_id').attr('value',rowiems[0].innerHTML);
                $('#ticket_attack_type').attr('value',rowiems[3].innerHTML);
                $('#ticket_process_status').attr('value',rowiems[11].innerHTML);
                $('#ticket_victim_ip').attr('value',rowiems[1].innerHTML);
                $('#ticket_create_time').attr('value',(new Date()).toLocaleTimeString());
                $('#tickform').attr('style','display:block');
            });
        })
    </script>

    <script>
        var datatablesfun;
        $(function()
        {
            datatablesfun = $('#nbos_maintable').dataTable(
                    {
                        "retrieve": true,
                        "bPaginate": true,
                        "bFilter": true,
                        "bInfo": true,
                        "bSort": false,
                        "processing" : true,
                        "serverSide" : true,
                        "searching":false,
                        "language":{
                            'emptyTable': '没有数据',
                            'loadingRecords': '加载中...',
                            'processing': '查询中...',
                            'lengthMenu': '每页 _MENU_ 条',
                            'zeroRecords': '没有数据',
                            'paginate': {
                                'first':      '第一页',
                                'last':       '最后一页',
                                'next':       '',
                                'previous':   ''
                            },
                            'info': '第 _PAGE_ 页 / 总 _PAGES_ 页',
                            'infoEmpty': '没有数据',
                        },

                        "paginationType":"full_numbers",
                        "ajax": {
                            url: "/thinkphp/index.php/Home/Index/<?php echo ($ajaxdataserver); ?>",
                            data : function(d) {
                                d.ddos_start_time = $('#ddos_start_time').val();
                                d.ddos_end_time = $('#ddos_end_time').val();
                            },
//                             {"ddos_start_time":$('#ddos_start_time').val(), "ddos_end_time":$('#ddos_end_time').val()},//参数
                            type: "GET", //提交的类型
                        }
                    }
            );
        });
    </script>
    <script>
        $(function(){
            $('.btn').on('click',function() {
                datatablesfun.fnDraw();
            });
        });
    </script>
    <input type="text" class="input-small ddos_datetime" id="ddos_start_time" placeholder="开始日期"> -
    <input type="text" class="input-small ddos_datetime" id="ddos_end_time" placeholder="结束日期">
    <button class="btn">搜索</button>

    </div>
</div>
<td class="row">
    <div class="col-md-12">
        
    </div>
</td>
</body>
</html>