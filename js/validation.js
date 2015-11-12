$(document).ready(function() {	
	// validate admin_new
	var admin_new_form = $('#admin_new_form');
    var admin_new_error = $('.alert-danger', admin_new_form);	
	admin_new_form.validate({ 
		errorElement: 'span', 
        errorClass: 'help-block', 
		rules: {
			user_fullname: {
				required: true,
				remote: {
					url: "includes/validation/checkAdminName.php",
					type: "post"
				}
			},
			user_login: {
				required: true,
				remote: {
					url: "includes/validation/checkAdminLogin.php",
					type: "post"
				}
			},
			user_email: {
				required: true,
				email: true,
				remote: {
						url: "includes/validation/checkAdminEmail.php",
						type: "post"
					 }
			},
			user_passwd: "required",
			user_passwd2: {
			  	equalTo: "#user_passwd"
			}
		},
		messages: {
			user_fullname: {
				required: "*Requerido.",
				remote: "Nombre ya existe, intenta con otro"
			},
			user_login: {
				required: "*Requerido.",
				remote: "Acceso ya existe, intenta con otro"
			},
			user_email: {
				required: "*Requerido.",
				email: "Email no valido", 
				remote: "Email ya existe, intenta con otro"
			},
			user_passwd: "*Requerido.",
			user_passwd2: {
			  	equalTo: "Las contraseñas no coinciden"
			}
		},
		
		invalidHandler: function (event, validator) { //display error alert on form submit        
			admin_new_error.show();
		},
		errorPlacement: function (error, element) { // render error placement for each input type
			if (element.parent(".input-group").size() > 0) {
				error.insertAfter(element.parent(".input-group"));
			} else if (element.attr("data-error-container")) { 
				error.appendTo(element.attr("data-error-container"));
			} else if (element.parents('.radio-list').size() > 0) { 
				error.appendTo(element.parents('.radio-list').attr("data-error-container"));
			} else if (element.parents('.radio-inline').size() > 0) { 
				error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
			} else if (element.parents('.checkbox-list').size() > 0) {
				error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
			} else if (element.parents('.checkbox-inline').size() > 0) { 
				error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
			} else {
				error.insertAfter(element); // for other inputs, just perform default behavior
			}
		},		
		highlight: function (element) { // hightlight error inputs
			$(element) 
				.closest('.form-group').addClass('has-error'); // set error class to the control group
		},		
		success: function (label) {
			label
				.closest('.form-group').removeClass('has-error'); // set success class to the control group
		},
		submitHandler: function (form) {
			success3.show();
			error3.hide();
		}	
	});
	// END validate admin_new
	
	// validate admin_edit
	var admin_edit_form = $('#admin_edit_form');
    var admin_edit_error = $('.alert-danger', admin_edit_form);	
	admin_edit_form.validate({
		errorElement: 'span', 
        errorClass: 'help-block', 
		rules: {
			user_fullname: {
				required: true,
				remote: {
					url: "includes/validation/checkAdminName_edit.php",
					type: "post",
					data: {
					  	user_fullname: function() {
							return $( "#user_fullname" ).val();
						},
						user_id: function() {
							return $( "#user_id" ).val();
						}
					}
				}
			},
			user_login: {
				required: true,
				remote: {
					url: "includes/validation/checkAdminLogin_edit.php",
					type: "post",
					data: {
					  	user_login: function() {
							return $( "#user_login" ).val();
						},
						user_id: function() {
							return $( "#user_id" ).val();
						}
					}
				}
			},
			user_email: {
				required: true,
				email: true,
				remote: {
						url: "includes/validation/checkAdminEmail_edit.php",
						type: "post",
						data: {
							user_email: function() {
								return $( "#user_email" ).val();
							},
							user_id: function() {
								return $( "#user_id" ).val();
							}
						}						
					}
			},
			user_passwd2: {
			  	equalTo: "#user_passwd"
			}
		},
		messages: {
			user_fullname: {
				required: "*Requerido.",
				remote: "Nombre ya existe, intenta con otro"
			},
			user_login: {
				required: "*Requerido.",
				remote: "Acceso ya existe, intenta con otro"
			},
			user_email: {
				required: "*Requerido.",
				email: "Email no valido", 
				remote: "Email ya existe, intenta con otro"
			},
			user_passwd2: {
			  	equalTo: "Las contraseñas no coinciden"
			}
		},
		
		invalidHandler: function (event, validator) { //display error alert on form submit        
			admin_edit_error.show();
		},
		errorPlacement: function (error, element) { // render error placement for each input type
			if (element.parent(".input-group").size() > 0) {
				error.insertAfter(element.parent(".input-group"));
			} else if (element.attr("data-error-container")) { 
				error.appendTo(element.attr("data-error-container"));
			} else if (element.parents('.radio-list').size() > 0) { 
				error.appendTo(element.parents('.radio-list').attr("data-error-container"));
			} else if (element.parents('.radio-inline').size() > 0) { 
				error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
			} else if (element.parents('.checkbox-list').size() > 0) {
				error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
			} else if (element.parents('.checkbox-inline').size() > 0) { 
				error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
			} else {
				error.insertAfter(element); // for other inputs, just perform default behavior
			}
		},		
		highlight: function (element) { // hightlight error inputs
			$(element) 
				.closest('.form-group').addClass('has-error'); // set error class to the control group
		},		
		success: function (label) {
			label
				.closest('.form-group').removeClass('has-error'); // set success class to the control group
		},
		submitHandler: function (form) {
			success3.show();
			error3.hide();
		}	
	});
	// END validate admin_edit
	
	
	// validate album_new
	var album_new_form = $('#album_new_form');
    var album_new_error = $('.alert-danger', album_new_form);	
	album_new_form.validate({
		errorElement: 'span', 
        errorClass: 'help-block', 
		rules: {
			album_name: {
				required: true,
				remote: {
					url: "includes/validation/checkAlbumName.php",
					type: "post"
				}
			}
		},
		messages: {
			album_name: {
				required: "*Requerido.",
				remote: "Nombre ya existe, intenta con otro"
			}
		},
		
		invalidHandler: function (event, validator) { //display error alert on form submit        
			admin_new_error.show();
		},
		errorPlacement: function (error, element) { // render error placement for each input type
			if (element.parent(".input-group").size() > 0) {
				error.insertAfter(element.parent(".input-group"));
			} else if (element.attr("data-error-container")) { 
				error.appendTo(element.attr("data-error-container"));
			} else if (element.parents('.radio-list').size() > 0) { 
				error.appendTo(element.parents('.radio-list').attr("data-error-container"));
			} else if (element.parents('.radio-inline').size() > 0) { 
				error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
			} else if (element.parents('.checkbox-list').size() > 0) {
				error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
			} else if (element.parents('.checkbox-inline').size() > 0) { 
				error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
			} else {
				error.insertAfter(element); // for other inputs, just perform default behavior
			}
		},		
		highlight: function (element) { // hightlight error inputs
			$(element) 
				.closest('.form-group').addClass('has-error'); // set error class to the control group
		},		
		success: function (label) {
			label
				.closest('.form-group').removeClass('has-error'); // set success class to the control group
		},
		submitHandler: function (form) {
			success3.show();
			error3.hide();
		}	
	});
	// END validate album_new
	
	// validate album_edit
	var album_edit_form = $('#album_edit_form');
    var album_edit_error = $('.alert-danger', album_edit_form);	
	album_edit_form.validate({
		errorElement: 'span', 
        errorClass: 'help-block', 
		rules: {
			album_name: {
				required: true,
				remote: {
					url: "includes/validation/checkAlbumName_edit.php",
					type: "post",
					data: {
						album_name: function() {
							return $( "#album_name" ).val();
						},
						album_id: function() {
							return $( "#album_id" ).val();
						}
					}			
				}
			}
		},
		messages: {
			album_name: {
				required: "*Requerido.",
				remote: "Nombre ya existe, intenta con otro"
			}
		},
		
		invalidHandler: function (event, validator) { //display error alert on form submit        
			admin_new_error.show();
		},
		errorPlacement: function (error, element) { // render error placement for each input type
			if (element.parent(".input-group").size() > 0) {
				error.insertAfter(element.parent(".input-group"));
			} else if (element.attr("data-error-container")) { 
				error.appendTo(element.attr("data-error-container"));
			} else if (element.parents('.radio-list').size() > 0) { 
				error.appendTo(element.parents('.radio-list').attr("data-error-container"));
			} else if (element.parents('.radio-inline').size() > 0) { 
				error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
			} else if (element.parents('.checkbox-list').size() > 0) {
				error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
			} else if (element.parents('.checkbox-inline').size() > 0) { 
				error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
			} else {
				error.insertAfter(element); // for other inputs, just perform default behavior
			}
		},		
		highlight: function (element) { // hightlight error inputs
			$(element) 
				.closest('.form-group').addClass('has-error'); // set error class to the control group
		},		
		success: function (label) {
			label
				.closest('.form-group').removeClass('has-error'); // set success class to the control group
		},
		submitHandler: function (form) {
			success3.show();
			error3.hide();
		}	
	});
	// END validate album_edit
	
	// validate file_new
	var file_form = $('#file_form');
    var file_error = $('.alert-danger', file_form);	
	file_form.validate({
		errorElement: 'span', 
        errorClass: 'help-block', 
		rules: {
			file_title: {
				required: true
			},
			comentarios: {
				required: true
			},
			file: {
			  required: true,
			  extension: "pdf|doc|docx|xls|xlsx|jpg"
			}
		},
		messages: {
			file_title: {
				required: "*Requerido."
			},
			comentarios: {
				required: "*Requerido."
			},
			file: {
				required: "*Requerido.",
			  	extension: "Tipo de archivo no permitido"
			}
		},
		
		invalidHandler: function (event, validator) { //display error alert on form submit        
			admin_new_error.show();
		},
		errorPlacement: function (error, element) { // render error placement for each input type
			if (element.parent(".input-group").size() > 0) {
				error.insertAfter(element.parent(".input-group"));
			} else if (element.attr("data-error-container")) { 
				error.appendTo(element.attr("data-error-container"));
			} else if (element.parents('.radio-list').size() > 0) { 
				error.appendTo(element.parents('.radio-list').attr("data-error-container"));
			} else if (element.parents('.radio-inline').size() > 0) { 
				error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
			} else if (element.parents('.checkbox-list').size() > 0) {
				error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
			} else if (element.parents('.checkbox-inline').size() > 0) { 
				error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
			} else {
				error.insertAfter(element); // for other inputs, just perform default behavior
			}
		},		
		highlight: function (element) { // hightlight error inputs
			$(element) 
				.closest('.form-group').addClass('has-error'); // set error class to the control group
		},		
		success: function (label) {
			label
				.closest('.form-group').removeClass('has-error'); // set success class to the control group
		},
		submitHandler: function (form) {
			success3.show();
			error3.hide();
		}	
	});
	// END validate file_form
	
	// validate foto_new
	var foto_upload_form = $('#foto_upload_form');
    var foto_upload_error = $('.alert-danger', foto_upload_form);	
	foto_upload_form.validate({
		errorElement: 'span', 
        errorClass: 'help-block', 
		rules: {
			foto: {
			  required: true,
			  extension: "jpeg|jpg"
			}
		},
		messages: {
			foto: {
				required: "*Requerido.",
			  	extension: "Tipo de archivo no permitido"
			}
		},
		
		invalidHandler: function (event, validator) { //display error alert on form submit        
			admin_new_error.show();
		},
		errorPlacement: function (error, element) { // render error placement for each input type
			if (element.parent(".input-group").size() > 0) {
				error.insertAfter(element.parent(".input-group"));
			} else if (element.attr("data-error-container")) { 
				error.appendTo(element.attr("data-error-container"));
			} else if (element.parents('.radio-list').size() > 0) { 
				error.appendTo(element.parents('.radio-list').attr("data-error-container"));
			} else if (element.parents('.radio-inline').size() > 0) { 
				error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
			} else if (element.parents('.checkbox-list').size() > 0) {
				error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
			} else if (element.parents('.checkbox-inline').size() > 0) { 
				error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
			} else {
				error.insertAfter(element); // for other inputs, just perform default behavior
			}
		},		
		highlight: function (element) { // hightlight error inputs
			$(element) 
				.closest('.form-group').addClass('has-error'); // set error class to the control group
		},		
		success: function (label) {
			label
				.closest('.form-group').removeClass('has-error'); // set success class to the control group
		},
		submitHandler: function (form) {
			success3.show();
			error3.hide();
		}	
	});
	// END validate foto_new
	
	
	// validate profile
	var profile_form = $('#profile_form');
    var profile_error = $('.alert-danger', profile_form);	
	profile_form.validate({
		errorElement: 'span', 
        errorClass: 'help-block', 
		rules: {
			user_fullname: {
				required: true,
				remote: {
					url: "includes/validation/checkAdminName_edit.php",
					type: "post",
					data: {
					  	user_fullname: function() {
							return $( "#user_fullname" ).val();
						},
						user_id: function() {
							return $( "#user_id" ).val();
						}
					}
				}
			},
			user_login: {
				required: true,
				remote: {
					url: "includes/validation/checkAdminLogin_edit.php",
					type: "post",
					data: {
					  	user_login: function() {
							return $( "#user_login" ).val();
						},
						user_id: function() {
							return $( "#user_id" ).val();
						}
					}
				}
			},
			user_email: {
				required: true,
				email: true,
				remote: {
						url: "includes/validation/checkAdminEmail_edit.php",
						type: "post",
						data: {
							user_email: function() {
								return $( "#user_email" ).val();
							},
							user_id: function() {
								return $( "#user_id" ).val();
							}
						}						
					}
			}
		},
		messages: {
			user_fullname: {
				required: "*Requerido.",
				remote: "Nombre ya existe, intenta con otro"
			},
			user_login: {
				required: "*Requerido.",
				remote: "Acceso ya existe, intenta con otro"
			},
			user_email: {
				required: "*Requerido.",
				email: "Email no valido", 
				remote: "Email ya existe, intenta con otro"
			}
		},
		
		invalidHandler: function (event, validator) { //display error alert on form submit        
			admin_edit_error.show();
		},
		errorPlacement: function (error, element) { // render error placement for each input type
			if (element.parent(".input-group").size() > 0) {
				error.insertAfter(element.parent(".input-group"));
			} else if (element.attr("data-error-container")) { 
				error.appendTo(element.attr("data-error-container"));
			} else if (element.parents('.radio-list').size() > 0) { 
				error.appendTo(element.parents('.radio-list').attr("data-error-container"));
			} else if (element.parents('.radio-inline').size() > 0) { 
				error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
			} else if (element.parents('.checkbox-list').size() > 0) {
				error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
			} else if (element.parents('.checkbox-inline').size() > 0) { 
				error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
			} else {
				error.insertAfter(element); // for other inputs, just perform default behavior
			}
		},		
		highlight: function (element) { // hightlight error inputs
			$(element) 
				.closest('.form-group').addClass('has-error'); // set error class to the control group
		},		
		success: function (label) {
			label
				.closest('.form-group').removeClass('has-error'); // set success class to the control group
		},
		submitHandler: function (form) {
			success3.show();
			error3.hide();
		}	
	});
	// END validate profile
	
	// validate avatar
	var profile_avatar_form = $('#profile_avatar_form');
    var profile_avatar_error = $('.alert-danger', profile_avatar_form);	
	profile_avatar_form.validate({
		errorElement: 'span', 
        errorClass: 'help-block', 
		rules: {
			avatar: {
			  required: true,
			  extension: "jpeg|jpg"
			}
		},
		messages: {
			avatar: {
				required: "*Requerido.",
			  	extension: "Tipo de archivo no permitido"
			}
		},
		
		invalidHandler: function (event, validator) { //display error alert on form submit        
			admin_new_error.show();
		},
		errorPlacement: function (error, element) { // render error placement for each input type
			if (element.parent(".input-group").size() > 0) {
				error.insertAfter(element.parent(".input-group"));
			} else if (element.attr("data-error-container")) { 
				error.appendTo(element.attr("data-error-container"));
			} else if (element.parents('.radio-list').size() > 0) { 
				error.appendTo(element.parents('.radio-list').attr("data-error-container"));
			} else if (element.parents('.radio-inline').size() > 0) { 
				error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
			} else if (element.parents('.checkbox-list').size() > 0) {
				error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
			} else if (element.parents('.checkbox-inline').size() > 0) { 
				error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
			} else {
				error.insertAfter(element); // for other inputs, just perform default behavior
			}
		},		
		highlight: function (element) { // hightlight error inputs
			$(element) 
				.closest('.form-group').addClass('has-error'); // set error class to the control group
		},		
		success: function (label) {
			label
				.closest('.form-group').removeClass('has-error'); // set success class to the control group
		},
		submitHandler: function (form) {
			success3.show();
			error3.hide();
		}	
	});
	// END validate avatar
	
	// validate avatar
	var profile_avatar_form = $('#profile_avatar_form');
    var profile_avatar_error = $('.alert-danger', profile_avatar_form);	
	profile_avatar_form.validate({
		errorElement: 'span', 
        errorClass: 'help-block', 
		rules: {
			avatar: {
			  required: true,
			  extension: "jpeg|jpg"
			}
		},
		messages: {
			avatar: {
				required: "*Requerido.",
			  	extension: "Tipo de archivo no permitido"
			}
		},
		
		invalidHandler: function (event, validator) { //display error alert on form submit        
			admin_new_error.show();
		},
		errorPlacement: function (error, element) { // render error placement for each input type
			if (element.parent(".input-group").size() > 0) {
				error.insertAfter(element.parent(".input-group"));
			} else if (element.attr("data-error-container")) { 
				error.appendTo(element.attr("data-error-container"));
			} else if (element.parents('.radio-list').size() > 0) { 
				error.appendTo(element.parents('.radio-list').attr("data-error-container"));
			} else if (element.parents('.radio-inline').size() > 0) { 
				error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
			} else if (element.parents('.checkbox-list').size() > 0) {
				error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
			} else if (element.parents('.checkbox-inline').size() > 0) { 
				error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
			} else {
				error.insertAfter(element); // for other inputs, just perform default behavior
			}
		},		
		highlight: function (element) { // hightlight error inputs
			$(element) 
				.closest('.form-group').addClass('has-error'); // set error class to the control group
		},		
		success: function (label) {
			label
				.closest('.form-group').removeClass('has-error'); // set success class to the control group
		},
		submitHandler: function (form) {
			success3.show();
			error3.hide();
		}	
	});
	// END validate avatar
	
	// validate passwd
	var profile_passwd_form = $('#profile_passwd_form');
    var profile_passwd_error = $('.alert-danger', profile_passwd_form);	
	profile_passwd_form.validate({
		errorElement: 'span', 
        errorClass: 'help-block', 
		rules: {
			current: {
			  required: true,
			  remote: {
						url: "includes/validation/checkPasswd.php",
						type: "post",
						data: {
							current: function() {
								return $( "#current" ).val();
							},
							user_id: function() {
								return $( "#user_id" ).val();
							}
						}						
					}
			},
			user_passwd: { 
				required: true
			},
			user_passwd2: {
				required: true, 
				equalTo: "#user_passwd" 
			}
		},
		messages: {
			current: {
				required: "*Requerido.",
			  	remote: "Tu password actual es incorrecto"
			},
			user_passwd: {
			  	required: "*Requerido."
			},
			user_passwd2: {
				required: "*Requerido.",
			  	equalTo: "Los nuevos passwords no coinciden"
			}
		},
		
		invalidHandler: function (event, validator) { //display error alert on form submit        
			admin_new_error.show();
		},
		errorPlacement: function (error, element) { // render error placement for each input type
			if (element.parent(".input-group").size() > 0) {
				error.insertAfter(element.parent(".input-group"));
			} else if (element.attr("data-error-container")) { 
				error.appendTo(element.attr("data-error-container"));
			} else if (element.parents('.radio-list').size() > 0) { 
				error.appendTo(element.parents('.radio-list').attr("data-error-container"));
			} else if (element.parents('.radio-inline').size() > 0) { 
				error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
			} else if (element.parents('.checkbox-list').size() > 0) {
				error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
			} else if (element.parents('.checkbox-inline').size() > 0) { 
				error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
			} else {
				error.insertAfter(element); // for other inputs, just perform default behavior
			}
		},		
		highlight: function (element) { // hightlight error inputs
			$(element) 
				.closest('.form-group').addClass('has-error'); // set error class to the control group
		},		
		success: function (label) {
			label
				.closest('.form-group').removeClass('has-error'); // set success class to the control group
		},
		submitHandler: function (form) {
			success3.show();
			error3.hide();
		}	
	});
	// END validate passwd
	
	
// doc ready	
});