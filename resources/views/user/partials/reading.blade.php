<?php
$viewed = new \App\Models\Viewed;
$data = $viewed->getListReading();

if(isset($data) && count($data) > 0):
?>
  <div class="list list-truyen list-history col-xs-12 col-sm-12 col-md-8 col-truyen-main">
    <div class="title-list"><h2>Sách bạn đã đọc</h2></div>
    @foreach ($data as $item)
    @if (Auth::user())
    <div class="row">
      <div class="col-xs-7 col-sm-6 col-md-8 col-title-history">
        <span class="glyphicon glyphicon-chevron-right"></span> <h3 itemprop="name"><a href="{{route('story.show', $item->story->alias)}}/">{{ $item->story->name}}</a></h3>
      </div>
      <div class="col-xs-5 col-sm-6 col-md-4 text-info">
        <a href="{{route('chapter.show', [$item->story->alias, $item->chapter->alias])}}">Đọc tiếp {{ $item->chapter->subname}}</a>
      </div>
    </div>
    @else
        <?php
        $story   = \App\Models\Story::select('alias', 'name')->where('id', $item['story_id'])->first();
        $chapter =\App\Models\Chapter::select('alias', 'subname')->where('id', $item['chapter_id'])->first();
         ?>
         <div class="row">
           <div class="col-xs-7 col-sm-6 col-md-8 col-title-history">
             <span class="glyphicon glyphicon-chevron-right"></span> <h3 itemprop="name"><a href="{{route('story.show', $story->alias)}}/">{{ $story->name}}</a></h3>
           </div>
           <div class="col-xs-5 col-sm-6 col-md-4 text-info">
             <a href="{{route('chapter.show', [$story->alias, $chapter->alias])}}">Đọc tiếp {{ $chapter->subname}}</a>
           </div>
         </div>
    @endif
    @endforeach
  </div>
<?php endif; ?>
