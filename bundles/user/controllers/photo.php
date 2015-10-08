<?php

use Gregwar\Image\Image;

class User_Photo_Controller extends Base_Controller {


	public $restful = true;

	
	public function post_upload_photo($profile_picture = null){
	
		$file = Input::file('0');
		

		
		if($file['size'] > 20970000 || $file['size'] < 51200)
		{
			echo json_encode(array("errors"=>"size"));
			exit;
		}
		

		if(($file['type'] == "image/jpeg") ||  ($file['type'] == "image/jpg") || ($file['type'] == "image/png"))
		{
		

			list($width, $height, $type, $attr) = getimagesize($file['tmp_name']);
			
			if($width < 215 && $height < 215){
			
				echo json_encode(array("errors"=>"dimension"));
				exit;
			
			}
			else{
			
				$image = Image::open($file['tmp_name']);
				
				$ranno =  uniqid($file['size']);		
				$filename = Auth::user()->id.$ranno;
				
			
				if($image->save(path('base')."/uploads/originals/$filename.jpg",'jpg','100'))
				{
						$image->cropResize(279, 300)->save(path('base')."/uploads/medium/$filename.jpg",'jpg','100');
						$image->cropResize(135, 180)->save(path('base')."/uploads/small/$filename.jpg",'jpg','100');
						$image->cropResize(70, 70)->save(path('base')."/uploads/thumbnails/$filename.jpg",'jpg','100');
						$photo = new Photo();
						$photo->photo_id = $filename;
       					$photo->user_id = Auth::user()->id;
						$photo->save(); 
						
						
						if($profile_picture){
						
							Auth::user()->setProfilePicture($photo->photo_id);
						
						}
						
				}		

				
			
			}
			
		
		}
		else{
		
			echo json_encode(array("errors"=>"type"));
			exit;
		
		}
		
		
		Event::fire('album.photo.upload');
		echo json_encode(array("success"=>"1"));
		exit;
		
	
	}
	
	
	public function post_delete_photo(){
	
		$photo = Photo::find(Input::get('delete_photo_id'));
		
		if($photo->user_id != Auth::user()->id)
		{
		
			return Redirect::to('/album');
			
		}
		else{
		
			$user = Auth::user();
			
			if($user->photo_id == $photo->photo_id)
			{
			
				$user->photo_id =  0;
				$user->save();
			
			}
			
			
			$photo->delete();
			
		}
		
		
		return Redirect::to('/album');
	
	
	}


}