var	month_order_view = function(){

		if ( $("body").find("#OrderStatus").length < 1 ) 
		{
			return false;
		};
		
		$.ajax({
			url: "/month_order_view",
			type: 'POST',
			success: function( data ) {

			var data1 = JSON.parse(data),
				data2 = $.map(data1, function(el) { return parseInt(el) });

				Highcharts.chart('OrderStatus', {
				    chart: {
				        type: 'column'
				    },
				    title: {
				        text: '每月訂單/銷單狀況'
				    },
				    xAxis: {
				        categories: [
				            'Jan',
				            'Feb',
				            'Mar',
				            'Apr',
				            'May',
				            'Jun',
				            'Jul',
				            'Aug',
				            'Sep',
				            'Oct',
				            'Nov',
				            'Dec'
				        ],
				        crosshair: true
				    },
				    yAxis: {
				        min: 0,
				        title: {
				            text: '訂單數'
				        }
				    },
				    tooltip: {
				        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
				        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
				            '<td style="padding:0"><b>{point.y:.0f} 單</b></td></tr>',
				        footerFormat: '</table>',
				        shared: true,
				        useHTML: true
				    },
				    plotOptions: {
				        column: {
				            pointPadding: 0.2,
				            borderWidth: 0
				        }
				    },
				    series: [{
				        name: '銷售',
				        data: data2

				    }]
				});

			}
		});

	},
	year_stock_view = function(){

		if ( $("body").find("#StockStatus").length < 1 ) 
		{
			return false;
		};

		$.ajax({
			url: "/year_stock_view",
			type: 'POST',
			success: function( data ) {

			var data1 = JSON.parse(data),
				Indata = $.map(data1['in'], function(el) { return parseInt(el) }),
				Outdata = $.map(data1['out'], function(el) { return parseInt(el) });
				
			    Highcharts.chart('StockStatus', {
			        chart: {
			            type: 'bar'
			        },
			        title: {
			            text: '每月出入庫狀況'
			        },
			        xAxis: [{
			            categories: [
				            'Jan',
				            'Feb',
				            'Mar',
				            'Apr',
				            'May',
				            'Jun',
				            'Jul',
				            'Aug',
				            'Sep',
				            'Oct',
				            'Nov',
				            'Dec'
				        ],
			            reversed: false,
			            labels: {
			                step: 1
			            }
			        }, { // mirror axis on right side
			            opposite: true,
			            reversed: false,
			            categories: [
				            'Jan',
				            'Feb',
				            'Mar',
				            'Apr',
				            'May',
				            'Jun',
				            'Jul',
				            'Aug',
				            'Sep',
				            'Oct',
				            'Nov',
				            'Dec'
				        ],
			            linkedTo: 0,
			            labels: {
			                step: 1
			            }
			        }],
			        yAxis: {
			            title: {
			                text: null
			            },
			            labels: {
			                formatter: function () {
			                    return Math.abs(this.value);
			                }
			            }
			        },

			        plotOptions: {
			            series: {
			                stacking: 'normal'
			            }
			        },

			        tooltip: {
			            formatter: function () {
			                return '<b>' + this.series.name + ', 數量 ' + this.point.category + '</b><br/>' +
			                    'Population: ' + Highcharts.numberFormat(Math.abs(this.point.y), 0);
			            }
			        },

			        series: [{
			            name: '入庫',
			            data: Indata
			        }, {
			            name: '出庫',
			            data: Outdata
			        }]
			    });	

			}
		});

	},
	stock_analytics = function(){

		if ( $("body").find("#ProductCategory").length < 1 ) 
		{
			return false;
		};

		$.ajax({
			url: "/stock_analytics",
			type: 'POST',
			success: function( data ) {


			var data1 = JSON.parse(data),
				times = 0,
				times2 = 0,
				level1 = $.map(data1['level1'], function(value, index) { 
							
							var colors = ["#FF0000","#AAAAAA","#FFFF00","#66B2EB","#00a65a"];

							data = {
								name: index,
								y: value,
								color: colors[times],
							};

							times++;

							times = times < 5 ? times : 1 ;

							return data;
						}),
				level2 = $.map(data1['level2'], function(value, index) { 

								var colors = ["#FF0000","#AAAAAA","#FFFF00","#66B2EB","#00a65a"];
									size = Object.keys(value).length,
									color_index = times2 % 5;

								data =  $.map(value, function(value2, index2){

											var brightness = 0.2;

											data = {
												name: index2,
												y: value2,
												color: Highcharts.Color(colors[times2]).brighten(brightness).get()
											};

											return data;								

										});
								
								times2++;

								times2 = times2 < 5 ? times2 : 1 ;

							return data 
						});

				// Create the chart
				Highcharts.chart('ProductCategory', {
				    chart: {
				        type: 'pie'
				    },
				    title: {
				        text: '庫存商品種類比例'
				    },
				    yAxis: {
				        title: {
				            text: '商品佔例'
				        }
				    },
				    plotOptions: {
				        pie: {
				            shadow: false,
				            center: ['50%', '50%']
				        }
				    },
				    tooltip: {
				        valueSuffix: '%'
				    },
				    series: [{
				        name: '大分類',
				        data: level1,
				        size: '60%',
				        dataLabels: {
				            formatter: function () {
				                return this.y > 5 ? this.point.name : null;
				            },
				            color: '#ffffff',
				            distance: -30
				        }
				    },{
				        name: '小分類',
				        data: level2,
				        size: '80%',
				        innerSize: '60%',
				        dataLabels: {
				            formatter: function () {
				                // display only if larger than 1
				                return this.y > 1 ? '<b>' + this.point.name + ':</b> ' +
				                    this.y + '%' : null;
				            }
				        },
				        id: 'versions'
				    }],
				    responsive: {
				        rules: [{
				            condition: {
				                maxWidth: 400
				            },
				            chartOptions: {
				                series: [{
				                    id: 'versions',
				                    dataLabels: {
				                        enabled: false
				                    }
				                }]
				            }
				        }]
				    }
				});			

			}
		});

	},
	month_top_five = function(){

		if ( $("body").find("#HotSellTop5").length < 1 ) 
		{
			return false;
		};

		$.ajax({
			url: "/year_product_top5",
			type: 'POST',
			success: function( data ) {

			var data1 = JSON.parse(data),
				total = $.map(data1['total'], function(el) { return el }),
				top5 = $.map(data1['top5'], function(el) { return el });
				
				Highcharts.chart('HotSellTop5', {
				    chart: {
				        type: 'column'
				    },
				    title: {
				        text: '月銷售Top 5'
				    },
				    xAxis: {
				        type: 'category'
				    },
				    yAxis: {
				        title: {
				            text: '銷售量'
				        }

				    },
				    legend: {
				        enabled: false
				    },
				    plotOptions: {
				        series: {
				            borderWidth: 0,
				            dataLabels: {
				                enabled: true,
				                format: '{point.y:.0f}'
				            }
				        }
				    },

				    tooltip: {
				        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
				        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
				    },

				    series: [{
				        name: '年報表',
				        colorByPoint: true,
				        data: total
				    }],
				    drilldown: {
				        series: top5
				    }
				});

			}
		});

	},
	product_top5_stack = function(){

		if ( $("body").find("#HotSellTop5Stack").length < 1 ) 
		{
			return false;
		};

		$.ajax({
			url: "/product_top5_stack",
			type: 'POST',
			success: function( data ) {

			var data1 = JSON.parse(data),
				categories = data1.product_name,
				safe_amount = data1.safe_amount,
				stock = data1.stock;

				// console.log(safe_amount);
				
				// return false;

				Highcharts.chart('HotSellTop5Stack', {
				    chart: {
				        type: 'column'
				    },
				    title: {
				        text: 'Top5商品庫存'
				    },
				    xAxis: {
				        categories: categories
				    },
				    yAxis: {
				        min: 0,
				        title: {
				            text: '庫存量'
				        },
				        stackLabels: {
				            enabled: true,
				            style: {
				                fontWeight: 'bold',
				                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
				            }
				        }
				    },
				    legend: {
				        align: 'right',
				        x: -30,
				        verticalAlign: 'top',
				        y: 25,
				        floating: true,
				        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
				        borderColor: '#CCC',
				        borderWidth: 1,
				        shadow: false
				    },
				    tooltip: {
				        headerFormat: '<b>{point.x}</b><br/>',
				        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
				    },
				    plotOptions: {
				        column: {
				            stacking: 'normal',
				            dataLabels: {
				                enabled: true,
				                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
				            }
				        }
				    },
				    series: [{
				        name: '安庫數',
				        data: safe_amount
				    }, {
				        name: '庫存數',
				        data: stock
				    }]
				});

			}
		});

	},
	loading = function(){

		if ( $(".report").length > 0 && $(".loadingImg").length > 0 ) 
		{

			setTimeout(function(){

				$(".report").fadeIn(500);
				$(".loadingImg").fadeOut(100);

			},2500);

		};

	};

month_order_view();
year_stock_view();
stock_analytics();
month_top_five();
loading();
// product_top5_stack();
