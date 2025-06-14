<style>
body {
    background: #181818;
    color: #f5f5f5;
    font-family: 'Segoe UI', Arial, sans-serif;
}
h1, hr {
    color: #fff;
    border-color: #333;
}
#hover .info-box,
.col-12.col-sm-6.col-md-3#hover .info-box {
    transition: transform 0.3s cubic-bezier(.4,2,.6,1), box-shadow 0.3s;
    background: #232323;
    border-radius: 18px;
    border: 1px solid #222;
    box-shadow: 0 2px 8px rgba(0,0,0,0.25);
    color: #f5f5f5;
}
#hover .info-box:hover,
.col-12.col-sm-6.col-md-3#hover .info-box:hover {
    transform: translateY(-10px) scale(1.04);
    box-shadow: 0 8px 32px rgba(0,0,0,0.35);
    z-index: 2;
    border-color: #444;
}
.dashboard  {
    border-radius: 12px;
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin-right: 16px;
    color: #fff;
}
.bg-info { background: #22242a !important; }
.bg-warning { background: #444 !important; }
.bg-primary { background: #1a1a1a !important; }
.bg-danger { background: #2d1a1a !important; }
.bg-success { background: #1a2d1a !important; }
.bg-navy { background: #1a1a2d !important; }
.bg-lightblue { background: #1a232d !important; }
.bg-teal { background: #1a2d2d !important; }
.info-box-content {
    padding: 8px 0;
}
.info-box-text {
    font-size: 1.1rem;
    color: #bbb;
    letter-spacing: 0.5px;
}
.info-box-number {
    font-size: 1.5rem;
    font-weight: bold;
    color: #fff;
}
.row {
    margin-top: 30px;
}
@media (max-width: 767px) {
    .info-box {
        margin-bottom: 18px;
    }
}
</style>

<center><h1 class="" style='color:black;'>Welcome to <?php echo $_settings->info('name') ?></h1></center>
<hr>
<br>
<div class="row" id='hover'>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box shadow">
           <i class="fas fa-th-list dashboard"></i>
            <div class="info-box-content">
                <span class="info-box-text">PO Records</span>
                <span class="info-box-number text-right">
                    <?php echo $conn->query("SELECT * FROM `purchase_order_list`")->num_rows; ?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box shadow">
     <i class="fas fa-boxes dashboard"></i>
            <div class="info-box-content">
                <span class="info-box-text">Receiving Records</span>
                <span class="info-box-number text-right">
                    <?php echo $conn->query("SELECT * FROM `receiving_list`")->num_rows; ?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box shadow">
            <i class="fas fa-exchange-alt dashboard"></i>
            <div class="info-box-content">
                <span class="info-box-text">BO Records</span>
                <span class="info-box-number text-right">
                    <?php echo $conn->query("SELECT * FROM `back_order_list`")->num_rows; ?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box shadow">
          <i class="fas fa-undo dashboard"></i>
            <div class="info-box-content">
                <span class="info-box-text">Return Records</span>
                <span class="info-box-number text-right">
                    <?php echo $conn->query("SELECT * FROM `return_list`")->num_rows; ?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box shadow">
          <i class="fas fa-file-invoice-dollar dashboard"></i>
            <div class="info-box-content">
                <span class="info-box-text">Sales Records</span>
                <span class="info-box-number text-right">
                    <?php echo $conn->query("SELECT * FROM `sales_list`")->num_rows; ?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box shadow">
            <i class="fas fa-truck-loading dashboard"></i>
            <div class="info-box-content">
                <span class="info-box-text">Suppliers</span>
                <span class="info-box-number text-right">
                    <?php echo $conn->query("SELECT * FROM `supplier_list` where `status` = 1")->num_rows; ?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box shadow">
            <i class="fas fa-th-list dashboard"></i>
            <div class="info-box-content">
                <span class="info-box-text">Items</span>
                <span class="info-box-number text-right">
                    <?php echo $conn->query("SELECT * FROM `item_list` where `status` = 1")->num_rows; ?>
                </span>
            </div>
        </div>
    </div>
    <?php if($_settings->userdata('type') == 1): ?>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box shadow">
          <i class="fas fa-users dashboard"></i>
            <div class="info-box-content">
                <span class="info-box-text">Users</span>
                <span class="info-box-number text-right">
                    <?php echo $conn->query("SELECT * FROM `users` where id != 1 ")->num_rows; ?>
                </span>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>