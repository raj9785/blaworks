<?php
include 'excel_reader.php';     // include the class

// creates an object instance of the class, and read the excel file data
$excel = new PhpExcelReader;
$excel->read('hello-org.xls');


// Excel file data is stored in $sheets property, an Array of worksheets
/*
The data is stored in 'cells' and the meta-data is stored in an array called 'cellsInfo'

Example (firt_sheet - index 0, second_sheet - index 1, ...):

$sheets[0]  -->  'cells'  -->  row --> column --> Interpreted value
         -->  'cellsInfo' --> row --> column --> 'type' (Can be 'date', 'number', or 'unknown')
                                            --> 'raw' (The raw data that Excel stores for that data cell)
*/

// this function creates and returns a HTML table with excel rows and columns data
// Parameter - array with excel worksheet data
function sheetData($sheet) {
 
 $con=mysqli_connect("localhost","root","","sample");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
  $s=null;
  $x = 1;
  while($x <= $sheet['numRows']) {

    $y = 1;
    while($y <= $sheet['numCols']) {
      $cell = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';
     
      $y++;
	  
	 // echo'<pre>',$x,$y,$y%2;
	  if($x>1){
	  if($y%2==0){
	   $c1= $cell;
	  }
	  if($y%2==1){
		$c1.= ','.$cell; 
		 echo $t1=$c1;
		  mysqli_query($con,"INSERT INTO statelist_new (states) VALUES ('".$t1."')");
		 $c1=null; 
		  echo'<br>';  
		
		  }
	  
    } 
}
	
	 
  
    $x++;
  }

 
}
$nr_sheets = count($excel->sheets);       // gets the number of sheets
$excel_data = '';              // to store the the html tables with data of each sheet

// traverses the number of sheets and sets html table with each sheet data in $excel_data
for($i=0; $i<$nr_sheets; $i++) {
  $excel_data .= '<h4>Sheet '. ($i + 1) .' (<em>'. $excel->boundsheets[$i]['name'] .'</em>)</h4>'. sheetData($excel->sheets[$i]) .'<br/>';  
}
?>

  

</body>
</html>
