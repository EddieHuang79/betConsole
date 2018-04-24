
if ( $(".basicForm").length > 0 ) 
{

	var basicForm = new Vue({
		el: '.basicForm',
		components: {
			basicForm: basicForm
		}
	});

}


if ( $(".basicList").length > 0 ) 
{

	var basicList = new Vue({
		el: '.basicList',
		components: {
			basicList: basicList
		},
		methods: {

			SearchToolDisplay: function() {
				$(".search_tool").toggle('slow');
			}
			
		}
	});

}

if ( $(".report").length > 0 ) 
{

	var report = new Vue({
		el: '.report',
		components: {
			reportOne: reportOne,
			reportTwo: reportTwo,
			reportThree: reportThree,
			reportFour: reportFour,
			reportFive: reportFive
		},
		created: function(){

			setTimeout(function(){

				$(".report").fadeIn(500);
				$(".loadingImg").fadeOut(100);

			},2500);

		}
	});

}