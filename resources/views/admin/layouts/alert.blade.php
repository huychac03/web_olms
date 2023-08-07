@php
    $array_alert = [
        'danger',
        'info',
        'warning',
        'success'
    ];

@endphp
@foreach($array_alert as $item)
    @if (session($item))
        <section class="content-header">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div class="callout callout-{{ $item }}">
                            <p><i class="fa fa-fw fa-exclamation-circle"></i> {{ session($item) }}</p>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </section>
    @endif
@endforeach