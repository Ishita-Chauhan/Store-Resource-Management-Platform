
		<div class='row' style='margin-bottom: 20px;'>
			<div class='col'>
				<a  id='createAllocation' class='btn btn-primary float-right' role='button'  style='color: white;'><i class='fa fa-user-plus' aria-hidden='true'></i>  Create Allocation</a>
			</div>
		</div>
		
		<div class='col-sm-12'>
			<table class='table table-striped table-bordered  table-hover table-sm' id='dtOrderTable'>
				<thead id='colAllocation'>

					<?php
					if(isset($cols))
						echo $cols;
					?>

				</thead>
				<tbody id='fillAllocation'>
					<?php
					if(isset($rows))
						echo $rows;
					?>
				</tbody>
			</table>
		</div>
		<div class='modal fade' id='modelAllocation'>
			<div class='modal-dialog modal-dialog-centered'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h4 class='modal-title'>Create New Allocation</h4>
						<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
					</div>
					<div class='modal-body'>
						<?php $this->load->view('allocation/createAllocation'); ?>
					</div>
				</div>
			</div>
		</div>	
		<div class='modal fade' id='modelEditAllocation'>
			<div class='modal-dialog  modal-dialog-centered'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h4 class='modal-title'>Update Allocation</h4>
						<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
					</div>
					<div class='modal-body'>
						<?php $this->load->view('allocation/editAllocation'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class='modal fade' id='modelDeleteAllocation'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h4 class='modal-title'>Confirm deletion of Allocation</h4>
						<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
					</div>
					<div class='modal-body'>
						Are You Sure?
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-secondary' data-dismiss='modal'>No, Cancel</button>
						<button type='button' class='btn btn-danger' id='btnDeleteAllocation' data-id='0'>Yes, Remove</button>
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
			$(document).on('click','#btnDeleteAllocation',function(e) {
				e.preventDefault();
				var id=$(this).attr('data-id');
				$('#modelDeleteAllocation').appendTo('body').modal('hide');
				jQuery.ajax({
					url : baseurl + '/allocation/removeAllocation',
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
							$.notify('Allocation Cannot be removed','error');
						}
						else
						{
							$('#modelDeleteAllocation').appendTo('body').modal('hide');
							data=JSON.parse(data);
							$('#colAllocation').html(data.col);
							$('#fillAllocation').html(data.row);
							$.notify('Allocation Removed Successfully','success');

							
						}
					}
				});
			});
			$(document).delegate('#createAllocation','click',function(e) {
				e.preventDefault();
				$('#modelAllocation').appendTo('body').modal('show');
			});
			$(document).delegate('.clickablerow','click',function(){
				var id=$(this).data('id');
				jQuery.ajax({
					url : baseurl + '/allocation/showEdit',
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
						$('#idfrmAllocation').val(id);
						$('#dltAllocation').attr('data-id',id);
						$.each(data,function(i,item){
							$('#idedit'+i).val(item);
						});
						$('#modelEditAllocation').appendTo('body').modal('show');
					}
				});
			});
		</script>
		