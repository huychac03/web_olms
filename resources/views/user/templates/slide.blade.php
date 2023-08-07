<div style="clear: both;"></div>
<div class="container" id="truyen-slide">
    <div class="list list-thumbnail col-xs-12">
        <div class="title-list"><h2><a href="{{route('danhsach.truyenfull')}}" title="Truyện full">Sách đã hoàn thành</a></h2><a href="http://truyenfull.vn/danh-sach/truyen-full/" title="Truyện full"><span class="glyphicon glyphicon-menu-right"></span></a></div>
        <div class="row">
            @if($stories)
                @foreach($stories as $story)
                    <?php
                    $chapter = $story->chapters()->orderBy('created_at', 'DESC')->first();
                    ?>
                    <div class="col-xs-4 col-sm-3 col-md-2">
                        <a href="{{route('story.show', $story->alias)}}" title="{{$story->name}}">
                            <img src="{{asset($story->image)}}" alt="{{$story->name}}">
                            <div class="caption">
                                <h3>{{$story->name}}</h3>
                                <small class="btn-xs label-primary">Hoàn thành - {{$story->chapters()->count()}} chương</small>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <p>Không có bài viết nào ở đây !</p>
            @endif
        </div>

    </div>
</div>