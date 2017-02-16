<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Tool Pro</title>

    <!-- Bootstrap -->
    <link href="/asset/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/asset/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/css/custom.min.css" rel="stylesheet">
    <link href="/asset/datatable/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/asset/datatable/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/asset/datatable/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/asset/datatable/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/asset/datatable/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
     <style type="text/css">
       .zoomhinh img:hover{
       -webkit-transform:scale(3.5); /*Webkit: Scale up image to 1.2x original size*/
       -moz-transform:scale(3.5); /*Mozilla scale version*/
       -o-transform:scale(3.5); /*Opera scale version*/
       box-shadow:0px 0px 3px gray; /*CSS3 shadow: 30px blurred shadow all around image*/
       -webkit-box-shadow:0px 0px 3px gray; /*Safari shadow version*/
       -moz-box-shadow:0px 0px 300px gray; /*Mozilla shadow version*/
        opacity: 1;
        margin-top: 40px;
        margin-bottom: 60px;
       }
     </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/admin/getimage/search" class="site_title"><i class="fa fa-paw"></i> <span>Enable StartUp !</span></a>
            </div>
            <div class="clearfix"></div>


            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Quản trị</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Trang chủ <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/admin/getimage/search">Tìm kiếm</a></li>
                      <li><a href="/admin/link/list">Danh sách tìm</a></li>
                    </ul>
                  </li>
                </ul>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-desktop"></i> Người dùng <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/admin/user/list">Danh sách</a></li>
                      <li><a href="/admin/user/add">Thêm</a></li>
                    </ul>
                  </li>
                </ul>
                <ul class="nav side-menu">
                  <li><a href="/admin/folder/danhsach"><i class="fa fa-desktop"></i> Thư mục</a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                @if(isset($userss))
                  <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      Xin chào {{$userss->name}}
                      <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                      <li>
                        <a href="/admin/user/edit/{{$userss->id}}">
                          <span>Cài đặt</span>
                        </a>
                      </li>
                      <li><a href="/logout"><i class="fa fa-sign-out pull-right"></i> Đăng xuất</a></li>
                    </ul>
                  </li>
                @endif
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
        
        <!-- page content -->
        @yield('content')
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Bản quyền thuộc <a href="http://enablestartup.com">Enable StartUp</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="/asset/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/asset/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="/js/custom.min.js"></script>
    <script src="/asset/datatable/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/asset/datatable/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="/asset/datatable/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/asset/datatable/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="/asset/datatable/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="/asset/datatable/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/asset/datatable/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="/asset/datatable/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="/asset/datatable/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="/asset/datatable/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/asset/datatable/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="/asset/datatable/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="/admin/js/myscript.js"></script>
    <script src="/admin/js/checbox.js"></script>
    <script src="/admin/js/dowload.js"></script>
    @if(session('ketqua'))
      <script type="text/javascript">
        $(document).ready(function(){
            $('#TrangBatDau').change(function(){
                var idTheLoai = $(this).val();
                var sotrang = <?php echo $sotrang; ?>;
                $.get('/admin/ajax/getSoTrang/'+idTheLoai+'/'+sotrang, function(data){
                    $('#TrangKetThuc').html(data);
                });
            });
        });
      </script>
    @endif
    <!-- Tạo thư mục mới -->
    <script>
      $(document).ready(function(){
        $('#create').click(function(){
          var tenthumuc = $('#tenthumuc').val();
          var par = /^[a-zA-Z0-9 ]/i;
          if(tenthumuc == "")
          {
            $('#tontai').removeAttr('style');
            $('#tontai').html("Nhập tên thư mục");
            $('#tontai').delay(3000).slideUp();
          }
           else if(/^[a-zA-Z0-9- ]*$/.test(tenthumuc) == false) {
              $('#tontai').removeAttr('style');
              $('#tontai').html("Tên thư mục không được chứa ký tự đặc biệt.");
              $('#tontai').delay(3000).slideUp();
          }
          else{
            $.get('/admin/ajax/taothumuc/'+tenthumuc, function(data){
              if(data.length > 0){
                $('#tontai').removeAttr('style');
                $('#tontai').html(data);
                $('#tontai').delay(3000).slideUp();
              } else{
                $('#close2').click();
                $.get('/admin/ajax/listthumuc', function(data1){
                  $('#listthumuc').html(data1);
                });
              } 
            });
          }
        });
      });
    </script>
    <!-- End tạo mới thư mục -->

    <script type="text/javascript">
        $("div.alert").delay(6000).slideUp();
    </script>
  </body>
</html>
