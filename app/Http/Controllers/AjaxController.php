<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Folder;

class AjaxController extends Controller
{
    //
    public function getSoTrang($idtrang, $sotrang)
    {
    	for($i = $idtrang; $i <=$sotrang; $i++)
    	{
    		echo "<option value='".$i."'>".$i."</option>";
    	}
    }
    //Tạo thư mục mới
    public function TaoThuMuc($tenthumuc)
    {
        $iduser = Auth::user()->id;
        $demtrung = Folder::where('user_id', $iduser)->where('name', $tenthumuc)->count(); 
        if($demtrung > 0) {
            return "Thư mục đã tồn tại";
        } else {
            $folder = new Folder;
            $folder->name = $tenthumuc;
            $folder->user_id = $iduser;
            $folder->save();
            return null;
        }
    }

    //Lấy danh sách thư mục
    public function ListThuMuc()
    {
        $iduser = Auth::user()->id;
        $list = Folder::where('user_id', $iduser)->orderBy('created_at', 'DESC')->get();
        foreach($list as $ds)
        {
            echo "<option value='".$ds->id."'>".$ds->name."</option>";
        }
    }
}
