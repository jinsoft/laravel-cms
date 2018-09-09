<div class="layui-side-scroll">
    <div class="layui-logo" lay-href="{{route('admin.dashboard')}}">
        <span>LavarelCMS</span>
    </div>

    <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu"
        lay-filter="layadmin-system-side-menu">
        <li data-name="home" class="layui-nav-item layui-nav-itemed">
            <a href="javascript:;" lay-tips="主页" lay-direction="2">
                <i class="layui-icon layui-icon-home"></i>
                <cite>资源总览</cite>
            </a>
            <dl class="layui-nav-child">
                <dd data-name="console" class="layui-this">
                    <a lay-href="{{route('admin.dashboard')}}">控制台</a>
                </dd>
                <dd data-name="console">
                    <a lay-href="home/homepage1.html">主页一</a>
                </dd>
            </dl>
        </li>
        <li data-name="message" class="layui-nav-item">
            <a href="javascript:;" lay-tips="内容" lay-direction="2">
                <i class="layui-icon layui-icon-read"></i>
                <cite>内容</cite>
            </a>
            <dl class="layui-nav-child">
                <dd><a lay-href="{{route('article.index')}}">文章列表</a></dd>
                <dd><a lay-href="{{route('category.index')}}">分类管理</a></dd>
                <dd><a lay-href="{{route('comment.index')}}">评论管理</a></dd>
                <dd><a lay-href="{{route('tag.index')}}">标签管理</a></dd>
            </dl>
        </li>
        <li data-name="app" class="layui-nav-item">
            <a href="javascript:;" lay-tips="资讯系统" lay-direction="2">
                <i class="layui-icon layui-icon-app"></i>
                <cite>资讯系统</cite>
            </a>
            <dl class="layui-nav-child">
                <dd data-name="forum">
                    <a href="javascript:;">社区系统</a>
                    <dl class="layui-nav-child">
                        <dd data-name="list"><a lay-href="app/forum/list.html">帖子列表</a></dd>
                        <dd data-name="replys"><a lay-href="app/forum/replys.html">回帖列表</a></dd>
                    </dl>
                </dd>
                <dd data-name="workorder">
                    <a lay-href="app/workorder/list.html">工单系统</a>
                </dd>
            </dl>
        </li>
        <li data-name="message" class="layui-nav-item">
            <a href="javascript:;" lay-tips="消息中心" lay-direction="2">
                <i class="layui-icon layui-icon-notice"></i>
                <cite>消息中心</cite>
            </a>
            <dl class="layui-nav-child">
                <dd data-name="console">
                    <a lay-href="{{route('admin.message')}}">消息管理</a>
                </dd>
                <dd data-name="console">
                    <a lay-href="{{route('admin.message')}}">我的消息</a>
                </dd>
            </dl>
        </li>
        <li data-name="senior" class="layui-nav-item">
            <a href="javascript:;" lay-tips="高级" lay-direction="2">
                <i class="layui-icon layui-icon-senior"></i>
                <cite>高级</cite>
            </a>
            <dl class="layui-nav-child">
                <dd>
                    <a layadmin-event="im">LayIM 通讯系统</a>
                </dd>
                <dd data-name="echarts">
                    <a href="javascript:;">Echarts集成</a>
                    <dl class="layui-nav-child">
                        <dd><a lay-href="senior/echarts/line.html">折线图</a></dd>
                        <dd><a lay-href="senior/echarts/bar.html">柱状图</a></dd>
                        <dd><a lay-href="senior/echarts/map.html">地图</a></dd>
                    </dl>
                </dd>
            </dl>
        </li>
        <li data-name="user" class="layui-nav-item">
            <a href="javascript:;" lay-tips="用户" lay-direction="2">
                <i class="layui-icon layui-icon-user"></i>
                <cite>用户</cite>
            </a>
            <dl class="layui-nav-child">
                <dd>
                    <a lay-href="user/user/list.html">网站用户</a>
                </dd>
                <dd>
                    <a lay-href="user/administrators/list.html">后台管理员</a>
                </dd>
                <dd>
                    <a lay-href="user/administrators/role.html">角色管理</a>
                </dd>
            </dl>
        </li>
        <li data-name="set" class="layui-nav-item">
            <a href="javascript:;" lay-tips="设置" lay-direction="2">
                <i class="layui-icon layui-icon-set"></i>
                <cite>设置</cite>
            </a>
            <dl class="layui-nav-child">
                <dd class="layui-nav-itemed">
                    <a href="javascript:;">系统设置</a>
                    <dl class="layui-nav-child">
                        <dd><a lay-href="set/system/website.html">网站设置</a></dd>
                        <dd><a lay-href="{{route('admin.setting.smtp')}}">邮件服务</a></dd>
                    </dl>
                </dd>
                <dd class="layui-nav-itemed">
                    <a href="javascript:;">我的设置</a>
                    <dl class="layui-nav-child">
                        <dd><a lay-href="{{route('admin.setting.info')}}">基本资料</a></dd>
                        <dd><a lay-href="set/user/password.html">修改密码</a></dd>
                    </dl>
                </dd>
            </dl>
        </li>
        <li data-name="get" class="layui-nav-item">
            <a href="javascript:;" lay-href="//www.layui.com/admin/#get" lay-tips="授权" lay-direction="2">
                <i class="layui-icon layui-icon-auz"></i>
                <cite>授权</cite>
            </a>
        </li>
    </ul>
</div>