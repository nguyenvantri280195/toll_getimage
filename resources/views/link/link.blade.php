@extends('master')
@section('content')
  <div class="right_col" role="main">
    <div class="">
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Danh sách tìm kiếm</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
             <form id="demo-form2" action="/admin/link/save" method= "post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
             <input type="hidden" name="_token" value="{!! csrf_token() !!}">
             @if(count($errors) > 0)
                <div class="alert alert-danger">
                  <ul>
                    @foreach($errors->all() as $error)
                      <li class="list-inline">{!! $error !!}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              <div class='col-lg-12'>
               @if(Session::has('flash_message'))
                <div class='alert alert-{!! Session::get('flash_level')!!}' >
                    {!! Session::get('flash_message')!!}
                </div>
               @endif
              </div>
              @if(session('anhtrung'))
                <div class='col-lg-12'>
                  <div class="alert alert-error">
                    <span style="font-weight: bold;">
                      Có {{ session('anhtrung') }} ảnh bị trùng.
                    </span>
                  </div>
                </div>
              @endif
              <table style="z-index:-1;"  id="datatable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th style="text-align:center;">STT</th>
                    <th style="text-align:center;" width="400px">Tên hình ảnh</th>
                    <th style="text-align:center;">Hình ảnh</th>
                    <th style="text-align:center;">Trạng thái</th>
                    <th style="text-align:center;">Chọn</th>
                  </tr>
                </thead>


                <tbody>
                <?php $i =0; ?>
                @foreach($data as $Item)
                  <?php $i++;?> 
                  <tr>
                    <td style="text-align:center;" >{{$i}}</td>
                    <td>{{$Item['name']}}</td>
                    <td class="zoomhinh" align="center"><img src="{{$Item['link']}}"  style="width: 70px;height: 90px;"  alt=""></td>
                    @if($Item['status']==1)
                      <td style="text-align:center;">Đã lưu</td>
                    @else
                    <td style="text-align:center;">Chưa lưu</td>
                    @endif
                    <td style="text-align:center;"><input type="checkbox" class ="item download" name="iddel[]" value="{{$Item['id']}}"></td>
                  </tr>
                  @endforeach
                </tbody>
                  <label>Chọn tất cả</label>
                  <input type="checkbox" style="margin-left: 10px;" onclick="checkall('item',this)" name="chk" align="center" class="chkall dowload" value="">
                  
                  <div id="dowload">
                    <button type="button" class="btn btn-success" data-target="#stack1" data-toggle="modal">Lưu vào thư mục</button>
                  </div>
                </div>
              </table>
              <!-- /.modal -->
              <div id="stack1" class="modal fade bs-modal-sm" tabindex="-1" data-width="400">
                  <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                              <h4 class="modal-title" align="center">Thư mục lưu</h4>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-md-12">
                                      <h4>Chọn thư mục lưu</h4>
                                      <p>
                                          <select name="thumuc" id="listthumuc" class="col-md-12 form-control">
                                          <?php 
                                            $iduser = Auth::user()->id;
                                            $tm = DB::table('folder')->where('user_id', $iduser)->get();
                                            foreach($tm as $ds)
                                              {
                                                  echo "<option value='".$ds->id."'>".$ds->name."</option>";
                                              }
                                          ?>
                                          </select>
                                      </p>

                                  </div>
                              </div>
                              <a class="btn btn-success" data-toggle="modal" href="#stack2" style="margin-top:20px;"> Tạo thư mục mới </a>
                              
                          </div>
                          <div class="modal-footer">
                              <button type="button" data-dismiss="modal" class="btn btn-primary btn-outline">Đóng</button>
                              <button type="submit" class="btn btn-success">Lưu</button>
                          </div>
                      </div>
                  </div>
              </div>
              <div id="stack2" class="modal fade bs-modal-sm" tabindex="-1">
                  <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                              <h4 class="modal-title">Tạo mới thư mục</h4>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-md-12">
                                      <h4>Tên thư mục</h4>
                                      <p><input type="text" class="col-md-12 form-control" id="tenthumuc"> </p>
                                  </div>
                                  <div class="col-md-12" id="tontai"></div>
                              </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" data-dismiss="modal" id="close2" class="btn btn-primary btn-outline">Đóng</button>
                              <button type="button" class="btn btn-success" id="create">Tạo</button>
                          </div>
                      </div>
                  </div>
              </div>
              </form>
            </div>
          </div>
        </div>
@endsection