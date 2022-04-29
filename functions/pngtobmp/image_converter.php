<?php 

class Image_converter{
	
	//image converter
	function convert_image($convert_type, $target_dir, $image_name, $image_quality=100){
		$target_dir = "$target_dir/";
		
		$image = $target_dir.$image_name;
		
		//remove extension from image;
		$img_name = $this->remove_extension_from_image($image);	
		
		//to bmp
		if($convert_type == 'bmp'){
			$binary = imagecreatefromstring(file_get_contents($image));
			imagebmp($binary, $target_dir.$img_name.'.'.$convert_type, $image_quality);
			unlink($image);

			return $img_name.'.'.$convert_type;
		}
		return false; 
	}
	
	//image upload handler
	public function upload_image($files, $target_dir, $input_name){
		
		$target_dir = "$target_dir/";
		
		//get the basename of the uploaded file
		$base_name = basename($files[$input_name]["name"]);

		//get the image type from the uploaded image
		$imageFileType = $this->get_image_type($base_name);
		
		//set dynamic name for the uploaded file
		$new_name = $this->get_dynamic_name($base_name, $imageFileType);
		
		//set the target file for uploading
		$target_file = $target_dir . $new_name;
	
		// Check uploaded is a valid image
		$validate = $this->validate_image($files[$input_name]["tmp_name"]);
		if(!$validate){
			echo '<script>alert("Does not look like an image file!")</script>';
			return false;
		}
		
		// Check file size - restrict if greater than 20 MB 
		$file_size = $this->check_file_size($files[$input_name]["size"], 2000000);
		if(!$file_size){
			echo '<script>alert("Sorry, you cannot upload more than 20MB file!")</script>';
			return false;
		}

		// Allow certain file formats
		if($imageFileType != "png") {
			echo '<script>alert("Please upload PNG Image only!")</script>';
			return false;
		  }
		
		if (move_uploaded_file($files[$input_name]["tmp_name"], $target_file)) {
			//return new image name and image file type;
			return array($new_name, $imageFileType);
		} else {
			echo '<script>alert("Sorry, an error occurred while uploading your file!")</script>';
		}

	}
	
	protected function get_image_type($target_file){
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		return $imageFileType;
	}
	
	protected function validate_image($file){
		$check = getimagesize($file);
		if($check !== false) {
			return true;
		} 
		return false;
	}
	
	protected function check_file_size($file, $size_limit){
		if ($file > $size_limit) {
			return false;
		}
		return true;
	}
	
	protected function check_only_allowed_image_types($imagetype){
		if($imagetype != "jpg" && $imagetype != "png" && $imagetype != "jpeg" && $imagetype != "gif" && $imagetype != "webp" && $imagetype != "bmp" ) {
			return false;
		}
		return true;
	}
	
	protected function get_dynamic_name($basename, $imagetype){
		$only_name = basename($basename, '.'.$imagetype); // remove extension
		$combine_time = $only_name.'_'.time();
		$new_name = $combine_time.'.'.$imagetype;
		return $new_name;
	}
	
	protected function remove_extension_from_image($image){
		$extension = $this->get_image_type($image); //get extension
		$only_name = basename($image, '.'.$extension); // remove extension
		return $only_name;
	}
}
?>