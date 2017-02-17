<?php

namespace App\Http\Controllers;
/*use Illuminate\Database\Eloquent\Model;*/
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Link;
use App\Folder;

class LinkController extends Controller
{
    public function getList(){
        
        $data= Link::select('name','link','status','id')->where('user_id', Auth::user()->id)->orderBy('id','DESC')->get()->toArray();
        return view('/link/link',compact('data'));
    }
    /*public function getDowloadDetail($id){
        $idhinhanh = Link::find($id);
        $idhinhanh->status=1;
        $idhinhanh->save();
        $link =  Link::find($id);
        $linkhinh = $link->link;
        $name = $link->name;
        $data= Link::select('name')->where('name',$name)->get()->toArray();
        $url='hinhanh/'.$name.'.jpg';
        if(file_exists($url)){
            $url = $linkhinh;
            $img_path ='hinhanh/'.$name.rand (1 , 10000 ).'.jpg';
            if(file_exists($img_path)){
                $img_path ='hinhanh/'.$name.rand (10001 , 100000 ).'.jpg';
            }
            $content = file_get_contents($url);
            file_put_contents($img_path, $content);
        }else{
            $url = $linkhinh;
            $img_path ='hinhanh/'.$name.'.jpg';
            $content = file_get_contents($url);
            file_put_contents($img_path, $content);
        }
        return redirect('/admin/link/list')->with(['flash_level'=>'success','flash_message'=>'Lưu ảnh thành công']);
    }*/
    public function postSave(Request $request)
    {
        $this->validate($request, 
            [
                'thumuc' => 'required'
            ],
            [
                'thumuc.required' => 'Bạn chưa chọn thư mục lưu'
            ]);
        $idlink = $request->iddel;
        $idfolder = $request->thumuc;
        if(count($idlink) > 0){
            $folder = Folder::find($idfolder);
            $anhtrung = 0;
            $anhluu = 0;
            if($folder->link_id != null)
            {
                foreach($idlink as $key=>$value)
                {
                    $link= Link::find($value);
                    $link->status=1;
                    $link->save();
                    $mang = explode(',', $folder->link_id);
                    $bien =  in_array($value, $mang);
                    if($bien == 1)
                    {
                        $anhtrung++;
                    } else {
                        $anhluu++;
                        $chuoi = $folder->link_id;
                        $chuoi2 = rtrim($chuoi, ",");
                        $folder->link_id = $chuoi2.",".$value;
                        $folder->save(); 
                    }
                } 
                $folder->link_id = $folder->link_id.",";
                $folder->save();
            } else{    
                foreach($idlink as $key=>$value)
                {
                    $anhluu++;
                    $folder->link_id = $folder->link_id.$value.",";
                    $folder->save();
                }
            }
            $soanhluu = "Lưu thành công ".$anhluu." ảnh vào thư mục <b>".$folder->name."</b>";
            return redirect('/admin/link/list')->with(['flash_level'=>'success','flash_message'=>$soanhluu, 'anhtrung'=>$anhtrung]);
        }else if(count($idlink)==0){
            return redirect('/admin/link/list')->with(['flash_level'=>'danger','flash_message'=>'Bạn chưa chọn ảnh']);
        }
    }
}