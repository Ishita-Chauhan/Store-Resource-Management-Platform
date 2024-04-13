
		<div class='row'>
			<div class='col-sm-12'>
				<form class='row g-3' id='frmeditDepartments' method='post'>
					<input type='hidden' id='idfrmDepartments' name='idDepartments' value=0>
					<div class='col-12'>
						<label class='form-label'>Name</label>
							<input type='text' class='form-control' data-validation='required'  name='name' id='ideditname' placeholder='Enter Name'>
					</div>
					<div class='col-12'>
						<label class='form-label'>Contact</label>
							<input type='text' class='form-control' data-validation='custom' data-validation-regexp='^([0-9]+)$' name='contact' id='ideditcontact' placeholder='Enter Contact'>
					</div>
					
					<div class='col-12'>
						<label for='select' class='form-label'>Status</label>
							<select class='form-control' name='status' id='ideditstatus'>
								<option class='active' value='0'>--Select Default--</option>
							</select>
					</div>
					
						<div class='col-12'>
								<a id='dltDepartments' role='button' style='color:white;' class='btn btn-danger' data-id='0'>Remove</a>
								<input type='submit' class='btn btn-warning' value='Update'>
							
						</div>
				</form>
			</div>
		</div>
		<script type='text/javascript'>
			$(document).ready(function(){
				$.validate({
					form : '#frmeditDepartments',
					modules : 'location, date, security, file',
					validateOnBlur : false,
					onSuccess : function($form) {
						var frm = document.getElementById('frmeditDepartments');
						var frmdt = new FormData(frm);
						jQuery.ajax({
							url : baseurl + '/departments/editDepartments',
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
								if(data=='0')
								{
									$.notify('Could not UpdateDepartments','error');
								}
								else
								{
									$('#modelEditDepartments').appendTo('body').modal('hide');
									$('#frmeditDepartments').get(0).reset();
									data=JSON.parse(data);
									$('#colDepartments').html(data.col);
									$('#fillDepartments').html(data.row);
									$.notify('Departments Updated Successfully','success');

								}
							}
						});
						return false;
					}
				});
				$(document).delegate('#dltDepartments','click',function(){

					$('#modelDeleteDepartments').appendTo('body').modal('show');
					$('#modelEditDepartments').appendTo('body').modal('hide');
					
					var id=$(this).attr('data-id');
					$('#btnDeleteDepartments').attr('data-id',id);
					//console.log($(this).data('id'));
				});
			});

		</script>
		