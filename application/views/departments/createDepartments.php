
		<div class='row'>
			<div class='col-sm-12'>
				<form class='row g-3'  id='frmDepartments' method='post'>
					<div class='col-12'>
						<label class='form-label'>Name</label>
							<input type='text' class='form-control' data-validation='required' 
							 name='name' id='idname' placeholder='Enter Name'>
					</div>
					<div class='col-12'>
						<label class='form-label'>Contact</label>
							<input type='text' class='form-control'  data-validation='custom' data-validation-regexp='^([0-9]+)$' name='contact' id='idcontact' placeholder='Enter Contact'>
					</div>
					
					<div class='col-12'>
						<label for='select' class='form-label'>Status</label>
							<select class='form-control' name='status' id='idstatus'>
								<option class='active' value='0'>--Select Default--</option>
							</select>
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
					form : '#frmDepartments',
					modules : 'location, date, security, file',
					validateOnBlur : false,
					onSuccess : function($form) {
						var frm = document.getElementById('frmDepartments');
						var frmdt = new FormData(frm);
						jQuery.ajax({
							url : baseurl + '/departments/createDepartments',
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
									$.notify('Unable to CreateDepartments','error');
								}
								else
								{
									$('#modelDepartments').appendTo('body').modal('hide');
									$('#frmDepartments').get(0).reset();
									data=JSON.parse(data);
									$('#colDepartments').html(data.col);
									$('#fillDepartments').html(data.row);
									$.notify('Departments Successfully Created','success');
							
								}
							}
						});
						return false; 
					}
				});
			});
		</script>
		