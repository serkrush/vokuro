
var CONFIG = (function () {
    var private = {
        ERROR_ACCESS_DENIED: 1,
        YES: 1,
        NO: 0
    };

    return {
        get: function (name) {
            return private[name];
        }
    };
})();

var m;
(new (function Main() {
    var _this = m = this;
    var _options = {};
    var _blockSelector = null;

    this.init = function (options) {
        _options = options || {};
    }

    /**
     * Generation random id
     *
     * @access    public
     * @param    string Id prefix
     * @param    int Digits length (default 8)
     * @return    string
     */

    this.id = function (prefix, size) {
        size = typeof (size) != 'undefined' ? size : 8;
        return (typeof (prefix) != 'undefined' ? prefix : "").toString() + ((new Date()).getTime().toString() + Math.round(Math.random() * Math.pow(10, 4)).toString()).reverse().substr(0, size);
    }

    /**
     * Check of variable or element of arrai initialization (not check defining)
     *
     * @access    public
     * @param    mixed
     * @return    bool
     */

    this.isset = function (variables) {
        return (typeof (variables) != 'undefined' && variables != null);
    }

    this.ifset = function (variables, defValue) {
        return this.isset(variables) ? variables : defValue;
    }

    /**
     * Wrapper for JSON.stringify if exist
     *
     * @access    public
     * @param    object
     * @return    string
     */

    this.toJSON = function (obj) {
        return JSON.stringify(obj);
    }

    /**
     * Get count of plain object elements
     *
     * @access    public
     * @param    object
     * @return    int
     */

    this.length = function (obj) {
        var count = 0;
        for (var k in obj)
            if (obj.hasOwnProperty(k))
                count++;
        return count;
    }

    /**
     * Get hash of plain object
     *
     * @access    public
     * @param    object
     * @return    string
     */

    this.hash = function (obj) {
        return this.md5(this.toJSON(obj));
    }

    /**
     * Wrapper for Crypt.md5
     *
     * @access    public
     * @param    string
     * @return    string
     */
    /* MD5 NOT WORKS, FUNCTION --DEFINE-- IS MISSED*/
    this.md5 = function (s) {
        crypt = crypt ? crypt : new (define("Crypt", "crypt.js"))();
        return crypt.md5(s);
    }

    this.b64Encode = function (str) {
        return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g, function (match, p1) {
            return String.fromCharCode('0x' + p1);
        }));
    }

    this.b64Decode = function (str) {
        return decodeURIComponent(Array.prototype.map.call(atob(str), function (c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));
    }

    /**
     * Wrapper for $.globalEval
     *
     * @access    public
     * @param    string
     * @return    bool
     */

    this.eval = function (code) {
        return $.globalEval(code);
    }


    this.tog = function (v) {
        return v ? 'addClass' : 'removeClass';
    }

    this.isInt = function (n) {
        return !isNaN(n) && parseFloat(n) == parseInt(n, 10);
    }

    this.isFloat = function (n) {
        n = parseFloat(n);
        return !isNaN(n) && n === +n && n !== (n | 0);
    }

    this.round = function (v) {
        return Math.round(v * 100) / 100
    }

    this.isDate = function (d) {
        if (Object.prototype.toString.call(d) === "[object Date]") {
            if (isNaN(d.getTime())) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    this.option = function (name) {
        return _this.isset(_options[name]) ? _options[name] : "";
    }

    this.post = function (url, post_data, callback, errorCallback) {

        $.ajax({
            url: url,
            data: post_data,
            dataType: "json",
            method: "POST"
        }).done(function (data) {

            if (_this.isset(data.error) && _this.isset(data.result)) {
                if (!data.error) {
                    callback(data.result);
                } else if (data.error && data.result.code === _this.option('ERROR_ACCESS_DENIED')) {
                    _this.unblockUI();
                    window.location.href = '/'
                } else {
                    _this.unblockUI();
                    if ($.isFunction(errorCallback)) {
                        errorCallback(data.result);
                    } else {
                        _this.dialog({
                            header: 'Vokuro',
                            body: data.result.message || 'Some error on theserver',
                            btnOk: {
                                label: "Ok",
                                callback: function () {
                                    return true;
                                }
                            }
                        });
                    }

                }
            } else {
                _this.unblockUI();
                _this.dialog({
                    header: 'error',
                    body: 'server-wrong-response',
                    btnOk: {
                        label: "Ok",
                        callback: function () {
                            return true;
                        }
                    }
                });
            }

        }).error(function (xhr, status, err) {
            _this.unblockUI();
            var response = xhr.statusText;
            if ($.isFunction(errorCallback)) {
                errorCallback({ message : response });
            } else {
                _this.dialog({
                    header: 'error',
                    body: response,
                    btnOk: {
                        label: "ok",
                        callback: function () {
                            return true;
                        }
                    }
                });
            }
        });

    };

    /**
     * Options can have following keys:
     * btnOk - callback
     * btnCancel - callback
     * url - upload dialog body from server. Server should return "html" key to fill dialog content.
     * data - post parameters (key/value array). It is using if url is specified.
     * header - header of dialog (text)
     * body - dialog body (HTML or text)
     * backdrop - block page while dialog is opened (true/false)
     * keyboard - close dialog by ESC (true/false)
     * before - callback, fire before opening dialog.
     * width, height - dialog width and height
     * onClosed - callback fire after dialog was closed
     */
    this.dialog = function (options) {
        if (_this.isset(options)) {
            var okCallback = null, closeCallback = null;
            var btnOk = options.btnOk || null;
            var btnCancel = options.btnCancel || null;
            var dataResult = null;
            if (options.url) {
                $.ajax({
                    url: options.url,
                    async: false,
                    data: options.data || null,
                    autoOpen: false,
                    dataType: "json",
                    method: "POST"
                }).done(function (data) {
                    if (_this.isset(data.error) && _this.isset(data.result)) {
                        dataResult = data.result;
                        if (data.error || !_this.isset(data.result.html)) {
                            options.header = 'Error';
                            options.body = data.result.message ? data.result.message : 'Error';
                            btnOk = null;
                        } else {
                            options.header = data.header ? data.header : options.header;
                            options.body = data.result.html;
                            if (_this.isset(data.result.actions)) {
                                $("#dialog .modal-footer .actions").html(data.result.actions);
                            }
                        }
                    }
                }).fail(function (data) {
                    options.header = 'Error';
                    options.body = data.result.message ? data.result.message : 'Error';
                });
            }

            if (options.size) {
                $("#dialog .modal-dialog").addClass(options.size);
            } // modal-sm modal-lg

            if (options.header) {
                $("#dialog .modal-header .modal-title").html(options.header);
                $("#dialog .modal-header").removeClass("hide");
            } else {
                $("#dialog .modal-header").addClass("hide");
            }

            $('#dialog #btnOk').addClass('hide');
            if (btnOk) {
                // re-enable the ok button:
                if ($('#dialog #btnOk').prop('disabled') == true)
                {
                    $('#dialog #btnOk').prop('disabled', false);
                }
                if (btnOk.label) {
                    $('#dialog #btnOk').text(btnOk.label);
                }
                $('#dialog #btnOk').removeClass('hide');
                $('#dialog #btnOk').unbind('click').click(function () {
                    okCallback = $.isFunction(btnOk) ? btnOk : btnOk.callback;
                    $('#dialog').modal('hide');
                });
            }

            $('#dialog #btnCancel').addClass('hide');
            if (btnCancel) {
                $('#dialog #btnCancel').removeClass('hide');
                if (btnCancel.label) {
                    $('#dialog #btnCancel').text(btnCancel.label);
                }
                closeCallback = $.isFunction(btnCancel) ? btnCancel : btnCancel.callback;
            }

            $("#dialog .modal-body").html(options.body);

            $('#dialog').unbind('hide.bs.modal').unbind('show.bs.modal');
            $('#dialog').modal({
                backdrop: _this.ifset(options.backdrop, true),
                keyboard: _this.ifset(options.keyboard, true),
                show: false
            }).on('hide.bs.modal', function () {
                if ($.isFunction(okCallback)) {
                    var value = okCallback($('#dialog'));
                    okCallback = null;
                    return value;
                } else if ($.isFunction(closeCallback)) {
                    var value = closeCallback($('#dialog'));
                    closeCallback = null;
                    return value;
                }

                return true;
            }).on('shown.bs.modal', function (event) {
                if (options.before && $.isFunction(options.before)) {
                    $("#dialog .modal-body").find('*').off();
                    options.before(dataResult);
                }
            }).on('hidden.bs.modal', function () {
                $("#dialog").off();
                $("#dialog .modal-body").html("");
                if (options.onClosed && $.isFunction(options.onClosed)) {
                    options.onClosed();
                }
            });
            $('#dialog').modal('show');
        }
    }

    this.clearable = function (selector, callback) {
        $(selector).on('input', '.clearable', function () {
            $(this)[m.tog(this.value)]('x');
        }).on('mousemove', '.x', function (e) {
            $(this)[m.tog(this.offsetWidth - 25 < e.clientX - this.getBoundingClientRect().left)]('onX');
        }).on('click', '.onX', function () {
            $(this).removeClass('x onX').val('');
            if (callback) {
                callback(this);
            }
        }).on('keyup', '.clearable', function (e) {
            if (e.keyCode == 27) {
                $(this).removeClass('x onX').val('');
                if (callback) {
                    callback(this);
                }
            }
        });
    }


    this.validateEmail = function (email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }


    this.companySelect = function () {
        var companyId = $(this).attr('data-company-id');
        _this.post('/company/change', {'company_id': companyId}, function (data) {
            if (_this.isset(data.url)) {
                window.location = data.url;
            } else {
                location.reload();
            }

        });
    };

    this.blockUI = function (selector) {
        _blockSelector = selector === undefined ? 'body' : selector;
        $.blockUI({
            animate: true,
            target: _blockSelector,
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff'
            }
        }
        );

    }

    this.unblockUI = function () {
        if (_blockSelector !== null) {
            _blockSelector = null;
            $.unblockUI(_blockSelector);
        }
    }

}

)());