
		<div class='row' style='margin-bottom: 20px;'>
			<div class='col'>
				<a  id='createAuthorities' class='btn btn-primary float-right' role='button'  style='color: white;'><i class='fa fa-user-plus' aria-hidden='true'></i>  Create Authorities</a>
			</div>
		</div>
		
		<div class='col-sm-12'>
			<table class='table table-striped table-bordered  table-hover table-sm' id='dtOrderTable'>
				<thead id='colAuthorities'>

					<?php
					if(isset($cols))
						echo $cols;
					?>

				</thead>
				<tbody id='fillAuthorities'>
					<?php
					if(isset($rows))
						echo $rows;
					?>
				</tbody>
			</table>
		</div>
		<div class='modal fade' id='modelAuthorities'>
			<div class='modal-dialog modal-dialog-centered'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h4 class='modal-title'>Create New Authorities</h4>
						<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
					</div>
					<div class='modal-body'>
						<?php $this->load->view('authorities/createAuthorities'); ?>
					</div>
				</div>
			</div>
		</div>	
		<div class='modal fade' id='modelEditAuthorities'>
			<div class='modal-dialog  modal-dialog-centered'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h4 class='modal-title'>Update Authorities</h4>
						<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
					</div>
					<div class='modal-body'>
						<?php $this->load->view('authorities/editAuthorities'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class='modal fade' id='modelDeleteAuthorities'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<h4 class='modal-title'>Confirm deletion of Authorities</h4>
						<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
					</div>
					<div class='modal-body'>
						Are You Sure?
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-secondary' data-dismiss='modal'>No, Cancel</button>
						<button type='button' class='btn btn-danger' id='btnDeleteAuthorities' data-id='0'>Yes, Remove</button>
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
			$(document).on('click','#btnDeleteAuthorities',function(e) {
				e.preventDefault();
				var id=$(this).attr('data-id');
				$('#modelDeleteAuthorities').appendTo('body').modal('hide');
				jQuery.ajax({
					url : baseurl + '/authorities/removeAuthorities',
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
							$.notify('Authorities Cannot be removed','error');
						}
						else
						{
							$('#modelDeleteAuthorities').appendTo('body').modal('hide');
							data=JSON.parse(data);
							$('#colAuthorities').html(data.col);
							$('#fillAuthorities').html(data.row);
							$.notify('Authorities Removed Successfully','success');

							
						}
					}
				});
			});
			$(document).delegate('#createAuthorities','click',function(e) {
				e.preventDefault();
				$('#modelAuthorities').appendTo('body').modal('show');
			});
			$(document).delegate('.clickablerow','click',function(){
				var id=$(this).data('id');
				jQuery.ajax({
					url : baseurl + '/authorities/showEdit',
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
						$('#idfrmAuthorities').val(id);
						$('#dltAuthorities').attr('data-id',id);
						$.each(data,function(i,item){
							$('#idedit'+i).val(item);
						});
						$('#modelEditAuthorities').appendTo('body').modal('show');
					}
				});
			});
		</script>
		