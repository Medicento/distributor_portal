var App = (function () {
  'use strict';
  
  App.dashboard = function( ){

    //Counter
    function counter(){

      $('[data-toggle="counter"]').each(function(i, e){
        var _el       = $(this);
        var prefix    = '';
        var suffix    = '';
        var start     = 0;
        var end       = 0;
        var decimals  = 0;
        var duration  = 7.5;

        if( _el.data('prefix') ){ prefix = _el.data('prefix'); }

        if( _el.data('suffix') ){ suffix = _el.data('suffix'); }

        if( _el.data('start') ){ start = _el.data('start'); }

        if( _el.data('end') ){ end = _el.data('end'); }

        if( _el.data('decimals') ){ decimals = _el.data('decimals'); }

        if( _el.data('duration') ){ duration = _el.data('duration'); }

        var count = new CountUp(_el.get(0), start, end, decimals, duration, { 
          suffix: suffix,
          prefix: prefix,
        });

        count.start();
      });
    }

    //Show loading class toggle
    function toggleLoader(){
      $('.toggle-loading').on('click',function(){
        var parent = $(this).parents('.widget, .panel');

        if( parent.length ){
          parent.addClass('be-loading-active');

          setTimeout(function(){
            parent.removeClass('be-loading-active');
          }, 3000);
        }
      });
    }

    //Top tile widgets
    // function sparklines(){

    //   var color1 = App.color.primary;
    //   var color2 = App.color.warning;
    //   var color3 = App.color.success;
    //   var color4 = App.color.danger;

    //   $('#spark1').sparkline([0,5,3,7,5,10,3,6,5,10], { 
    //     width: '85',
    //     height: '35',
    //     lineColor: color1,
    //     highlightSpotColor: color1,
    //     highlightLineColor: color1,
    //     fillColor: false,
    //     spotColor: false,
    //     minSpotColor: false,
    //     maxSpotColor: false,
    //     lineWidth: 1.15
    //   });

    //   $("#spark2").sparkline([5,8,7,10,9,10,8,6,4,6,8,7,6,8], { 
    //     type: 'bar', 
    //     width: '85',
    //     height: '35',
    //     barWidth: 3,
    //     barSpacing: 3,
    //     chartRangeMin: 0,
    //     barColor: color2 
    //   });

    //   $('#spark3').sparkline([2,3,4,5,4,3,2,3,4,5,6,5,4,3,4,5,6,5,4,4,5], { 
    //     type: 'discrete', 
    //     width: '85',
    //     height: '35',
    //     lineHeight: 20,
    //     lineColor: color3,
    //     xwidth: 18 
    //   });

    //   $('#spark4').sparkline([2,5,3,7,5,10,3,6,5,7], { 
    //     width: '85',
    //     height: '35',
    //     lineColor: color4,
    //     highlightSpotColor: color4,
    //     highlightLineColor: color4,
    //     fillColor: false,
    //     spotColor: false,
    //     minSpotColor: false,
    //     maxSpotColor: false,
    //     lineWidth: 1.15
    //   });
    // }

    //Main chart
    function mainChart(){

      var color1 = App.color.primary;
      var color2 = tinycolor( App.color.primary ).lighten( 13 ).toString();
//      var color3 = tinycolor( App.color.primary ).lighten( 20 ).toString();

      var data = [
        [1, 35],
        [2, 60],
        [3, 40],
        [4, 65],
        [5, 45],
        [6, 75],
        [7, 35],
        [8, 40],
        [9, 60]
      ];

      var data2 = [
        [1, 20],
        [2, 30],
        [3, 40],
        [4, 50],
        [5, 50],
        [6, 40],
        [7, 30],
        [8, 20],
        [9, 10]
      ];
//
//      var data3 = [
//        [1, 35],
//        [2, 15],
//        [3, 20],
//        [4, 30],
//        [5, 15],
//        [6, 18],
//        [7, 28],
//        [8, 10],
//        [9, 30]
//      ];
     

      var plot_statistics = $.plot("#main-chart", 
        [
        {
          data: data, 
          canvasRender: true
        },
        {
          data: data2, 
          canvasRender: true
        }
//        {
//          data: data3, 
//          canvasRender: true
//        }
        ], {
        series: {
          lines: {
            show: true,
            lineWidth: 0, 
            fill: true,
            fillColor: { colors: [{ opacity: 1 }, { opacity: 1 }] }
          },
          fillColor: "rgba(0, 0, 0, 1)",
          shadowSize: 0,
          curvedLines: {
            apply: true,
            active: true,
            monotonicFit: true
          }
        },
        legend:{
          show: false
        },
        grid: {
          show: true,
          margin: {
            top: 20,
            bottom: 0,
            left: 0,
            right: 0,
          },
          labelMargin: 0,
          minBorderMargin: 0,
          axisMargin: 0,
          tickColor: "rgba(0,0,0,0.05)",
          borderWidth: 0,
          hoverable: true,
          clickable: true
        },
        colors: [color1, color2],
        xaxis: {
          tickFormatter: function(){
            return '';
          },
          autoscaleMargin: 0,
          ticks: 11,
          tickDecimals: 0,
          tickLength: 0
        },
        yaxis: {
          tickFormatter: function(){
            return '';
          },
          //autoscaleMargin: 0.01,
          ticks: 4,
          tickDecimals: 0
        }
      });

      //Chart legend color setter
      $('[data-color="main-chart-color1"]').css({'background-color':color1});
      $('[data-color="main-chart-color2"]').css({'background-color':color2});
//      $('[data-color="main-chart-color3"]').css({'background-color':color3});
    }

  
    //CounterUp Init
    counter();

    //Loader show
    toggleLoader();

    //Row 1
    sparklines();

	  //Row 2
    mainChart();


  };

  return App;
})(App || {});
