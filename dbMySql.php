<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS','ost');
define('DB_NAME','test');

class DB_con
{
 function __construct()
 {
  $conn = mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die('localhost connection problem'.mysql_error());
  mysql_select_db(DB_NAME, $conn);
 }
 
 public function insert($cname,$pid,$date)
 {
  $res = mysql_query("INSERT categories(parentid,name,date_create) VALUES('$pid','$cname','$date')");
  return $res;
 }
 
 public function select()
 {
  $res=mysql_query("select * from categories");
  return $res;
 }
  public function select_sc($cat_id)
 {
  $res_sc=mysql_query("SELECT * FROM categories where id='".$cat_id."'");
  return $res_sc;
 }
 
  public function delete($id)
 {
  mysql_query("Delete FROM categories where id='".$id."'");
  $res2=mysql_query("Delete FROM pro_cat where cat_id='".$id."'");
  return $res2;
 }
 
  public function data_fetch($id)
 {
  $res2=mysql_query("SELECT * FROM categories where id='".$id."'");
  return $res2;
 }
 
   public function data_sid($sid)
 {
  $res3=mysql_query("SELECT * FROM categories where id='".$sid."'");
  return $res3;
 }
 
  public function update($cname,$pid,$id)
 {
  $res=mysql_query("update categories set name='".$cname."',parentid='".$pid."' where id='".$id."'");
  return $res;
 }
 /*Product*/
 
 public function pro_add($pname,$cid,$date,$prod_desc,$fld_img,$temp)
 {
	 $move = "upload/";
	 move_uploaded_file($temp, $move.$fld_img);
	 //echo "INSERT products(pname,prod_desc,fld_img,date_add) VALUES('$pname','$prod_desc','$fld_img','$date')"die;
	$res=mysql_query("INSERT products(pname,prod_desc,fld_img,date_add) VALUES('$pname','$prod_desc','$fld_img','$date')"); 
 
	$last_id = mysql_insert_id();
		foreach($cid as $k=>$value)
	   {
		$res=mysql_query("INSERT pro_cat(pro_id,cat_id) VALUES('$last_id','$value')");
		
	   }
	return $res;
 	 	
 }
 
 public function select2()
 {
  $res=mysql_query("SELECT * FROM products");
  return $res;
 }
 
   public function delete2($id)
 {
  $res2=mysql_query("Delete FROM products where id='".$id."'");
  $res3=mysql_query("Delete FROM pro_cat where pro_id='".$id."'");
  return $res3;
 }
 
   public function data_fetch2($id)
 {
  $res2=mysql_query("SELECT * FROM products where id='".$id."'");
  return $res2;
 }
 
    public function data_fetch3($id)
 {
  $res3=mysql_query("SELECT * FROM pro_cat where pro_id='".$id."'");
  return $res3;
 }
 
   public function data_fetch4($cat_id)
 {
  $res4=mysql_query("SELECT * FROM categories where id='".$id."'");
  return $res4;
 }
 
   public function update2($pname,$cid,$id,$id2,$pdesc,$fld_img,$temp,$img)
 {
	$move = "upload/";
	 move_uploaded_file($temp, $move.$fld_img); 
	 if(empty($fld_img))
	 {
  mysql_query("update products set pname='".$pname."',prod_desc='".$pdesc."',fld_img='".$img."' where id='".$id."'");
	}
	else
	{
	mysql_query("update products set pname='".$pname."',prod_desc='".$pdesc."',fld_img='".$fld_img."' where id='".$id."'");
	}	
	
  /*foreach($cid as $value)
  {
	  echo $value;
  }die;*/
 /* foreach(array_combine($id2, $cid) as $f => $n) 
  {
    echo "update pro_cat set cat_id='".$n."' where id='".$f."'";
    $res=mysql_query("update pro_cat set cat_id='".$n."' where id='".$f."'");
	} */
		/*  foreach($cid as $k=>$value)
	   {
		   //echo "update pro_cat set cat_id='".$value."' where id='".$id2."'";
		}*/
		for ($i = 0 ; $i < count($id2); $i ++) 
		{
		//echo "update pro_cat set cat_id='".$cid[$i]."' where id='".$id2[$i]."'";
		 $res=mysql_query("update pro_cat set cat_id='".$cid[$i]."' where id='".$id2[$i]."'"); 
		}
	   return $res;
 }
 
}

?>
