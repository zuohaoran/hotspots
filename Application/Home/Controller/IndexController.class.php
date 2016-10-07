<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function showCompanyValue()
    {
    // $base = date("Y-m-d",strtotime("2005-08-04"));
        $data = [];
        $date= [];

    //for ($i = 0; $i < 20; $i++)
    //{
    // $base = date("Y-m-d", strtotime("$base +1 days"));
    //   array_push($date,$base);
    //  array_push($data, mt_rand(5, 15));
    // }

    //$this->ajaxReturn(json_encode(array('date'=>$date, 'data'=>$data)));
    }

    public function showChinaMapHotspots()
    {
        $result = array(
            'data' => [
                [name=> "清华大学", value=>300],
                [name=> "北京大学", value=>400],
                [name=> "北京邮电大学", value=> 79],
                [name=> "天津", value=> 105],
                [name=> "石家庄", value=> 147],
                [name=> "太原", value=> 39],
                [name=> "呼和浩特", value=> 58],
                [name=> "西安", value=> 61],
                [name=> "西宁", value=> 57],
                [name=> "兰州", value=> 99],
                [name=> "银川", value=> 52],
                [name=> "乌鲁木齐", value=> 84],
                [name=> "成都", value=> 58],
                [name=> "重庆", value=> 66],
                [name=> "昆明", value=> 39],
                [name=> "贵阳", value=> 71],
                [name=> "拉萨", value=> 24],
                [name=> "广州", value=> 38],
                [name=> "桂林", value=> 59],
                [name=> "南宁", value=> 37],
                [name=> "海口", value=> 44],
                [name=> "深圳", value=> 41],
                [name=> "武汉", value=> 273],
                [name=> "长沙", value=> 175],
                [name=> "郑州", value=> 113],
                [name=> "南京", value=> 67],
                [name=> "合肥", value=> 229],
                [name=> "济南", value=> 92],
                [name=> "青岛", value=> 18],
                [name=> "上海", value=> 25],
                [name=> "杭州", value=> 84],
                [name=> "南昌", value=> 54],
                [name=> "福州", value=> 29],
                [name=> "厦门", value=> 26],
                [name=> "沈阳", value=> 50],
                [name=> "大连", value=> 47],
                [name=> "长春", value=> 51],
                [name=> "哈尔滨", value=> 114],
                ]);
        $this->ajaxReturn(json_encode($result));
    }

    public function index()
    {
        $this->assign('title',"全国主要城市市流量显示");
        $this->assign('ajaxdataserver',"showChinaMapHotspots");
        $this->assign('navigation_bar_number',0);
        $this->display(); // 输出模板
    }

    public function company()
    {
        $base = date("Y-m-d",strtotime("2005-08-04"));
        $data = [];
        $date= [];

        for ($i = 0; $i < 20; $i++)
        {
            $base = date("Y-m-d", strtotime("$base +1 days"));
            array_push($date,$base);
            array_push($data, mt_rand(5, 15));
        }

//        $this->ajaxReturn(json_encode(array('date'=>$date, 'data'=>$data)));

        $this->assign('data',json_encode(array('date'=>$date, 'data'=>$data)));

        $this->assign('title',"各公司流量显示");
        $this->assign('ajaxdataserver',"showCompanyValue");
        $this->assign('navigation_bar_number',1);
        $this->display(); // 输出模板
    }
}