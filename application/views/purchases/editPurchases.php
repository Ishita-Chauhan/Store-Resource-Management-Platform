
		<div class='row'>
			<div class='col-sm-12'>
				<form class='row g-3' id='frmeditPurchases' method='post'>
					<input type='hidden' id='idfrmPurchases' name='idPurchases' value=0>
					<div class='col-12'>
						<label class='form-label'>Dateofpurchase</label>
							<input type='text' class='form-control'  readonly='readonly' name='dateOfPurchase' id='ideditdateOfPurchase' placeholder='Enter Dateofpurchase'>
					</div>
					
					<div class='col-12'>
						<label for='select' class='form-label'>Purchaserequests_id</label>
							<select class='form-control' name='purchaseRequests_id' id='ideditpurchaseRequests_id'>
								<option class='active' value='0'>--Select Default--</option>
							</select>
					</div>
					
						<div class='col-12'>
								<a id='dltPurchases' role='button' style='color:white;' class='btn btn-danger' data-id='0'>Remove</a>
								<input type='submit' class='btn btn-warning' value='Update'>
							
						</div>
				</form>
			</div>
		</div>
		<script type='text/javascript'>
			$(document).ready(function(){
				$.validate({
					form : '#frmeditPurchases',
					modules : 'location, date, security, file',
					validateOnBlur : false,
					onSuccess : function($form) {
						var frm = document.getElementById('frmeditPurchases');
						var frmdt = new FormData(frm);
						jQuery.ajax({
							url : baseurl + '/purchases/editPurchases',
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
									$.notify('Could not UpdatePurchases','error');
								}
								else
								{
									$('#modelEditPurchases').appendTo('body').modal('hide');
									$('#frmeditPurchases').get(0).reset();
									data=JSON.parse(data);
									$('#colPurchases').html(data.col);
									$('#fillPurchases').html(data.row);
									$.notify('Purchases Updated Successfully','success');

								}
							}
						});
						return false;
					}
				});
				$(document).delegate('#dltPurchases','click',function(){

					$('#modelDeletePurchases').appendTo('body').modal('show');
					$('#modelEditPurchases').appendTo('body').modal('hide');
					
					var id=$(this).attr('data-id');
					$('#btnDeletePurchases').attr('data-id',id);
					//console.log($(this).data('id'));
				});
			});

		</script>
		