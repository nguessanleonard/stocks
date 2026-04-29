<script>
    $(document).ready(function()
    {
        //$('#js-page-content').smartPanel();

        //
        //
        var dataSetPie = [
            {
                label: "Asia",
                data: 4119630000,
                color: myapp_get_color.primary_500
            },
            {
                label: "Latin America",
                data: 590950000,
                color: myapp_get_color.info_500
            },
            {
                label: "Africa",
                data: 1012960000,
                color: myapp_get_color.warning_500
            },
            {
                label: "Oceania",
                data: 95100000,
                color: myapp_get_color.danger_500
            },
            {
                label: "Europe",
                data: 727080000,
                color: myapp_get_color.success_500
            },
            {
                label: "North America",
                data: 344120000,
                color: myapp_get_color.fusion_400
            }];


        $.plot($("#flotPie"), dataSetPie,
            {
                series:
                    {
                        pie:
                            {
                                innerRadius: 0.5,
                                show: true,
                                radius: 1,
                                label:
                                    {
                                        show: true,
                                        radius: 2 / 3,
                                        threshold: 0.1
                                    }
                            }
                    },
                legend:
                    {
                        show: false
                    }
            });




        /*
         * VECTOR MAP
         */



        $('#vector-map').vectorMap(
            {
                map: 'world_en',
                backgroundColor: 'transparent',
                color: myapp_get_color.warning_50,
                borderOpacity: 0.5,
                borderWidth: 1,
                hoverColor: myapp_get_color.success_300,
                hoverOpacity: null,
                selectedColor: myapp_get_color.success_500,
                selectedRegions: ['US'],
                enableZoom: true,
                showTooltip: true,
                scaleColors: [myapp_get_color.primary_400, myapp_get_color.primary_50],
                values: data_array,
                normalizeFunction: 'polynomial',
                onRegionClick: function(element, code, region)
                {
                    /*var message = 'You clicked "'
                    + region
                    + '" which has the code: '
                    + code.toLowerCase();

                console.log(message);*/

                    var randomNumber = Math.floor(Math.random() * 10000000);
                    var arrow;

                    if (Math.random() >= 0.5 == true)
                    {
                        arrow = '<div class="ml-2 d-inline-flex"><i class="fal fa-caret-up text-success fs-xs"></i></div>'
                    }
                    else
                    {
                        arrow = '<div class="ml-2 d-inline-flex"><i class="fal fa-caret-down text-danger fs-xs"></i></div>'
                    }

                    $('.js-jqvmap-flag').attr('src', 'https://lipis.github.io/flag-icon-css/flags/4x3/' + code.toLowerCase() + '.svg');
                    $('.js-jqvmap-country').html(region + ' - ' + '$' + randomNumber.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + arrow);
                }
            });


        /* TAB 1: UPDATING CHART */
        var data = [],
            totalPoints = 200;
        var getRandomData = function()
        {
            if (data.length > 0)
                data = data.slice(1);

            // do a random walk
            while (data.length < totalPoints)
            {
                var prev = data.length > 0 ? data[data.length - 1] : 50;
                var y = prev + Math.random() * 10 - 5;
                if (y < 0)
                    y = 0;
                if (y > 100)
                    y = 100;
                data.push(y);
            }

            // zip the generated y values with the x values
            var res = [];
            for (var i = 0; i < data.length; ++i)
                res.push([i, data[i]])
            return res;
        }
        // setup control widget
        var updateInterval = 1500;
        $("#updating-chart").val(updateInterval).change(function()
        {

            var v = $(this).val();
            if (v && !isNaN(+v))
            {
                updateInterval = +v;
                $(this).val("" + updateInterval);
            }

        });
        // setup plot
        var options = {
            colors: [myapp_get_color.primary_700],
            series:
                {
                    lines:
                        {
                            show: true,
                            lineWidth: 0.5,
                            fill: 0.9,
                            fillColor:
                                {
                                    colors: [
                                        {
                                            opacity: 0.6
                                        },
                                        {
                                            opacity: 0
                                        }]
                                },
                        },

                    shadowSize: 0 // Drawing is faster without shadows
                },
            grid:
                {
                    borderColor: '#F0F0F0',
                    borderWidth: 1,
                    labelMargin: 5
                },
            xaxis:
                {
                    color: '#F0F0F0',
                    font:
                        {
                            size: 10,
                            color: '#999'
                        }
                },
            yaxis:
                {
                    min: 0,
                    max: 100,
                    color: '#F0F0F0',
                    font:
                        {
                            size: 10,
                            color: '#999'
                        }
                }
        };
        var plot = $.plot($("#updating-chart"), [getRandomData()], options);
        /* live switch */
        $('input[type="checkbox"]#start_interval').click(function()
        {
            if ($(this).prop('checked'))
            {
                $on = true;
                updateInterval = 1500;
                update();
            }
            else
            {
                clearInterval(updateInterval);
                $on = false;
            }
        });
        var update = function()
        {
            if ($on == true)
            {
                plot.setData([getRandomData()]);
                plot.draw();
                setTimeout(update, updateInterval);

            }
            else
            {
                clearInterval(updateInterval)
            }

        }



        /*calendar */
        var todayDate = moment().startOf('day');
        var YM = todayDate.format('YYYY-MM');
        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
        var TODAY = todayDate.format('YYYY-MM-DD');
        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');


        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl,
            {
                plugins: ['dayGrid', 'list', 'timeGrid', 'interaction', 'bootstrap'],
                themeSystem: 'bootstrap',
                timeZone: 'UTC',
                dateAlignment: "month", //week, month
                buttonText:
                    {
                        today: 'today',
                        month: 'month',
                        week: 'week',
                        day: 'day',
                        list: 'list'
                    },
                eventTimeFormat:
                    {
                        hour: 'numeric',
                        minute: '2-digit',
                        meridiem: 'short'
                    },
                navLinks: true,
                header:
                    {
                        left: 'title',
                        center: '',
                        right: 'today prev,next'
                    },
                footer:
                    {
                        left: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
                        center: '',
                        right: ''
                    },
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: [
                    {
                        title: 'All Day Event',
                        start: YM + '-01',
                        description: 'This is a test description', //this is currently bugged: https://github.com/fullcalendar/fullcalendar/issues/1795
                        className: "border-warning bg-warning text-dark"
                    },
                    {
                        title: 'Reporting',
                        start: YM + '-14T13:30:00',
                        end: YM + '-14',
                        className: "bg-white border-primary text-primary"
                    },
                    {
                        title: 'Surgery oncall',
                        start: YM + '-02',
                        end: YM + '-03',
                        className: "bg-primary border-primary text-white"
                    },
                    {
                        title: 'NextGen Expo 2019 - Product Release',
                        start: YM + '-03',
                        end: YM + '-05',
                        className: "bg-info border-info text-white"
                    },
                    {
                        title: 'Dinner',
                        start: YM + '-12',
                        end: YM + '-10'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: YM + '-09T16:00:00',
                        className: "bg-danger border-danger text-white"
                    },
                    {
                        id: 1000,
                        title: 'Repeating Event',
                        start: YM + '-16T16:00:00'
                    },
                    {
                        title: 'Conference',
                        start: YESTERDAY,
                        end: TOMORROW,
                        className: "bg-success border-success text-white"
                    },
                    {
                        title: 'Meeting',
                        start: TODAY + 'T10:30:00',
                        end: TODAY + 'T12:30:00',
                        className: "bg-primary text-white border-primary"
                    },
                    {
                        title: 'Lunch',
                        start: TODAY + 'T12:00:00',
                        className: "bg-info border-info"
                    },
                    {
                        title: 'Meeting',
                        start: TODAY + 'T14:30:00',
                        className: "bg-warning text-dark border-warning"
                    },
                    {
                        title: 'Happy Hour',
                        start: TODAY + 'T17:30:00',
                        className: "bg-success border-success text-white"
                    },
                    {
                        title: 'Dinner',
                        start: TODAY + 'T20:00:00',
                        className: "bg-danger border-danger text-white"
                    },
                    {
                        title: 'Birthday Party',
                        start: TOMORROW + 'T07:00:00',
                        className: "bg-primary text-white border-primary text-white"
                    },
                    {
                        title: 'Gotbootstrap Meeting',
                        url: 'http://gotbootstrap.com/',
                        start: YM + '-28',
                        className: "bg-info border-info text-white"
                    }],
                viewSkeletonRender: function()
                {
                    $('.fc-toolbar .btn-default').addClass('btn-sm');
                    $('.fc-header-toolbar h2').addClass('fs-md');
                    $('#calendar').addClass('fc-reset-order')
                },

            });

        calendar.render();
    });

</script>
