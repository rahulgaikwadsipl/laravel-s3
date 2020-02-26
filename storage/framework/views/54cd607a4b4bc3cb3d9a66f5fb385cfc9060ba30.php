<!DOCTYPE html>
<html>
<head>
	<title>Laravel AWS S3</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>


<div class="container">
  <div class="">
    <div class=""><h2>Laravel Image Upload to AWS S3 Private Bucket</h2></div>


    <div class="panel-body">


      <?php if(count($errors) > 0): ?>
	 <div class="alert alert-danger">
	    <strong>Whoops!</strong> There were some problems with your input.<br><br>
		<ul>
		  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		    <li><?php echo e($error); ?></li>
		  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		 </ul>
	    </div>
      <?php endif; ?>


	  <?php if($message = Session::get('success')): ?>
		<div class="alert alert-success alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
		        <strong><?php echo e($message); ?></strong>
		</div>
		<img src="<?php echo e(Session::get('path')); ?>">
	  <?php endif; ?>

	  <form action="<?php echo e(url('s3-image-upload')); ?>" enctype="multipart/form-data" method="POST">
		<?php echo e(csrf_field()); ?>

		<div class="row">
			<div class="col-md-12">
				<input type="file" name="image" />
			</div>
			<div class="col-md-12">
				
			</div>
			<div class="col-md-12">
				<button type="submit" class="btn btn-success">Upload</button>
			</div>
		</div>
	  </form>
    </div>


  </div>
</div>


</body>
</html><?php /**PATH /var/www/html/laravel-s3/resources/views/image-upload.blade.php ENDPATH**/ ?>