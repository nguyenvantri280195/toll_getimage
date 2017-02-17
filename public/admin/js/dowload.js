
 $(function(){	
 	 $('.taive').click(function(e){ 
      e.preventDefault();
      var link = $(this).attr('href');
      var name = $(this).attr('data-name');
      var a  = document.createElement('a'); 
       a.href = link;
       a.download = name+'.png';
       a.click();
       a.remove();
    });
});
 $(function(){	
 	 $('.dowloadall').click(function(e){ 
      e.preventDefault();
      var link = $(this).attr('href');
      var name = $(this).attr('data_name');
      var a  = document.createElement('a'); 
      /* a.href = link;
       a.download = name+'.png';
       a.click();
       a.remove();*/
    });
});
