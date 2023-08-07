<!-- navibar -->
<div class="navbar navbar-default navbar-static-top" role="navigation" id="nav">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Hiện menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <h1><a class="header-logo" href="/" title="doc truyen">doc sach</a></h1>
        </div>
        <div class="navbar-collapse collapse" itemscope="" itemtype="http://schema.org/WebSite">
            <meta itemprop="url" content="{{ url('/') }}">
            <ul class="control nav navbar-nav ">
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-list"></i> Danh sách <i class="caret"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('danhsach.truyenmoi') }}" title="Sách mới cập nhật">Sách mới</a></li>
                        <li><a href="{{ route('danhsach.truyenhot') }}" title="Sách Hot">Sách Hot</a></li>
                        <li><a href="{{ route('danhsach.truyenfull') }}" title="Sách Full">Sách Full</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-list"></span> Thể loại <span class="caret"></span></a>
                    <div class="dropdown-menu multi-column">
                        <div class="row">

                            <?php
                            $categories = \App\Models\Category::select('id', 'name', 'alias', 'parent_id')->orderBy('id', 'DESC')->get();
                            $t = 1; $c = 1;
                            foreach($categories as $category)
                            {
                                $count = count($categories);
                                if($t == 1)
                                    echo '<div class="col-md-4"><ul class="dropdown-menu">';
                                echo '<li><a href="'. route('category.list.index', $category->alias) .'">'. $category->name .'</a></li>';
                                if($t == 10 || $count == $c){
                                    $t = 0;
                                    echo '</ul></div>';
                                }
                                $t++; $c++;
                            }
                            ?>
                        </div>
                    </div>
                </li>

                <li class="dropdown">
                    @if(!Auth::guard('nd')->user())
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> Tài khoản <i class="caret"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ url("/user/login") }}"><span class="glyphicon glyphicon-user"></span> Đăng nhập</a>
                            <a href="{{ url("/register") }}"><span class="glyphicon glyphicon-cog"></span> Đăng ký</a>
                        </li>
                    </ul>
                    @else
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> {{ Auth::guard('nd')->user()->name }} ( {{ Auth::guard('nd')->user()->point }} ) <i class="caret"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url("/user/logout") }}"><span class="glyphicon glyphicon-user"></span>Đăng xuất</a>
                            </li>
                        </ul>
                    @endif
                </li>


            </ul>
            <form class="navbar-form navbar-right" action="{{ route('danhsach.search') }}" role="search" itemprop="potentialAction">
                <div class="input-group search-holder">
                    <meta itemprop="target" content="#?tukhoa={tukhoa}">
                    <input class="form-control" id="search-input" type="search" name="q" placeholder="Tìm kiếm..." value="{{ old('q') }}" itemprop="query-input" required="">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                    </div>
                </div>
                <div class="list-group list-search-res hide"></div>
            </form>

        </div>
        <!--/.nav-collapse -->
    </div>
    <div class="navbar-breadcrumb">
        <div class="container breadcrumb-container">
            @yield('breadcrumb')
            @include('user.partials.social')
        </div>
    </div>
</div><!-- navibar -->
