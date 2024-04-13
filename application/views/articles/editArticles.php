
		<div class='row'>
			<div class='col-sm-12'>
				<form class='row g-3' id='frmeditArticles' method='post'>
					<input type='hidden' id='idfrmArticles' name='idArticles' value=0>
					<div class='col-12'>
						<label class='form-label'>Name</label>
							<input type='text' class='form-control' data-validation='required'  name='name' id='ideditname' placeholder='Enter Name'>
					</div>
					<div class='col-12'>
						<label for='address' class='form-label'>Nature</label>
							<textarea class='form-control' rows='3' name='nature' id='ideditnature' placeholder='Enter Nature' data-validation='required' ></textarea>
					</div>
					
					<div class='col-12'>
						<label class='form-label'>Price</label>
							<input type='text' class='form-control' data-validation='required'  name='price' id='ideditprice' placeholder='Enter Price'>
					</div>
					<div class='col-12'>
						<label class='form-label'>Expiry</label>
							<input type='text' class='form-control'  readonly='readonly' name='expiry' id='ideditexpiry' placeholder='Enter Expiry'>
					</div>
					
					<div class='col-12'>
						<label for='address' class='form-label'>Description</label>
							<textarea class='form-control' rows='3' name='description' id='ideditdescription' placeholder='Enter Description' data-validation='required' ></textarea>
					</div>
					
					<div class='col-12'>
						<label for='select' class='form-label'>Status</label>
							<select class='form-control' name='status' id='ideditstatus'>
								<option class='active' value='0'>--Select Default--</option>
							</select>
					</div>
					
						<div class='col-12'>
								<a id='dltArticles' role='button' style='color:white;' class='btn btn-danger' data-id='0'>Remove</a>
								<input type='submit' class='btn btn-warning' value='Update'>
							
						</div>
				</form>
			</div>
		</div>
		<script type='text/javascript'>
			$(document).ready(function(){
				$.validate({
					form : '#frmeditArticles',
					modules : 'location, date, security, file',
					validateOnBlur : false,
					onSuccess : function($form) {
						var frm = document.getElementById('frmeditArticles');
						var frmdt = new FormData(frm);
						jQuery.ajax({
							url : baseurl + '/articles/editArticles',
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
									$.notify('Could not UpdateArticles','error');
								}
								else
								{
									$('#modelEditArticles').appendTo('body').modal('hide');
									$('#frmeditArticles').get(0).reset();
									data=JSON.parse(data);
									$('#colArticles').html(data.col);
									$('#fillArticles').html(data.row);
									$.notify('Articles Updated Successfully','success');

								}
							}
						});
						return false;
					}
				});
				$(document).delegate('#dltArticles','click',function(){

					$('#modelDeleteArticles').appendTo('body').modal('show');
					$('#modelEditArticles').appendTo('body').modal('hide');
					
					var id=$(this).attr('data-id');
					$('#btnDeleteArticles').attr('data-id',id);
					//console.log($(this).data('id'));
				});
			});

		</script>
		