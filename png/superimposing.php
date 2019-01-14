<?php
	function uploadAction()
	{
		if (isset($_POST['canvas-img']))
		{
			$img = $_POST['canvas-img'];
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			
			if (isset($_POST['video-img']) && !empty($_POST['video-img']))
			{
				$videoImg = $_POST['video-img'];
				$videoImg = str_replace('data:image/png;base64,', '', $videoImg);
				$videoImg = str_replace(' ', '+', $videoImg);
				$dest = imagecreatefromstring(base64_decode($videoImg));
				$src = imagecreatefromstring(base64_decode($img));
				imagecopyresampled($dest, $src, 0, 0, 0, 0, (int)$_POST['img-width'], (int)$_POST['img-height'], (int)$_POST['img-width'], (int)$_POST['img-height']);

				ob_start(); // Let's start output buffering.
				imagejpeg($dest); //This will normally output the image, but because of ob_start(), it won't.
				$contents = ob_get_contents(); //Instead, output above is saved to $contents
				ob_end_clean(); //End the output buffer.

				$img = base64_encode($contents);
				//$this->ImagesModel->saveImage("canvasImage", $img, "image/png", currentUser());
			}
			$this->ImagesModel->saveImage("canvasImage", $img, "image/png", currentUser());
			Router::redirect('/gallery/gallery');
		}
		$userImages = $this->ImagesModel->getImages(currentUser()->id);
				// Build image tags
		$imgString = '';
		foreach ($userImages as $userImage)
		{
			$imageTag = "<img class='user-images img-responsive' src='data:" . $userImage->type . ";base64, " . $userImage->image . "' alt='" . $userImage->name ."'>";
			$imageTag .= "<form action='" . PROOT . "gallery/deleteImage/" . $userImage->id . "' method='POST'>";
			$imageTag .= "<div class='text-center'>";
			$imageTag .= "<input type='submit' value='Delete' class='btn btn-large btn-primary text-center'>";
			$imageTag .= "</div>";
			$imageTag .= "</form>";
			$imgString .= $imageTag;
		}
		$this->view->userImages = $imgString;
		$this->view->render('gallery/upload');
	}

		public function imageInfoAction($pageNumber = 1, $imageId = '') {
			if ($imageId == '')
				return ;
			if (!($imageId = intval($imageId))) {
				return ;
			}

			// Display Image
			$image = $this->ImagesModel->getImage($imageId);
			$this->view->viewImageId = $image->id;
			$this->view->viewImageType = $image->type;
			$this->view->viewImage = $image->image;
			$this->view->viewImageName = $image->name;
			$this->view->numLikes = $this->LikesModel->countLikes($imageId);

			// Likes
			if (isset($_POST['like'])) {
				if (currentUser() && $_POST['like'] == $this->view->numLikes) {
					if (!($this->LikesModel->alreadyLiked($imageId, currentUser()->id))) {
						$this->LikesModel->likeImage($imageId, currentUser()->id);
						$this->view->numLikes += 1;    
					}
					unset($_POST['like']);        
				} else {
					unset($_POST['like']);
					Router::redirect('register/login');
				}
			}

			if (isset($_POST['commentText'])) {
				$commentText = Input::get("commentText");
				$commentText = trim($commentText);

if ($commentText != '') {
					$this->CommentsModel->addComment(currentUser()->id, $imageId, $commentText);
					$originalUser = new Users(intval($image->user_id));
					if (currentUser()->id != $originalUser->id) {
						if ($originalUser->notifications == 1)
							SendEmail::sendNotification($originalUser->email, $originalUser->username, $originalUser);
					}
				}
				
				unset($_POST['commentText']);
			}

			// Comments
			$this->view->comments = $this->CommentsModel->getComments($imageId);

			foreach ($this->view->comments as $comment) {
				$u = new Users(intval($comment->user_id));
				if ($u->username)
					$comment->user_id = $u->username;
				else
					$comment->user_id = "Anonymous";
			}
			$this->galleryAction($pageNumber);
		}

		public function deleteImageAction($imageId = '') {
			if ($imageId != '') {
				if (intval($imageId)) {
					$image = $this->ImagesModel->getImage($imageId);
					if ($image && currentUser()->id == $image->user_id) {
						$this->ImagesModel->deleteImage(intval($imageId));
					}
				}
			}
			Router::redirect('/gallery/upload');
		}
	}
}
?>