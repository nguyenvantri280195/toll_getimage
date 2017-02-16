  @extends('master')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>User</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form id="demo-form2" action="/admin/user/edit/{{$user->id}}" method= "POST" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
             @if(count($errors) > 0)
              <div class="alert alert-danger">
                <ul>
                  @foreach($errors->all() as $error)
                    <li class="list-inline">{!! $error !!}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="username"  name="username" value="{{$user->name}}" disabled="" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Password</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="password" id="password" name="password"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">RePassword</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="rePassword" class="form-control col-md-7 col-xs-12" type="password" name="rePassword">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="email" class="date-picker form-control col-md-7 col-xs-12" value="{{$user->email}}"  name="email" type="email">
                </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">User level</label>
                  <label class="radio-inline">
                      <input name="rdoLevel" value="1"  type="radio" 
                        @if($user->level ==1)
                        checked="checked" 
                        @endif
                      >Admin
                  </label>
                  <label class="radio-inline">
                      <input name="rdoLevel" value="2" type="radio"
                        @if($user->level==2)
                        checked="checked" 
                        @endif
                      >Member
                  </label>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button class="btn btn-primary" type="button">Cancel</button>
                  <button class="btn btn-primary" type="reset">Reset</button>
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
@endsection

