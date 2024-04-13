
		<div class='row'>
			<div class='col-sm-12'>
				<form class='row g-3' id='frmeditPurchaserequests' method='post'>
					<input type='hidden' id='idfrmPurchaserequests' name='idPurchaserequests' value=0>
					<div class='col-12'>
						<label class='form-label'>Dateofreq</label>
							<input type='text' class='form-control'  readonly='readonly' name='dateOfReq' id='ideditdateOfReq' placeholder='Enter Dateofreq'>
					</div>
					
					<div class='col-12'>
						<label for='select' class='form-label'>Users_id</label>
							<select class='form-control' name='users_id' id='ideditusers_id'>
								<option class='active' value='0'>--Select Default--</option>
							</select>
					</div>
					
					<div class='col-12'>
						<label class='form-label'>Ts</label>
							<input type='text' class='form-control' data-validation='required'  name='ts' id='ideditts' placeholder='Enter Ts'>
					</div>
					<div class='col-12'>
						<label for='select' class='form-label'>Status</label>
							<select class='form-control' name='status' id='ideditstatus'>
								<option class='active' value='0'>--Select Default--</option>
							</select>
					</div>
					
						<div class='col-12'>
								<a id='dltPurchaserequests' role='button' style='color:white;' class='btn btn-danger' data-id='0'>Remove</a>
								<input type='submit' class='btn btn-warning' value='Update'>
							
						</div>
				</form>
			</div>
		</div>
		<script type='text/javascript'>
			$(document).ready(function(){
				$.validate({
					form : '#frmeditPurchaserequests',
					modules : 'location, date, security, file',
					validateOnBlur : false,
					onSuccess : function($form) {
						var frm = document.getElementById('frmeditPurchaserequests');
						var frmdt = new FormData(frm);
						jQuery.ajax({
							url : baseurl + '/purchaserequests/editPurchaserequests',
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
									$.notify('Could not UpdatePurchaserequests','error');
								}
								else
								{
									$('#modelEditPurchaserequests').appendTo('body').modal('hide');
									$('#frmeditPurchaserequests').get(0).reset();
									data=JSON.parse(data);
									$('#colPurchaserequests').html(data.col);
									$('#fillPurchaserequests').html(data.row);
									$.notify('Purchaserequests Updated Successfully','success');

								}
							}
						});
						return false;
					}
				});
				$(document).delegate('#dltPurchaserequests','click',function(){

					$('#modelDeletePurchaserequests').appendTo('body').modal('show');
					$('#modelEditPurchaserequests').appendTo('body').modal('hide');
					
					var id=$(this).attr('data-id');
					$('#btnDeletePurchaserequests').attr('data-id',id);
					//console.log($(this).data('id'));
				});
			});

		</script>
		