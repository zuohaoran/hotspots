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
        

<div id="hotspots" style="height: 650px;">

</div>

<script type="text/javascript" language="javascript">
    var myChart = echarts.init(document.getElementById("hotspots"));

    var app = {};
    option = null;
    var geoCoordMap = {
        "清华大学":[116.323,40.004],
        "北京大学":[116.304,39.992],
        "北京邮电大学":[116.349,39.959],
        "天津":[117.2,39.13],
        "石家庄":[114.48,38.03],
        "太原":[112.53,37.87],
        "呼和浩特":[111.65,40.82],
        "西安":[108.95,34.27],
        "西宁":[101.74,36.56],
        "兰州":[103.73,36.03],
        "银川":[106.27,38.47],
        "乌鲁木齐":[87.68,43.77],
        "成都":[104.06,30.67],
        "重庆":[106.54,29.59],
        "昆明":[102.73,25.04],
        "贵阳":[106.71,26.57],
        "拉萨":[91.11,29.97],
        "广州":[113.23,23.16],
        "桂林":[110.28,25.29],
        "南宁":[108.33,22.84],
        "海口":[110.35,20.02],
        "深圳":[114.07,22.62],
        "武汉":[114.31,30.52],
        "长沙":[113,28.21],
        "郑州":[113.65,34.76],
        "南京":[118.78,32.04],
        "合肥":[117.27,31.86],
        "济南":[117,36.65],
        "青岛":[120.33,36.07],
        "上海":[121.48,31.22],
        "杭州":[120.19,30.26],
        "南昌":[115.89,28.68],
        "福州":[119.3,26.08],
        "厦门":[118.1,24.46],
        "沈阳":[123.38,41.8],
        "大连":[121.62,38.92],
        "长春":[125.35,43.88],
        "哈尔滨":[126.63,45.75],
    };

    var convertData = function (data) {
        var res = [];
        for (var i = 0; i < data.length; i++) {
            var geoCoord = geoCoordMap[data[i].name];
            if (geoCoord) {
                res.push({
                    name: data[i].name,
                    value: geoCoord.concat(data[i].value)
                });
            }
        }
        return res;
    };

    function getChartData() {
        //获得图表的options对象
        var options = myChart.getOption();
        //通过Ajax获取数据
        $.ajax({
            type : "post",
            async : false, //同步执行
            url : "/hotspots/index.php/Home/Index/<?php echo ($ajaxdataserver); ?>",
            data : {},
            dataType : "json", //返回数据形式为json
            success : function(result) {
                if (result) {
                    tempdata = JSON.parse(result)['data'];
                    options.series[0].data = convertData(tempdata);
                    options.series[1].data = convertData(tempdata.sort(function (a, b) {
                        return b.value - a.value;
                    }).slice(0, 5));
                    myChart.hideLoading();
                    myChart.setOption(options);
                }
            },
            error : function(errorMsg) {
                alert("图表请求数据失败!");
                myChart.hideLoading();
            }
        });
    }

    option = {
        roam:true,
        backgroundColor: '#404a59',
        title: {
            text: '全国主要城市流量显示',
            x:'center',
            textStyle: {
                color: '#fff'
            }
        },
        tooltip: {
            trigger: 'item',
            formatter: function (params) {
                return params.name + ' : ' + params.value[2];
            }
        },
        legend: {
            orient: 'vertical',
            y: 'bottom',
            x:'right',
            data:['流量'],
            textStyle: {
                color: '#fff'
            }
        },
        dataRange: {
            min: 0,
            max: 200,
            calculable: true,
            color: ['#d94e5d','#eac736','#50a3ba'],
            textStyle: {
                color: '#fff'
            }
        },
        geo: {
            map: 'china',
            label: {
                emphasis: {
                    show: false
                }
            },
            itemStyle: {
                normal: {
                    areaColor: '#323c48',
                    borderColor: '#111'
                },
                emphasis: {
                    areaColor: '#2a333d'
                }
            }
        },
        series: [
            {
                name: '流量',
                type: 'scatter',
                coordinateSystem: 'geo',
                symbolSize: function (val) {
                    return val[2] / 10;
                },
                label: {
                    normal: {
                        formatter: '{b}',
                        position: 'right',
                        show: false
                    },
                    emphasis: {
                        show: true
                    }
                },
                itemStyle: {
                    normal: {
                        color: '#ddb926'
                    }
                }
            },
            {
                name: 'Top 5',
                type: 'effectScatter',
                coordinateSystem: 'geo',

                symbolSize: function (val) {
                    return val[2] / 10;
                },
                showEffectOn: 'render',
                rippleEffect: {
                    brushType: 'stroke'
                },
                hoverAnimation: true,
                label: {
                    normal: {
                        formatter: '{b}',
                        position: 'right',
                        show: true
                    }
                },
                itemStyle: {
                    normal: {
                        color: '#f4e925',
                        shadowBlur: 10,
                        shadowColor: '#333'
                    }
                },
                zlevel: 1
            }
        ]
    };


    myChart.setOption(option, true);
    myChart.hideLoading();
    getChartData();//aja后台交互

    myChart.on('click',function (param) {
        layer.open({
            type: 1,
            title:'详细信息',
            skin: 'layui-layer-rim', //加上边框
            area: ['420px', '240px'], //宽高
            content: "<div style='padding:20px'>"+ param.name+' : '+param.value[2]+"</div>"
        });
    });

</script>


    </div>
</td>
</body>
</html>