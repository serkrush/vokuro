    $( "document" ).ready( function (e) {
        $("div#my-awesome-dropzone").dropzone({
            url: "/users/loadImg/",
            init: function() {
                this.on("success", function (file) {
                    $( "input[name='nameavatar']" ).val(file.name);
                    $( "input[name='urlavatar']" ).val(file.dataURL);
                });
                // this.on("sending", function(file, xhr, formData) {
                //     // console.log(file.name);
                //     //
                //     // console.log(file.upload.filename);
                //     // console.log(file.dataURL);
                //     $( "input[name='nameavatar']" ).val(file.name);
                //     $( "input[name='urlavatar']" ).val(file.dataURL);
                //     // console.log(file);
                //     // console.log(this.getQueuedFiles());
                // //     var data = new FormData();
                // //     data.append("nameavatar", file.name);
                // //     data.append("iduser", $('#id').val());
                // //
                // //     $.ajax({
                // //         url         : '/users/edit',
                // //         type        : 'POST', // важно!
                // //         data        : data,
                // //         cache       : false,
                // //         dataType    : 'json',
                // //         // отключаем обработку передаваемых данных, пусть передаются как есть
                // //         processData : false,
                // //         // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
                // //         contentType : false,
                // //         // функция успешного ответа сервера
                // //         success     : function( respond, status, jqXHR ){
                // //
                // //             // ОК - файлы загружены
                // //             if( typeof respond.error === 'undefined' ){
                // //                 // выведем пути загруженных файлов в блок '.ajax-reply'
                // //                 var files_path = respond.files;
                // //                 var html = '';
                // //                 $.each( files_path, function( key, val ){
                // //                     html += val +'<br>';
                // //                 } )
                // //
                // //                 $('.ajax-reply').html( html );
                // //             }
                // //             // ошибка
                // //             else {
                // //                 console.log('ОШИБКА: ' + respond.error );
                // //             }
                // //         },
                // //         // функция ошибки ответа сервера
                // //         error: function( jqXHR, status, errorThrown ){
                // //             console.log( 'ОШИБКА AJAX запроса: ' + status, jqXHR );
                // //         }
                // //
                // //     });
                // });

                //
                // this.on("success", function(file, responseText) {
                //     // console.log('on');
                //     // console.log(file);
                //     // console.log(responseText);
                //     console.log('success');
                // });
            }
        });

        $('.btnLoad').click(function (e) {
            e.preventDefault();
            var data = new FormData();
            data.append("nameavatar", $( "input[name='nameavatar']" ).val());
            data.append("urlavatar", $( "input[name='urlavatar']" ).val());
            data.append("iduser", $('#id').val());

            $.ajax({
                url         : '/users/edit',
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
                    console.log(111);
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
    });