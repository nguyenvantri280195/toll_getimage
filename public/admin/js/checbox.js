function checkall(class_name, obj) {
		//dduyệt ưa các chexbox có class = class_name(item)
		//trả về mảng bắt đau từ 0
		var items = document.getElementsByClassName(class_name);
		if(obj.checked == true) //đã được chọn	
		{
			for(i=0; i<items.length; i++)
				items[i].checked = true;
		}else{
			for(i=0; i<items.length; i++)
				items[i].checked = false;
		}
	}