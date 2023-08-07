@extends('user.layouts.app')
@section('title', $story->name . ' - ' . $chapter->subname . ' :' . $chapter->name)
@section('breadcrumb')
    {!! showBreadcrumb($breadcrumb) !!}
@endsection
@section('content')

    <div class="container chapter" id="chapterBody" style="margin-top: 0px;">
        <div class="row">
            <div class="col-xs-12">
{{--                @if ($chapter->point >= 0 && isset($chapter->userChapter[0]->point) && $chapter->userChapter[0]->point >= 0--}}
{{--                && isset($chapter->userChapter[0]->start_time) && checkPaymentTime($chapter->userChapter[0]->start_time) > 0 || $chapter->status == 1)--}}
                <button type="button" class="btn btn-responsive btn-success toggle-nav-open">
                    <span class="glyphicon glyphicon-menu-up"></span>
                </button>

                <a class="truyen-title" href="{{ route('story.show', $story->alias)  }}" title="{{ $story->name }}">{{ $story->name }}</a>
                <h2>
                    <a class="chapter-title" href="{{ route('chapter.show', [$story->alias, $chapter->alias]) }}" title="{{ $story->name }} - {{ $chapter->subname }}: {{ $chapter->name }}">
                        <span class="chapter-text">{{ $chapter->subname }}</span>: {{ $chapter->name }}
                    </a>
                </h2>
                <hr class="chapter-start">
                @include('user.partials.chapter')
                <hr class="chapter-end">

                <div class="chapter-content">
                    {!! ($chapter->content) !!}
                </div>

                <div class="ads container">
                    {!! \App\Models\Option::getvalue('ads_chapter') !!}
                </div>

                <hr class="chapter-end">
                <div class="chapter-nav" id="chapter-nav-bot">
                    @include('user.partials.chapter')
                    <div class="text-center">
                        <button type="button" class="btn btn-warning" id="chapter_error" chapter-id="{{ $chapter->id }}"><span class="glyphicon glyphicon-exclamation-sign"></span> Báo lỗi chương</button>
                        <button type="button" class="btn btn-info" id="chapter_comment"><span class="glyphicon glyphicon-comment"></span> Bình luận</button>
                    </div>
                    <div class="bg-info text-center visible-md visible-lg box-notice">Bình luận văn minh lịch sự là động lực cho tác giả. Nếu gặp chương bị lỗi hãy "Báo lỗi chương" để BQT xử lý!</div>
                    <div class="col-xs-12">
                        <div class="row" id="fb-comment-chapter">
                            <div class="fb-comments fb_iframe_widget" data-href="{{ route('chapter.show', [$story->alias, $chapter->alias]) }}" data-width="832" data-numposts="5" data-colorscheme="light" fb-xfbml-state="rendered"></div>
                        </div>
                    </div>
                </div>
<!-- {{--                @else--}}
{{--                    <div class="chapter-nav" id="chapter-nav-bot" style="margin-top: 100px; margin-bottom: 150px">--}}
{{--                        <span class="glyphicon glyphicon-lock" style="font-size: 80px; color: #eea236"></span>--}}
{{--                        <div class="text-center">--}}
{{--                            <button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-exclamation-sign"></span> Nội dung chương đã bị khóa </button>--}}
{{--                            @if (isset($user))--}}
{{--                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#nap_point">--}}
{{--                                    <span class="glyphicon glyphicon-plus-sign"></span>--}}
{{--                                    @if (isset($user->point) && $user->point > $chapter->point) Mua chương @else Nạp linh thạch @endif--}}
{{--                                </button>--}}
{{--                            @else--}}
{{--                                <a href="{{ route('user.login') }}"><button type="button" class="btn btn-success">--}}
{{--                                    <span class="glyphicon glyphicon-plus-sign"></span>--}}
{{--                                    @if (isset($user->point) && $user->point > $chapter->point) Mua chương @else Nạp linh thạch @endif--}}
{{--                                </button></a>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                        <div class="bg-info text-center visible-md visible-lg box-notice" >Bạn cần có <b>{{ $chapter->point }} Linh thạch</b>  để xem nội dung</div>--}}
{{--                        <div class="text-center">--}}
{{--                            <button type="button" class="btn btn-primary" onclick="history.back()"><span class="glyphicon glyphicon-road"></span> Trở lại</button>--}}
{{--                        </div>--}}
{{--                        <div class="col-xs-12">--}}
{{--                            <div class="row" id="fb-comment-chapter">--}}
{{--                                <div class="fb-comments fb_iframe_widget" data-href="{{ route('chapter.show', [$story->alias, $chapter->alias]) }}" data-width="832" data-numposts="5" data-colorscheme="light" fb-xfbml-state="rendered"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}} -->
{{--                @endif--}}
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade bd-example-modal-sm" id="nap_point" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        @if (isset($user->point) && $user->point >= $chapter->point)
                            <b>Bạn xác nhận thanh toán {{ $chapter->point }}</b> <a href="">Nạp linh thạch</a>
                        @else
                            <b>Bạn không đủ linh thạch để mua chương . Vui lòng liên hệ admin để nạp linh thạch</b>
                        @endif

                    </div>
                    @if (isset($user->point) && $user->point >= $chapter->point)
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" id="payment_chapter" url="{{ route('payment.chapter', $chapter->id) }}" point="{{ $chapter->point }}">Xác nhận</button>
                        </div>
                    @else
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal" >Xác nhận</button>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
