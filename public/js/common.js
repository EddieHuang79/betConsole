var Show_current_position = function(){
		var service_id = $(".service_id").val();
		if (parseInt(service_id) > 0)
		{
			$("[page='page"+service_id+"']").parents(".treeview-menu").addClass("active");
			$("[page='page"+service_id+"']").parents(".treeview-menu").toggle();
			$("[page='page"+service_id+"']").parents(".treeview").find(".fa-angle-left").addClass("fa-angle-down");
			$("[page='page"+service_id+"']").parents(".treeview").find(".fa-angle-left").removeClass("fa-angle-left");
		};

	},
	RemoveBtn = function(){
		var target_class = $(this).attr("target"),
			target_len = $("."+target_class).length;
		if (target_len > 1) 
		{
			$(this).parents(".clone").remove();
		}
		else
		{
			$(this).parents(".clone").find("input[type='text'],select,input[type='hidden']").val('');
		}

	},
	AddBtn = function(){
		var target_class = $(this).attr("target");
		$("."+target_class+":first").clone().insertAfter("."+target_class+":last");
		$("."+target_class+":last").find("input[type='text'],select,input[type='hidden']").val('');
	
	},
	ClickAll = function(){
		var group = $(this).attr("group"),
			Dom = $("[group='"+group+"']"),
			status = Dom.prop("checked") == true ? true : false ;

		Dom.each(function(e){
			$(this).prop("checked", status);
		});
	
	},
	Search_tool_display = function() {
		$(".search_tool").toggle('slow');
	
	},
	Refresh_verify_code = function() {
		$.ajax({
			url: "/refresh",
			data: "",
			type: 'POST',
			success: function( response ) {
				$(".verify_code").attr("src", response);
			}
		});
	
	},
	Ajax_init = function() {
		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
	
	},
	ClosePopup = function() {
		$(".lightbox").hide();
		var placeholder = $("[name='store_type']").attr("placeholder_bk");
		if ( placeholder !== "undefined" &&  placeholder != "") 
			$("[name='store_type']").attr("placeholder", placeholder);
	
	},
	call_store_type = function() {
		var placeholder = $(this).attr("placeholder");
		$(this).attr("placeholder", "");
		$(this).attr("placeholder_bk", placeholder);
		$(".store_type_border").show();
		$(".store_type>li").hide();
		$(".store_type>li.parent").show();
		$(".store_type>li").removeClass('store_type_choose');
	
	}
	store_type_find_child = function() {
		var optid = $(this).val();
		$("[name='store_type_id']").val("");
		$("[name='store_type_id']>option").hide();
		$("[name='store_type_id']>option[parentsid='"+optid+"']").show();
	
	},
	set_store_type = function() {
		var choose_opt = $(this).text(),
			optid = $(this).attr("optid");
		$("[name='store_type']").val(choose_opt);
		$("[name='store_type_id']").val(optid);
		$(".store_type_border").hide();
	
	},
	change_store = function() {
		var store_id = $(this).attr("storeId"),
			selected = $(this).hasClass("selected");

		if ( selected === false ) 
		{
			$(".switch_store").val(store_id);
			$("form.change_store").submit();
		};

	},
	dragHandler = function(e){
		e.preventDefault();
	
	},
	dropImage = function(e){
		e.preventDefault();
		var files = e.dataTransfer.files,
			objXhr = new XMLHttpRequest(),
			url = "/photo_upload_process",
			objForm = new FormData();
		objXhr.open('POST', url) ;
		objForm.append('photo_upload_preview', files[0]);
		objXhr.send(objForm);
	

		objXhr.upload.onprogress = function(e) {

		    if (e.lengthComputable)
		    {
		        var intComplete = (e.loaded / e.total) * 100 | 0,
		        	elProgress = $("#upload_progress");

		        elProgress.text(intComplete + '%') ; // 控制進度條的顯示數字，例如65%

		        elProgress.attr("style","width: "+intComplete+'%;') ; // 控制進度條的長度

		        elProgress.attr('aria-valuenow', intComplete) ;
		    }
		};

		objXhr.onload = function(e){
		    /*接收後端傳回的Response，本範例的後端程式會傳回每個圖檔是否都上傳成功，以及上傳成功的圖片數量*/

		    var arrData = JSON.parse(objXhr.responseText),
		    	img = new Image(),
		    	images_container = $(".upload_image_preview") ;
		    	// $(".crop_txt").show();
		        img.src = arrData ;
		        img.className = 'image' ;
		        img.id = 'crop_image' ;
		        images_container.append(img) ;
		    $(".autoUpload").hide();
		    $(".cropImage").show();
			$('#crop_image').cropper({
				aspectRatio: 1,
				background: false,
				zoomable: false

			});
		};
	
	},
	upload_crop_image = function(e){
		// Upload cropped image to server if the browser supports `HTMLCanvasElement.toBlob`
		getRoundedCanvas($('#crop_image').cropper('getCroppedCanvas')).toBlob(function (blob) {
				var formData = new FormData();

				formData.append('photo_upload', blob);

				$.ajax('/photo_upload_process', {
					method: "POST",
					data: formData,
					processData: false,
					contentType: false,
					success: function (response) {
						location.reload();
					},
					error: function (error) {
						console.log(error+'Upload error');
					}
				});
		});
	
	},
	getRoundedCanvas = function(sourceCanvas){
		var canvas = document.createElement('canvas'),
			context = canvas.getContext('2d'),
			width = sourceCanvas.width,
			height = sourceCanvas.height;

		canvas.width = width;
		canvas.height = height;
		context.beginPath();
		context.arc(width / 2, height / 2, Math.min(width, height) / 2, 0, 2 * Math.PI);
		context.strokeStyle = 'rgba(0,0,0,0)';
		context.stroke();
		context.clip();
		context.drawImage(sourceCanvas, 0, 0, width, height);

		return canvas;
	
	},
	clickAllFunction = function(){
		var	target = $(this).attr("target"),
			Dom = $("."+target),
			status = $(this).prop("checked") == true ? true : false ;

		Dom.each(function(e){
			$(this).prop("checked", status);
		});

	},
	count_lightbox_width = function(){
		var lightbox_width = ( $(".lightbox").width() / 2 ) * -1;
		$(".lightbox").css( "margin-left", lightbox_width );
	
	},
	extend_account_deadline = function(){
		
		var account = $(this).attr("account"),
			userId = $(this).attr("userId");
		
		$(".popup_option").find(".account").text(account);
		$("[name='user_id']").val(userId);

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
	ExtendSubmit = function(){
		
		var user_id = $("#ShopForm").find("[name='user_id']").val(),
			date_spec = $("#ShopForm").find("[name='date_spec']").val(),
			url = $("#ShopForm").attr("action");

			if ( user_id == '' || date_spec == '' ) 
			{

				$("#ShopForm").find("[name='date_spec']").focus();

				return false;
			
			};

			$.ajax({
				url: url,
				type: 'POST',
				data: "user_id="+user_id+"&date_spec="+date_spec,
				success: function( response ) {
					
					var data = JSON.parse(response);
					$(".shop_finish").find(".subject").text(data.subject);
					$(".shop_finish").find(".content").text(data.content);
					$(".lightbox").hide();
					$(".shop_finish").fadeIn();

					// After 1.5 sec reload

					setTimeout(function(){ location.reload(); }, 1500);

				}
			});	
	
	},
	MallSubmit = function(){
		
		var service = [],
			verify = true;

		$("[name='service[]']").each(function(e){

			var value = $(this).val();

			if ( service.indexOf(value) < 0 && value != '' ) 
			{
				service[e] = value; 
			}
			else
			{
				verify = false;
				$("[name='service[]']").eq(e).focus();
				$("[name='service[]']").eq(e).css("background-color","#CCC");
			};

		});
	
		if ( verify === false ) 
		{

			return false;

		};

		$("#mallForm").submit();

	},
	product_category = function(){

		var parents_id = $(this).val();

		$(".append").remove();
	
		$.ajax({
			url: "/product_category/get_child_list",
			type: 'POST',
			data: "parents_id="+parents_id,
			success: function( response ) {
				var data = JSON.parse(response);

				$('<select>', {
					    name: 'new_category',
					    class: "append form-control"
					}
				).insertAfter("#category");

				$.map(data, function(value,index) { 

					$('[name="new_category"]').append($('<option>', {
					    value: index,
					    text: value,
					    class: "append"
					}));

				});

				$('[name="category"]').attr("name", "parents_category");
				$('[name="new_category"]').attr("name", "category");
				
			}
		});	

	},
	add_block = function() {
		var target = $(this).attr("target"),
			limit = $(this).attr("limit"),
			len = $(target).length;

			if (limit > 0 && limit <= len) 
			{
				return false;
			};

			$(target+":first").clone().insertAfter(target+":last");
			$(target+":last").find("input[type='text'],select,input[type='number']").val('');			
	},
	remove_block = function() {
		var target = $(this).attr("target"),
			len = $(target).length;

		if (len > 1) 
		{
			$(this).parents(target).remove();
		};

		if (len <= 1) 
		{
			$(this).parents(target).find("input[type='text'],select,input[type='number']").val('');
		};	
		
	};


Show_current_position();
Ajax_init();
count_lightbox_width();

$(".addbtn").on("click", AddBtn);
$(document).on("click", ".removeLabel", RemoveBtn);
$("[alt='main']").on("click", ClickAll);
$(".refresh_verify_code").on("click", Refresh_verify_code);
$(".close_btn").on("click", ClosePopup);

$("[name='store_type']").on("click", call_store_type);
$("[name='parents_store_type']").on("change", store_type_find_child);
$(".branch_select>li").on("click", change_store);
$(".crop").on("click", upload_crop_image);
$(".clickAll").on("click", clickAllFunction);
$(".extend_account_deadline").on("click", extend_account_deadline);
$("#category").on("change", product_category);
$(".fa-search").on("click", Search_tool_display);
$(".add_block").on("click", add_block);
$(document).on("click", ".remove", remove_block);

$("#start_date").datetimepicker({
								minDate: new Date(),
								dateFormat: 'yy/mm/dd', 
								timeFormat: 'HH:mm:ss'
							});

$("#end_date").datetimepicker({
								minDate: new Date(),
								dateFormat: 'yy/mm/dd', 
								timeFormat: 'HH:mm:ss'
							});

if ( $(".search_tool").find("[name='date']").length > 0 ) 
{
	
	$(".search_tool").find("[name='date']").datepicker({dateFormat: "yy-mm-dd"});

};
