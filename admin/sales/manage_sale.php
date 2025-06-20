<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM sales_list where id = '{$_GET['id']}'");
    if($qry->num_rows >0){
        foreach($qry->fetch_array() as $k => $v){
            $$k = $v;
        }
    }
}
?>
<style>
    select[readonly].select2-hidden-accessible + .select2-container {
        pointer-events: none;
        touch-action: none;
        background: #eee;
        box-shadow: none;
    }

    select[readonly].select2-hidden-accessible + .select2-container .select2-selection {
        background: #eee;
        box-shadow: none;
    }
</style>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h4 class="card-title"><?php echo isset($id) ? "Sale Details - ".$sales_code : 'Create New Sale Record' ?></h4>
    </div>
    <div class="card-body">
        <form action="" id="sale-form">
            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <label class="control-label text-info">Sale Code</label>
                        <input type="text" class="form-control form-control-sm rounded-0" value="<?php echo isset($sales_code) ? $sales_code : '' ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="client" class="control-label text-info">Client Name</label>
                            <input type="text" name="client" class="form-control form-control-sm rounded-0" value="<?php echo isset($client) ? $client : 'Guest' ?>" >
                        </div>
                    </div>
                </div>
                <hr>
                <fieldset>
                    <legend class="text-info">Item Form</legend>
                    <div class="row justify-content-center align-items-end">
                            <?php 
                                $item_arr = array();
                                $cost_arr = array();
                                $qry = $conn->query("SELECT 
                                    stock_list.*, 
                                    item_list.name as ItemName, 
                                    item_list.id as ItemID, 
                                    item_list.description as description, 
                                    item_list.cost as cost, 
                                    supplier_list.name as supplierName 
                                    FROM stock_list 
                                    LEFT JOIN item_list ON item_list.id = stock_list.item_id 
                                    LEFT JOIN supplier_list ON supplier_list.id = stock_list.supplier_id 
                                    WHERE item_list.status = 1 
                                    ORDER BY item_list.name ASC");

                                while($row = $qry->fetch_assoc()):
                                    $data[] = $row;
                             
                                endwhile;
                            ?>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="item_id" class="control-label">Item</label>

<?php 
                            //     $qry = $conn->query("SELECT
                            // *, item_list.name as ItemName, item_list.description as description, supplier_list.name as supplierName
                            // FROM stock_list LEFT JOIN item_list ON item_list.id = stock_list.item_id LEFT JOIN supplier_list ON supplier_list.id = stock_list.supplier_id ORDER BY item_list.name ASC");
?>

                                <select  id="item_id" class="custom-select select2">
                                    <option disabled selected></option>
                                    <?php foreach($data as $stock): ?>
                                        <option value="<?php echo $stock['id'] .';'. $stock['description'] .';'. $stock['ItemName'].';'.$stock['quantity'].';'.$stock['cost'].';'.$stock['ItemID'].';'.$stock['unit'] ?>"><strong>ITEM:</strong>   <?php echo $stock['ItemName'] ?>                                                                                              <strong>QTY:</strong>   <?php echo $stock['quantity'] ?></option>
                                    <?php endforeach; ?>
                                </select>


                                
                            </div>
                        </div>
                        <!-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="unit" class="control-label">Unit</label>
                                <input type="text" class="form-control rounded-0" id="unit">
                            </div>
                        </div> -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="qty" class="control-label">Qty</label>
                                <input type="number" step="any" class="form-control rounded-0" id="qty">
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            <div class="form-group">
                                <button type="button" class="btn btn-flat btn-sm btn-primary" id="add_to_list">Add to List</button>
                            </div>
                        </div>
                       <!-- <input type="hidden" id='itemID' name='itemID'> -->

                </fieldset>
                <hr>
                <table class="table table-striped table-bordered" id="list">

                    <colgroup>
                        <col width="5%">
                        <col width="10%">
                        <col width="10%">
                        <col width="25%">
                        <col width="25%">
                        <col width="25%">
                    </colgroup>
                    <thead>
                        <tr class="text-light bg-navy">
                            <th class="text-center py-1 px-2"></th>
                            <th class="text-center py-1 px-2">Qty</th>
                            <th class="text-center py-1 px-2">Unit</th>
                            <th class="text-center py-1 px-2">Item</th>
                            <th class="text-center py-1 px-2">Cost</th>
                            <th class="text-center py-1 px-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php
$total = 0;

if (isset($id) && !empty($stock_ids)):

    // Make sure $stock_ids is an array
    if (is_array($stock_ids)) {
        // Sanitize and convert to comma-separated string
        $stock_ids_str = implode(",", array_map('intval', $stock_ids));
    } else {
        // fallback: single value (but still sanitize)
        $stock_ids_str = intval($stock_ids);
    }

    $qry = $conn->query("SELECT s.*, i.name, i.description 
                         FROM `stock_list` s 
                         INNER JOIN item_list i ON s.item_id = i.id 
                         WHERE s.id IN ($stock_ids_str)");

    while ($row = $qry->fetch_assoc()):
        $total += $row['total'];
?>
<!-- HTML output continues here -->
<?php
    endwhile;
endif;
?>


                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-right py-1 px-2" colspan="5">Total
                                <input type="hidden" name="amount" value="<?php echo isset($discount) ? $discount : 0 ?>">
                            </th>
                            <th class="text-right py-1 px-2 grand-total">0</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="remarks" class="text-info control-label">Remarks</label>
                            <textarea name="remarks" id="remarks" rows="3" class="form-control rounded-0"><?php echo isset($remarks) ? $remarks : '' ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer py-1 text-center">
        <button class="btn btn-flat btn-primary" type="submit" form="sale-form">Save</button>
        <a class="btn btn-flat btn-dark" href="<?php echo base_url.'/admin?page=sale' ?>">Cancel</a>
    </div>
</div>
<!-- <input type="hidden" id='itemID' name='itemID'> -->

<table id="clone_list" class="d-none">

    <tr>
        <td class="py-1 px-2 text-center">
            <button class="btn btn-outline-danger btn-sm rem_row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="py-1 px-2 text-center qty">
            <span class="visible"></span>
            <input type="hidden" name="item_id[]">
            <input type="hidden" name="unit[]">
            <input type="hidden" name="qty[]">
            <input type="hidden" name="price[]">
            <input type="hidden" name="total[]">
        </td>
        <td class="py-1 px-2 text-center unit">
        </td>
        <td class="py-1 px-2 item">
        </td>
        <td class="py-1 px-2 text-right cost">
        </td>
        <td class="py-1 px-2 text-right total">
        </td>
    </tr>
</table>
<script>
    // var items = $.parseJSON('<?php //echo json_encode($item_arr) ?>')
    // var costs = $.parseJSON('<?php// echo json_encode($cost_arr) ?>')
    
    $(function(){
        $('.select2').select2({
            placeholder:"Please select here",
            width:'resolve',
        })
        $('#add_to_list').click(function(){
            var itemData = $('#item_id').val();
            var itemParts = itemData ? itemData.split(';') : [];     
            var itemID = itemParts.length > 5 ? itemParts[5] : '';
            var item = itemParts.length > 0 ? itemParts[0] : '' + ';' + itemID;
            var item_description = itemParts.length > 1 ? itemParts[1] : '';
            var item_name = itemParts.length > 2 ? itemParts[2] : '';
            var quantity = itemParts.length > 3 ? itemParts[3] : '';
            var costs = itemParts.length > 4 ? itemParts[4] : '';
            var unit = itemParts.length > 6 ? itemParts[6] : '';
            // console.log(itemData )
       
            var qty = $('#qty').val() > 0 ? $('#qty').val() : 0;
            // var unit = $('#unit').val()
            var price = costs|| 0
            var total = parseFloat(qty) *parseFloat(price)




            // console.log(supplier,item)
            // var item_name = items[item].name || 'N/A';
            // var item_description = items[item].description || 'N/A';
            var tr = $('#clone_list tr').clone()


            if(parseFloat(qty) > parseFloat(quantity)){
                alert_toast('Requested quantity exceeds available stock.','warning');
                console.log(qty + ' is greater than ' + quantity);
                return false;
            }

            if(item == '' || qty == '' || unit == '' ){
                alert_toast('Form Item textfields are required.','warning');
                return false;
            }
            if($('table#list tbody').find('tr[data-id="'+item+'"]').length > 0){
                alert_toast('Item is already exists on the list.','error');
                return false;
            }
            tr.find('[name="item_id[]"]').val(item)
            tr.find('[name="unit[]"]').val(unit)
            tr.find('[name="qty[]"]').val(qty)
            tr.find('[name="price[]"]').val(price)
            tr.find('[name="total[]"]').val(total)
            tr.attr('data-id',item)
            tr.find('.qty .visible').text(qty)
            tr.find('.unit').text(unit)
            tr.find('.item').html(item_name+'<br/>'+item_description)
            tr.find('.cost').text(parseFloat(price).toLocaleString('en-US'))
            tr.find('.total').text(parseFloat(total).toLocaleString('en-US'))

            $('table#list tbody').append(tr)
            calc()
            $('#item_id').val('').trigger('change')
            $('#itemID').val(itemID)
            $('#qty').val('')
            $('#unit').val('')
            tr.find('.rem_row').click(function(){
                rem($(this))
            })
            
            $('[name="discount_perc"],[name="tax_perc"]').on('input',function(){
                calc()
            })
            $('#supplier_id').attr('readonly','readonly')
        })
        $('#sale-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_sale",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(resp.status == 'success'){
						location.replace(_base_url_+"admin/?page=sales/view_sale&id="+resp.id);
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
                    $('html,body').animate({scrollTop:0},'fast')
				}
			})
		})

        if('<?php echo isset($id) && $id > 0 ?>' == 1){
            calc()
            $('#supplier_id').trigger('change')
            $('#supplier_id').attr('readonly','readonly')
            $('table#list tbody tr .rem_row').click(function(){
                rem($(this))
            })
        }
    })
    function rem(_this){
        _this.closest('tr').remove()
        calc()
        if($('table#list tbody tr').length <= 0)
            $('#supplier_id').removeAttr('readonly')

    }
    function calc(){
        var grand_total = 0;
        $('table#list tbody input[name="total[]"]').each(function(){
            grand_total += parseFloat($(this).val())
            
        })
       
        $('table#list tfoot .grand-total').text(parseFloat(grand_total).toLocaleString('en-US',{style:'decimal',maximumFractionDigit:2}))
        $('[name="amount"]').val(parseFloat(grand_total))

    }
</script>