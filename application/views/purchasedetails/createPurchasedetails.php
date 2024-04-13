
		<div class='row'>
			<div class='col-sm-12'>
				<form class='row g-3'  id='frmPurchasedetails' method='post'>
					<div class='col-12'>
						<label for='select' class='form-label'>Purchases_id</label>
							<select class='form-control' name='purchases_id' id='idpurchases_id'>
								<option class='active' value='0'>--Select Default--</option>
							</select>
					</div>
					
					<div class='col-12'>
						<label class='form-label'>Qty</label>
							<input type='text' class='form-control'  data-validation='custom' data-validation-regexp='^([0-9]+)$' name='qty' id='idqty' placeholder='Enter Qty'>
					</div>
					
					<div class='col-12'>
						<label for='select' class='form-label'>Authorities_id</label>
							<select class='form-control' name='authorities_id' id='idauthorities_id'>
								<option class='active' value='0'>--Select Default--</option>
							</select>
					</div>
					
					<div class='col-12'>
						<label class='form-label'>Price</label>
							<input type='text' class='form-control'  data-validation='custom' data-validation-regexp='^([0-9]+)$' name='price' id='idprice' placeholder='Enter Price'>
					</div>
					
					<div class='col-12'>
						<label for='select' class='form-label'>Status</label>
							<select class='form-control' name='status' id='idstatus'>
								<option class='active' value='0'>--Select Default--</option>
							</select>
					</div>
					
					<div class='col-12'>
						<label for='address' class='form-label'>Reasonforunserviceability</label>
							<textarea class='form-control' rows='3' name='reasonForUnserviceability' id='idreasonForUnserviceability' placeholder='Enter Reasonforunserviceability' data-validation='required' ></textarea>
					</div>
					
					<div class='col-12'>
						<label class='form-label'>Expectedexp</label>
							<input type='text' class='form-control' readonly='readonly' name='expectedExp' id='idexpectedExp' placeholder='Enter Expectedexp'>
					</div>
					
					<div class='col-12'>
						<label for='select' class='form-label'>Articles_id</label>
							<select class='form-control' name='articles_id' id='idarticles_id'>
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
					form : '#frmPurchasedetails',
					modules : 'location, date, security, file',
					validateOnBlur : false,
					onSuccess : function($form) {
						var frm = document.getElementById('frmPurchasedetails');
						var frmdt = new FormData(frm);
						jQuery.ajax({
							url : baseurl + '/purchasedetails/createPurchasedetails',
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
									$.notify('Unable to CreatePurchasedetails','error');
								}
								else
								{
									$('#modelPurchasedetails').appendTo('body').modal('hide');
									$('#frmPurchasedetails').get(0).reset();
									data=JSON.parse(data);
									$('#colPurchasedetails').html(data.col);
									$('#fillPurchasedetails').html(data.row);
									$.notify('Purchasedetails Successfully Created','success');
							
								}
							}
						});
						return false; 
					}
				});
			});
		</script>
		