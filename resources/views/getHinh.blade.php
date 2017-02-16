@extends('master')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Tool lấy hình</h2>
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
            <form  class="form-horizontal form-label-left" action="get" method="post">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Link</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="link" name="link" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button class="btn btn-primary" type="button">Cancel</button>
				          <button class="btn btn-primary" type="reset">Reset</button>
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </form>
            @if(Session('img'))
              @foreach(Session('img') as $key=>$val)
                @foreach ($val as $value) 
                  <img src="{{$value['link']}}" title="{{$value['ten']}}" width="150px" height="100px" style="padding: 2px;">
                @endforeach
              
              @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
@endsection

