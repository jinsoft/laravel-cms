@extends('admin.layouts.base')

@section('content')
    <div class="layui-card">
        <div class="layui-form layui-card-header layuiadmin-card-header-auto">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">分类</label>
                    <div class="layui-input-inline">
                        <select name="category_id">
                            <option value="">请选择类别</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">标题</label>
                    <div class="layui-input-inline">
                        <input type="text" name="title" placeholder="请输入" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <button class="layui-btn layuiadmin-btn-list" lay-submit lay-filter="search">
                        <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="layui-card-body">
            <div style="padding-bottom: 10px;">
                <button class="layui-btn layuiadmin-btn-list" data-type="batchdel">删除</button>
                <button class="layui-btn layuiadmin-btn-list" data-type="add">添加</button>
            </div>
            <table id="dateTable" lay-filter="dateTable"></table>
            <script type="text/html" id="category">
                @{{d.category.name}}
            </script>
            <script type="text/html" id="buttonTpl">
                <button class="layui-btn layui-btn-xs">已发布</button>
                <button class="layui-btn layui-btn-primary layui-btn-xs">待修改</button>
            </script>
            <script type="text/html" id="table-content-list">
                <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i
                            class="layui-icon layui-icon-edit"></i>编辑</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i
                            class="layui-icon layui-icon-delete"></i>删除</a>
            </script>
        </div>
    </div>
@endsection


@section('script')
    <script>
        layui.use(['layer', 'table', 'form'], function () {
            var table = layui.table
                , form = layui.form
                , layer = layui.layer;

            var dataTable = table.render({
                elem: '#dateTable'
                , url: "{{route('admin.article.data')}}"
                , limit: 15
                , limits: [15, 30, 50, 100]
                , cols: [[
                    {
                        type: "checkbox",
                        fixed: "left"
                    }, {
                        field: "id",
                        width: 50,
                        title: "文章ID",
                        sort: true
                    }, {
                        field: 'name',
                        title: '类别',
                        width: 200,
                        toolbar: '#category'
                    }, {
                        field: "title",
                        title: "文章标题",
                        width: 350
                    }, {
                        field: "created_at",
                        title: "创建时间",
                        sort: true
                    }, {
                        field: "updated_at",
                        title: "更新时间",
                        sort: true
                    }, {
                        field: "status",
                        title: "发布状态",
                        templet: "#buttonTpl",
                        minWidth: 80,
                        align: "center"
                    }, {
                        title: "操作",
                        minWidth: 150,
                        align: "center",
                        fixed: "right",
                        toolbar: "#table-content-list"
                    }
                ]]
                , page: true
                , defaultToolbar: ['filter', 'print']
            });
            //监听搜索
            form.on('submit(search)', function (data) {
                var field = data.field;
                console.log(field.title);
                dataTable.reload({
                    where: {category_id: field.category_id, title: field.title},
                    page: {curr: 1}
                });
                //执行重载
                table.reload('LAY-app-content-list', {
                    where: field
                });
            });

            var $ = layui.$, active = {
                batchdel: function () {
                    var checkStatus = table.checkStatus('dateTable')
                        , checkData = checkStatus.data; //得到选中的数据

                    if (checkData.length === 0) {
                        return layer.msg('请选择数据');
                    }

                    layer.confirm('确定删除吗？', function (index) {

                        //执行 Ajax 后重载
                        /*
                        admin.req({
                          url: 'xxx'
                          //,……
                        });
                        */
                        table.reload('LAY-app-content-list');
                        layer.msg('已删除');
                    });
                },
                add: function () {
                    layer.open({
                        type: 2
                        , title: '添加文章'
                        , content: 'listform.html'
                        , maxmin: true
                        , area: ['550px', '550px']
                        , btn: ['确定', '取消']
                        , yes: function (index, layero) {
                            //点击确认触发 iframe 内容中的按钮提交
                            var submit = layero.find('iframe').contents().find("#layuiadmin-app-form-submit");
                            submit.click();
                        }
                    });
                }
            };

            $('.layui-btn.layuiadmin-btn-list').on('click', function () {
                var type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });

        });
    </script>

@endsection