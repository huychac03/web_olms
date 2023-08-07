@extends('user.layouts.app')
@section('title', 'Liên hệ')
@section('breadcrumb')
    {!! showBreadcrumb([[url('contact'), 'Liên hệ']]) !!}
@endsection
@section('content')

    <div class="container single-page">
        <div class="row">
            <div class="list list-truyen col-xs-12">
                <div class="title-list"><h2>Contact - Liên hệ</h2></div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="row single-page-inner">
                            <div class="col-md-8">
                                <div class="alert hide" id="single-page-status"></div>
                                <noscript>&lt;div class="alert alert-danger"&gt;Bạn cần bật javascript để sử dụng form liên hệ&lt;/div&gt;</noscript>
                                <div class="well well-sm">
                                    <form class="single-page-form" id="contact-form" >
                                        <div class="row">
                                            <div class="col-md-6">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <label for="contact-name">Tên</label>
                                                    <input type="text" class="form-control" id="contact-name" placeholder="Tên của bạn" required="required">
                                                </div>
                                                <div class="form-group">
                                                    <label for="contact-email">Email</label>
                                                    <div class="input-group">
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                                    </span>
                                                        <input type="email" class="form-control" id="contact-email" placeholder="Địa chỉ email của bạn" required="required"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="contact-subject">Chủ đề</label>
                                                    <select id="contact-subject" name="subject" class="form-control" >
                                                        <option value="Liên hệ" selected="selected">Liên hệ</option>
                                                        <option value="Góp ý">Góp ý</option>
                                                        <option value="Báo lỗi">Báo lỗi</option>
                                                        <option value="Quảng cáo">Quảng cáo</option>
                                                        <option value="Khác">Khác</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contact-message">Nội dung</label>
                                                    <textarea name="message" id="contact-message" class="form-control" rows="9" cols="25" required="required" placeholder="Nội dung liên hệ"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary pull-right">Gửi</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <fieldset>
                                    <legend><span class="glyphicon glyphicon-globe"></span> Thông tin liên hệ</legend>
                                    <div>
                                        <strong>{{ \App\Models\Option::getvalue('sitename') }}</strong><br>
                                        <strong>Email:</strong> {{ \App\Models\Option::getvalue('email_contact') }}<br>
                                        <strong>Facebook:</strong> <a href="{{ \App\Models\Option::getvalue('fb_fanpage') }}" target="_blank" rel="nofollow">{{ \App\Models\Option::getvalue('fb_fanpage') }}</a>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
