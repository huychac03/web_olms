@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <link href='https://fonts.googleapis.com/css?family=Anton|Passion+One|PT+Sans+Caption' rel='stylesheet' type='text/css'>
        <!-- Error Page -->
        <div class="error">
            <div class="container-floud">
                <div class="col-xs-12 ground-color text-center default">
                    <div class="container-error-404">
                        <div class="clip"><div class="shadow"><span class="digit thirdDigit"></span></div></div>
                        <div class="clip"><div class="shadow"><span class="digit secondDigit"></span></div></div>
                        <div class="clip"><div class="shadow"><span class="digit firstDigit"></span></div></div>
                        <div class="msg">OH!<span class="triangle"></span></div>
                    </div>
                    <h2 class="h1">Sorry! Bạn không có quyền truy cập chức năng này.</h2>
                    <button type="button" class="btn btn-info btn-flat margin btn-lg" onclick="window.history.back()"><i class="fa fa-fw fa-hand-o-left"></i> Quay trở lại</button>
                </div>
            </div>
        </div>
        <!-- Error Page -->

    </section>
@endsection

@section('script')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <script>
        function randomNum()
        {
            "use strict";
            return Math.floor(Math.random() * 9)+1;
        }
        var loop1,loop2,loop3,time=30, i=0, number, selector3 = document.querySelector('.thirdDigit'), selector2 = document.querySelector('.secondDigit'),
            selector1 = document.querySelector('.firstDigit');
        loop3 = setInterval(function()
        {
            "use strict";
            if(i > 40)
            {
                clearInterval(loop3);
                selector3.textContent = 4;
            }else
            {
                selector3.textContent = randomNum();
                i++;
            }
        }, time);
        loop2 = setInterval(function()
        {
            "use strict";
            if(i > 80)
            {
                clearInterval(loop2);
                selector2.textContent = 0;
            }else
            {
                selector2.textContent = randomNum();
                i++;
            }
        }, time);
        loop1 = setInterval(function()
        {
            "use strict";
            if(i > 100)
            {
                clearInterval(loop1);
                selector1.textContent = 3;
            }else
            {
                selector1.textContent = randomNum();
                i++;
            }
        }, time);
    </script>
@endsection