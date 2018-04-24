var basicForm = {

		template: '<form :action="list.action" method="POST" enctype="multipart/form-data">\
						<div class="box-body">\
							<div v-for="(item, index) in list">\
								<div v-if="item.type === 1 && item.display === true" class="form-group" :class="item.attrClass">\
									<label>{{ item.title }}</label><h6>{{ item.desc }}</h6>\
									<input type="text" :name="item.key" class="form-control" :value="item.value" :placeholder="item.placeholder" required/>\
								</div>\
								<div v-if="item.type === 2 && item.display === true" class="form-group" :class="item.attrClass">\
									<label>{{ item.title }}</label><h6>{{ item.desc }}</h6>\
									<select :name="item.key" class="form-control" @change="EventFunc(index)" required>\
										<option value="">{{ txt.select_default }}</option>\
										<option v-for="(ChildItem, ChildIndex) in item.data" :value="ChildIndex">{{ ChildItem }}</option>\
									</select>\
								</div>\
								<div v-if="item.type === 3 && item.display === true" class="form-group" :class="item.attrClass">\
									<label>{{ txt.status }}</label><h6>{{ item.desc }}</h6>\
									<div class="radio" v-for="(ChildItem, ChildIndex) in item.data">\
										<label>\
											<input type="radio" :value="ChildIndex" :name="item.key" required/>{{ ChildItem }}\
										</label>\
									</div>\
								</div>\
								<div v-if="item.type === 4 && item.display === true" class="form-group" :class="item.attrClass">\
									<label>{{ item.title }}</label><h6>{{ item.desc }}</h6>\
									<div :class="item.key" v-for="(dataItem, dataIndex) in item.data">\
										<input type="button" :value="txt.remove_block" class="remove btn btn-primary" :target=" \'.\' + item.key" @click="removeBlock($event)"> <br /><br />\
										<div v-for="(childItem, childIndex) in item.child"><label>{{ childItem.childTitle }}</label>: <input type="text" :name="childItem.key" class="form-control" :value="dataItem[childItem.childTitle]" /></div>\
									</div>\
									<input type="button" :value="txt.add_block" class="add_block btn btn-primary" :target=" \'.\' + item.key" @click="addBlock($event)">\
								</div>\
								<div v-if="item.type === 5 && item.display === true" class="form-group" :class="item.attrClass">\
									<label>{{ item.title }}</label><h6>{{ item.desc }}</h6>\
									<div>{{ item.value }}</div>\
								</div>\
								<div v-if="item.type === 6 && item.display === true" class="form-group" :class="item.attrClass">\
									<label>{{ item.title }}</label><h6>{{ item.desc }}</h6>\
									<div v-for="(dataItem, dataIndex) in item.data">\
										<input type="checkbox" :value="dataItem.id" :name="item.key" />{{ dataItem.name }}\
									</div>\
								</div>\
								<div v-if="item.type === 7 && item.display === true" class="form-group" :class="item.attrClass">\
									<label>{{ item.title }}</label><h6>{{ item.desc }}</h6>\
									<input type="password" :name="item.key" class="form-control" :value="item.value" :placeholder="item.placeholder" required/>\
								</div>\
								<div v-if="item.type === 8 && item.display === true" class="form-group" :class="item.attrClass">\
									<label>{{ item.title }}</label><h6>{{ item.desc }}</h6>\
									<input type="file" :name="item.key"> <br />\
									<input type="button" :value="txt.downaload_example" class="btn btn-primary" @click="linkTo(item.Samplelink)" >\
								</div>\
								<div v-if="item.type === 9 && item.display === true" class="form-group" :class="item.attrClass">\
									<label>{{ item.title }}</label><h6>{{ item.desc }}</h6>\
									<select :name="item.key" class="form-control" @change="EventFunc(index)" required>\
										<option value="">{{ txt.select_default }}</option>\
										<option v-for="(ChildItem, ChildIndex) in item.data" :value="ChildIndex">{{ ChildItem }}</option>\
									</select> <br />\
									<select :name="item.SubMenuKey" class="hide ajaxSelect form-control">\
										<option value="">{{ txt.select_default }}</option>\
									</select>\
								</div>\
								<div v-if="item.type === 10 && item.display === true" class="form-group" :class="item.attrClass">\
									<label>{{ item.title }}</label><h6>{{ item.desc }}</h6>\
									<input type="text" :name="item.key" class="form-control autocomplete" :value="item.value" :placeholder="item.placeholder" @click="autocomplete($event, site, item.key)" required/>\
								</div>\
								<div v-if="item.type === 11 && item.display === true" class="form-group" :class="item.attrClass">\
									<input type="hidden" :name="item.key" :value="item.value">\
								</div>\
								<div v-if="item.type === 12 && item.display === true" class="form-group" :class="item.attrClass">\
									<label>{{ item.title }}</label><h6>{{ item.desc }}</h6>\
									<div>{{ item.value }}</div>\
								</div>\
								<div v-if="item.type === 13 && item.display === true" class="form-group" :class="item.attrClass">\
									<label>{{ item.title }}</label><h6>{{ item.desc }}</h6>\
									<div class="auth-div" v-for="(ChildItem, ChildIndex) in item.data">\
										<label v-if="!Array.isArray(ChildItem.child)" class="RoleListBtn" @click="extendRoleList($event)">+</label>\
										<input type="checkbox" :value="ChildItem.id" alt="main" :class="\'auth\' + ChildItem.id" :name="item.key" @click="clickAll(\'auth\' + ChildItem.id)">{{ ChildItem.name }}\
										<ul class="auth">\
											<li v-for="(SubChildItem, SubChildIndex) in ChildItem.child"><input type="checkbox" :value="SubChildItem.id" :class="\'auth\' + ChildItem.id" :name="item.key" >{{ SubChildItem.name }}</li>\
										</ul>\
									</div>\
								</div>\
							</div>\
							<div class="form-group">\
								<input type="submit" class="btn btn-primary btnColor" :value="txt.send "/>\
								<input type="hidden" name="_method" :value="list.method" />\
								<input type="hidden" name="_token" :value="token" />\
							</div>\
						</div>\
					</form>',
		props: ["txt", "list", "token", "site"],
		mounted: function(){
			
			this.$nextTick(function() {
		
				var list = this.list;

				$.map(list, function(value, index){

					if ( value.hasPlugin !== '' ) 
					{

						switch(value.hasPlugin)
						{

							case "DateTimePicker":

								$("[name='"+value.key+"']").datetimepicker({
																minDate: new Date(),
																dateFormat: 'yy/mm/dd', 
																timeFormat: 'HH:mm:ss'
															});

								break;

							case "DatePicker":

								$("[name='"+value.key+"']").datepicker({dateFormat: "yy-mm-dd"});

								break;

						}

					};

					if ( value.value !== '' && parseInt(value.type) === 2 ) 
					{

						$("[name='"+value.key+"']").val(value.value);

						basicForm.$refs.basicForm.EventFunc( index );

					}

					if ( value.value !== '' && parseInt(value.type) === 3 ) 
					{

						$("[name='"+value.key+"'][value='"+value.value+"']").attr("checked", true);

					}

					if ( value.value !== '' && parseInt(value.type) === 6 ) 
					{

						var data = value.value;

							$.map(data, function(item){

								$("[name='"+value.key+"'][value='"+item+"']").attr("checked", true);

							});						

					}

					if ( value.value !== '' && parseInt(value.type) === 9 ) 
					{

						$("[name='"+value.key+"']").val(value.value);

						basicForm.$refs.basicForm.EventFunc( value.SubMenuKey );

						setTimeout(function(){ $(".ajaxSelect").val(value.SubValue) }, 500);

					}

					if ( value.value !== '' && parseInt(value.type) === 13 ) 
					{

						var data = value.value;

							$.map(data, function(item){

								$(".auth"+item).prop("checked", true);

								console.log(".auth"+item);

							});								

					}

					if ( value.required === false ) 
					{

						$("[name='"+value.key+"']").attr("required", false);					

					}

				});

			})			
		
		},
		methods: {

			addBlock: function(event) {

				var target = $(event.currentTarget).attr("target"),
					limit = $(event.currentTarget).attr("limit"),
					len = $(target).length;

					if (limit > 0 && limit <= len) 
					{
						return false;
					};

					$(target+":first").clone().insertAfter(target+":last");
					$(target+":last").find("input[type='text'],select,input[type='number']").val('');

			},

			removeBlock: function() {

				var target = $(event.currentTarget).attr("target"),
					len = $(target).length;

				if (len > 1) 
				{
					$(event.currentTarget).parents(target).remove();
				};

				if (len <= 1) 
				{
					$(event.currentTarget).parents(target).find("input[type='text'],select,input[type='number']").val('');
				};	
				
			},

			EventFunc: function(key){

				switch(key)
				{

					case 'ecoupon_type':

						var type = parseInt($("[name='type']").val());

							$(".ecouponType").addClass("hide");

							$(".ecouponType").find("input").attr("required", false);

							$(".ecouponType" + type).removeClass("hide");

							$(".ecouponType" + type).find("input").attr("required", true);

						break;


					case 'ecoupon_match_type':

						var type = parseInt($("[name='match_type']").val());

							$(".matchType").find("input,select").attr("required", false);

							$(".matchType").addClass("hide");

							$(".matchType" + type).removeClass("hide");

							$(".matchType" + type).find("input,select").attr("required", true);

						break;


					case 'category':

							this.ajaxSelect( "category" );

						break;

					case 'store_type_select':
					case 'store_type_id':

							this.ajaxSelect( "store_type_select" );

						break;

				}

			},

			linkTo: function(link){

				location.href = link;

			},

			ajaxSelect: function(key){

				switch(key)
				{

					case "category":

							$('.ajaxSelect').hasClass("hide") ? $('.ajaxSelect').removeClass("hide") : "" ;

							$.ajax({
								url: "/get_child_list",
								type: 'POST',
								data: "parents_id="+$("[name='parents_category']").val(),
								success: function( response ) {

									var return_data = JSON.parse(response);

									$('.ajaxSelect').find("option.append").remove();

									$.map(return_data, function(value, index) {
										$('.ajaxSelect').append($('<option>', {
										    value: index,
										    text: value,
										    class: "append"
										}));
									});
								
								}
							});	

						break;


					case "store_type_select":

							$('.ajaxSelect').hasClass("hide") ? $('.ajaxSelect').removeClass("hide") : "" ;

							$.ajax({
								url: "/get_child_store",
								type: 'POST',
								data: "parents_store="+$("[name='parents_store_type']").val(),
								success: function( response ) {

									var return_data = JSON.parse(response);

									$('.ajaxSelect').find("option.append").remove();

									$.map(return_data, function(value, index) {
										$('.ajaxSelect').append($('<option>', {
										    value: index,
										    text: value,
										    class: "append"
										}));
									});
								
								}
							});	

						break;

				}

			},

			autocomplete: function(event, site, type){


				var url = site;

					switch(type)
					{

						case 'product_name':

							url += "/product/get_product_list";

							$( "[name='"+type+"']" ).autocomplete({
						    	source: url,
						    	close: function( event, ui ) {

						    	},
						    	select: function( event, ui ) {
						    		var product_id = ui.item.index,
						    			keep_for_days = ui.item.keep_for_days;
						    		$("[name='product_id']").val(product_id);
						    		$("[name='keep_for_days']").val(keep_for_days);
						    	},
						    	response: function( event, ui ){


						    	}
						    });

							break;

					}

			},

			extendRoleList: function(event){

				var label_txt = $(event.currentTarget).parents(".auth-div").find("ul.auth:visible").length > 0 ? "+" : "-" ;
					
					$(event.currentTarget).parents(".auth-div").find("ul.auth").toggle();
					
					$(event.currentTarget).text(label_txt);

			},

			clickAll: function(target){

				$("."+target).prop("checked", $("."+target+":first").prop("checked"));

			}

		}
		
	},
	basicList = {

		template: '<table class="table table-bordered table-striped">\
						<thead>\
							<tr>\
								<th v-for="(item, index) in list.title">\
									<div v-if="item.clickAll"><input type="checkbox" class="clickAll" @click="clickAll(item.target)"> {{ txt.select_all }}</div>\
									<div v-if="typeof item === \'string\'">{{ item }}</div>\
								</th>\
							</tr>\
						</thead>\
						<tbody>\
							<tr v-for="item2 in list.data">\
								<td v-for="row in item2.data">\
									<div v-if="!Array.isArray(row)">\
										<div v-if="row.isImage && row.data != \'\'"><img :src="row.data" alt="ProductPic" :class="row.class"/></div>\
										<div v-if="row.checkbox"><input type="checkbox" :name="row.key" :value="row.id" :class="row.class"/></div>\
										<div v-if="typeof row !== \'object\'">{{ row }}</div>\
									</div>\
									<div v-if="Array.isArray(row)">\
										<div v-for="(row1,index) in row">\
											<div>{{ row1 }}</div>\
										</div>\
									</div>\
								</td>\
								<td>\
									<input v-if="item2.Editlink" type="button" class="btn btn-primary btnColor" :value="txt.edit" @click="linkTo(item2.Editlink)"/>\
									<input v-if="item2.Clonelink" type="button" class="btn btn-primary btnColor" :value="txt.clone" @click="linkTo(item2.Clonelink)"/>\
									<input v-if="item2.PromoSettinglink" type="button" class="btn btn-primary btnColor" :value="txt.promo_price_setting" @click="linkTo(item2.PromoSettinglink)"/>\
									<div v-if="item2.actionWord">{{ item2.actionWord }}</div>\
								</td>\
							</tr>\
							<tr v-if="list.data.length < 1">\
								<th :colspan="list.title.length + 1">{{ txt.find_nothing }}</th>\
							</tr>\
						</tbody>\
					</table>',
		props: ["txt", "list"],
		methods: {

			linkTo: function(link){

				location.href = link;

			},

			extend_account_deadline: function( item ){
				
				$(".popup_option").find(".account").text( item.data.store_name );
				$("[name='user_id']").val( item.id );

				$.ajax({
					url: "/get_extend_deadline_option",
					type: 'POST',
					success: function( response ) {

						var data = JSON.parse(response);

						if ( data.length !== 0 ) 
						{

							$('[name="date_spec"]>.append').remove();

							$.map(data, function(value, index) {
								$('[name="date_spec"]').append($('<option>', {
								    value: index,
								    text: value,
								    class: "append"
								}));
							});

						}
						else
						{

							$("div.popup_option").text("擴充道具不足，請前往商城購買！");
							$("div.mall_product_btn").text("");
							$("div.mall_product_btn").append("<button class=\"btn btn-lg btn-primary btn-block\" type=\"button\" onclick=\"location.href='/buy';\">前往商城購買</button>");

						}

						$(".extend_lightbox").show();
					
					}
				});	

			},

			clickAll: function(target){

				$("."+target).prop("checked", $(".clickAll").prop("checked"));

			}

		}

	},
	reportOne = {

		template: '<div></div>',
		props: ["data"],
		created: function(){

				setTimeout(function(){

					var data = report.$refs.report1.data;

					Highcharts.chart('report1', {
					    chart: {
					        type: 'column'
					    },
					    title: {
					        text: data.title
					    },
					    xAxis: {
					        categories: data.categories
					    },
					    yAxis: {
					        min: 0,
					        title: {
					            text: data.yAxisTitle
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
					    series: data.series
					});

				}, 1000);

		}

	},
	reportTwo = {

		template: '<div></div>',
		props: ["data"],
		created: function(){

				setTimeout(function(){

					var data = report.$refs.report2.data;

					Highcharts.setOptions({
					    lang: {
					      decimalPoint: '.',
					      thousandsSep: ','
					    }
					});

					Highcharts.chart('report2', {
					    chart: {
					        type: 'column'
					    },
					    title: {
					        text: data.title
					    },
					    xAxis: {
					        categories: data.categories
					    },
					    yAxis: {
					        min: 0,
					        title: {
					            text: data.yAxisTitle
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
					        pointFormat: '{series.name}: {point.y:,.0f}<br/>Total: {point.stackTotal:,.0f}'
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
					    series: data.series
					});

				}, 1000);

		}

	},
	reportThree = {

		template: '<div></div>',
		props: ["data"],
		created: function(){

				setTimeout(function(){

					var data = report.$refs.report3.data;

					Highcharts.setOptions({
					    lang: {
					      decimalPoint: '.',
					      thousandsSep: ','
					    }
					});

					Highcharts.chart('report3', {
					    chart: {
					        type: 'column'
					    },
					    title: {
					        text: data.title
					    },
					    xAxis: {
					        categories: data.categories
					    },
					    yAxis: {
					        min: 0,
					        title: {
					            text: data.yAxisTitle
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
					        pointFormat: '{series.name}: {point.y:,.0f}<br/>Total: {point.stackTotal:,.0f}'
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
					    series: data.series
					});

				}, 1000);

		}

	},
	reportFour = {

		template: '<div></div>',
		props: ["data"],
		created: function(){

				setTimeout(function(){

					var data = report.$refs.report4.data;

					Highcharts.setOptions({
					    lang: {
					      decimalPoint: '.',
					      thousandsSep: ','
					    }
					});

					Highcharts.chart('report4', {
					    chart: {
					        type: 'column'
					    },
					    title: {
					        text: data.title
					    },
					    xAxis: {
					        categories: data.categories
					    },
					    yAxis: {
					        min: 0,
					        title: {
					            text: data.yAxisTitle
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
					        pointFormat: '{series.name}: {point.y:,.0f}<br/>Total: {point.stackTotal:,.0f}'
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
					    series: data.series
					});

				}, 1000);

		}

	},
	reportFive = {

		template: '<div></div>',
		props: ["data"],
		created: function(){

				setTimeout(function(){

					var data = report.$refs.report5.data;

					Highcharts.chart('report5', {
						chart: {
							type: 'area'
						},
						title: {
							text: data.title
						},
						subtitle: {
							text: data.subtitle
						},
						xAxis: {
							categories: data.categories,
							tickmarkPlacement: 'on',
							title: {
								enabled: false
							}
						},
						yAxis: {
							title: {
								text: data.yAxisTitle
							},
							labels: {
								formatter: function () {
									return this.value;
								}
							}
						},
						tooltip: {
							split: true,
							valueSuffix: "人"
						},
						plotOptions: {
							area: {
								stacking: 'normal',
								lineColor: '#666666',
								lineWidth: 1,
								marker: {
									lineWidth: 1,
									lineColor: '#666666'
								}
							}
						},
						series: data.series
					});

				}, 1000);

		}

	},
	reportSix = {

		template: '<div></div>',
		props: ["data"],
		created: function(){

				// setTimeout(function(){

				// 	var data = report.$refs.report1.data;

				// 	Highcharts.chart('report1', {
				// 	    chart: {
				// 	        type: 'column'
				// 	    },
				// 	    title: {
				// 	        text: data.title
				// 	    },
				// 	    xAxis: {
				// 	        categories: data.categories
				// 	    },
				// 	    yAxis: {
				// 	        min: 0,
				// 	        title: {
				// 	            text: data.yAxisTitle
				// 	        },
				// 	        stackLabels: {
				// 	            enabled: true,
				// 	            style: {
				// 	                fontWeight: 'bold',
				// 	                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
				// 	            }
				// 	        }
				// 	    },
				// 	    legend: {
				// 	        align: 'right',
				// 	        x: -30,
				// 	        verticalAlign: 'top',
				// 	        y: 25,
				// 	        floating: true,
				// 	        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
				// 	        borderColor: '#CCC',
				// 	        borderWidth: 1,
				// 	        shadow: false
				// 	    },
				// 	    tooltip: {
				// 	        headerFormat: '<b>{point.x}</b><br/>',
				// 	        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
				// 	    },
				// 	    plotOptions: {
				// 	        column: {
				// 	            stacking: 'normal',
				// 	            dataLabels: {
				// 	                enabled: true,
				// 	                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
				// 	            }
				// 	        }
				// 	    },
				// 	    series: data.series
				// 	});

				// }, 3000);

		}

	};