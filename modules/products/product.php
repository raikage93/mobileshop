<?php
$prd_id = $_GET['prd_id'];

$sql = "SELECT * FROM product
		WHERE prd_id = $prd_id";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);
?>
<!--	List Product	-->
<div id="product">
    <div id="product-head" class="row">
        <div id="product-img" class="col-lg-6 col-md-6 col-sm-12">
            <img src="admin/img/products/<?php echo $row['prd_image'];?>">
        </div>
        <div id="product-details" class="col-lg-6 col-md-6 col-sm-12">
            <h1><?php echo $row['prd_name'];?></h1>
            <ul>
                <li><span>Bảo hành:</span> <?php echo $row['prd_warranty'];?></li>
                <li><span>Đi kèm:</span> <?php echo $row['prd_accessories'];?></li>
                <li><span>Tình trạng:</span> <?php echo $row['prd_new'];?></li>
                <li><span>Khuyến Mại:</span> <?php echo $row['prd_promotion'];?></li>
                <li id="price">Giá Bán (chưa bao gồm VAT)</li>
                <li id="price-number"><?php echo $row['prd_price'];?>đ</li>
                <li id="status"><?php if($row['prd_status' == 1]){echo 'Còn hàng';}else{echo 'Hết hàng';}?></li>
            </ul>
            <div id="add-cart"><a href="modules/cart/add_cart.php?prd_id=<?php echo $row['prd_id'];?>">Mua ngay</a></div>
        </div>
    </div>
    <div id="product-body" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Đánh giá về <?php echo $row['prd_name'];?></h3>
            <?php echo $row['prd_details'];?>
        </div>
    </div>
    
    <?php
    if(isset($_POST['sbm'])){
		$comm_name = $_POST['comm_name'];	
		$comm_mail = $_POST['comm_mail'];	
		$comm_details = $_POST['comm_details'];	
		
		date_default_timezone_set('Asia/Bangkok');
		$comm_date = date('Y-m-d H:i:s');
		
		$sql = "INSERT INTO comment(comm_name, comm_mail, comm_details, comm_date, prd_id)
				VALUES('$comm_name', '$comm_mail', '$comm_details', '$comm_date', '$prd_id')";
		mysqli_query($conn, $sql);
	}
	?>
	  
    <!--	Comment	-->
    <div id="comment" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Bình luận sản phẩm</h3>
            <form method="post">
                <div class="form-group">
                    <label>Tên:</label>
                    <input name="comm_name" required type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input name="comm_mail" required type="email" class="form-control" id="pwd">
                </div>
                <div class="form-group">
                    <label>Nội dung:</label>
                    <textarea name="comm_details" required rows="8" class="form-control"></textarea>     
                </div>
                <button type="submit" name="sbm" class="btn btn-primary">Gửi</button>
            </form> 
        </div>
    </div>
    <!--	End Comment	-->  
    
    <?php
	//	Pagination
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}
	else{
		$page = 1;	
	}
	$rows_per_page = 5;
	$per_row = $page*$rows_per_page - $rows_per_page;
	
	
    $sql = "SELECT * FROM comment
			WHERE prd_id = $prd_id
			ORDER BY comm_id ASC
			LIMIT $per_row, $rows_per_page";
	$query = mysqli_query($conn, $sql);
	
	//	Pagination Bar
	$total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM comment WHERE prd_id = $prd_id"));
	$total_pages = ceil($total_rows/$rows_per_page);
	
	$list_pages = '';
	$page_prev = $page - 1;
	
	if($page == 1){
		$disabled_prev = ' disabled';
	}
	else{
		$disabled_prev = '';
	}
	
	$list_pages .= '<li class="page-item'.$disabled_prev.'"><a class="page-link" href="index.php?page_layout=product&prd_id='.$prd_id.'&page='.$page_prev.'">Trang trước</a></li>';
	for($j = 1; $j<=$total_pages; $j++){
		
		if($j == $page){
			$active = ' active';
		}
		else{
			$active = '';
		}
		
		$list_pages .= '<li class="page-item'.$active.'"><a class="page-link" href="index.php?page_layout=product&prd_id='.$prd_id.'&page='.$j.'">'.$j.'</a></li>';
	}
	$page_next = $page + 1;
	
	if($page == $total_pages){
		$disabled_next = ' disabled';
	}
	else{
		$disabled_next = '';
	}
	
	$list_pages .= '<li class="page-item'.$disabled_next.'"><a class="page-link" href="index.php?page_layout=product&prd_id='.$prd_id.'&page='.$page_next.'">Trang sau</a></li>';
	?>  
    <!--	Comments List	-->
    <div id="comments-list" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php
            while($row = mysqli_fetch_array($query)){
			?>
            <div class="comment-item">
                <ul>
                    <li><b><?php echo $row['comm_name'];?></b></li>
                    <li><?php echo $row['comm_date'];?></li>
                    <li>
                        <p><?php echo $row['comm_details'];?></p>
                    </li>
                </ul>
            </div>
            <?php
			}
			?>
        </div>
    </div>
    <!--	End Comments List	-->
</div>
<!--	End Product	--> 
<div id="pagination">
    <ul class="pagination">
        <?php echo $list_pages;?>
    </ul> 
</div> 