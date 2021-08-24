<?php
//HTML Header
function htmlHeader_gfr_91()    { ?>
      <!DOCTYPE html>
      <html lang="en">
      <head>
          <!-- Required meta tags -->
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		  <link href="css/lab04-gfr-91.css" rel="stylesheet" type="text/css" />
          <!-- Bootstrap CSS -->
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

          <title>Lab04 - Gfr-91</title>
      </head>
      <body>
	  	<div class="title">
		  	<h1>Lab 04 - Receipt Generator</h1>
		</div>
		</br>
<?php
  }

//HTML Footer
  function htmlFooter_gfr_91()    {?>
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>
  </html>
<?php
  }
	//HTML Receipt Table
	#Parameter: Receipt: The Array of itemns receipt[]
	function tableReceipt_gfr_91($receipt) {
		$totalReceipt = 0;
		echo '
		<div class="receipt">
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Item Number</th>
					<th scope="col">Item Description</th>
					<th scope="col">Cost</th>
					<th scope="col">Quantity</th>
					<th scope="col">Price</th>
				</tr>
			</thead>
			<tbody>';
			foreach($receipt as $item) {
				echo '
				<tr>
				<th scope="row">'.$item[0].'</th>
				<td>'.$item[1].'</td>
				<td>$'.$item[2].'</td>
				<td>'.$item[3].'</td>
				<td>$'.number_format($item[4],2).'</td>
				</tr>
				';
				$totalReceipt += $item[4];
			}
				
		echo '
			</tbody>
		</table>
		<table>
			<tr>
				<th scope="row">Subtotal: $'.
					number_format($totalReceipt,2)
				.'</th>
			</tr>
			<tr>
				<th scope="row">Tax: $'.
					number_format((TAX*$totalReceipt),2)
				.'</th>
			</tr>
			<tr>
				<th scope="row">Total: $'.
					number_format(((1+TAX)*$totalReceipt),2)
				.'</th>
			</tr>
		</table>
		</div>
		';
	}
	//HTML to present the error messages
	function htmlErrors_gfr_91($errors)   {
		echo '
		<div class="alert alert-warning" role="alert">
			<p>Please fix the following errors:</p>
			<ul>';
				foreach($errors as $error)  {
					echo '<li>'.$error.'</li>';
				}			
		echo '</ul>
		</div>
		';
	}
	
	//HTML Form
	function htmlFormFile_gfr_91(){
		echo '
		<div class="container-form">
		  <form action="'.$_SERVER['PHP_SELF'].'" method="POST" enctype="multipart/form-data">
		  
		  <div>
            <input type="file" name="receiptFile">
			<input type="submit" value="Upload CSV">
          </div>
		  </form>
		</div>
		';
	}
?>