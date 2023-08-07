@if($stories)
    <?php $count = 1; ?>
    @foreach($stories as $story)
        <div class="item top-{{$count}}" itemscope="">
            <a href="{{route('story.show', $story->alias)}}">
                <span class="full-label"></span>
                <img src="{{asset($story->image)}}" alt="{{$story->name}}" class="img-responsive" itemprop="image">
                <div class="title"><h3 itemprop="name">{{$story->name}}</h3></div>
            </a>
        </div>
        <?php $count++; ?>
    @endforeach
@else
    <p>Không có bài viết nào ở đây !</p>
@endif