
<!DOCTYPE html>
<html>
<head>
	<title>Upload excel</title>
	 <link rel="stylesheet" href="bootstrap.min.css" />
	 <script src="bootstrap.min.js"></script>
</head>
<body>
    <div class="widget-body">
    	<div class="widget-main">
    		<div class="row">
		    	<form class="form-horizontal" method="POST" action="do_upload.php" enctype="multipart/form-data">
					<div class="form-group">
						<div class="col-sm-6">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> File </label>
							<div class="col-sm-6">
									<input type="file" name="attachment" class="btn btn-primary" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
							</div> 
						</div>
						<div class="form-group" style="margin-left: 20px;">
							<div class="col-sm-3">
		          				<button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-upload"></i> Upload</button>
		          			</div>
		          		</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<!-- $objPHPExcel	= PHPExcel_IOFactory::load($file); -->