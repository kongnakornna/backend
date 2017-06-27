<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
</head>

<body>
<?php 
	$hi=$this->lang->line('hi');
	echo 'TEST'.$hi;

?>

<p><a href="<?php echo base_url('multilanguage');?>/?lang=english&uri=<?php print(uri_string()); ?>" > English</a></p>
<p><a href="<?php echo base_url('multilanguage');?>/?lang=thai&uri=<?php print(uri_string()); ?>" > Thai</a></p>

</body>
</html>
