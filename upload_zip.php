
<?php 
// echo $_SERVER['DOCUMENT_ROOT'];
// echo __DIR__;
if($_SERVER['REQUEST_METHOD'] =='POST'):
$zip = $_FILES['zip_upload'];
// echo "<pre>";
// print_r($zip);
// echo "<pre>";
#### Setting Errors Array
$errors = array();
//Setting Database Zip Name
$all_zips = array();

$upload_files = $_FILES['zip_upload'];
// Get Info from the form
$zip_name =  $upload_files['name'];
$zip_type =  $upload_files['type'];
$zip_temp =  $upload_files['tmp_name'];
$zip_error =  $upload_files['error'];
$zip_size =  $upload_files['size'];
// Set the allowed extension
$allowed_extenstions = array('jpg','jif','jpeg','png');
 
// Get file Extenstion 

// echo $image_extenstion."<br>";

// Check if file
if($zip_error[0] == 4):
    echo '<div>No File Uploaded</div>';
else:
    $files_counts = count($zip_name);
echo $files_counts;
for($i= 0; $i<$files_counts;$i++){
    // Setting Errors Array
    $errors = array();
    // Get File extenstion
    $tmp =  explode('.',$zip_name[$i]);
    $image_extenstion[$i]  =strtolower(end ($tmp));
    // Get Random for file
    $zip_random[$i] = rand(0,100000).'.'.$image_extenstion[$i];

     // check file size
     if($zip_size[$i] > 900000):
        $errors[] = '<div> File cant be more then X  </div>';
    endif;
    if(!in_array( $image_extenstion[$i], $allowed_extenstions)):
        $errors[] = '<div>File is not Valid</div>';
    endif;

    // No Error
    if(empty($errors)):
    move_uploaded_file($zip_temp[$i],'uploads/'.$zip_random[$i]);
    // seccussfull Messege
    echo '<div style ="background-color:green;padding:10px;margin:20px ; border-radius: 4px; text-align: center; width:400px;">';
    echo '<div>File Number ' . ($i + 1) . '</div> Uploaded';
    echo '<div>File Name:' .$zip_name[$i].'</div>';
    echo '<div>New Name:' .$zip_random[$i].'</div>';
    echo '</div>';
    $all_zips[] = $zip_random[$i];
    else:
          echo '<div style="background-color:red;padding:10px;margin:20px; border-radius: 4px; text-align: center; width:400px;">';
        echo'Error for File Number ' . ($i + 1);
        echo '<div>File Name:' .$zip_name[$i].'</div>';
         // loop for errors
         foreach($errors as $error):
             echo $error;
         endforeach;
         echo '</div>';
    endif;
}
endif;
// print_r($all_zips);
$zip_filed = implode(',',$all_zips);
echo $zip_filed;
endif;
// mathoed of bath to deal with server
// dirname, getcwd, realpath 
// realpath from out : realpath(dirname(getcwd));
// folder of upload you but firewall
//and by htaccess you Prevent open any file except what want.
// if you to make it easey 
?>