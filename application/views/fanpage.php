				<!-- BEGIN .wrapper -->
				<div class="wrapper">
					
					<div class="main-content">

						<!-- BEGIN Chat -->
						<div class="panel">
							<div class="chat-box">
							</div>
							<div class="chat-box-type">
								<?php if($user) : ?>
									<form class="chat-form" enctype="multipart/form-data" action="" method="post">
										<textarea class="chat-area" name="chat_text" placeholder="Scrie mesaj..."></textarea>
										<input type="submit" name="submit_chat" value="Trimite" />
									</form>
								<?php else : ?>
									<p class="contact-info" style="background-color: #FFE4E4; padding: 10px 5px;"><span class="required"><i class="fa fa-info"></i></span> Pentru a scri in chat este necesar sa fii autentificat.</p>	
								<?php endif; ?>
							</div>
							<!-- <div class="feedback">trimis</div> -->
						<!-- END Chat -->
						</div>

					</div>
				

				<aside id="sidebar">

						<div class="widget">
							<div class="w-title">
								<h3>Magazin Online</h3>
							</div>
							<div class="banner">
								<a href="#" target="_blank"><img src="<?php echo base_url(); ?>resources/images/magazin-online-banner.jpg" alt="Devils MD Shop" /></a>
							</div>
						<!-- END .widget -->
						</div>

						<div class="widget">
							<div class="w-title">
								<h3>Sondaj</h3>
							</div>
							<div class="content">
								<a href="#" class="upper-title">VEZI ARHIVA<i class="fa fa-caret-right"></i></a>
								Functia de Sondaj urmeaza sa fie efectuata.<br />
							</div>
						<!-- END .widget -->
						</div>
						
					</aside>
					
				<!-- END .wrapper -->
				</div>
				
			<!-- BEGIN .content -->
			</section>

			<div class="wrapper" style="width: 1148px;">
				<div class="panel">
					<div class="fp-title" id="fp">
						<h2>Colecțiile utilizatorilor</h2>
					</div>

					<div id="fp-block">
						<div class="fp-users">
							<?php for($i=0; $i<count($avlbl_users); $i++) : ?>
								<span data-id="<?php echo($avlbl_users_id[$i]); ?>" class="fp-activ-user <?php if($i == 0) { ?>active<?php } ?>">
									<?php echo($avlbl_users[$i]); ?>
								</span>
							<?php endfor; ?>
						</div>
						<div class="fp-content">
							<div class="fp-menu">
								<div class="fp-option imagini active">
									Imagini
								</div>
								<div class="fp-option video">
									Video
								</div>
								<div class="fp-option citate">
									Citate
								</div>
							</div>
							<div class="fp-result" data-featherlight-gallery data-featherlight-filter="a">
								<?php
									if($user) :
										echo("<span class='fp-imagini-style add-img'><img src='" . base_url() . "resources/images/fanpage/add-img.png' />
											<span class='fp-imagini-descr'>Adaugă Imagine</span>
											</a></span>");
									endif;
									if($imagini) : 
										foreach($imagini as $img) :
											$delete_icn = "<span data-id='".$img->id."' class='delete-fp-item delete-fp-img'><img src='" . base_url() . "resources/images/delete_btn.png' title='Șterge' /></span>";
											if($img->image == "") :
												$vsv = "<span class='fp-imagini-style'>
													" . ($user ? $delete_icn : "") . "
													<a class='thumbnail gallery' href='" . $img->url . "'><img src='" . base_url() . "timthumb.php?src=" . $img->url . "&w=220&h=150' />
													<span class='fp-imagini-descr'>".$img->description."</span>
													<span class='fp-imagini-zoom'><img src='".base_url()."resources/images/zoom.png'></span></a></span>";
											else :
												$vsv = "<span class='fp-imagini-style'>
													" . ($user ? $delete_icn : "") . "
													<a class='thumbnail gallery' href='" . base_url() . "resources/images/fanpage/" . $img->image . "'><img src='" . base_url() . "timthumb.php?src=" . base_url() . "resources/images/fanpage/" . $img->image . "&w=220&h=150' />
													<span class='fp-imagini-descr'>".$img->description."</span>
													<span class='fp-imagini-zoom'><img src='".base_url()."resources/images/zoom.png'></span></a></span>";
											endif;
											echo $vsv;
										endforeach;
									else : 
										echo("<span class='fp-imagini-style'><a class='thumbnail gallery' href='" . base_url() . "resources/images/fanpage/no-fp-img.png'><img src='" . base_url() . "timthumb.php?src=" . base_url() . "resources/images/fanpage/no-fp-img.png&w=220&h=150' />
													<span class='fp-imagini-descr'>Vezi Video sau Citate ale acestui utilizator</span>
													</a></span>");
									endif;
								?>
							</div>
							<div class="clear-float"></div>
						</div>
						<div class="fp-comments">
							<h3>Comentarii:</h3>
							<div class="clear-float"></div>
							<div class="fp-com-content">
								<?php if($fp_comentarii) :
									foreach($fp_comentarii as $com) : ?>
										<div class="fp-com">
											<div class="username">
												<strong><?php echo $com->nume; ?></strong> &nbsp;&nbsp;
												<?php if($com->rating != 0) : ?>
													Rating acordat: <span class="rating-fp-coms">
													<?php for($i=0;$i<$com->rating;$i++) :
															print("<img src='" . base_url() . "resources/images/icon_star.png'>");
														endfor;
													?></span>
												<?php endif; ?>
											</div>
											<div class="comment">
												<?php echo $com->comentariu; ?> 
											</div> 
										</div>
									<?php endforeach;
								else : 
									echo("<p>Aceasta colectie nu are nici un comentariu. Scrie tu primul!</p>");
								endif; ?>
							</div>
							<hr style="width: 99%; border: 1px solid #E0E0E0; margin-left:0;">
							<h6 class="add-fp-comments"><i class="fa fa-comments-o"></i> Adauga comentariu</h6>
							<div class="add-com-box">
								<?php if($user) : ?>
									<form class="add-fp-form" enctype="multipart/form-data" action="<?php echo base_url();?>fanpage" method="post">
										<input type="hidden" class="fp_user_id" name="fp_id" value="<?php echo $fp_user_id; ?>" />
										<label>Rating:</label>
										<select name="rating">
											<option>Alege...</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select><br /><br />
										<label>Mesajul:</label>
										<textarea name="fp_coment" placeholder="Comentariul tau..."></textarea><br />
										<input type="submit" name="submit_comentariu" value="Adaugă" />
									</form>
								<?php else : ?>
									<p class="contact-info" style="background-color: #FFE4E4; padding: 10px 5px;"><span class="required"><i class="fa fa-info"></i></span> Pentru a scri un comentariu este necesar sa fii autentificat.</p>
								<?php endif; ?>
							</div>
						</div>
					</div>

				</div>

				<div class="add-fp-box img-box">
					<img class="add-fp-box-close" src="<?php echo base_url(); ?>resources/images/button_cancel.png" align="right">
					<form class="add-fp-form" enctype="multipart/form-data" action="<?php echo base_url();?>fanpage" method="post">
						<label>Tipul de incarcare:</label><br /><br />
						<input type="radio" class="fp-chk-local" name="load_type" value="local">Din propriul device
						<input type="radio" class="fp-chk-url" name="load_type" value="url" style="margin-left: 30px">Prin url extern<br /><br />
						<label class="chck-lbl">Imagine:</label>
						<input class="fp-img-browse" style="display:none" type="file" name="fp_imagine" size="20" />
						<input class="fp-img-url" style="display:none" type="text" name="link" placeholder="Linkul extern al imaginii" />
						<label class="chck-lbl">Descriere:</label>
						<input class="chck-lbl" type="text" name="description" placeholder="Descrierea imaginii" />
						<input class="chck-lbl" type="submit" name="submit_image" value="Adaugă" />
					</form>
				</div>

				<div class="add-fp-box video-box">
					<img class="add-fp-box-close" src="<?php echo base_url(); ?>resources/images/button_cancel.png" align="right">
					<form class="add-fp-form" enctype="multipart/form-data" action="<?php echo base_url();?>fanpage" method="post">
						<label>Tipul videoului:</label>
						<select name="video_type">
							<option>Alege...</option>
							<option value="youtube">Youtube</option>
							<option value="facebook">Facebook</option>
							<option value="vimeo">Vimeo</option>
						</select>
						<br /><br />
						<label>Titlu:</label>
						<input type="text" name="title" placeholder="Titlul videoului" />
						<label>Link:</label>
						<input type="text" name="video_id" placeholder="Linkul catre video" />
						<input type="submit" name="submit_video" value="Adaugă" />
					</form>
				</div>

				<div class="add-fp-box citat-box">
					<img class="add-fp-box-close" src="<?php echo base_url(); ?>resources/images/button_cancel.png" align="right">
					<form class="add-fp-form" enctype="multipart/form-data" action="<?php echo base_url();?>fanpage" method="post">
						<label>Asertiunea:</label>
						<input type="text" name="citat" placeholder="Asertiunea autorului..." />
						<label>Autorul:</label>
						<input type="text" name="autor" placeholder="Autorul..." />
						<input type="submit" name="submit_citat" value="Adaugă" />
					</form>
				</div>

			</div>
					
					