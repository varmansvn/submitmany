<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Welcome to CodeIgniter</title>
<link
	href="<?php echo base_url('assets/bootstrap/css/bootstrap.css'); ?>"
	rel="stylesheet">

</head>
<body>

	<div class="container">

		<div class="page-header">
			<h1>Product</h1>
		</div>

		<div class="row">
			<div class="col-md-4">
				<h3>Add new product</h3>
				<form role="form" id="createProductForm">
					<div class="form-group">
						<label for="tblProductName">Product Name</label> <input
							type="text" class="form-control" id="tbProductName"
							placeholder="Enter product name">
					</div>
					<div class="form-group">
						<label for="tbProductQty">Product Quantity</label> <input
							type="text" class="form-control" id="tbProductQty"
							placeholder="Enter quantity">
					</div>
					<button type="button" class="btn btn-primary" id="btnAddToList">Add
						to list</button>

					<button type="button" class="btn btn-danger" id="btnClearList">Clear
						the list</button>

					<button type="button" class="btn btn-success" id="btnSubmitAll">Submit
						all</button>
				</form>

			</div>

			<div class="col-md-8">
				<h3>Product list</h3>
				<table class="table table-bordered table-striped"
					id="tblProductList">
					<thead>
						<tr>
							<th>Product Name</th>
							<th>Product Quantity</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>

			</div>
		</div>


		<div class="page-header"><h3>[Server Console]</h3></div>
		<div class="row" id="serverConsole">
			
		</div>


	</div>

	<script src="<?php echo base_url('assets/jquery/jquery.js'); ?>"></script>
	<script
		src="<?php echo base_url('assets/bootstrap/js/bootstrap.js'); ?>"></script>

	<script>

	$(document).ready(function() {
		
		$("#btnAddToList").bind("click", function() {
			var tr = "<tr><td id='name'>"+$("#tbProductName").val()+"</td><td id='qty'>"+$("#tbProductQty").val()+"</td></tr>";
			$(tr).appendTo($("#tblProductList tbody"));
			$('#createProductForm')[0].reset();
		});

		$("#btnClearList").bind("click", function() {
			$("#tblProductList tbody tr").remove();
		});

		$("#btnSubmitAll").bind("click", function(event) {

			var productList = {
				list: []
			};		

			$("#tblProductList tbody tr").each(function() {
				var product = {
					name: '',
					qty: ''
				};
				product.name = $(this).find("#name").text();
				product.qty = $(this).find("#qty").text();				
				productList.list.push(product);
											
			});

			var request = $.ajax({
				  url: "product/add",
				  type: "post",				  
				  data: productList	  
			});
				 
			request.done(function(response) {
				 var msg = "<p class='text-success'>server replies:<br>"+response+"</p>";				 
				$("#serverConsole").empty();
				$("#serverConsole").append(msg);
			});
				 
			request.fail(function( jqXHR, textStatus ) {				 
				 var msg = "<p class='text-danger'>server replies with status: "+textStatus+"</p>";
				 $("#serverConsole").empty();
				 $("#serverConsole").append(msg);
			});
			
		});
	});

	</script>
</body>
</html>