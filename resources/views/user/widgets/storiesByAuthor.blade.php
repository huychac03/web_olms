<?php
if($story)
    $author = $story->authors()->first();
if($author)
    $stories = $author->stories()->where('active', 1)->where('stories.id', '<>', $story->id)->skip(0)->take(5)->get();
?>
@if($stories->count() > 0)
<div class="list list-truyen col-xs-12">
    <div class="title-list"><h4>Sách cùng tác giả</h4></div>
    @foreach($stories as $story)
    <div class="row">
        <div class="col-xs-12">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <h3 itemprop="name"><a href="{{ route('story.show', $story->alias) }}" title="{{$story->name}}" itemprop="url">{{$story->name}}</a></h3>
        </div>
    </div>
    @endforeach
</div>
@endif