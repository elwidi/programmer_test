<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head> 
<?php include "config.php";?>
<body>
	<?php if (isset($_GET)) {
			if (isset($_GET['error']) && $_GET['error'] == 1) {
			echo '<h5>File melebihi 100KB.</h5>';
			}

			if (isset($_GET['error']) && $_GET['error'] == 2) {
			echo '<h5 style= "color:red;">Nama Barang sudah ada.</h5>';
			}
		} 
	?>
	<form method = "POST" action = "" enctype="multipart/form-data">
		Nama Barang : <input type="text" id = "nama_barang" name = "nama_barang"><br/><br/>
		Harga Beli : <input type="number" id = "harga_beli" name="harga_beli"><br/><br/>
		Harga Jual : <input type="number" id = "harga_jual" name="harga_jual"><br/><br/>
		Stock : <input type="number" id = "stock" name="stock"><br/><br/>
		Foto : <input type="file" name="foto" accept = ".jpg, .png"><br/><br/>
		<span id= "photo_path"></span>
		<input type = "hidden" id = "edit" name = "edit" value = "0">
		<input type = "submit" value = "Submit">
	</form>
	

	<table border = "1">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Barang</th>
				<th>Harga Beli</th>
				<th>Harga Jual</th>
				<th>Stock</th>
				<th>Option</th>

			</tr>
		</thead>
		<tbody>
			<?php 
				$get_barangq = "select * from barang";
		        $get_barangf = mysqli_query($con,$get_barangq);

		        if (mysqli_num_rows($get_barangf) > 0) {
				    $no = 1;
				    while($row = mysqli_fetch_assoc($get_barangf)) {
				    	$erow = "";
				    	$erow .= "<tr>";
				    	$erow .='<td>'.$no.'</td>';
						$erow .='<td>'.$row["nama_barang"].'</td>';
						$erow .='<td>'.$row["harga_beli"].'</td>';
						$erow .='<td>'.$row["harga_jual"].'</td>';
						$erow .='<td>'.$row["stock"].'</td>';
						$erow .='<td><button class = "edit" id_barang = "'.$row["id"].'">edit</button> | <button class = "delete" id_barang = "'.$row["id"].'">delete</button></td>';
				    	$erow .= "</tr>";
				    	$no++;
				        echo $erow;
				    }
				} else {
				    echo "0 results";
				}

		        exit();
		     ?>
		</tbody>
		
	</table>
</body>
</html>

<?php 
	if(!empty($_POST)){
		$file_name = "";
		if (!empty($_FILES)){
			$file_name = "";
			if($_FILES['foto']['size'] > 100000){
				header('location:index.php?error=1');
			} else {
				$file_name = basename($_FILES['foto']['name']);
				$file_name2 = pathinfo($_FILES['foto']['name'], PATHINFO_FILENAME);
				$ekstension = array_pop(explode(".", $file_name)); 
				$file_name = $file_name2."_".date("Y-m-d_His").".".$ekstension;
				$uploaddir = 'img/';
				$uploadfile = $uploaddir . $file_name;

				echo '<pre>';
				if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile)) {
				    $file_name = $file_name;
				} else {
				    $file_name = null;
				}
			}
		}

		$input = $_POST;
	    foreach ($input as $key => $value) {
	    	$$key = $value;
	    }
		if($input['edit'] == 0){
			$getlast_barangq = "select id from barang where nama_barang = '$nama_barang' order by id desc limit 1";
	        $getlast_barangf = mysqli_query($con,$getlast_barangq);
	        $getlast_barang = mysqli_fetch_array($getlast_barangf);
	        if(empty($getlast_barang)){
	        	$query = mysqli_query($con,"INSERT INTO `barang`(`nama_barang`, `harga_beli`, `harga_jual`, `stock`, `foto`) VALUES ('$nama_barang','$harga_beli','$harga_jual',$stock,'$file_name')") or die(mysql_error());

	        	header('location:index.php');
	        } else {
	        	header('location:index.php?error=2');
	        }
		}
	}
?>

<script type="text/javascript">
	$(document).ready(function(){
	    $(".edit").click(function(){
	    	var a = "l";
	    	<?php 
	    		$a = a;
	    		$getlast_barangq = "select * from barang where nama_barang = '$nama_barang' order by id desc limit 1";
	        	$getlast_barangf = mysqli_query($con,$getlast_barangq);
	        	$getlast_barang = mysqli_fetch_array($getlast_barangf);
	    	?>
	    	alert($('#nama_barang').val());
	        // console.log($('#nama_barang').val());
	    });
	}); 
</script>