<div class="chapter-nav" id="chapter-nav-top">
    <input type="hidden" id="ten-truyen" value="{{ $story->alias }}">
    <input type="hidden" id="truyen-id" value="{{ $story->id }}">
    <input type="hidden" id="chapter-id" value="{{ $chapter->id }}">
    <input type="hidden" id="chapter-bnum" value="">
    <input type="hidden" id="chapter-num" value="{{ $story->id }}">
    <div class="btn-group">
        @if($chapterNav['previousChapter'])
            <a class="btn btn-success" href="{{ route('chapter.show', [$story->alias, $chapterNav['previousChapter']->alias])  }}" title="{{$chapterNav['previousChapter']->subname}}" id="prev_chap"><span class="glyphicon glyphicon-chevron-left"></span> <span class="hidden-xs">Chương </span>trước</a>
        @else
            <a class="btn btn-success disabled" href="javascript:void(0)" title="Không có chương trước" id="prev_chap"><span class="glyphicon glyphicon-chevron-left"></span> <span class="hidden-xs">Chương </span>trước</a>
        @endif
        <button type="button" class="btn btn-success btnGoToChapter"><span class="glyphicon glyphicon-list-alt"></span></button>
        <select name="goToChapter" class="goToChapter btn btn-success form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
            @foreach($story->chapters as $chap)
                <option value="{{ route('chapter.show',[$story->alias, $chap->alias] ) }}" {{ $chapter->alias == $chap->alias ? 'selected' : '' }}>{{ $chap->subname  }}</option>
            @endforeach
        </select>
        @if($chapterNav['nextChapter'])
            <a class="btn btn-success" href="{{ route('chapter.show', [$story->alias, $chapterNav['nextChapter']->alias])  }}" title="Chương 1" id="next_chap"><span class="hidden-xs">Chương </span>sau <span class="glyphicon glyphicon-chevron-right"></span></a>
        @else
            <a class="btn btn-success disabled" href="javascript:void(0)" title="Không có chương trước" id="next_chap"><span class="hidden-xs">Chương </span>sau <span class="glyphicon glyphicon-chevron-right"></span></a>
        @endif
    </div>
</div>