<html>
<?php include "config.php";?>
<body>
	<?php if (isset($_GET)) {
			if (isset($_GET['error']) && $_GET['error'] == 1) {
			echo '<h5>File melebihi 100KB.</h5>';
			}
		} 
	?>
	<form method = "POST" action = "" enctype="multipart/form-data">
		Nama Barang : <input type="text" id = "nama_barang" name = "nama_barang"><br/><br/>
		Harga Beli : <input type="text" id = "harga_beli" name="harga_beli"><br/><br/>
		Harga Jual : <input type="text" id = "harga_jual" name="harga_jual"><br/><br/>
		Stock : <input type="text" id = "stock" name="stock"><br/><br/>
		Foto : <input type="file" name="foto" accept = ".jpg, .png"><br/><br/>
		<span id= "photo_path"></span>
		<input type = "hidden" id = "edit" name = "edit" value = "0">
		<input type = "submit" value = "Submit">
	</form>
	<button id = "test_js" onclick = "ready();">EDIT</button>
</body>
</html>

<?php 
	if(!empty($_POST)){
		
		
		if (!empty($_FILES)){
			var_dump(dirname(__FILE__)); exit();
			if($_FILES['foto']['size'] > 100000){
				header('location:index.php?error=1');
			} else {
				// var_dump('S'); exit;
				
				/*$uploaddir = '/var/www/uploads/';
				$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

				echo '<pre>';
				if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
				    echo "File is valid, and was successfully uploaded.\n";
				} else {
				    echo "Possible file upload attack!\n";
				}*/
			}
		}
		/*$input = $_POST;
		if($input['edit'] == 0){
			$getlast_barangq = "select id from barang order by id desc limit 1";
            $getlast_barangf = mysqli_query($con,$get_konsul_data);
            $getlast_barang = mysqli_fetch_array($data_konsul);

            if(empty($getlast_barang)){
            	$prefix = 1;
            	$input['nama_barang'] = $input['nama_barang']."_".$prefix;
            } else {
            	var_dump($getlast_barang); exit();
            }

            /*$query = mysqli_query($con,"INSERT INTO `biodata_user`(`id_biodata`, `nama`, `jenis_kelamin`, `alamat`, `pekerjaan`, `jenis_ayam`) VALUES ('','$nama','$jenis_kelamin','$alamat','$pekerjaan','$jenis_ayam')") or die(mysql_error());*/
		// }
		 
		
		exit;
	}
?>

<script type="text/javascript">
	function ready () {
		console.log('woy');
	}
	// document.ready(function() {
		// (function() {
   /*document.getElementById("test_js").click(function(){
			alert('hole');
		})

})();*/
		
	// });
</script>