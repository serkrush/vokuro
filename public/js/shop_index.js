var shops;

(new (function Shops() {
    var TYPEHEAD_MIN_LENGTH = 2;

    var _this = shops = this;

    var _shops;
    var _type_objects = [];
    var _curr_head = null;
    var _page, _per_page;
    var _orderTable = null;



    this.init = function() {
        console.log('init func');
        _orderTable = new OrderTable("#table-id", function (columnName, direction) {

            _this.search($(this).attr("data-page"),columnName, direction);
        });
        _this.initPager();

    };
    function clearTypehead() {
        _shops = {};
        _type_objects = [];
        _curr_head = null;

    }


    this.initPager = function() {
        console.log('initPager func');
        _orderTable.init();

        $('#resultSearch .pagination a').click(function(e) {
            e.preventDefault();
            _this.search($(this).attr("data-page"), _vBy, _vDir);
        });

        $('.btn.btn-success').click(function(e) {
            e.preventDefault();
            _vBy = null;
            _vDir = null;
            _this.search($(this).attr("data-page"));
        });

        $('.btn.del').click(function(e) {
            e.preventDefault();
            var vAction = confirm("To remove the store \"" + $(this).closest('tr').find('input:first').val() + "\"?");
            if (vAction===true){
                _this.delete($(this).attr("href"));
                _this.search($(this).attr("data-page"), _vBy, _vDir);
            }
        });

        $('.btn.upd').click(function(e) {
            e.preventDefault();

           _this.update(this);
        });
    };

    this.search = function(page, orderColumn, orderDirection ) {
        var data = {
            //"package_id": _curr_head != null?_packages[_curr_head]["id"]:null
        };
        data["page"] = (page === undefined ? _page : page);

        data["nameshop"] = $("#nameshop").val();
        data["adresshop"] = $("#adresshop").val();

        if (orderDirection!==null) {
            data["orderByColumn"] = orderColumn;
            data["orderByDirection"] = orderDirection;
        }
        m.post("/changeShop/index", data, function(data) {
            $('#resultSearch').html(data.html);
            clearTypehead();
            _page = data.page;
            _per_page = data.per_page;
            _this.initPager();
        });
    };

    this.delete = function(vHref) {
        var data = {};
        data["idshop"] = vHref.replace(/[^0-9]/,'');
        m.post("/changeShop/delete", data, function() {
            console.log('delete true');
        });
        // var data = {};
        // data["nameshop"] = $("#nameshop").val();
        // data["adresshop"] = $("#adresshop").val();
        // m.post("/changeShop/index", data, function(data) {
        //     $('#resultSearch').html(data.html);
        //     clearTypehead();
        //     _page = data.page;
        //     _per_page = data.per_page;
        //     _this.initPager();
        // });
    };

    this.update = function(e) {
        var data = {};
        data["idshop"] = $(e).attr("href").replace(/[^0-9]/,'');
        data["nameshop"] = $(e).closest("tr").find(".inputNameshop").val();
        data["adresshop"] = $(e).closest("tr").find(".inputAdresshop").val();
        m.post("/changeShop/update", data, function() {
            $(e).closest("tr").find('.statusRec').addClass('check');
        });
    };

})());
