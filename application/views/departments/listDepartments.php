
		<div class='row' style='margin-bottom: 20px;'>
			<div class='col'>
				<a  id='createDepartments' class='btn btn-primary float-right' role='button'  style='color: white;'><i class='fa fa-user-plus' aria-hidden='true'></i>  Create Departments</a>
			</div>
		</div>
		
		<div class='col-sm-12'>
			<table class='table table-striped table-bordered  table-hover table-sm' id='dtOrderTable'>
				<thead id='colDepartments'>

					<?php
					if(isset($cols))
						echo $cols;
					?>

				</thead>
				<tbody id='fillDepartments'>
					<?php
					if(isset($rows))
						echo $rows;
					?>
				</tbody>
			</table>
		</div>
		<div class='modal fade' id='modelDepartments'>
			<div class='modal-dialog modal-dialog-centered'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h4 class='modal-title'>Create New Departments</h4>
						<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
					</div>
					<div class='modal-body'>
						<?php $this->load->view('departments/createDepartments'); ?>
					</div>
				</div>
			</div>
		</div>	
		<div class='modal fade' id='modelEditDepartments'>
			<div class='modal-dialog  modal-dialog-centered'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h4 class='modal-title'>Update Departments</h4>
						<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
					</div>
					<div class='modal-body'>
						<?php $this->load->view('departments/editDepartments'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class='modal fade' id='modelDeleteDepartments'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h4 class='modal-title'>Confirm deletion of Departments</h4>
						<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
					</div>
					<div class='modal-body'>
						Are You Sure?
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-secondary' data-dismiss='modal'>No, Cancel</button>
						<button type='button' class='btn btn-danger' id='btnDeleteDepartments' data-id='0'>Yes, Remove</button>
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
			$(document).on('click','#btnDeleteDepartments',function(e) {
				e.preventDefault();
				var id=$(this).attr('data-id');
				$('#modelDeleteDepartments').appendTo('body').modal('hide');
				jQuery.ajax({
					url : baseurl + '/departments/removeDepartments',
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
							$.notify('Departments Cannot be removed','error');
						}
						else
						{
							$('#modelDeleteDepartments').appendTo('body').modal('hide');
							data=JSON.parse(data);
							$('#colDepartments').html(data.col);
							$('#fillDepartments').html(data.row);
							$.notify('Departments Removed Successfully','success');

							
						}
					}
				});
			});
			$(document).delegate('#createDepartments','click',function(e) {
				e.preventDefault();
				$('#modelDepartments').appendTo('body').modal('show');
			});
			$(document).delegate('.clickablerow','click',function(){
				var id=$(this).data('id');
				jQuery.ajax({
					url : baseurl + '/departments/showEdit',
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
						$('#idfrmDepartments').val(id);
						$('#dltDepartments').attr('data-id',id);
						$.each(data,function(i,item){
							$('#idedit'+i).val(item);
						});
						$('#modelEditDepartments').appendTo('body').modal('show');
					}
				});
			});
		</script>
		