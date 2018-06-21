var vLoadFile;

(new (function loadFile() {
    var TYPEHEAD_MIN_LENGTH = 2;
    var _name;
    var _type_objects = [];
    var _curr_head = null;
    var _curr_id = null;

    var files; // переменная. будет содержать данные файлов

    // заполняем переменную данными, при изменении значения поля file
    $('input[type=file]').on('change', function(){
        console.log('click load');
        files = this.files;
    });

    // обработка и отправка AJAX запроса при клике на кнопку upload_files
    $('.upload_files').on( 'click', function( event ){
        console.log('ajax load');
        event.stopPropagation(); // остановка всех текущих JS событий
        event.preventDefault();  // остановка дефолтного события для текущего элемента - клик для <a> тега

        // ничего не делаем если files пустой
        if( typeof files == 'undefined' ) return;

        // создадим объект данных формы
        var data = new FormData();

        // заполняем объект данных файлами в подходящем для отправки формате
        $.each( files, function( key, value ){
            data.append( key, value );
        });

        // добавим переменную для идентификации запроса
        data.append( 'my_file_upload', 1 );
        data.append( 'nameavatar', _curr_head);
        data.append( 'iduser', _curr_id);

        // AJAX запрос
        $.ajax({
            url         : '/new/index',
            type        : 'POST', // важно!
            data        : data,
            cache       : false,
            dataType    : 'json',
            // отключаем обработку передаваемых данных, пусть передаются как есть
            processData : false,
            // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
            contentType : false,
            // функция успешного ответа сервера
            success     : function( respond, status, jqXHR ){

                // ОК - файлы загружены
                if( typeof respond.error === 'undefined' ){
                    // выведем пути загруженных файлов в блок '.ajax-reply'
                    var files_path = respond.files;
                    var html = '';
                    $.each( files_path, function( key, val ){
                        html += val +'<br>';
                    } )

                    $('.ajax-reply').html( html );
                }
                // ошибка
                else {
                    console.log('ОШИБКА: ' + respond.error );
                }
            },
            // функция ошибки ответа сервера
            error: function( jqXHR, status, errorThrown ){
                console.log( 'ОШИБКА AJAX запроса: ' + status, jqXHR );
            }

        });

    });





    // ----------------------- auto complete init ---------------------------------

    $('#search_user_name').typeahead({
        minLength: TYPEHEAD_MIN_LENGTH,
        highlight: true,
        source: function(query, process) {
            if (_type_objects.length <= 0) {
                m.post("/new/typehead", {'name': query}, function(data) {
                    _name = {};
                    _type_objects = [];
                    $.each(data["name"], function(id, data) {
                        _name[data["typehead"]] = data;
                        _type_objects.push(data["typehead"]);
                    });
                    process(_type_objects);
                });
            } else {
                process(_type_objects);
            }
        },
        updater: function(item) {
            var user_head = _name[item]["typehead"];
            var user_id = _name[item]["id"];
            if (user_head != _curr_head) {
                _curr_head = user_head;
                _curr_id = user_id;
                $('input[name="nameuser"]').val(user_head);
                $('input[name="iduser"]').val(user_id);
                // _this.search(0);
            }
            return _name[item]["displayname"];
        }
    });

    // $('#search_user_name').keydown(function(e) {
    //     if ($(this).val().length < TYPEHEAD_MIN_LENGTH) {
    //         clearTypehead();
    //     }
    // });
})());
