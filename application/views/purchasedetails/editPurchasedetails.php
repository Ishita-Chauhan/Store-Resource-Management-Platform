
		<div class='row'>
			<div class='col-sm-12'>
				<form class='row g-3' id='frmeditPurchasedetails' method='post'>
					<input type='hidden' id='idfrmPurchasedetails' name='idPurchasedetails' value=0>
					<div class='col-12'>
						<label for='select' class='form-label'>Purchases_id</label>
							<select class='form-control' name='purchases_id' id='ideditpurchases_id'>
								<option class='active' value='0'>--Select Default--</option>
							</select>
					</div>
					
					<div class='col-12'>
						<label class='form-label'>Qty</label>
							<input type='text' class='form-control' data-validation='custom' data-validation-regexp='^([0-9]+)$' name='qty' id='ideditqty' placeholder='Enter Qty'>
					</div>
					
					<div class='col-12'>
						<label for='select' class='form-label'>Authorities_id</label>
							<select class='form-control' name='authorities_id' id='ideditauthorities_id'>
								<option class='active' value='0'>--Select Default--</option>
							</select>
					</div>
					
					<div class='col-12'>
						<label class='form-label'>Price</label>
							<input type='text' class='form-control' data-validation='custom' data-validation-regexp='^([0-9]+)$' name='price' id='ideditprice' placeholder='Enter Price'>
					</div>
					
					<div class='col-12'>
						<label for='select' class='form-label'>Status</label>
							<select class='form-control' name='status' id='ideditstatus'>
								<option class='active' value='0'>--Select Default--</option>
							</select>
					</div>
					
					<div class='col-12'>
						<label for='address' class='form-label'>Reasonforunserviceability</label>
							<textarea class='form-control' rows='3' name='reasonForUnserviceability' id='ideditreasonForUnserviceability' placeholder='Enter Reasonforunserviceability' data-validation='required' ></textarea>
					</div>
					
					<div class='col-12'>
						<label class='form-label'>Expectedexp</label>
							<input type='text' class='form-control'  readonly='readonly' name='expectedExp' id='ideditexpectedExp' placeholder='Enter Expectedexp'>
					</div>
					
					<div class='col-12'>
						<label for='select' class='form-label'>Articles_id</label>
							<select class='form-control' name='articles_id' id='ideditarticles_id'>
								<option class='active' value='0'>--Select Default--</option>
							</select>
					</div>
					
						<div class='col-12'>
								<a id='dltPurchasedetails' role='button' style='color:white;' class='btn btn-danger' data-id='0'>Remove</a>
								<input type='submit' class='btn btn-warning' value='Update'>
							
						</div>
				</form>
			</div>
		</div>
		<script type='text/javascript'>
			$(document).ready(function(){
				$.validate({
					form : '#frmeditPurchasedetails',
					modules : 'location, date, security, file',
					validateOnBlur : false,
					onSuccess : function($form) {
						var frm = document.getElementById('frmeditPurchasedetails');
						var frmdt = new FormData(frm);
						jQuery.ajax({
							url : baseurl + '/purchasedetails/editPurchasedetails',
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
									$.notify('Could not UpdatePurchasedetails','error');
								}
								else
								{
									$('#modelEditPurchasedetails').appendTo('body').modal('hide');
									$('#frmeditPurchasedetails').get(0).reset();
									data=JSON.parse(data);
									$('#colPurchasedetails').html(data.col);
									$('#fillPurchasedetails').html(data.row);
									$.notify('Purchasedetails Updated Successfully','success');

								}
							}
						});
						return false;
					}
				});
				$(document).delegate('#dltPurchasedetails','click',function(){

					$('#modelDeletePurchasedetails').appendTo('body').modal('show');
					$('#modelEditPurchasedetails').appendTo('body').modal('hide');
					
					var id=$(this).attr('data-id');
					$('#btnDeletePurchasedetails').attr('data-id',id);
					//console.log($(this).data('id'));
				});
			});

		</script>
		