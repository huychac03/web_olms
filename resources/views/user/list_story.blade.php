@extends('user.layouts.app')
@section('title', $data['title'])

@section('seo')
    <meta name="description" content="{{$data['description']}}">
    <meta name="keywords" content="{{$data['keyword']}}">
@endsection
@section('breadcrumb')
    {!! showBreadcrumb($breadcrumb) !!}
@endsection
@section('content')
    <div class="container" id="list-page">
        <div class="col-xs-12 col-sm-12 col-md-9 col-truyen-main">
            <div class="list list-truyen col-xs-12">
                <div class="title-list">
                    <h2>{{ $data['title']  }}</h2>

                    @if($data['alias'] != route('danhsach.truyenfull'))
                        <div class="filter"><a href="?filter=full">Chỉ hiện sách đã hoàn (full)</a></div>
                    @endif

                </div>

                @foreach( $data['stories'] as $story)
                    <div class="row" itemscope="">
                        <div class="col-xs-3">
                            <div style="width: 150px; height: 80px;
                                    background-image: url('{{ url(imageThumb($story->image, false)) }}');
                                    background-repeat:   no-repeat; background-size: contain;
                                    background-position: 0% 0%;
                                    background-size: 100% 100%;
                                    margin-bottom: 10px;
                                    ">
                                {{--<img class="visible-xs-block" src="" alt="{{ $story->name  }}"><img class="visible-sm-block visible-md-block visible-lg-block" src="{{ asset($story->image) }}" alt="{{ $story->name  }}">--}}
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div>
                                <span class="glyphicon glyphicon-book"></span>
                                <h3 class="truyen-title" itemprop="name">
                                    <a href="{{ route('story.show', $story->alias) }}" title="{{ $story->name  }}" itemprop="url">{{ $story->name  }}</a>
                                </h3>
                                @if($story->status == 1)
                                    <span class="label-title label-full"></span>
                                @endif
                                {{--<span class="label-title label-hot"></span>--}}
                                @foreach ($story->authors as $author)
                                    <span class="author" itemprop="author">
                                        <span class="glyphicon glyphicon-pencil"></span> {{ $author->name  }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        <?php $chapter = $story->chapters()->orderBy('created_at', 'DESC')->first(); ?>
                        @if($chapter)
                        <div class="col-xs-2 text-info">
                            <div>
                                <a href="{{  route('chapter.show', [$story->alias, $chapter->alias])}}" title="{{ $chapter->name  }}"><span class="chapter-text">{{ $chapter->subname  }}</span></a>
                            </div>
                        </div>
                        @endif
                    </div>
                @endforeach

            </div>
            <div class="container text-center pagination-container">
                <div class="col-xs-12 col-sm-12 col-md-9 col-truyen-main">
                    {{ $data['stories']->links() }}
                </div>
            </div>
        </div>

        <div class="visible-md-block visible-lg-block col-md-3 text-center col-truyen-side">
            @if(isset($data['description']))
                <div class="panel cat-desc text-left">
                    <div class="panel-body">
                       {!! nl2br($data['description']) !!}
                    </div>
                </div>
            @endif
            @include('user.widgets.categories')
            @include('user.widgets.hotstory')
        </div>
    </div>
@endsection
