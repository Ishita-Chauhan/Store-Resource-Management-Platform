
		<div class='row'>
			<div class='col-sm-12'>
				<form class='row g-3'  id='frmAllocation' method='post'>
					<div class='col-12'>
						<label class='form-label'>Name</label>
							<input type='text' class='form-control' data-validation='required' 
							 name='name' id='idname' placeholder='Enter Name'>
					</div>
					<div class='col-12'>
						<label for='select' class='form-label'>Purchasedetails_id</label>
							<select class='form-control' name='purchaseDetails_id' id='idpurchaseDetails_id'>
								<option class='active' value='0'>--Select Default--</option>
							</select>
					</div>
					
					<div class='col-12'>
						<label for='select' class='form-label'>Departments_id</label>
							<select class='form-control' name='departments_id' id='iddepartments_id'>
								<option class='active' value='0'>--Select Default--</option>
							</select>
					</div>
					
					<div class='col-12'>
						<label class='form-label'>Detailsofdeadstockreg</label>
							<input type='text' class='form-control' readonly='readonly' name='detailsOfDeadStockReg' id='iddetailsOfDeadStockReg' placeholder='Enter Detailsofdeadstockreg'>
					</div>
					
					<div class='col-12'>
						<label class='form-label'>Unservdate</label>
							<input type='text' class='form-control' readonly='readonly' name='unServDate' id='idunServDate' placeholder='Enter Unservdate'>
					</div>
					
					<div class='col-12'>
						<label class='form-label'>Actualperiodofunserv</label>
							<input type='text' class='form-control' readonly='readonly' name='actualPeriodOfUnServ' id='idactualPeriodOfUnServ' placeholder='Enter Actualperiodofunserv'>
					</div>
					
					<div class='col-12'>
						<label class='form-label'>Ts</label>
							<input type='text' class='form-control' readonly='readonly' name='ts' id='idts' placeholder='Enter Ts'>
					</div>
					
					<div class='col-12'>
						<label for='address' class='form-label'>Responsibilityfordamage</label>
							<textarea class='form-control' rows='3' name='responsibilityForDamage' id='idresponsibilityForDamage' placeholder='Enter Responsibilityfordamage' data-validation='required' ></textarea>
					</div>
					
					<div class='col-12'>
						<label for='address' class='form-label'>Repairable</label>
							<textarea class='form-control' rows='3' name='repairable' id='idrepairable' placeholder='Enter Repairable' data-validation='required' ></textarea>
					</div>
					
					<div class='col-12'>
						<label class='form-label'>Costofrepair</label>
							<input type='text' class='form-control' data-validation='required' 
							 name='costOfRepair' id='idcostOfRepair' placeholder='Enter Costofrepair'>
					</div>
					<div class='col-12'>
						<label for='select' class='form-label'>Status</label>
							<select class='form-control' name='status' id='idstatus'>
								<option class='active' value='0'>--Select Default--</option>
							</select>
					</div>
					
					<div class='col-12'>
						<label for='address' class='form-label'>Descriptionofdefects</label>
							<textarea class='form-control' rows='3' name='descriptionOfDefects' id='iddescriptionOfDefects' placeholder='Enter Descriptionofdefects' data-validation='required' ></textarea>
					</div>
					
					<div class='col-12'>
						<label for='address' class='form-label'>Remarks</label>
							<textarea class='form-control' rows='3' name='remarks' id='idremarks' placeholder='Enter Remarks' data-validation='required' ></textarea>
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
					form : '#frmAllocation',
					modules : 'location, date, security, file',
					validateOnBlur : false,
					onSuccess : function($form) {
						var frm = document.getElementById('frmAllocation');
						var frmdt = new FormData(frm);
						jQuery.ajax({
							url : baseurl + '/allocation/createAllocation',
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
									$.notify('Unable to CreateAllocation','error');
								}
								else
								{
									$('#modelAllocation').appendTo('body').modal('hide');
									$('#frmAllocation').get(0).reset();
									data=JSON.parse(data);
									$('#colAllocation').html(data.col);
									$('#fillAllocation').html(data.row);
									$.notify('Allocation Successfully Created','success');
							
								}
							}
						});
						return false; 
					}
				});
			});
		</script>
		