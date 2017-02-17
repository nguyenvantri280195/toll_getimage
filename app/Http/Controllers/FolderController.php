<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Link;
use App\Folder;

class FolderController extends Controller
{
   public function getList($id){
        $iduser = Auth::user()->id;
        $data = Folder::where('user_id',$iduser)->where('id',$id)->orderBy('id','DESC')->first();
        if($data->link_id == null){
            return view('folder.folder', ['nullvalue'=>"Không có ảnh nào.", 'idthumuc'=>$id,'tenthumuc'=>$data->name]);
        } else {
            $id_link = rtrim($data->link_id, ",");
            $id_link1 = explode(',', $id_link);
            $mang['link'] = array();
            for($i=0;$i<count($id_link1);$i++){
                $link = Link::find($id_link1[$i]);
                $mang['link'][$i]['id'] = $link->id;
                $mang['link'][$i]['name'] = $link->name;
                $mang['link'][$i]['link'] = $link->link;
            }
            return view('folder.folder', ['link'=>$mang, 'idthumuc'=>$id,'tenthumuc'=>$data->name]);
        }
    }
    public function postDownload($id,Request $request){
       if($request->downloadsm==1){

            $link = "http://ih1.redbubble.net/image.146799531.8876/raf,750x1000,075,f,dd2121:8219e99865.2u2.jpg";
            $data = file_get_contents($link);
            $im = imagecreatefromstring($data);
            if ($im !== false) {
                header('Content-Type: image/png');
                imagepng($im);
                imagedestroy($im);
            }
            else {
                echo 'An error occurred.';
            }
            var_dump($data);die;
                
       }elseif($request->deletesm ==2){
            $idlink = $request->iddel;
            $folder = Folder::find($id);
            if(count($idlink) > 0){
                foreach ($idlink as $key => $value) { 
                    $linkid = $folder->link_id;
                    $linkid1 = $value.",";
                    $linkid2 = str_replace($linkid1, "", $linkid);
                    $folder->link_id = $linkid2;
                    $folder->save();
                }
                return redirect('/admin/folder/list/'.$id)->with(['flash_level'=>'success','flash_message'=>'Xoá ảnh thành công']);
            } else {
                return redirect('/admin/folder/list/'.$id)->with(['flash_level'=>'success','flash_message'=>'Bạn chưa chọn ánh']);
            }
       }else{
            echo "Lỗi";
       }
        
    }
    public function getDanhsach(){
    	$id = Auth::user()->id;
    	$nameFolder = Folder::select('name','id')->where('user_id',$id)->get()->toArray();
    	return view('/folder/list',compact('nameFolder'));
    }
    public function DownloadDetail($idlink){

        $link=Link::find($idlink);
        $link = "$link->link";
        $data = file_get_contents($link);
        $im = imagecreatefromstring($data);
        if ($im !== false) {
            header('Content-Type: image/png');
            imagepng($im);
            imagedestroy($im);
        }
        else {
            echo 'An error occurred.';
        }
   }
   public function DownloadAll(){

        /*$link=Link::find($idlink);
        $link = "$link->link";
        $data = file_get_contents($link);
        $im = imagecreatefromstring($data);
        if ($im !== false) {
            header('Content-Type: image/png');
            imagepng($im);
            imagedestroy($im);
        }
        else {
            echo 'An error occurred.';
        }*/
   }
}

