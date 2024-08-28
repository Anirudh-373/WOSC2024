$(document).ready(function(){
	show_date();
	setInterval(function(){
		show_date();
	}, 1000);
	$(".side_menu li, .side_menu li ul").hover(function(){
		$(this).find('ul').css("display",'block');
		//$(this).find('ul').slideDown( "slow" );
	},function(){
		$(this).find('ul').css("display",'none');
		//$(this).find('ul').slideUp( "slow" );
	});
	$(".drop_down_title").live("click",function(){
		var down_id=$(this).attr('for');
		var down_status=$("#"+down_id).css('display');
		$( ".drop_down_content").slideUp( "slow" );
		$(".drop_down_title").removeClass('drop_selected');
		if(down_status=='none'){
			$(this).addClass('drop_selected');
			$( "#"+down_id).slideDown( "slow" );
		} else {
			$(this).removeClass('drop_selected');
		}
	});
	
	$(".tool-main").hover(function(){
		$(".tool-tip-box").css("display",'none');
		var tool_id=$(this).find(".tool-main-id").attr('for');
		$("#"+tool_id).css("display",'block');
	},function(){
		$(".tool-tip-box").css("display",'none');
	});
	/*$('.digits').countdowntimer({
		startDate : $("#today_servar_data").val(),
		//startDate : "2015/02/22 09:30:00",
		dateAndTime : "2015/02/23 09:30:00",
		size : "lg"
	});*/
	var austDay = new Date();
	austDay = new Date("2015/02/23 08:30:00");
	//austDay = new Date("0/0/0 0:0:00");
	$('.digits').countdown({until: austDay});
});
function show_date(){
		var month_array=new Array('January','February','March','April','May','June','July','August','September','October','November','December');
		var day_array=new Array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
		var currentdate = new Date();
		var date_suffix='th';
		var today_date=currentdate.getDate();
		date_suffix = ordinal_suffix_of(today_date);
		// if(today_date%10==1 && today_date%10!=11){
		// 	date_suffix='st';
		// } else if(today_date%10==2 && today_date%10!=12){
		// 	date_suffix='nd';
		// } else if(today_date%10==3 && today_date%10!=13){
		// 	date_suffix='rd';
		// }
		var show_date=day_array[currentdate.getDay()] + " " + currentdate.getDate() + ""+ date_suffix +" " + month_array[currentdate.getMonth()]  + " "  
						+ currentdate.getFullYear() + " "  + ("0" + currentdate.getHours()).slice(-2) + ":"  + ("0" + currentdate.getMinutes()).slice(-2) + ":" + ("0" + currentdate.getSeconds()).slice(-2);
		$(".div_content_left").html(show_date);
}

function ordinal_suffix_of(i) {
	var j = i % 10,
		k = i % 100;
	if (j == 1 && k != 11) {
		return "st";
	}
	if (j == 2 && k != 12) {
		return "nd";
	}
	if (j == 3 && k != 13) {
		return "rd";
	}
	return "th";
}
