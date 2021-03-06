<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;
use Illuminate\Support\Facades\Auth;
class ToolController extends Controller
{
    function getSearch()
    {
    	return view('search');
    }
    function postSearch(Request $request)
    {
    	function curl_get_contents($url)
		{
		  $ch = curl_init($url);
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		  $data = curl_exec($ch);
		  curl_close($ch);
		  return $data;
		}
		$this->validate($request, 
    		[
    			'keywork' => 'required|regex:/^[a-zA-Z0-9 ]*$/'
    		],
    		[
    			'keywork.required' => 'Bạn chưa nhập từ khoá',
    			'keywork.regex' => 'Chỉ cho phép ký tự là số hoặc chữ không dấu',
    		]
    	);
    	$keywork = $request->keywork;

    	$keywork1 = str_replace(" ", "+", $keywork);
    	$keywork2 = $keywork1."+shirt";
    	$link = "http://www.redbubble.com/shop/".$keywork2;
    	$sortby = $request->sortby;
    	if($sortby != "")
    	{
    		$link = "http://www.redbubble.com/shop/".$sortby."+".$keywork2;
    	}
    	$content = curl_get_contents($link);
    	$loi = strpos($content, "no-results");
    	if($loi != false)
    	{
    		return redirect('/admin/getimage/search')->with(['keywork'=>$keywork, 'sortby'=>$sortby, 'loi'=>$loi]);
    	}
    	set_time_limit(60);

    	//Lấy danh sách hình ảnh
		$dom = new \DOMDocument;
		@$dom->loadHTML($content);
		$dem=0;
		$mang['hinhanh']=array();
		foreach($dom->getElementsByTagName('a') as $node)
		{
			$hinh= $node->getAttribute('data-lazyload-bg-src');
			if(strlen($hinh) > 1)
			{
				$dem++;
    			$test = strstr($hinh, "http");
    			$test2 = trim($test, ";");
    			$test3 = trim($test2, ")");
    			$test4 = str_replace('220x294','750x1000',$test3);
    			$test5 = str_replace('300x400','750x1000',$test4);
    			$tieude = $node->getAttribute('title');
    			$tenanh = preg_replace('/[^a-zA-Z0-9 ]/','', $tieude);
    			$tenanh1 = $tenanh.".jpg";
    			$mang['hinhanh'][$dem]['ten']=$tenanh1;
				$mang['hinhanh'][$dem]['link']=$test5;
			}
		}

    	//Lấy số kết quả tìm được
    	$dem = strpos($content, "subtle");
    	$chuoi = trim(substr($content, $dem+8, 20));
    	$chuoi2 = strstr($chuoi, " Results", true);
    	$chuoi3 = str_replace(",", "", $chuoi2);
    	$result = (int)$chuoi3;
    	
    	return redirect('/admin/getimage/search')->with(['ketqua'=>$result, 'link'=>$link,'keywork'=>$keywork,'img'=>$mang,'sortby'=>$sortby]);

    }
    function postGetSearch(Request $request)
    {
    	
    	$link = $request->link;
    	$sortby = $request->sortby;
    	$keywork = $request->keywork;
    	$ketqua = $request->ketqua;
    	$trangbatdau = $request->trangbatdau;
    	$trangketthuc = $request->trangketthuc;
		$dem = 0;	
		$demanhluu=0;
		$demanhtrung=0;
		$array['demloi']=array();
		$mang['hinhanh']=array();
		for($i=$trangbatdau; $i<=$trangketthuc;$i++){
			$link1 = $link."?&page=".$i;
			$str = file_get_contents($link1);
			$dom = new \DOMDocument;
			@$dom->loadHTML($str);
			set_time_limit(100);
			foreach($dom->getElementsByTagName('a') as $node)
			{
				$hinh= $node->getAttribute('data-lazyload-bg-src');
				if(strlen($hinh) > 1)
				{
					$dem++;
	    			$test = strstr($hinh, "http");
	    			$test2 = trim($test, ";");
	    			$test3 = trim($test2, ")");
	    			$test4 = str_replace('220x294','750x1000',$test3);
	    			$test5 = str_replace('300x400','750x1000',$test4);
	    			$tieude = $node->getAttribute('title');
	    			$tenanh = preg_replace('/[^a-zA-Z0-9 ]/','', $tieude);
	    			$tenanh1 = $tenanh.".jpg";

	    			//Lấy tên ảnh để lưu
	    			$tenanhluu = str_replace("TShirt", "", $tenanh);

	    			//Xử lý trùng link trước khi lưu
	    			$error = Link::where('link', $test5)->first();
	    			if($error)
	    			{
	    				$demanhtrung++;
	    				$array['demloi'][$demanhtrung]['ten']=$error->name;
						$array['demloi'][$demanhtrung]['link']=$error->link;
	    			}
	    			else
	    			{
	    				$demanhluu++;
	    				$dblink = new Link;
		    			$dblink->link = $test5;
		    			$dblink->name = $tenanhluu;
		    			$dblink->user_id = Auth::user()->id;
		    			$dblink->save();
	    			}
	    			

				}
			}
		}



		return redirect('/admin/getimage/search')->with(['soanhluu'=>$demanhluu, 'soanhtrung'=>$demanhtrung, 'anhtrung'=>$array,'link'=>$link,'ketqua'=>$ketqua, 'keywork'=>$keywork,'sortby'=>$sortby]);
	}
}