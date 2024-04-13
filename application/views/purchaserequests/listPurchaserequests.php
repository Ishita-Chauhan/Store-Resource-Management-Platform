
		<div class='row' style='margin-bottom: 20px;'>
			<div class='col'>
				<a  id='createPurchaserequests' class='btn btn-primary float-right' role='button'  style='color: white;'><i class='fa fa-user-plus' aria-hidden='true'></i>  Create Purchaserequests</a>
			</div>
		</div>
		
		<div class='col-sm-12'>
			<table class='table table-striped table-bordered  table-hover table-sm' id='dtOrderTable'>
				<thead id='colPurchaserequests'>

					<?php
					if(isset($cols))
						echo $cols;
					?>

				</thead>
				<tbody id='fillPurchaserequests'>
					<?php
					if(isset($rows))
						echo $rows;
					?>
				</tbody>
			</table>
		</div>
		<div class='modal fade' id='modelPurchaserequests'>
			<div class='modal-dialog modal-dialog-centered'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h4 class='modal-title'>Create New Purchaserequests</h4>
						<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
					</div>
					<div class='modal-body'>
						<?php $this->load->view('purchaserequests/createPurchaserequests'); ?>
					</div>
				</div>
			</div>
		</div>	
		<div class='modal fade' id='modelEditPurchaserequests'>
			<div class='modal-dialog  modal-dialog-centered'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h4 class='modal-title'>Update Purchaserequests</h4>
						<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
					</div>
					<div class='modal-body'>
						<?php $this->load->view('purchaserequests/editPurchaserequests'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class='modal fade' id='modelDeletePurchaserequests'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h4 class='modal-title'>Confirm deletion of Purchaserequests</h4>
						<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
					</div>
					<div class='modal-body'>
						Are You Sure?
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-secondary' data-dismiss='modal'>No, Cancel</button>
						<button type='button' class='btn btn-danger' id='btnDeletePurchaserequests' data-id='0'>Yes, Remove</button>
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
			$(document).on('click','#btnDeletePurchaserequests',function(e) {
				e.preventDefault();
				var id=$(this).attr('data-id');
				$('#modelDeletePurchaserequests').appendTo('body').modal('hide');
				jQuery.ajax({
					url : baseurl + '/purchaserequests/removePurchaserequests',
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
							$.notify('Purchaserequests Cannot be removed','error');
						}
						else
						{
							$('#modelDeletePurchaserequests').appendTo('body').modal('hide');
							data=JSON.parse(data);
							$('#colPurchaserequests').html(data.col);
							$('#fillPurchaserequests').html(data.row);
							$.notify('Purchaserequests Removed Successfully','success');

							
						}
					}
				});
			});
			$(document).delegate('#createPurchaserequests','click',function(e) {
				e.preventDefault();
				$('#modelPurchaserequests').appendTo('body').modal('show');
			});
			$(document).delegate('.clickablerow','click',function(){
				var id=$(this).data('id');
				jQuery.ajax({
					url : baseurl + '/purchaserequests/showEdit',
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
						$('#idfrmPurchaserequests').val(id);
						$('#dltPurchaserequests').attr('data-id',id);
						$.each(data,function(i,item){
							$('#idedit'+i).val(item);
						});
						$('#modelEditPurchaserequests').appendTo('body').modal('show');
					}
				});
			});
		</script>
		