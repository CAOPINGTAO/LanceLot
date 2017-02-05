////////////////////////////////
// Author: Bora DAN — http://codecanyon.net/user/bqra
// 18 August 2013
// E-mail: bora_dan@hotmail.com
////////////////////////////////

$(function () {    
    (function ($) {
        $.fn.jalendar = function (options) {
            
            var settings = $.extend({
                customDay: new Date(),
                color: '#65c2c0',
                lang: 'EN'
            }, options);
            
            // Languages            
            var dayNames = {};
            var monthNames = {};
            var lAddEvent = {};
            var lAllDay = {};
            var lTotalEvents = {};
            var lEvent = {};
            dayNames['EN'] = new Array('星期一', '星期二', '星期三', '星期四', '星期五', '星期六', '星期日');
            dayNames['TR'] = new Array('Pzt', 'Sal', 'Çar', 'Per', 'Cum', 'Cmt', 'Pzr');
            dayNames['ES'] = new Array('Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Såb', 'Dom');
            monthNames['EN'] = new Array('一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'); 
            monthNames['TR'] = new Array('Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'); 
            monthNames['ES'] = new Array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'); 
            lAddEvent['EN'] = 'Add New Event';
            lAddEvent['TR'] = 'Yeni Etkinlik Ekle';
            lAddEvent['ES'] = 'Agregar Un Nuevo Evento';
            lAllDay['EN'] = 'All Day';
            lAllDay['TR'] = 'Tüm Gün';
            lAllDay['ES'] = 'Todo El Día';
            lTotalEvents['EN'] = '本月所有上映电影: ';
            lTotalEvents['TR'] = 'Bu Ayki Etkinlik Sayısı: ';
            lTotalEvents['ES'] = 'Total De Eventos En Este Mes: ';
            lEvent['EN'] = 'Event(s)';
            lEvent['TR'] = 'Etkinlik';
            lEvent['ES'] = 'Evento(s)';
            
            
            var $this = $(this);
            var div = function (e, classN) {
                return $(document.createElement(e)).addClass(classN);
            };
            
            // HTML Tree
            $this.append(
                div('div', 'wood-bottom'), 
                div('div', 'jalendar-wood').append(
                    div('div', 'close-button'),
                    div('div', 'jalendar-pages').append(
                        div('div', 'pages-bottom'),
                        div('div', 'header').css('background-color', settings.color).append(
                            div('a', 'prv-m'),
                            div('h1'),
                            div('a', 'nxt-m'),
                            div('div', 'day-names')
                        ),
                        div('div', 'total-bar').html( lTotalEvents[settings.lang] + '<b style="color: '+settings.color+'"></b>'),
                        div('div', 'days clearfix')
                    ),
                    div('div', 'add-event').append(
                        div('div', 'add-new').append(
                            '<input type="text" disabled placeholder="' + lAddEvent[settings.lang] + '" value="本日上映" />',
                            div('div', 'clear')
                        ),
                        div('div', 'events').append(
                            div('h3','').append(
                                div('span', '').html('<b></b>部电影')
                            ),
                            div('div', 'gradient-wood'),
                            div('div', 'events-list')
                        )
                    )
                )
            );
            
            // Adding day boxes
            for (var i = 0; i < 42; i++) {
                $this.find('.days').append(div('div', 'day'));
            }
            
            // Adding day names fields
            for (var i = 0; i < 7; i++) {
                $this.find('.day-names').append(div('h2').text(dayNames[settings.lang][i]));
            }

            var d = new Date(settings.customDay);
            var year = d.getFullYear();
            var date = d.getDate();
            var month = d.getMonth();
            
            var isLeapYear = function(year1) {
                var f = new Date();
                f.setYear(year1);
                f.setMonth(1);
                f.setDate(29);
                return f.getDate() == 29;
            };
        
            var feb;
            var febCalc = function(feb) { 
                if (isLeapYear(year) === true) { feb = 29; } else { feb = 28; } 
                return feb;
            };
            var monthDays = new Array(31, febCalc(feb), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

            function calcMonth() {

                monthDays[1] = febCalc(feb);
                
                var weekStart = new Date();
                weekStart.setFullYear(year, month, 0);
                var startDay = weekStart.getDay();  
                
                $this.find('.header h1').html(monthNames[settings.lang][month] + ' ' + year);
        
                $this.find('.day').html('&nbsp;');
                $this.find('.day').removeClass('this-month');
                for (var i = 1; i <= monthDays[month]; i++) {
                    startDay++;
                    $this.find('.day').eq(startDay-1).addClass('this-month').attr('data-date', i+'/'+(month+1)+'/'+year).html(i);
                }
                if ( month == d.getMonth() ) {
                    $this.find('.day.this-month').removeClass('today').eq(date-1).addClass('today').css('color', settings.color);
                } else {
                    $this.find('.day.this-month').removeClass('today').attr('style', '');
                }
                
                // added event
                $this.find('.added-event').each(function(i){
                    $(this).attr('data-id', i);
                    $this.find('.this-month[data-date="' + $(this).attr('data-date') + '"]').append(
                        div('div','event-single').attr('data-id', i).append(
                            div('p','').text($(this).attr('data-title')),
                            div('div','details').append(
                                div('div', 'clock').text($(this).attr('data-time'))
                            )
                        )
                    );
                    $this.find('.day').has('.event-single').addClass('have-event').prepend(div('i',''));
                });
                
                calcTotalDayAgain();  
                
            }
            
            calcMonth();
            
            var arrows = new Array ($this.find('.prv-m'), $this.find('.nxt-m'));
            var dropdown = new Array ($this.find('.add-time .select span'), $this.find('.add-time .select .dropdown .option'), $this.find('.add-time .select'));
            var allDay = new Array ('.all-day fieldset[data-type="disabled"]', '.all-day fieldset[data-type="enabled"]');
            var $close = $this.find('.jalendar-wood > .close-button');
            var $erase = $this.find('.event-single .erase');
            $this.find('.jalendar-pages').css({'width' : $this.find('.jalendar-pages').width() });
            $this.find('.events').css('height', ($this.height()-197) );
            $this.find('.select .dropdown .option').hover(function() {
                $(this).css('background-color', settings.color); 
            }, function(){
                $(this).css('background-color', 'inherit'); 
            });
            var jalendarWoodW = $this.find('.jalendar-wood').width();
            var woodBottomW = $this.find('.wood-bottom').width();

            // calculate for scroll
            function calcScroll() {
                if ( $this.find('.events-list').height() < $this.find('.events').height() ) { $this.find('.gradient-wood').hide(); $this.find('.events-list').css('border', 'none') } else { $this.find('.gradient-wood').show(); }
            }
            
            // Calculate total event again
            function calcTotalDayAgain() {
                var eventCount = $this.find('.this-month .event-single').length;
                $this.find('.total-bar b').text(eventCount);
                $this.find('.events h3 span b').text($this.find('.events .event-single').length)
            }
            
            function prevAddEvent() {
                $this.find('.day').removeClass('selected').removeAttr('style');
                $this.find('.today').css('color', settings.color);
                $this.find('.add-event').hide();
                $this.children('.jalendar-wood').animate({'width' : jalendarWoodW}, 200);
                $this.children('.wood-bottom').animate({'width' : woodBottomW}, 200);
                $close.hide();
            }
            
            arrows[1].on('click', function () {
                if ( month >= 11 ) {
                    month = 0;
                    year++;
                } else {
                    month++;   
                }
                calcMonth();
                prevAddEvent();
            });
            arrows[0].on('click', function () {
                dayClick = $this.find('.this-month');
                if ( month === 0 ) {
                    month = 11;
                    year--;
                } else {
                    month--;   
                }
                calcMonth();
                prevAddEvent();
            });
            
            $this.on('click', '.this-month', function () {
                var eventSingle = $(this).find('.event-single')
                $this.find('.events .event-single').remove();
                prevAddEvent();
                $(this).addClass('selected').css({'background-color': settings.color});
                $this.children('.jalendar-wood, .wood-bottom').animate({width : '+=300px' }, 200, function() {
                    $this.find('.add-event').show().find('.events-list').html(eventSingle.clone())
                    $this.find('.add-new input').select();
                    calcTotalDayAgain();
                    calcScroll();
                    $close.show();
                });
            });
            
            // add new event with panel
            var dataId = parseInt($this.find('.total-bar b').text());
            $this.find('.submit').on('click', function(){
                var title = $(this).prev('input').val();
                var thisDay = $this.find('.day.this-month.selected').attr('data-date');
				
				//执行ajax
				$.ajax({
					url:"insert",
					type:"get",
					data:{ title:title,date:thisDay},
					dataType:"text",
					success:function(res){
						if(res=="ok"){
							var time;
							$this.prepend(div('div', 'added-event').attr({'data-date':thisDay, 'data-time': time, 'data-title': title, 'data-id': dataId}));
							
							$this.find('.day.this-month.selected').prepend(
								div('div','event-single').attr('data-id', dataId).append(
									div('p','').text(title),
									div('div','details').append(
										div('div', 'clock').text(time)
									)
								)
							);
							$this.find('.day').has('.event-single').addClass('have-event').prepend(div('i',''));
							$this.find('.events-list').html($this.find('.day.this-month.selected .event-single').clone())
							$this.find('.events-list .event-single').eq(0).hide().slideDown();
							calcTotalDayAgain();
							calcScroll();
							// scrolltop after adding new event
							$this.find('.events-list').scrollTop(0);
							// form reset
							$this.find('.add-new > input[type="text"]').val(lAddEvent[settings.lang]).select();
							dataId++;
						}else{
							alert("添加失败，稍后再试!");
						}
					}
				});
				
				
				
				
                
            });
            
            $close.on('click', function(){
                prevAddEvent(); 
            });
            

        };

    }(jQuery));

});

