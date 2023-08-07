@if($stories)
    @foreach($stories as $story)
        <?php
            $chapter = $story->chapters()->orderBy('created_at', 'DESC')->first();
        ?>
<div class="row" itemscope="" style="display: table-row;">
    <div class="col-xs-9 col-sm-6 col-md-5 col-title">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <h3 itemprop="name">
            <a href="{{route('story.show', $story->alias)}}" title="{{$story->name}}" itemprop="url">
                {{$story->name}}
            </a>
        </h3>
    </div>
    <div class="hidden-xs col-sm-3 col-md-3 col-cat text-888">
        {!! the_category($story->categories)  !!}
    </div>
    <div class="col-xs-3 col-sm-3 col-md-2 col-chap text-info">
        {!!  ($chapter ? '
        <a href="'.route('chapter.show', [$story->alias, $chapter->alias]) .'" title="'.$chapter->name .'">
            <span class="chapter-text">'.$chapter->subname .'</span>
        </a>' : '...')  !!}
    </div>
    <div class="hidden-xs hidden-sm col-md-2 col-time text-888">{{$story->updated_at->diffForHumans()}} </div>
</div>
@endforeach
@else
    <p>Không có bài viết nào ở đây !</p>
@endif