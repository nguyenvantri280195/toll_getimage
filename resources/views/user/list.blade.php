@extends('master')
@section('content')
  <div class="right_col" role="main">
    
    <div class="">
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
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
            <div class="x_title">
              <h2>Users</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <table id="datatable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Delete</th>
                    <th>Edit</th>
                  </tr>
                </thead>


                <tbody>
                @foreach($user as $item)
                  <tr>
                    <td>{{$item['id']}}</td>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['email']}}</td>
                    @if($item['level']==1)
                    <td>Admin</td>
                    @else
                    <td>Member</td>
                    @endif
                    <td><a href="/admin/user/delete/{{$item['id']}}">Delete</a></td>
                    <td><a href="/admin/user/edit/{{$item['id']}}">Edit</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
@endsection
       