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
    <input type="text" class="input-small ddos_datetime" id="ddos_start_time" placeholder="开始日期"> -
    <input type="text" class="input-small ddos_datetime" id="ddos_end_time" placeholder="结束日期">
    <button class="btn">搜索</button>

    </div>
</div>
<div class="row">
    
</div>
<td class="row">
    <div class="col-md-12">
        
    <script>
        $(function () {
            var gresschart;
            gressOptions = {
                credits: {enabled: false},
                //图表展示容器，与div的id保持一致
                chart: {
                    renderTo: 'chartdraw',
                    type: 'line'                         //指定图表的类型，默认是折线图（line）
                },
                title: {
                    text: '带宽显示图'      //指定图表标题
                },
                tooltip:
                {
                    formatter:function(){
                        return'<strong>'+this.series.name+'</strong>'+
                                Highcharts.dateFormat('%Y-%m-%d %H:%M:%S',this.x)+': '+this.y+' Mb/s';
                    }
                },
                xAxis: {
                    type: 'datetime',
                    title:{
                        text: '时间'
                    },
                    formatter:function(){
                        return Highcharts.dateFormat('%Y-%m-%d %H:%M:%S',this.x)+': '+this.y+' m/s';
                    }
                },
                yAxis: {
                    type: 'int',
                    title: {
                        text: '带宽 ( Mb/s )'                  //指定y轴的标题
                    },
                    min: 0
                },
                series: [
                    {                                 //指定数据列
                        name: '出带宽',                          //数据列名
                    },
                    {
                        name: '入带宽',
                    }],

            };

            gresschart = new Highcharts.Chart(gressOptions);

            updatehighchart('both');

            function updatehighchart(routernumber)
            {
                $.get('/thinkphp/index.php/Home/Index/ajaxgressrouter',
                        {
                            router:routernumber,
                            ddos_start_time:$('#ddos_start_time').val(),
                            ddos_end_time:$('#ddos_end_time').val()
                        },
                        function (data) {
                    var jsondata = JSON.parse(data);
                    var ingress=[];
                    var egress=[];
                    for(var i=0; i < jsondata.ingress.length; i++)
                    {
                        var item = jsondata.ingress[i];
                        ingress.push([new Date(Date.parse(item.datetime)).getTime(),parseInt(item.sumbytes)]);
                    }
                    for(var i=0; i < jsondata.egress.length; i++)
                    {
                        var item = jsondata.egress[i];
                        egress.push([new Date(Date.parse(item.datetime)).getTime(),parseInt(item.sumbytes)]);
                    }
                    gresschart.series[0].setData(egress);
                    gresschart.series[1].setData(ingress);

                    gresschart.redraw();
                });
            }

            $('#subnavbar li').click(function()
            {
                $(this).addClass("active").siblings().removeClass("active");
                var index = $(this).index();
                if(index == 0){
                    updatehighchart('both');
                }
                else{
                    updatehighchart(index.toString());
                }
            });

            $('.btn').click(function()
            {
                var index = $('#subnavbar .active').index();
                if(index == 0){
                    updatehighchart('both');
                }
                else{
                    updatehighchart(index.toString());
                }
            });
        });

    </script>
    <div class="col-md-8 col-md-offset-2">
        <div>
            <ul class="nav nav-pills" id="subnavbar">
                <li class="active"><a href="#">国内总带宽</a></li>
                <li><a href="#">路由器1总带宽</a></li>
                <li><a href="#">路由器2总带宽</a></li>
            </ul>
        </div>

        <div id="chartdraw"></div>
    </div>


    </div>
</td>
</body>
</html>