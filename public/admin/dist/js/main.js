setTimeout(function(){
    $('.show-notification').slideUp(2000);
}, 3000);

$('#dataTableList').DataTable({
    responsive: true,
    "language": {
        "emptyTable":     "Không tồn tại dữ liệu",
        "lengthMenu":     "Hiển thị _MENU_ ",
        "search":         "Tìm kiếm",
        "paginate": {
            "next":       "Tiếp",
            "previous":   "Quay trở lại"
        },
        "info":           "Hiển thị  _PAGE_  của _PAGES_",
        "processing": "",
        "infoFiltered": " ",
        "infoEmpty":"Không tồn tại dữ liệu",
        "zeroRecords": " ",

    },
    "order": [[ 0, 'desc' ]],
});

$(".confirm__btn").click(function(event){
    event.preventDefault();
    let $this = $(this);

    $.confirm({
        title: 'Cảnh báo?',
        content: 'Bạn có chắc chắn muốn thực hiện thao tác này không.',
        type: 'green',
        buttons: {
            ok: {
                text: "ok!",
                btnClass: 'btn-primary',
                keys: ['enter'],
                action: function(){
                    window.location = $this.attr('href');
                }
            },
            cancel: function(){
                console.log('the user clicked cancel');
            }
        }
    });
});

$(document).ready(function() {
    var url = window.location;
    var element = $('ul.sidebar-menu a').filter(function() {
        return this.href == url;
    }).parent().parent().parent().addClass('active').addClass('menu-open');

    var e = $('ul.sidebar-menu a').filter(function() {
        return this.href == url;
    }).parent().addClass('active').addClass('menu-open');

    $('.chosen-select').select2();
});