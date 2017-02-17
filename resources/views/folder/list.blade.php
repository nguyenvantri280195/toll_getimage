@extends('master')
@section('content')
<style type="text/css" media="screen">
  .checkbox{
    position: relative;
    top: -27px;
    left: 196px;
    width: 22px;
  }
  .namethumuc{
   color: black;
    position: relative;
    right: 91px;
    bottom: -15px;
  }
</style>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
       <form id="demo-form2" action="/admin/folder/download" method= "GET" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
       <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="x_panel">
          <div class="x_title">
            <h2>Danh sách thư mục</h2>
            <div class="clearfix"></div>
          </div>
         <div class="x_content">
             <form id="demo-form2" action="/admin/link/dowload/0" method= "get" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
             <input type="hidden" name="_token" value="{!! csrf_token() !!}">
             <div class="col-md-12">
               @foreach($nameFolder as $item)
                 <div class="col-md-2" style="float: left; margin-bottom: 10px;">
                    <a href="/admin/folder/list/{{$item['id']}}" >
                     <i class="fa fa-folder co" aria-hidden="true" style="font-size: 100px;  color: #E6B100;"></i> 
                    </a>
                    <span class="namethumuc">{{$item['name']}}</span>
                 </div>
               @endforeach
             </div>

          </div>
          
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
@endsection


