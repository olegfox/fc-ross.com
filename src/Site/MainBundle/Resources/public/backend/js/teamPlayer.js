$(function(){
    function loadPlayer(idTeam, select){
        $.post('/admin/player/team/'+idTeam, {}, function(data){
            var players = JSON.parse(data);
            $.each(players, function(key, value){
                select.append($('<option>', {
                    value: key,
                    text : value
                }));
            });
        }).fail(function(){
            throw Error('Ошибка получения списка игроков');
        });
    }

    function changeNumberTeam(object){
        object.find('li').each(function(i, e){
            var select = $(e).find('select:first').get(0);

            $(select).unbind('change').change(function(){
                var numberTeam = $(this).val(),
                    idTeam = $('#site_mainbundle_event_eventTeam select').eq(numberTeam).val();

                $(this).parent().parent()
                    .find('select')
                    .eq(1)
                    .find("option")
                    .remove();

                loadPlayer(
                    idTeam,
                    $(this).parent().parent().find('select').eq(1)
                );
            });
        });
    }

    function changeTeam(){
        $('#site_mainbundle_event_eventTeam li').each(function(i, e){
            var select = $(e).find('select:first').get(0),
                numberTeam = i;

            $(select).unbind('change').change(function(){
                var idTeam = $(this).val();

                $('#site_mainbundle_event_playerTeam li').each(function(i, e){
                    if($(e).find('select').eq(0).val() == numberTeam){
                        $(this)
                            .find('select')
                            .eq(1)
                            .find("option")
                            .remove();
                    }
                });

                $('#site_mainbundle_event_punishmentEvent li').each(function(i, e){
                    if($(e).find('select').eq(0).val() == numberTeam){
                        $(this)
                            .find('select')
                            .eq(2)
                            .find("option")
                            .remove();
                    }
                });

                $('#site_mainbundle_event_goalEvent li').each(function(i, e){
                    if($(e).find('select').eq(0).val() == numberTeam){
                        $(this)
                            .find('select')
                            .eq(1)
                            .find("option")
                            .remove();
                    }
                });

                $.post('/admin/player/team/'+idTeam, {}, function(data){
                    var players = JSON.parse(data);
                    $('#site_mainbundle_event_playerTeam li').each(function(i, e){
                        if($(e).find('select').eq(0).val() == numberTeam){
                            var sel = $(e).find('select').eq(1);

                            $.each(players, function(key, value){
                                sel.append($('<option>', {
                                    value: key,
                                    text : value
                                }));
                            });
                        }
                    });

                    $('#site_mainbundle_event_punishmentEvent li').each(function(i, e){
                        if($(e).find('select').eq(0).val() == numberTeam){
                            var sel = $(e).find('select').eq(2);

                            $.each(players, function(key, value){
                                sel.append($('<option>', {
                                    value: key,
                                    text : value
                                }));
                            });
                        }
                    });

                    $('#site_mainbundle_event_goalEvent li').each(function(i, e){
                        if($(e).find('select').eq(0).val() == numberTeam){
                            var sel = $(e).find('select').eq(1);

                            $.each(players, function(key, value){
                                sel.append($('<option>', {
                                    value: key,
                                    text : value
                                }));
                            });
                        }
                    });
                }).fail(function(){
                    throw Error('Ошибка получения списка игроков');
                });

            });
        });
    }

    function init(){
        $('#site_mainbundle_event_eventTeam li').each(function(i, e){
            var select = $(e).find('select:first'),
                numberTeam = i;

            var idTeam = select.val();

            $.post('/admin/player/team/'+idTeam, {}, function(data){
                var players = JSON.parse(data);

                // Иницализаця списка игроков в составе команд
                $('#site_mainbundle_event_playerTeam li').each(function(i, e){
                    if($(e).find('select').eq(0).val() == numberTeam){
                        var sel = $(e).find('select').eq(1),
                            val = sel.val();

                        sel
                            .find('option')
                            .remove();

                        for(var key in players){
                            sel.append($('<option>', {
                                value: key,
                                text : players[key]
                            }));
                        }

                        sel.find('option[value="'+val+'"]').attr('selected', 'selected');
                    }
                });

                // Иницализаця списка игроков в наказаниях
                $('#site_mainbundle_event_punishmentEvent li').each(function(i, e){
                    if($(e).find('select').eq(0).val() == numberTeam){
                        var sel = $(e).find('select').eq(1),
                            val = sel.val();

                        sel
                            .find('option')
                            .remove();

                        for(var key in players){
                            sel.append($('<option>', {
                                value: key,
                                text : players[key]
                            }));
                        }

                        sel.find('option[value="'+val+'"]').attr('selected', 'selected');
                    }
                });

                // Иницализаця списка игроков в голах
                $('#site_mainbundle_event_goalEvent li').each(function(i, e){
                    if($(e).find('select').eq(0).val() == numberTeam){
                        var sel = $(e).find('select').eq(1),
                            val = sel.val();

                        sel
                            .find('option')
                            .remove();

                        for(var key in players){
                            sel.append($('<option>', {
                                value: key,
                                text : players[key]
                            }));
                        }

                        sel.find('option[value="'+val+'"]').attr('selected', 'selected');
                    }
                });
            }).fail(function(){
                throw Error('Ошибка получения списка игроков');
            });

        });
    }

    // Добавление игрока в составе команд
    $('a[data-collection="site_mainbundle_event_playerTeam"]').click(function(){
        setTimeout(function(){
            var numberTeam = $('#site_mainbundle_event_playerTeam .form-inline:last select:first').val(),
                idTeam = $('#site_mainbundle_event_eventTeam select').eq(numberTeam).val();

            $('#site_mainbundle_event_playerTeam .form-inline:last select')
                .eq(1)
                .find("option")
                .remove();

            loadPlayer(
                idTeam,
                $('#site_mainbundle_event_playerTeam .form-inline:last select').eq(1)
            );

            changeNumberTeam($('#site_mainbundle_event_playerTeam'));
        }, 500);
    });

    // Добавление игрока в наказаниях
    $('a[data-collection="site_mainbundle_event_punishmentEvent"]').click(function(){
        setTimeout(function(){
            var numberTeam = $('#site_mainbundle_event_punishmentEvent .form-inline:last select:first').val(),
                idTeam = $('#site_mainbundle_event_eventTeam select').eq(numberTeam).val();

            $('#site_mainbundle_event_punishmentEvent .form-inline:last select')
                .eq(2)
                .find("option")
                .remove();

            loadPlayer(
                idTeam,
                $('#site_mainbundle_event_punishmentEvent .form-inline:last select').eq(2)
            );

            changeNumberTeam($('#site_mainbundle_event_punishmentEvent'));
        }, 500);
    });

    // Добавление игрока в голах
    $('a[data-collection="site_mainbundle_event_goalEvent"]').click(function(){
        setTimeout(function(){
            var numberTeam = $('#site_mainbundle_event_goalEvent .form-inline:last select:first').val(),
                idTeam = $('#site_mainbundle_event_eventTeam select').eq(numberTeam).val();

            $('#site_mainbundle_event_goalEvent .form-inline:last select')
                .eq(1)
                .find("option")
                .remove();

            loadPlayer(
                idTeam,
                $('#site_mainbundle_event_goalEvent .form-inline:last select').eq(1)
            );

            changeNumberTeam($('#site_mainbundle_event_goalEvent'));
        }, 500);
    });


    // Изменение номера команды игрока
    changeNumberTeam($('#site_mainbundle_event_playerTeam'));
    changeNumberTeam($('#site_mainbundle_event_punishmentEvent'));
    changeNumberTeam($('#site_mainbundle_event_goalEvent'));

    // Изменение команды в списке команд
    changeTeam();

    // Инициализация списков игроков в соответствии с командами
    init();
});