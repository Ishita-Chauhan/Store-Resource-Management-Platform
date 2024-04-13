
		<div class='row'>
			<div class='col-sm-12'>
				<form class='row g-3'  id='frmAuthorities' method='post'>
					<div class='col-12'>
						<label class='form-label'>Name</label>
							<input type='text' class='form-control' data-validation='required' 
							 name='name' id='idname' placeholder='Enter Name'>
					</div>
					<div class='col-12'>
						<label class='form-label'>Contactpersonname</label>
							<input type='text' class='form-control' data-validation='required' 
							 name='contactPersonName' id='idcontactPersonName' placeholder='Enter Contactpersonname'>
					</div>
					<div class='col-12'>
						<label class='form-label'>Contactno</label>
							<input type='text' class='form-control'  data-validation='custom' data-validation-regexp='^([0-9]+)$' name='contactNo' id='idcontactNo' placeholder='Enter Contactno'>
					</div>
					
						<div class='col-12'>
								<input type='submit' class='btn btn-success' value='Create'>
						</div>
				</form>
			</div>
		</div>
		<script type='text/javascript'>
			$(document).ready(function(){
				$.validate({
					form : '#frmAuthorities',
					modules : 'location, date, security, file',
					validateOnBlur : false,
					onSuccess : function($form) {
						var frm = document.getElementById('frmAuthorities');
						var frmdt = new FormData(frm);
						jQuery.ajax({
							url : baseurl + '/authorities/createAuthorities',
							type:'POST',
							data : frmdt,
							processData: false,
							contentType: false,
							async:true,
							beforeSend: function(data) {
								$('#load').show();
							},
							complete: function(data) {
								$('#load').hide();
							},
							success:function(data){
								if(data==0)
								{
									$.notify('Unable to CreateAuthorities','error');
								}
								else
								{
									$('#modelAuthorities').appendTo('body').modal('hide');
									$('#frmAuthorities').get(0).reset();
									data=JSON.parse(data);
									$('#colAuthorities').html(data.col);
									$('#fillAuthorities').html(data.row);
									$.notify('Authorities Successfully Created','success');
							
								}
							}
						});
						return false; 
					}
				});
			});
		</script>
		