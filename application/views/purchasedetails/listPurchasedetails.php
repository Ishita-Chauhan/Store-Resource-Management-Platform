
		<div class='row' style='margin-bottom: 20px;'>
			<div class='col'>
				<a  id='createPurchasedetails' class='btn btn-primary float-right' role='button'  style='color: white;'><i class='fa fa-user-plus' aria-hidden='true'></i>  Create Purchasedetails</a>
			</div>
		</div>
		
		<div class='col-sm-12'>
			<table class='table table-striped table-bordered  table-hover table-sm' id='dtOrderTable'>
				<thead id='colPurchasedetails'>

					<?php
					if(isset($cols))
						echo $cols;
					?>

				</thead>
				<tbody id='fillPurchasedetails'>
					<?php
					if(isset($rows))
						echo $rows;
					?>
				</tbody>
			</table>
		</div>
		<div class='modal fade' id='modelPurchasedetails'>
			<div class='modal-dialog modal-dialog-centered'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h4 class='modal-title'>Create New Purchasedetails</h4>
						<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
					</div>
					<div class='modal-body'>
						<?php $this->load->view('purchasedetails/createPurchasedetails'); ?>
					</div>
				</div>
			</div>
		</div>	
		<div class='modal fade' id='modelEditPurchasedetails'>
			<div class='modal-dialog  modal-dialog-centered'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h4 class='modal-title'>Update Purchasedetails</h4>
						<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
					</div>
					<div class='modal-body'>
						<?php $this->load->view('purchasedetails/editPurchasedetails'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class='modal fade' id='modelDeletePurchasedetails'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h4 class='modal-title'>Confirm deletion of Purchasedetails</h4>
						<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
					</div>
					<div class='modal-body'>
						Are You Sure?
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-secondary' data-dismiss='modal'>No, Cancel</button>
						<button type='button' class='btn btn-danger' id='btnDeletePurchasedetails' data-id='0'>Yes, Remove</button>
					</div>
				</div>
			</div>
		</div>

		<script type='text/javascript'>
			$(document).ready(function () {
				$('#dtOrderTable').DataTable({
					'order': [[ 0, 'asc' ]],
					'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, 'All']],
					'language': {
						'emptyTable': '<b>No Record Found!</b>'
					},
					'info': false
				});
				$('.dataTables_length').addClass('bs-select');
			});
			$(document).on('click','#btnDeletePurchasedetails',function(e) {
				e.preventDefault();
				var id=$(this).attr('data-id');
				$('#modelDeletePurchasedetails').appendTo('body').modal('hide');
				jQuery.ajax({
					url : baseurl + '/purchasedetails/removePurchasedetails',
					type:'POST',
					data : {id:id},
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
							$.notify('Purchasedetails Cannot be removed','error');
						}
						else
						{
							$('#modelDeletePurchasedetails').appendTo('body').modal('hide');
							data=JSON.parse(data);
							$('#colPurchasedetails').html(data.col);
							$('#fillPurchasedetails').html(data.row);
							$.notify('Purchasedetails Removed Successfully','success');

							
						}
					}
				});
			});
			$(document).delegate('#createPurchasedetails','click',function(e) {
				e.preventDefault();
				$('#modelPurchasedetails').appendTo('body').modal('show');
			});
			$(document).delegate('.clickablerow','click',function(){
				var id=$(this).data('id');
				jQuery.ajax({
					url : baseurl + '/purchasedetails/showEdit',
					type:'POST',
					dataType:'text',
					data : {id:id},
					async:true,
					beforeSend: function(data) {
						$('#load').show();
					},
					complete: function(data) {
						$('#load').hide();
					},
					success:function(data){
						data=JSON.parse(data);
						$('#idfrmPurchasedetails').val(id);
						$('#dltPurchasedetails').attr('data-id',id);
						$.each(data,function(i,item){
							$('#idedit'+i).val(item);
						});
						$('#modelEditPurchasedetails').appendTo('body').modal('show');
					}
				});
			});
		</script>
		