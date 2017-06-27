<?php
$id = $this->uri->segment(3);
if($id==''){
$id=1;
}
$date=date('Y-m-d H:i:s');
$url=base_url('list/put/');
$url=$url.$id;
$url2=base_url('list/post/');
$url2=$url.$id;
#$url3=base_url('talentonline/wallet_typepackage/post_add/');
$url3=base_url('list/post_add/');
$url4=base_url('list/post_insert/');

$url5=base_url('list/delete/');
$url5=$url5.$id;
echo $url5;
?>

<?php echo '<hr> TEST Post '.$url; ?>
<form action="<?php echo $url;?>" method="post">
    wallet typepackage name <input type="text" name="wallet_typepackage_name" value=""/>
    <input type="submit" name="submit" value="submit"/>
</form>

 
<?php echo '<hr> TEST Post '.$url2; ?>
<form action="<?php echo $url;?>" method="post">
    wallet typepackage name <input type="text" name="wallet_typepackage_name" value=""/>
    <input type="submit" name="submit" value="submit"/>
</form>

<hr>
<?php echo '<hr> TEST Post Insert '.$url3; ?>
<form action="<?php echo $url3;?>" method="post">
    wallet typepackage name <input type="text" name="wallet_typepackage_name" value=""/>
							<input type="hidden" name="date" value="<?php echo $date;?>"/>
    <input type="submit" name="submit" value="submit"/>
</form>
<hr>

<?php echo '<hr> TEST Post Insert '.$url4; ?>
<form action="<?php echo $url4;?>" method="post">
    wallet typepackage name <input type="text" name="wallet_typepackage_name" value=""/>
							<input type="hidden" name="date" value="<?php echo $date;?>"/>
    <input type="submit" name="submit" value="submit"/>
</form>

<hr>

