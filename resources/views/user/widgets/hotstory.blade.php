<div class="list list-truyen list-side col-xs-12">
    <div class="title-list"><h4>Sách đang hot</h4></div>
    <?php
            $stories = \App\Models\Story::where('active', 1)->orderBy('view', 'DESC')->skip(0)->take(10)->get();
            $count = 1;
            ?>
    @if($stories)
        @foreach($stories as $story)
        <div class="row top-item" >
            <div class="col-xs-12">
                <div class="top-num top-{{ $count }}">{{ $count  }}</div>
                <div class="s-title">
                    <h3 itemprop="name">
                        <a href="{{ route('story.show', $story->alias) }}" title="{{ $story->name }}" itemprop="url">{{ $story->name }}</a>
                    </h3>
                </div>
                <div>
                    {!! the_category($story->categories) !!}
                </div>
            </div>
        </div>
        <?php $count++ ; ?>
        @endforeach
    @endif
</div>