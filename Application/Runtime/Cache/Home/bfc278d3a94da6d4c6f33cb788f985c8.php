<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <script type="text/javascript" src="//cdn.bootcss.com/jquery/3.0.0-alpha1/jquery.min.js"></script>
    <script type="text/javascript" src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="/hotspots/Public/js/echarts.min.js"></script>
    <script type="text/javascript" src="/hotspots/Public/js/china.js"></script>
    <script type="text/javascript" src="/hotspots/Public/js/layer.js"></script>

    <link rel="stylesheet" type="text/css" href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" />

    <title><?php echo ($title); ?></title>
</head>
<body>
<ul class="nav nav-tabs">

    <ul class="nav nav-tabs" id="navigation_bar_id">
        <li><a href="/hotspots/index.php/Home/Index/index.html">全国主要城市流量显示</a></li>
        <li><a href="/hotspots/index.php/Home/Index/company.html">各公司流量显示</a></li>
    </ul>
    <script>
        $(function()
        {
            $('#navigation_bar_id li')[parseInt(<?php echo ($navigation_bar_number); ?>)].setAttribute('class','active');
        })
    </script>
</ul>
<!--<div class="row">-->
    <!--<div class="col-md-4 col-md-offset-1">-->
        <!--<h1><?php echo ($title); ?></h1>-->
    <!--</div>-->
    <!--<div class="col-md-4 col-md-offset-4">-->
        <!---->
    <!--</div>-->
<!--</div>-->
<!--<div class="row">-->
    <!---->
<!--</div>-->
<td class="row">
    <div class="col-md-12">
        
    <div id="company" style="height: 650px">

    </div>

    <script>
        var myChart = echarts.init(document.getElementById("company"));
        var d = <?php echo ($data); ?>;
        var data=d['data'];
        var date=d['date'];
        option = {
            tooltip: {
                trigger: 'axis'
            },
            title: {
                left: 'center',
                text: '各公司流量显示',
            },
            legend: {
                top: 'bottom',
                data:['意向']
            },
            toolbox: {
                show: true,
                feature: {
                    dataView: {show: true, readOnly: false},
                    magicType: {show: true, type: ['line', 'bar', 'stack', 'tiled']},
                    restore: {show: true},
                    saveAsImage: {show: true}
                }
            },
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: date
            },
            yAxis: {
                type: 'value',
                boundaryGap: [0, '100%'],
            },
            dataZoom: [{
                type: 'inside',
                start: 0,
                end: 10
            }, {
                start: 0,
                end: 10
            }],
            series: [
                {
                    name:'模拟数据',
                    type:'line',
                    smooth:true,
                    symbol: 'none',
                    sampling: 'average',
                    itemStyle: {
                        normal: {
                            color: 'rgb(255, 70, 131)'
                        }
                    },
                    areaStyle: {
                        normal: {
                            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                offset: 0,
                                color: 'rgb(255, 158, 68)'
                            }, {
                                offset: 1,
                                color: 'rgb(255, 70, 131)'
                            }])
                        }
                    },
                    data: data,
                }
            ]
        };

//        function getChartData()
//        {
//            var options = myChart.getOption();
//            //通过Ajax获取数据
//            $.ajax({
//                type : "post",
//                async : false, //同步执行
//                url : "/hotspots/index.php/Home/Index/<?php echo ($ajaxdataserver); ?>",
//                data : {},
//                dataType : "json", //返回数据形式为json
//                success : function(result) {
//                    if (result) {
//
//                        var tempdata = JSON.parse(result)
//
//                        options.series[0].data = tempdata['data'];
//                        alert(tempdata['date'])
//                        options.xAxis.data = tempdata['date'];
//
//                        myChart.hideLoading();
//                        myChart.setOption(options);
//                    }
//                },
//                error : function(errorMsg) {
//                    alert("图表请求数据失败!");
//                    myChart.hideLoading();
//                }
//            });
//
//        }

        myChart.setOption(option, true);
//        getChartData()

    </script>

    </div>
</td>
</body>
</html>