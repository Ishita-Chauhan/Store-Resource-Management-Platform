
		<div class='row'>
			<div class='col-sm-12'>
				<form class='row g-3'  id='frmArticles' method='post'>
					<div class='col-12'>
						<label class='form-label'>Name</label>
							<input type='text' class='form-control' data-validation='required' 
							 name='name' id='idname' placeholder='Enter Name'>
					</div>
					<div class='col-12'>
						<label for='address' class='form-label'>Nature</label>
							<textarea class='form-control' rows='3' name='nature' id='idnature' placeholder='Enter Nature' data-validation='required' ></textarea>
					</div>
					
					<div class='col-12'>
						<label class='form-label'>Price</label>
							<input type='text' class='form-control' data-validation='required' 
							 name='price' id='idprice' placeholder='Enter Price'>
					</div>
					<div class='col-12'>
						<label class='form-label'>Expiry</label>
							<input type='text' class='form-control' readonly='readonly' name='expiry' id='idexpiry' placeholder='Enter Expiry'>
					</div>
					
					<div class='col-12'>
						<label for='address' class='form-label'>Description</label>
							<textarea class='form-control' rows='3' name='description' id='iddescription' placeholder='Enter Description' data-validation='required' ></textarea>
					</div>
					
					<div class='col-12'>
						<label for='select' class='form-label'>Status</label>
							<select class='form-control' name='status' id='idstatus'>
								<option class='active' value='0'>--Select Default--</option>
							</select>
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
					form : '#frmArticles',
					modules : 'location, date, security, file',
					validateOnBlur : false,
					onSuccess : function($form) {
						var frm = document.getElementById('frmArticles');
						var frmdt = new FormData(frm);
						jQuery.ajax({
							url : baseurl + '/articles/createArticles',
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
									$.notify('Unable to CreateArticles','error');
								}
								else
								{
									$('#modelArticles').appendTo('body').modal('hide');
									$('#frmArticles').get(0).reset();
									data=JSON.parse(data);
									$('#colArticles').html(data.col);
									$('#fillArticles').html(data.row);
									$.notify('Articles Successfully Created','success');
							
								}
							}
						});
						return false; 
					}
				});
			});
		</script>
		