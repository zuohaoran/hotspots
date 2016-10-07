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
<body>
<ul class="nav nav-tabs">

    <ul class="nav nav-tabs" id="navigation_bar_id">
        <li><a href="/thinkphp/index.php/Home/Index/index.html">DDoS</a></li>
        <li><a href="/thinkphp/index.php/Home/Index/drdos.html">DRDoS</a></li>
        <li><a href="/thinkphp/index.php/Home/Index/gress.html">入带宽/出带宽</a></li>
    </ul>
    <script>
        $(function()
        {
            $('#navigation_bar_id li')[parseInt(<?php echo ($navigation_bar_number); ?>)].setAttribute('class','active');
        })
    </script>
</ul>
<div class="row">
    <div class="col-md-3 col-md-offset-1">
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
<div class="row">
    
    <div class="row" id="tickform" style="display:none">
        <div class="col-md-4 col-md-offset-4">
            <form>
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-4">序号</div>
                        <div class="col-md-2"><input type="text" id="ticket_id"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-4">处理状态</div>
                        <div class="col-md-2"><input type="text" id="ticket_process_status"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-4">攻击类型</div>
                        <div class="col-md-2"><input type="text" id="ticket_attack_type"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-4">被攻击对象</div>
                        <div class="col-md-2"><input type="text" id="ticket_victim_ip"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-4">创建时间</div>
                        <div class="col-md-2"><input type="text" id="ticket_create_time"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-4">最后修改时间</div>
                        <div class="col-md-2"><input type="text" id="ticket_update_time"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-4">填写人</div>
                        <div class="col-md-2"><input type="text" id="ticket_writer"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">情况描述</div>
                        <div class="col-md-8"><input type="text" id="ticket_desciption"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">后续处理</div>
                        <div class="col-md-8"><input type="text" id="ticket_later_process"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-md-offset-4" id="ticket_submit">
                        <button type="submit" class="btn btn-default">提交</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

</div>
<td class="row">
    <div class="col-md-12">
        
    <script>
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
    <table class="display compact" cellspacing="0" width="100%" id="nbos_maintable">
        <thead>
        <tr>
            <th>序号</th>
            <th>被攻击服务器</th>
            <th>被攻击服务器归属</th>
            <th>类型</th>
            <th>起始时间</th>
            <th>结束时间</th>
            <th>pps</th>
            <th>kbps</th>
            <th>attacker_ipcnt</th>
            <th>attacker_iplist</th>
            <th>atacker_ipcnt</th>
            <th>处理情况</th>
            <th>操作</th>
        </tr>
        </thead>


        <tfoot>
        <tr>
            <th>序号</th>
            <th>被攻击服务器</th>
            <th>被攻击服务器归属</th>
            <th>类型</th>
            <th>起始时间</th>
            <th>结束时间</th>
            <th>pps</th>
            <th>kbps</th>
            <th>attack_ipcnt</th>
            <th>attack_iplist</th>
            <th>attack_ipcnt</th>
            <th>处理情况</th>
            <th>操作</th>
        </tr>
        </tfoot>
    </table>

    </div>
</td>
</body>
</html>