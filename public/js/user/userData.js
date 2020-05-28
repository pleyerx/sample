
$(function () {
   let init = function () {
        $('#userList').DataTable({
			ajax:           "./users",
			dataSrc: 		"data",
			deferRender:    true,
			scrollY:        200,
			scrollCollapse: true,
			scroller:       true,
			columns: 	
			[
				{ data: "user_account",
					render: function(data,type,row,meta){
						return data.toLowerCase();
					} 
				},			
				{ data: "user_name" },
				{ data: "user_sex", 
					render: function(data,type,row,meta){
						let outputSex = '';
						if( data == 0 ){
							outputSex = '女生';
						}else if( data == 1){
							outputSex = '男生';
						}
						return outputSex;
					} 
				},
				{ data: "user_birthday",
					render: function(data,type,row,meta){
						let birthdayArr = data.split("-");
						return birthdayArr[0] + '年' + birthdayArr[1]+'月' +birthdayArr[2]+ '日';
					} 
				},
				{ data: "user_email" },
				{
					orderable: false,
					render: function (data, type, row, meta) { 
						return "<input type='button' class='deleteUser' data-id='" + row.uid + "'  value='Delete' />";
					}
				}						
			]
        });
    }
	
	$("#deleteUserDialog").dialog({
        autoOpen: false,
        show: "blind",
        hide: "explode",
        buttons: {
            "ok": function() {  doDeleteUser();},
            "cancel": function() { $(this).dialog("close"); }
        }
    });
	
	$("#addUserDialog").dialog({
        autoOpen: false,
        show: "blind",
        hide: "explode",
        buttons: {
            "註冊帳號": function() {  doAddUser();},
            "取消": function() { $(this).dialog("close"); }
        }
    });	
	
	let doAddUser = function () {

		var form = $('#addUserForm')[0];
		var formData = new FormData(form);		
	    $.ajax({
        	url : "./user",
            type : "POST",
			data: formData,
			contentType : false,
			processData : false, 
            dataType : "json",
            success : function(data, textStatus, jqxhr){
                if( jqxhr.status == 200 ) {
                    window.location.reload();
                } else {
                    alert(data.message);
                }
            },
            error : function(jqXHR, textStatus, errorThrown ) {
                data = $.parseJSON(jqXHR.responseText);
				alert(data.message);
            }
        });	
	}
	
	let doDeleteUser = function () {
		let userId = $("#deleteUserHidden").val();
		//console.log(userId);
		
        $.ajax({
        	url : "./user/"+userId,
            type : "DELETE",
            dataType : "json",
            cache : false,
            success : function(data, textStatus, jqxhr){
                if( jqxhr.status == 200 ) {
					alert("刪除成功");
                    window.location.reload();
                } else {
                    alert("刪除失敗");
                }
            },
            error : function(data) {
                alert("刪除失敗");
            }
        });
	}
	
	$(document).delegate('.deleteUser','click',function() {
    	let id = $(this).data("id");
		$("#deleteUserDialog").dialog("open");
		$("#deleteUserHidden").val(id);
 	});	
	
	$(document).delegate('#addUserButton','click',function() {
		$("#addUserDialog").dialog("open");
 	});	
	init();
});