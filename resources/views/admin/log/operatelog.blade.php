<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Data Tables</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/dist/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/css/dist/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('admin.common.top')
    @include('admin.common.nav')
            <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.common.mbx')

                <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">日志列表</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>编号</th>
                                    <th>管理员</th>
                                    <th>操作地址</th>
                                    <th>操作方法</th>
                                    <th>是否成功</th>
                                    <th>操作描述</th>
                                    <th>操作时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--@foreach($logs as $k=>$log)
                                    <tr>
                                        <td>{{++$k}}</td>
                                        <td>{{$log->username}}</td>
                                        <td>{{$log->url}}</td>
                                        <td>{{$log->method}}</td>
                                        <td>
                                            @if($log->status == 1)成功
                                            @else失败
                                            @endif
                                        </td>
                                        <td>{{$log->description}}</td>
                                        <td>{{date('Y/m/d H:i:s',$log->time)}}</td>
                                        <td>
                                            <a href="#myModal" data-toggle="modal" data-id="{{$log->id}}">删除</a>
                                        </td>
                                    </tr>
                                @endforeach--}}
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('admin.common.bottom')
</div>
<!-- ./wrapper -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">确认删除</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" id="roleid"/>
                您真的要删除吗？
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <a href="#" class="btn btn-primary">删除</a>
            </div>
        </div>
    </div>
</div>

<!-- jQuery 2.2.3 -->
<script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/js/bootstrap/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/js/dist/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/js/dist/demo.js"></script>
<!-- page script -->
<script>
    $(function () {
        $('#myModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);
            modal.find('.modal-footer a').attr('href', '/admin/log/deloperate/' + id);
        });
        $("#example1").DataTable({
            "serverSide": true,
            "processing": true,
            "sort": false,
            "searchable": true,
            "language": {
                "zeroRecords": "没有找到记录",
                "processing": "正在加载数据...",
                "lengthMenu": "每页显示 _MENU_ 条记录",
                "info": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_ 条记录",
                "infoEmpty": "当前显示 0 到 0 条，共 0 条记录",
                "infoFiltered": "(从 _MAX_ 条记录中筛选)",
                "search": "搜索",
                "searchPlaceholder": "管理员",
                "paginate": {
                    "first": "第一页",
                    "previous": " 上一页 ",
                    "next": " 下一页 ",
                    "last": " 最后一页 "
                }
            },
            "ajax": "/admin/log/getOperateData",
            "columns": [
                {"data": "id"},
                {"data": "username"},
                {"data": "url"},
                {"data": "method"},
                {
                    "data": "status",
                    "render": function (data) {
                        return data == 1 ? "成功" : "失败";
                    }
                },
                {"data": "description"},
                {"data": "timestr"},
                {
                    "data": null,
                    "defaultContent": "",
                    "render": function (data, type, row) {
                        return "<a href='#myModal' data-toggle='modal' data-id='" + data.id + "'>删除</a>";
                    }
                }
            ],
        })
    });
</script>
</body>
</html>
