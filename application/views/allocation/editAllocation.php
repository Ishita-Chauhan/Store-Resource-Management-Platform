
		<div class='row'>
			<div class='col-sm-12'>
				<form class='row g-3' id='frmeditAllocation' method='post'>
					<input type='hidden' id='idfrmAllocation' name='idAllocation' value=0>
					<div class='col-12'>
						<label class='form-label'>Name</label>
							<input type='text' class='form-control' data-validation='required'  name='name' id='ideditname' placeholder='Enter Name'>
					</div>
					<div class='col-12'>
						<label for='select' class='form-label'>Purchasedetails_id</label>
							<select class='form-control' name='purchaseDetails_id' id='ideditpurchaseDetails_id'>
								<option class='active' value='0'>--Select Default--</option>
							</select>
					</div>
					
					<div class='col-12'>
						<label for='select' class='form-label'>Departments_id</label>
							<select class='form-control' name='departments_id' id='ideditdepartments_id'>
								<option class='active' value='0'>--Select Default--</option>
							</select>
					</div>
					
					<div class='col-12'>
						<label class='form-label'>Detailsofdeadstockreg</label>
							<input type='text' class='form-control'  readonly='readonly' name='detailsOfDeadStockReg' id='ideditdetailsOfDeadStockReg' placeholder='Enter Detailsofdeadstockreg'>
					</div>
					
					<div class='col-12'>
						<label class='form-label'>Unservdate</label>
							<input type='text' class='form-control'  readonly='readonly' name='unServDate' id='ideditunServDate' placeholder='Enter Unservdate'>
					</div>
					
					<div class='col-12'>
						<label class='form-label'>Actualperiodofunserv</label>
							<input type='text' class='form-control'  readonly='readonly' name='actualPeriodOfUnServ' id='ideditactualPeriodOfUnServ' placeholder='Enter Actualperiodofunserv'>
					</div>
					
					<div class='col-12'>
						<label class='form-label'>Ts</label>
							<input type='text' class='form-control'  readonly='readonly' name='ts' id='ideditts' placeholder='Enter Ts'>
					</div>
					
					<div class='col-12'>
						<label for='address' class='form-label'>Responsibilityfordamage</label>
							<textarea class='form-control' rows='3' name='responsibilityForDamage' id='ideditresponsibilityForDamage' placeholder='Enter Responsibilityfordamage' data-validation='required' ></textarea>
					</div>
					
					<div class='col-12'>
						<label for='address' class='form-label'>Repairable</label>
							<textarea class='form-control' rows='3' name='repairable' id='ideditrepairable' placeholder='Enter Repairable' data-validation='required' ></textarea>
					</div>
					
					<div class='col-12'>
						<label class='form-label'>Costofrepair</label>
							<input type='text' class='form-control' data-validation='required'  name='costOfRepair' id='ideditcostOfRepair' placeholder='Enter Costofrepair'>
					</div>
					<div class='col-12'>
						<label for='select' class='form-label'>Status</label>
							<select class='form-control' name='status' id='ideditstatus'>
								<option class='active' value='0'>--Select Default--</option>
							</select>
					</div>
					
					<div class='col-12'>
						<label for='address' class='form-label'>Descriptionofdefects</label>
							<textarea class='form-control' rows='3' name='descriptionOfDefects' id='ideditdescriptionOfDefects' placeholder='Enter Descriptionofdefects' data-validation='required' ></textarea>
					</div>
					
					<div class='col-12'>
						<label for='address' class='form-label'>Remarks</label>
							<textarea class='form-control' rows='3' name='remarks' id='ideditremarks' placeholder='Enter Remarks' data-validation='required' ></textarea>
					</div>
					
						<div class='col-12'>
								<a id='dltAllocation' role='button' style='color:white;' class='btn btn-danger' data-id='0'>Remove</a>
								<input type='submit' class='btn btn-warning' value='Update'>
							
						</div>
				</form>
			</div>
		</div>
		<script type='text/javascript'>
			$(document).ready(function(){
				$.validate({
					form : '#frmeditAllocation',
					modules : 'location, date, security, file',
					validateOnBlur : false,
					onSuccess : function($form) {
						var frm = document.getElementById('frmeditAllocation');
						var frmdt = new FormData(frm);
						jQuery.ajax({
							url : baseurl + '/allocation/editAllocation',
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
									$.notify('Could not UpdateAllocation','error');
								}
								else
								{
									$('#modelEditAllocation').appendTo('body').modal('hide');
									$('#frmeditAllocation').get(0).reset();
									data=JSON.parse(data);
									$('#colAllocation').html(data.col);
									$('#fillAllocation').html(data.row);
									$.notify('Allocation Updated Successfully','success');

								}
							}
						});
						return false;
					}
				});
				$(document).delegate('#dltAllocation','click',function(){

					$('#modelDeleteAllocation').appendTo('body').modal('show');
					$('#modelEditAllocation').appendTo('body').modal('hide');
					
					var id=$(this).attr('data-id');
					$('#btnDeleteAllocation').attr('data-id',id);
					//console.log($(this).data('id'));
				});
			});

		</script>
		