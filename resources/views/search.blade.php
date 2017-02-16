@extends('master')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Tìm kiếm từ khoá</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
              @if(count($errors) > 0)
        				<div class="alert alert-danger">
        					<ul>
        						@foreach($errors->all() as $error)
        							<li class="list-inline">{!! $error !!}</li>
        						@endforeach
        					</ul>
        				</div>
        			@endif
              @if(session('soanhluu'))
                <div class="alert alert-success">
                  <span style="font-weight: bold;">
                    Đã lưu {{ session('soanhluu') }} ảnh vào database.
                  </span>
                </div>
              @endif
              @if(session('soanhtrung'))
                <div class="alert alert-error">
                  <span style="font-weight: bold;">
                    Có {{ session('soanhtrung') }} ảnh bị trùng.
                  </span>
                </div>
              @endif
              <form  class="form-horizontal form-label-left input_mask" action="search" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group">
                  <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">Tìm </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="keywork" name="keywork" class="form-control col-md-7 col-xs-12" placeholder="Nhập từ cần tìm kiếm" value="@if(session('keywork')){{session('keywork')}}@endif">
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-6">
                    <select name="sortby" id="" class="form-control col-md-7 col-xs-12">
                      <option value="">Most Relevant</option>
                      <option value="recent" @if(session('sortby') && session('sortby') == 'recent') {{ "selected" }}@endif>Recent</option>
                      <option value="top+selling" @if(session('sortby') && session('sortby') == 'top+selling') {{ "selected" }}@endif>Top Selling</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-success" id="search">Tìm kiếm</button>
                </div>
              </form>
              @if(session('loi'))
                <div class="alert-default" style="padding:15px 0;">
                  <span style="font-weight: bold;">
                    Không tìm thấy kết quả phù hợp. Vui lòng kiểm tra lại từ khoá tìm kiếm!
                  </span>
                </div>
              @endif
              @if(session('ketqua'))
                <?php 
                  $soketqua = session('ketqua');
                  $sotrang = ceil($soketqua/96);
                ?>
                <div class="alert-default" style="padding:15px 0;">
                  <span style="font-weight: bold;" id="ser">
                    Tìm thấy {{$soketqua}} kết quả, tương ứng với {{$sotrang}} trang
                  </span>
                </div>
                <div class="col-md-12 col-xs-12">
                  <form  class="form-horizontal form-label-left input_mask" action="getsearch" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="link" value="{{session('link')}}">
                    <input type="hidden" name="sortby" value="{{session('sortby')}}">
                    <input type="hidden" name="keywork" value="{{session('keywork')}}">
                    <input type="hidden" name="ketqua" value="{{session('ketqua')}}">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Chọn số trang cần lấy:</label>
                    <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">Từ
                    </label>
                    <div class="col-md-2 col-sm-2 col-xs-4">
                      <select name="trangbatdau" id="TrangBatDau" class="form-control">
                        @for($i =1; $i <= $sotrang;$i++)
                          <option value="{{$i}}">{{$i}}</option>
                        @endfor
                      </select>
                    </div>
                    <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">Đến
                    </label>
                    <div class="col-md-2 col-sm-2 col-xs-4">
                      <select name="trangketthuc" id="TrangKetThuc" class="form-control">
                        @for($i =1; $i <= $sotrang;$i++)
                          <option value="{{$i}}">{{$i}}</option>
                        @endfor
                      </select>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-4">
                      <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                  </form>
                </div>
                @if(session('img'))
                  <div class="col-md-12 col-xs-12" align="center" style="padding: 20px 0;">
                    <span class="control-label"  style="font-size: 14px; font-weight: bold;">Hình ảnh đại diện cho trang đầu tiên</span>
                  </div>
                  <div class="col-md-12 col-xs-12">
                    @foreach(Session('img') as $key=>$val)
                      @foreach ($val as $value) 
                        <img src="{{$value['link']}}" title="{{$value['ten']}}" width="190px" height="250px" style="padding: 5px;">
                      @endforeach  
                    @endforeach
                  </div> 
                @endif
              @endif
              @if(session('anhtrung'))
                @if(session('soanhtrung'))
                  <div class="col-md-12 col-xs-12" align="center" style="padding: 20px 0;">
                    <span class="control-label"  style="font-size: 14px; font-weight: bold;">Danh sách ảnh bị trùng</span>
                  </div>    
                @endif             
                <div class="col-md-12 col-xs-12">
                  @foreach(Session('anhtrung') as $key=>$val)
                    @foreach ($val as $value) 
                      <img src="{{$value['link']}}" title="{{$value['ten']}}" width="190px" height="250px" style="padding: 5px;">
                    @endforeach  
                  @endforeach
                </div> 
              @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
@endsection

