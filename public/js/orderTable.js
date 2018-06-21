var _vDir = null;
var _vBy = null;
// var _columnName = null;
// var _direction = null;

function OrderTable(vPar, callback) {
    // $('table').find('[data-order-by="nameshop"]').css('background', 'red');
    var _callback = callback;

    this.init = function() {
        $(vPar).find('th.ordered').each(function () {
            // console.log(_vBy);
            // console.log(_vDir);
            // $(vPar).find('[data-order-by="' + _vBy + '"]').attr('data-order-dir', _vDir);

            var vDir = $(this).attr("data-order-dir");
            console.log('vDir='+vDir);
            if ( vDir === undefined || vDir.length <= 0 ) {
                $(this).removeClass('desc');
                $(this).removeClass('asc');
            } else if (vDir === 'ASC') {
                $(this).addClass('asc');
                $(this).removeClass('desc');
            } else {
                $(this).addClass('desc');
                $(this).removeClass('asc');
            }
        });

        $(vPar).find("th.ordered").click(initOrderClick);
    };

    function initOrderClick(e) {

        var vNameColumn = $(this).attr("data-order-by");
        var vDir = $(this).attr("data-order-dir");
        // if ( vNameColumn != $(this).closest('table').attr("data-order-column")){
        //     $('th').removeClass('desc');
        //     $('th').removeClass('asc');
        //     $('th').attr("data-order-dir", '');
        // }
        console.log(vNameColumn);
        console.log(vDir);
        if ( vDir === undefined|| vDir.length <= 0 ) {
            vDir = 'ASC';
            $(this).removeClass('desc');
            $(this).addClass('asc');
        } else if (vDir === 'ASC') {
            vDir = 'DESC';
            $(this).addClass('desc');
            $(this).removeClass('asc');
        } else {
            vDir = '';
            $(this).removeClass('desc');
            $(this).removeClass('asc');
        }
        $(this).attr("data-order-dir", vDir);
        // $(this).closest('table').attr("data-order-column", vNameColumn);
        if ($.isFunction(_callback)) {
            _callback(vNameColumn, vDir);
        }

        _vDir = $(this).attr("data-order-dir");
        _vBy = $(this).attr("data-order-by");
    }

    // this.init();
}