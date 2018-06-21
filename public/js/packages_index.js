var packages;

(new (function Packages() {
    var TYPEHEAD_MIN_LENGTH = 2;

    var _this = packages = this;

    var _packages;
    var _type_objects = [];
    var _curr_head = null;
    var _page, _per_page;
    var _did = null;

    this.init = function() {
        _this.initPager();

        $("#btn_export").click(function (e) {
            e.preventDefault();
            _this.export();
        });

        $('#from_time').datepicker({
            format: 'dd M yyyy',
            clearBtn: true,
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom left",
            container: '#custom-from'
        });

        $('#to_time').datepicker({
            format: 'dd M yyyy',
            clearBtn: true,
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom left",
            container: '#custom-to'
        });

        // ----------------------- auto complete init ---------------------------------

        $('#search_package_id').typeahead({
            minLength: TYPEHEAD_MIN_LENGTH,
            highlight: true,
            source: function(query, process) {
                if (_type_objects.length <= 0) {
                    m.post("/packages/typehead", {'package_id': query}, function(data) {
                        _packages = {};
                        _type_objects = [];
                        $.each(data["packages"], function(id, data) {
                            _packages[data["typehead"]] = data;
                            _type_objects.push(data["typehead"]);
                        });
                        process(_type_objects);
                    });
                } else {
                    process(_type_objects);
                }
            },
            updater: function(item) {
                var user_head = _packages[item]["typehead"];
                if (user_head != _curr_head) {
                    _curr_head = user_head;
                    _this.search(0);
                }
                return _packages[item]["displayname"];
            }
        });

        $('#search_package_id').keydown(function(e) {
            if ($(this).val().length < TYPEHEAD_MIN_LENGTH) {
                clearTypehead();
            }
        });

        // ----------------------- input clear feature ---------------------------------

        m.clearable("#form-search", function(e) {
            clearTypehead();
            _this.search(0);
        });

    };

    function clearTypehead() {
        _packages = {};
        _type_objects = [];
        _curr_head = null;
    }

    this.initPager = function() {

        $('.packages-index #package_list .list .pagination a').click(function(e) {
            e.preventDefault();
            _this.search($(this).attr("data-page"));
        });

        $('.packages-index #productsTab .list .pagination a').click(function(e) {
            e.preventDefault();
            // _this.products($(this).attr("data-page"));
            console.log(_did);
            _this.queryPkg($(this).attr("data-page"), _did);
        });

        $('.packages-index #package_list tbody tr').click(function () {
            _did = $(this).data( 'did');
            $('.packages-index a[href="#productsTab"]').tab('show');
            _this.queryPkg(0, _did);
        });
    };

    this.search = function(page) {
        _did = null;
        var data = {
            "package_id": _curr_head != null?_packages[_curr_head]["id"]:null
        };
        data["page"] = (page === undefined ? _page : page);
        data["prod"] = "1";
        m.post("/packages/index", data, function(data) {
            $('.packages-index #package_list .list').html(data.html);
            clearTypehead();
            _page = data.page;
            _per_page = data.per_page;
            _this.initPager();
        });
    };

    // this.products = function(page) {
    //     var data = {
    //         // "package_id": _curr_head != null?_packages[_curr_head]["id"]:null
    //     };
    //     data["page"] = (page === undefined ? _page : page);
    //     data["search"] = "1";
    //     m.post("/packages/index", data, function(data) {
    //         $('.packages-index #productsTab .list').html(data.htmlProd);
    //         clearTypehead();
    //         _page = data.page;
    //         _per_page = data.per_page;
    //         _this.initPager();
    //     });
    // };

    this.queryPkg = function(page) {
        var data = {
            // "package_id": _curr_head != null?_packages[_curr_head]["id"]:null
        };
        data["page"] = (page === undefined ? _page : page);
        data["search"] = "1";
        console.log(_did);
        data["pkg_id"] = _did;
        m.post("/packages/index", data, function(data) {
            console.log(_this);
            $('.packages-index #productsTab .list').html(data.htmlProd);
            clearTypehead();
            _page = data.page;
            _per_page = data.per_page;
            // console.log( _this);
            // $('.packages-index #productsTab .list').initPager();
            _this.initPager();
        });
    };

    this.export = function() {
        var data = {
            "package_id": $('#package_id').val()
        };
        var from = $("#from_time").datepicker('getDate');
        if (from != null) {
            data['from_time'] =  from.getTime() / 1000;
        }
        var to = $("#to_time").datepicker('getDate');
        if (to != null) {
            data['to_time'] =  to.getTime() / 1000;
        }
        m.post("/packages/validate", data, function() {
            window.location = '/packages/export?' + $.param( data );
        });
    }

})());