<?php
$id = $this->uri->segment(3);
if($id==''){
$id2=1;
}
$date=date('Y-m-d H:i:s');
$url=base_url('talentonline/wallet_typepackage/wallet_typepackage_update/'); //put
$url=$url.$id2;
$url2=base_url('talentonline/wallet_typepackage/post/');
$url2=$url.$id;
#$url3=base_url('talentonline/wallet_typepackage/post_add/');
$url3=base_url('talentonline/wallet_typepackage/wallet_typepackageinsert/');
$url4=base_url('talentonline/wallet_typepackage/wallet_typepackage_insert/');

$url5=base_url('talentonline/wallet_typepackage/wallet_typepackage_delete/');
$url5=$url5.$id;
echo $url5;

//set map api url
$url_api = "http://localhost/api/talentonline/wallet_typepackage/wallet_typepackage_where/$id?format=json";
//call api
$json_api = file_get_contents($url_api);
$json_data_api = json_decode($json_api);
Debug($json_data_api); echo $json_data_api;


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

