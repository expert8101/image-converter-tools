<?php

//import the converter class
require('image_converter.php');

if($_FILES){
	$obj = new Image_converter();
	
	//call upload function and send the $_FILES, target folder and input name
	$upload = $obj->upload_image($_FILES, 'uploads', 'fileToUpload');
	if($upload){
		$imageName = urlencode($upload[0]);
		$imageType = urlencode($upload[1]);
		
		if($imageType == 'jpeg'){
			$imageType = 'jpg';
		}
		header('Location: convert.php?imageName='.$imageName.'&imageType='.$imageType);
	}
}	
include("../includes/head.php");
include("../includes/header.php");
?>

<main id="main">
    <!-- ======= script section ======= -->
    <section  class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-8 script">
            <section class="entry entry-single">
              <div class="row align-items-center">
                <div class="row">
                  <h2 class="mainHeading">Convert TIFF to GIF Online</h2>
                </div>
                  <hr>
              <div class="col">
                  <div class="row" style='border: 1px solid #CCC; margin: 10px; padding: 10px; max-width: 1200px; box-shadow: 2px 2px 0px 0px #CCC; border-radius: 10px; overflow: hidden;'>	
                      <div style="text-align: center; margin: 10px;">
                        <tr><td align="center"><h4>TIFF to GIF Converter</h4></td></th><tr>
                      </div>
                      <div class="row" style='text-align: center; border: 1px dashed #CCC; padding: 20px; max-width: 1200px; margin: 20px auto; border-radius: 10px;'>
                        <form action="" method="post" enctype="multipart/form-data">
                          <input type="file" class="form-control-file btn btn-secondary" name="fileToUpload" id="fileToUpload" required/><br>
                          <input class="btn btn-secondary" type="submit" value="Upload" name="submit" style="margin: 20px;" />
                        </form>
                      </div>
                    </div>
              </div>
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
          </div>  
                <!-- end script section -->        
          <!-- sidebar -->
          <div class="col-lg-4">
          <?php include("../includes/sidebar.php"); ?>
          </div>
          <!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Single Section -->

  </main><!-- End #main -->
  <?php include("../includes/footer.php"); ?>
