
		<div class='row'>
			<div class='col-sm-12'>
				<form class='row g-3'  id='frmPurchases' method='post'>
					<div class='col-12'>
						<label class='form-label'>Dateofpurchase</label>
							<input type='text' class='form-control' readonly='readonly' name='dateOfPurchase' id='iddateOfPurchase' placeholder='Enter Dateofpurchase'>
					</div>
					
					<div class='col-12'>
						<label for='select' class='form-label'>Purchaserequests_id</label>
							<select class='form-control' name='purchaseRequests_id' id='idpurchaseRequests_id'>
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
					form : '#frmPurchases',
					modules : 'location, date, security, file',
					validateOnBlur : false,
					onSuccess : function($form) {
						var frm = document.getElementById('frmPurchases');
						var frmdt = new FormData(frm);
						jQuery.ajax({
							url : baseurl + '/purchases/createPurchases',
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
									$.notify('Unable to CreatePurchases','error');
								}
								else
								{
									$('#modelPurchases').appendTo('body').modal('hide');
									$('#frmPurchases').get(0).reset();
									data=JSON.parse(data);
									$('#colPurchases').html(data.col);
									$('#fillPurchases').html(data.row);
									$.notify('Purchases Successfully Created','success');
							
								}
							}
						});
						return false; 
					}
				});
			});
		</script>
		