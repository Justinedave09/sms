
<?php 
if(isset($_GET['id']) && $_GET['id'] > 0){

	echo 'YES';
	$user = $conn->query("SELECT * FROM stock_list LEFT JOIN item_list ON item_list.id = stock_list.item_id  where stock_list.id ='{$_GET['id']}'");
	if($user && $user->num_rows > 0){
		foreach($user->fetch_array() as $k =>$v){
			$meta[$k] = $v;
		}
	}
}
?>
<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-body">
		<div class="container-fluid">
			<div id="msg"></div>
			<form action="" id="add_stock">	
                <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
                <div class="form-group col-6">
                    <label for="item_name">Item Name</label>
                    <select name="item_name" id="item_name" class="form-control" required>
                        <option value="">Select Item</option>
                        <?php
                        // Example: Fetch item names from a table called 'items'
                        $items = $conn->query("SELECT id, name FROM item_list ORDER BY id ASC");
                        while($row = $items->fetch_assoc()):
                        ?>
                            <option value="<?php echo htmlspecialchars($row['id']); ?>" <?php echo (isset($meta['item_id']) && $meta['item_id'] == $row['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($row['name']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
				<!-- <div class="form-group col-6">
					<label for="name">Item Description</label>
					<input type="text" name="item_description" id="item_description" class="form-control" value="<?php echo isset($meta['item_description']) ? $meta['item_description']: '' ?>" required>
                </div> -->
                <div class="form-group col-6">
                    <label for="supplier_id">Item Supplier</label>
                    <select name="supplier_id" id="supplier_id" class="form-control" >
                        <option value="">Select Supplier</option>
                        <?php
                        $suppliers = $conn->query("SELECT id, name FROM supplier_list ORDER BY name ASC");
                        while($row = $suppliers->fetch_assoc()):
                        ?>
                            <option value="<?php echo $row['id']; ?>" <?php echo (isset($meta['supplier_id']) && $meta['supplier_id'] == $row['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($row['name']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                    </div>

                <div class="form-group col-6">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="<?php echo isset($meta['quantity']) ? $meta['quantity'] : '' ?>" min="0" required>
                </div>
                <div class="form-group col-6">
                    <label for="unit">Unit</label>
                    <select name="unit" id="unit" class="form-control" required>
                        <option value="">Select Unit</option>
                        <option value="pcs" <?php echo (isset($meta['unit']) && $meta['unit'] == 'pcs') ? 'selected' : ''; ?>>Pieces</option>
                        <option value="kg" <?php echo (isset($meta['unit']) && $meta['unit'] == 'kg') ? 'selected' : ''; ?>>Kilograms</option>
                        <option value="ltr" <?php echo (isset($meta['unit']) && $meta['unit'] == 'ltr') ? 'selected' : ''; ?>>Liters</option>
                        <option value="box" <?php echo (isset($meta['unit']) && $meta['unit'] == 'box') ? 'selected' : ''; ?>>Box</option>
                        <option value="pack" <?php echo (isset($meta['unit']) && $meta['unit'] == 'pack') ? 'selected' : ''; ?>>Pack</option>
                        <!-- Add more units as needed -->
                    </select>
                </div>
				
				<div class="form-group col-6">
					<label for="price" class="control-label">Price</label>
					<input type="text" class="form-control" id="price" name="price" required>
				</div>
				<script>
				$(function(){
					$('#price').on('input', function() {
						let value = $(this).val().replace(/,/g, '');
						if (!isNaN(value) && value !== '') {
							$(this).val(Number(value).toLocaleString());
						} else {
							$(this).val('');
						}
					});
				});
				</script>		
			</div>	
			</form>
		</div>
	</div>
	<div class="card-footer">
			<div class="col-md-12">
				<div class="row">
					<button class="btn btn-sm btn-primary mr-2" form="add_stock">Save</button>
					<a class="btn btn-sm btn-secondary" href="./?page=stocks/">Cancel</a>
				</div>
			</div>
		</div>
</div>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
<script>
	$(function(){
		$('.select2').select2({
			width:'resolve'
		})
	})
	// function displayImg(input,_this) {
	//     if (input.files && input.files[0]) {
	//         var reader = new FileReader();
	//         reader.onload = function (e) {
	//         	$('#cimg').attr('src', e.target.result);
	//         }

	//         reader.readAsDataURL(input.files[0]);
	//     }
	// }
	$('#add_stock').submit(function(e){
		e.preventDefault();
		var _this = $(this)
		start_loader()
		$.ajax({
			url:_base_url_+"classes/Master.php?f=add_stock",
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			dataType: 'json',
			success:function(resp){
				if(resp.status == 'success'){
					$('#msg').html('<div class="alert alert-success">New stock inserted successfully.</div>')
					location.href = './?page=stocks';
				}else{
					$('#msg').html('<div class="alert alert-danger">Error Occurred</div>')
					$("html, body").animate({ scrollTop: 0 }, "fast");
				}
				end_loader()
			}
		});
	});


</script>