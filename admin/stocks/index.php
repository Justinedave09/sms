<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Stocks <?php //echo $_SESSION['userdata']['username']?></h3>
        <!-- <div class="card-tools">
			<a href="<?php echo base_url ?>admin/?page=stocks/add_stock" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div> -->
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-sm table-stripped" >
                    <colgroup>
                        <col width="2%">
                        <col width="15%">
                        <col width="25%">
                        <col width="15%">
						<col width="8%">
                        <col width="13%">
                        <col width="15%">
						<!-- <col width="15%"> -->
                    </colgroup>
                    <thead class="thead-gray">
                        <tr>
                            <th>#</th>
                            <th>Item Name</th>
                            <th>Description</th>
                            <th>Available Stocks</th>
							 <th>Units</th>
							 <th>Price Per Unit</th>
							 <th>Overall Price</th>
							 <!-- <th>Actions</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
						$qry = $conn->query("SELECT
						 *, item_list.name as ItemName, item_list.description as description, supplier_list.name as supplierName
						 FROM stock_list LEFT JOIN item_list ON item_list.id = stock_list.item_id LEFT JOIN supplier_list ON supplier_list.id = stock_list.supplier_id ORDER BY item_list.name ASC");
						while($row = $qry->fetch_assoc()):
                            // $in = $conn->query("SELECT SUM(quantity) as total FROM stock_list where item_id = '{$row['id']}' and type = 1")->fetch_array()['total'];
                            // $out = $conn->query("SELECT SUM(quantity) as total FROM stock_list where item_id = '{$row['id']}' and type = 2")->fetch_array()['total'];
                            // $row['available'] = $in - $out;
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td><?php echo $row['ItemName'] ?></td>
                                <td><?php echo $row['description'] ?></td>
                                <td ><?php echo number_format($row['quantity']) ?></td>
								<td><?php echo $row['unit']?></td>
								<td><?php echo number_format($row['price'])?></td>
								<td><?php echo number_format($row['quantity'] * $row['price'])?></td>
								<!-- <td>
									<a href="<?php //echo base_url ?>admin/?page=stocks/add_stock&id=<?php// echo $row['id'] ?>" class="btn btn-sm btn-primary" title="Edit">
										<span class="fas fa-edit"></span>
									</a>
								</td> -->
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Received Orders permanently?","delete_receiving",[$(this).attr('data-id')])
		})
		$('.view_details').click(function(){
			uni_modal("Receiving Details","receiving/view_receiving.php?id="+$(this).attr('data-id'),'mid-large')
		})
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable();
	})
	function delete_receiving($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_receiving",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>