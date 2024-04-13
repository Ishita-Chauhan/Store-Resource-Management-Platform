
		<div class='row'>
			<div class='col-sm-12'>
				<form class='row g-3' id='frmeditAuthorities' method='post'>
					<input type='hidden' id='idfrmAuthorities' name='idAuthorities' value=0>
					<div class='col-12'>
						<label class='form-label'>Name</label>
							<input type='text' class='form-control' data-validation='required'  name='name' id='ideditname' placeholder='Enter Name'>
					</div>
					<div class='col-12'>
						<label class='form-label'>Contactpersonname</label>
							<input type='text' class='form-control' data-validation='required'  name='contactPersonName' id='ideditcontactPersonName' placeholder='Enter Contactpersonname'>
					</div>
					<div class='col-12'>
						<label class='form-label'>Contactno</label>
							<input type='text' class='form-control' data-validation='custom' data-validation-regexp='^([0-9]+)$' name='contactNo' id='ideditcontactNo' placeholder='Enter Contactno'>
					</div>
					
						<div class='col-12'>
								<a id='dltAuthorities' role='button' style='color:white;' class='btn btn-danger' data-id='0'>Remove</a>
								<input type='submit' class='btn btn-warning' value='Update'>
							
						</div>
				</form>
			</div>
		</div>
		<script type='text/javascript'>
			$(document).ready(function(){
				$.validate({
					form : '#frmeditAuthorities',
					modules : 'location, date, security, file',
					validateOnBlur : false,
					onSuccess : function($form) {
						var frm = document.getElementById('frmeditAuthorities');
						var frmdt = new FormData(frm);
						jQuery.ajax({
							url : baseurl + '/authorities/editAuthorities',
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
									$.notify('Could not UpdateAuthorities','error');
								}
								else
								{
									$('#modelEditAuthorities').appendTo('body').modal('hide');
									$('#frmeditAuthorities').get(0).reset();
									data=JSON.parse(data);
									$('#colAuthorities').html(data.col);
									$('#fillAuthorities').html(data.row);
									$.notify('Authorities Updated Successfully','success');

								}
							}
						});
						return false;
					}
				});
				$(document).delegate('#dltAuthorities','click',function(){

					$('#modelDeleteAuthorities').appendTo('body').modal('show');
					$('#modelEditAuthorities').appendTo('body').modal('hide');
					
					var id=$(this).attr('data-id');
					$('#btnDeleteAuthorities').attr('data-id',id);
					//console.log($(this).data('id'));
				});
			});

		</script>
		