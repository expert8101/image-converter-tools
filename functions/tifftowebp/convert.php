<?php 
include("../includes/head.php");
include("../includes/header.php");

//import the converter class
require('image_converter.php');

$imageType = '';
$download = false;

//handle get method, when page redirects
if($_GET){	
	$imageType = urldecode($_GET['imageType']);
	$imageName = urldecode($_GET['imageName']);
}else{
	header('Location:index.php');
}

//handle post method when the form submitted
if($_POST){
	
	$convert_type = $_POST['convert_type'];
	
	//create object of image converter class
	$obj = new Image_converter();
	$target_dir = 'uploads';
	//convert image to the specified type
	$image = $obj->convert_image($convert_type, $target_dir, $imageName);
	
	//if converted activate download link 
	if($image){
		$download = true;
	}
}



//convert types
$types = array(

	'webp' => 'WEBP',
);
?>
<main id="main">
    <!-- ======= script section ======= -->
    <section  class="blog">
      <div class="container" data-aos="fade-up">
          <div class="row">
              <div class="col-lg-8 script">
                <section class="entry entry-single">
                <div class="row align-items-center">
                      
                
                      <?php if(!$download) {?>
                        <form method="post" action="">
                            <table width="500" align="center">
                            <tr>
                              <td align="center">
                                <h3>Image Uploaded Successfully</h3>
                                <img class="imgPreview" src="uploads/<?=$imageName;?>"  />
                              </td>
                            </tr>
                            <tr>
                              <td align="center" style="display: none;">
                            
                                Convert To: 
                                  <select name="convert_type">
                                    <?php foreach($types as $key=>$type) {?>
                                      <?php if($key != $imageType){?>
                                      <option value="<?=$key;?>"><?=$type;?></option>
                                      <?php } ?>
                                    <?php } ?>
                                  </select>
                                  <br /><br />
                              </td>
                            </tr>
                            <tr>
                              <td align="center"><input class="btn btn-primary" type="submit" value="Convert Image" id="convertBtn" /></td>
                            </tr>
                          </table>
                          </form>
                      <?php } ?>
                      <?php if($download) {?>
                        <table width="500" align="center">
                            <tr>
                              <td align="center">
                                <h3>Image Converted to <?php echo ucwords($convert_type); ?> Successfully! </h3>
                                <img class="imgPreview" src="<?=$target_dir.'/'.$image;?>"  />
                              </td>
                            </tr>
                            <td align="center">
                            <a href="download.php?filepath=<?php echo $target_dir.'/'.$image; ?>" class="btn btn-success" id="dnldBtn">Download</a>
                              <!-- <a href="download.php?filepath=<?php echo $target_dir.'/'.$image; ?>" />Download Converted Image</a> -->
                            </td>
                          </tr>
                          <tr>
                            <td align="center"><a href="index.php" class="btn btn-secondary" id="anotherImg">Convert Another Image</a></td>
                          </tr>
                        </table>
                      <?php } ?>

                    <hr style="margin-top: 20px;>
              <div class="row" id="aboutSec" ">
                <!-- <img src='assets/img/main_page.png' style="max-width: 600px; margin-top: 20px; margin-bottom: 20px;" class="rounded mx-auto d-block" alt="" /> -->
                <h2 class='display-8'>How to convert PNG to JPG</h2>
                  <ul class="qList">
                    <li>Upload any PNG format image you want to convert into JPG.</li>
                    <li>Click on Upload</li>
                    <li>Click on Convert Button to convert PNG to JPG</li>
                    <li>Click on Download Button to download your Converted JPG Image</li>
                  </ul>

                <h2 class='display-8'>How can I convert PNG to JPG for free?</h2>
                  <ul class="qList">
                    <li>Upload any PNG format image you want to convert into JPG.</li>
                    <li>Click on Upload</li>
                    <li>Click on Convert Button to convert PNG to JPG</li>
                    <li>Click on Download Button to download your Converted JPG Image</li>
                  </ul>
              </div>
                    
                  <!-- end script section -->
            </div>
                    <div class="col-lg-4">
                    <?php include("../includes/sidebar.php"); ?>
                    </div>
                    <!-- End blog sidebar -->
        </div>

      </div>
    </section><!-- End Blog Single Section -->

  </main><!-- End #main -->
  <?php include("../includes/footer.php"); ?>
