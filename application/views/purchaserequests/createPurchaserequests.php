
		<div class='row'>
			<div class='col-sm-12'>
				<form class='row g-3'  id='frmPurchaserequests' method='post'>
					<div class='col-12'>
						<label class='form-label'>Dateofreq</label>
							<input type='text' class='form-control' readonly='readonly' name='dateOfReq' id='iddateOfReq' placeholder='Enter Dateofreq'>
					</div>
					
					<div class='col-12'>
						<label for='select' class='form-label'>Users_id</label>
							<select class='form-control' name='users_id' id='idusers_id'>
								<option class='active' value='0'>--Select Default--</option>
							</select>
					</div>
					
					<div class='col-12'>
						<label class='form-label'>Ts</label>
							<input type='text' class='form-control' data-validation='required' 
							 name='ts' id='idts' placeholder='Enter Ts'>
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
					form : '#frmPurchaserequests',
					modules : 'location, date, security, file',
					validateOnBlur : false,
					onSuccess : function($form) {
						var frm = document.getElementById('frmPurchaserequests');
						var frmdt = new FormData(frm);
						jQuery.ajax({
							url : baseurl + '/purchaserequests/createPurchaserequests',
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
									$.notify('Unable to CreatePurchaserequests','error');
								}
								else
								{
									$('#modelPurchaserequests').appendTo('body').modal('hide');
									$('#frmPurchaserequests').get(0).reset();
									data=JSON.parse(data);
									$('#colPurchaserequests').html(data.col);
									$('#fillPurchaserequests').html(data.row);
									$.notify('Purchaserequests Successfully Created','success');
							
								}
							}
						});
						return false; 
					}
				});
			});
		</script>
		