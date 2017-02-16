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
    	$data= Folder::select('link_id')->where('user_id',$iduser)->where('id',$id)->get();
    	foreach ($data as $key => $value) {
            $id_link1 = explode(',', $value['link_id']);
            $mang['link'] = array();
            for($i=0;$i<count($id_link1)-1;$i++){
                $link = Link::find($id_link1[$i]);
                $mang['link'][$i]['id'] = $link->id;
                $mang['link'][$i]['name'] = $link->name;
                $mang['link'][$i]['link'] = $link->link;
            }
    	}
        return view('folder.folder', ['link'=>$mang, 'idthumuc'=>$id]);	
    }
    public function postDownload($id,Request $request){
		$idlink = $request->iddel;
        if(count($idlink) > 0){
            foreach ($idlink as $key => $value) {  
            	$link = Link::find($value);
                // $content = file_get_contents($link->link);
                // file_put_contents($link->name.".jpg", $content);
               	?>
                <script type="text/javascript">
                  var a  = document.createElement('a'); 
                  a.href = '<?php echo $link->link;?>';   
                  a.download = 'image.png';
                  a.click();
                </script> 
                <?php
            }
        return redirect('/admin/folder/list/'.$id)->with(['flash_level'=>'success','flash_message'=>'Bạn đã lưu ảnh thành công']); 
        }else if(count($idlink)==0){
            return redirect('/admin/folder/list/'.$id)->with(['flash_level'=>'danger','flash_message'=>'Bạn chưa chọn ảnh']);
        }
    	
    }
    public function Delete($id){
    	
    }
    public function getDanhsach(){
    	$id = Auth::user()->id;
    	$nameFolder = Folder::select('name')->where('user_id',$id)->get()->toArray();
    	return view('/folder/list',compact('nameFolder'));
    }
   }
