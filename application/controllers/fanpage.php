<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fanpage extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$user = $this->session->userdata('logged_in');
		$data['getUser'] = $this->mu_model->getUser($user['id']);
		$data['chat'] = $this->mu_model->getFunction('chat');
		$users = $this->mu_model->randomOrder('users');
		$all_imagini = $this->mu_model->getFunction('fp_imagini');
		$all_video = $this->mu_model->getFunction('fp_video');
		$all_citate = $this->mu_model->getFunction('fp_citate');
		$data['user'] = $user;
		$avlbl_users_id = array();
		$avlbl_users = array();
		$i = 0;
		if($user) {
			array_push($avlbl_users, $user['name']);
			array_push($avlbl_users_id, $user['id']);	
		}
		foreach($users as $usr) :
			$check = 0;
			foreach($all_imagini as $img) :
				if($usr->id == $img->user_id) :
					if($usr->id != $user['id']) {
						array_push($avlbl_users, $usr->name);
						array_push($avlbl_users_id, $usr->id);
						$check = 1;
					}
					break;
				endif;
			endforeach;
			if($check == 0) {
				foreach($all_video as $vid) :
				if($usr->id == $vid->user_id) :
					if($usr->id != $user['id']) {
						array_push($avlbl_users, $usr->name);
						array_push($avlbl_users_id, $usr->id);
						$check = 1;
					}
					break;
				endif;
			endforeach;
			}
			if($check == false) {
				foreach($all_citate as $cit) :
				if($usr->id == $cit->user_id) :
					if($usr->id != $user['id']) {
						array_push($avlbl_users, $usr->name);
						array_push($avlbl_users_id, $usr->id);
						$check = true;
					}
					break;
				endif;
			endforeach;
			}
		endforeach;
		
		$data['avlbl_users'] = $avlbl_users;
		$data['avlbl_users_id'] = $avlbl_users_id;

		if($user) :
			$data['imagini'] = $this->mu_model->getByWhereStmt('fp_imagini', 'user_id', $user['id']);
		else :
			$data['imagini'] = $this->mu_model->getByWhereStmt('fp_imagini', 'user_id', $avlbl_users_id[0]);
		endif;			

		if($this->input->post('submit_image')) :
			if($this->input->post('load_type') == 'local') {
				$image_type = 'image';
				if (!empty($_FILES['fp_imagine']['name'])):
	                $image = md5($_FILES['fp_imagine']['name']).'.png';
	                $img = ROOT.'resources/images/fanpage/'.$image;
	                move_uploaded_file($_FILES['fp_imagine']['tmp_name'], $img);
           		endif;
			} else if($this->input->post('load_type') == 'url') {
				$image_type = 'url';
				$image = $this->input->post('link');
			}
			$author = $user['id'];
			$this->mu_model->insertFpImagine($image_type, $image, $author);
			redirect('fanpage#fp');
		endif;

		if($this->input->post('submit_video')) :
			$this->mu_model->insertFpVideo($user['id']);
			redirect('fanpage#fp');
		endif;

		if($this->input->post('submit_citat')) :
			$this->mu_model->insertFpCitat($user['id']);
			redirect('fanpage#fp');
		endif;

		$this->load->view('header', $data);
		$this->load->view('fanpage',$data);
		$this->load->view('footer');
	}

	public function showMsg()
	{
		$user = $this->session->userdata('logged_in');
		$chat = $this->mu_model->getFunction('chat');
		if($chat) :
			foreach($chat as $chat_msg) :
				if($user['name'] == $chat_msg->sender) :
					$sender = $chat_msg->avatar;
					$class_name = "chat-me";
				else :
					$sender = $chat_msg->avatar;
					$class_name = "chat-you";
				endif;
				echo('<div class="' . $class_name . '">
						<img src="' . base_url() . 'resources/images/avatars/thumbnails/' . $sender . '" title="' . $chat_msg->sender . '"/>
						<span class="text-msg">' . $chat_msg->message.'</span></div><div class="clear-float">
					</div>');
				echo('<br /><br />');
			endforeach;
		else :
			echo('Nu sunt mesaje in chat.');
		endif;
	}

	public function writeMsg()
	{
		$user = $this->session->userdata('logged_in');
		$this->mu_model->insertChatMsg($user['name'], $user['avatar']);
		echo('Mesajul a fost trimis cu succes!');
	}

	public function getImagini() 
	{
		$imagini = $this->mu_model->getByWhereStmt('fp_imagini', 'user_id', $this->input->post('id_user'));
		$user = $this->session->userdata('logged_in');
		if($user) :
				if($user['id'] == $this->input->post('id_user')) :
					echo("<span class='fp-imagini-style add-img'><img src='" . base_url() . "resources/images/fanpage/add-img.png' />
						<span class='fp-imagini-descr'>Adaugă Imagine</span>
						</span>");
				endif;
			endif;
		if($imagini) : 
			foreach($imagini as $img) :
				$delete_icn = "<span data-id='".$img->id."' class='delete-fp-item delete-fp-img'><img src='" . base_url() . "resources/images/delete_btn.png' title='Șterge' /></span>";
				if($img->image == "") :
					$img_display = "<span class='fp-imagini-style'>
						" . ($user['id'] == $this->input->post('id_user') ? $delete_icn : "") . "
						<a class='thumbnail gallery' href='" . $img->url . "'><img src='" . base_url() . "timthumb.php?src=" . $img->url . "&w=220&h=150' />
						<span class='fp-imagini-descr'>".$img->description."</span>
						<span class='fp-imagini-zoom'><img src='".base_url()."resources/images/zoom.png'></span></a></span>";
				else :
					$img_display = "<span class='fp-imagini-style'>
						" . ($user['id'] == $this->input->post('id_user') ? $delete_icn : "") . "
						<a class='thumbnail gallery' href='" . base_url() . "resources/images/fanpage/" . $img->image . "'><img src='" . base_url() . "timthumb.php?src=" . base_url() . "resources/images/fanpage/" . $img->image . "&w=220&h=150' />
						<span class='fp-imagini-descr'>".$img->description."</span>
						<span class='fp-imagini-zoom'><img src='".base_url()."resources/images/zoom.png'></span></a></span>";
				endif;
				echo $img_display;
			endforeach;
		else : 
			echo("<span class='fp-imagini-style'><a class='thumbnail gallery' href='" . base_url() . "resources/images/fanpage/no-fp-img.png'><img src='" . base_url() . "timthumb.php?src=" . base_url() . "resources/images/fanpage/no-fp-img.png&w=220&h=150' />
						<span class='fp-imagini-descr'>Vezi Video sau Citate ale acestui utilizator</span>
						</a></span>");
		endif;
	}

	public function getVideo() 
	{
		$video = $this->mu_model->getByWhereStmt('fp_video', 'user_id', $this->input->post('id_user'));
		$user = $this->session->userdata('logged_in');
		if($user) :
			if($user['id'] == $this->input->post('id_user')) :
				echo("<span class='fp-imagini-style add-video'><img src='" . base_url() . "resources/images/fanpage/add-video.png' />
					<span class='fp-imagini-descr'>Adaugă Video</span>
					</a></span>");
			endif;
		endif;
		if($video) :
			foreach($video as $vid) :
				$id = $vid->video_id;
				$delete_icn = "<span data-id='". $vid->id ."' class='delete-fp-item delete-fp-video'><img src='" . base_url() . "resources/images/delete_btn.png' title='Șterge' /></span>";
				if($vid->type == "youtube") :
					echo("<span class='fp-imagini-style'>
							" . ($user['id'] == $this->input->post('id_user') ? $delete_icn : "") . "
							<a href='https://www.youtube.com/embed/". $vid->video_id ."' data-featherlight='iframe'>
							<span class='fp-imagini-descr'>". $vid->title ."</span>
							<span class='video-hover'></span>
							<img src='http://img.youtube.com/vi/". $vid->video_id ."/hqdefault.jpg' style='height: 161px;'/>
						</a></span>");
				elseif($vid->type == "facebook") :
					echo('<span class="fp-imagini-style">
							' . ($user["id"] == $this->input->post("id_user") ? $delete_icn : "") . '
							<a href="https://www.facebook.com/video/embed?video_id='. $vid->video_id .'" data-featherlight="iframe">
							<span class="fp-imagini-descr">'. $vid->title .'</span>
							<span class="video-hover"></span>
							<img src="https://graph.facebook.com/'. $vid->video_id .'/picture" style="height: 161px; "/>
							</a>
						</span>
						');
				elseif($vid->type == "vimeo") :
					$thumbnail = unserialize(file_get_contents("http://vimeo.com/api/v2/video/". $vid->video_id .".php"));
					echo('<span class="fp-imagini-style">
							' . ($user["id"] == $this->input->post("id_user") ? $delete_icn : "") . '
							<a href="https://player.vimeo.com/video/'. $vid->video_id .'" data-featherlight="iframe">
							<span class="fp-imagini-descr">'. $vid->title .'</span>
							<span class="video-hover"></span>
							<img src="' . $thumbnail[0]['thumbnail_small'] .'" style="height: 161px;"/>
							</a>
						</span>
						');
				endif;
			endforeach;
		else :
			echo("<span class='fp-imagini-style'><a class='thumbnail gallery' href='" . base_url() . "resources/images/fanpage/no-fp-video2.png'><img src='" . base_url() . "timthumb.php?src=" . base_url() . "resources/images/fanpage/no-fp-video2.png&w=220&h=150' />
						<span class='fp-imagini-descr'>Vezi Imagini sau Citate ale acestui utilizator</span>
						</a></span>");
		endif;

	}

	public function getCitate() 
	{
		$citate = $this->mu_model->getByWhereStmt('fp_citate', 'user_id', $this->input->post('id_user'));
		$user = $this->session->userdata('logged_in');
		echo("<div id='masonry-grid' class='citate-box'>
				<div class='gutter-sizer'></div>");
				if($user) :
					if($user['id'] == $this->input->post('id_user')) :
						echo("
								<div class='grid-item citat add-citat'>
									<img src='" . base_url() . "resources/images/fanpage/add-quote.png' />			
								</div>
							");
					endif;
				endif;
				foreach ($citate as $citat) :
					$delete_icn = "<span data-id='". $citat->id ."' class='delete-fp-citate'><img src='" . base_url() . "resources/images/delete_btn.png' title='Șterge' /></span>";
					echo("
							<div class='grid-item citat'>
								" . ($user['id'] == $this->input->post('id_user') ? $delete_icn : '') . " 
								<div class='quotes'><i class='fa fa-quote-left'></i></div>
								<div class='asertiune'>
									" . $citat->citat_text . "
								</div>
								<div class='clear-float'></div>
								<div class='autor'>
								- " . $citat->citat_autor . " 
								</div>
							</div>
						");
				endforeach;
			echo("</div>");
	}

	public function deleteImagine() {
		$id = $this->input->post('item_id');
		$this->mu_model->deleteFunction($id, 'fp_imagini');
	}
	public function deleteVideo() {
		$id = $this->input->post('item_id');
		$this->mu_model->deleteFunction($id, 'fp_video');
	}
	public function deleteCitat() {
		$id = $this->input->post('item_id');
		$this->mu_model->deleteFunction($id, 'fp_citate');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */