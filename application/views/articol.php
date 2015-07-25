				<div class="wrapper">
					
					<div class="main-content">

						<!-- BEGIN .panel -->
						<div class="panel">
							<div class="shortcode-content hreview">
								<div class="article-head">
									<h1 class="fn"><?php echo $article->title; ?></h1>
									<div class="article-info">
										<div class="social-buttons left">
											<a href="#" class="social-thing facebook"><i class="fa fa-facebook"></i><span class="counter">3k</span></a>
											<a href="#" class="social-thing twitter"><i class="fa fa-twitter"></i><span class="counter">1.2k</span></a>
											<a href="#" class="social-thing pinterest"><i class="fa fa-pinterest"></i><span class="counter">620</span></a>
											<a href="#" class="social-thing google"><i class="fa fa-google-plus"></i><span class="counter">200</span></a>
										</div>
										<div class="right">
											<span class="reviewer"><i class="fa fa-user"></i>
											    <?php foreach($authors as $author) :
											 		if($author->id == $article->author_id)
											 			echo('postat de ' . $author->name . ',');
										 		endforeach; ?>
											 </span> 
											<span class="dtreviewed"><i class="fa fa-clock-o"></i> <?php echo(model_data($article->added_date)); ?></span>
										</div>
										<div class="clear-float"></div>
									</div>
								</div>

								<div class="paragraph-row">
									<div class="panel">
										<div class="review-photo"><img src="<?php echo base_url(); ?>resources/uploads/<?php echo $article->image; ?>" alt="" width="380px" align="left" /></div>

											<div class="paragraph-content"><?php echo($article->content); ?></div>

											<?php if($user) : ?>
												<?php if($getUser->class >= 60) : ?>
													<div class="admin-options">
														<i class="fa fa-cogs"></i>
														<a href="<?php echo base_url(); ?>cp/article/<?php echo($article->url); ?>">Editeaza </a>
														<?php if($getUser->id != $article->author_id) : ?>
															|<a href="1"> Avertizeaza autorul </a>
															<?php if($getUser->class >= 80) : ?>
																|<a href="1"> Sterge </a>
															<?php endif; ?>	
														<?php else : ?>
															|<a href="1"> Vreau sa imi sterg articolul </a>
														<?php endif; ?>	
													</div>
												<?php endif; ?>
											<?php endif; ?>
									</div>
								</div>

								<div class="article-foot">
									<div class="left">
										<span><i class="fa fa-folder-open"></i> Categories:</span>
										<?php 
										$cats = array();
										foreach($categ_leg as $categ_con) :
											if($categ_con->article_id == $article->id) :
												foreach($categories as $category) {
													if($categ_con->category_id == $category->id) {
														array_push($cats, $category->name);
													}
												}
											endif;
										endforeach; 
										for($i=0;$i<count($cats);$i++) {
											echo('<a href="#">' . $cats[$i] . '</a>');
											if($i+1 != count($cats))
												echo(', ');
										}
										?>	
									</div>
									<div class="right">
										<span><i class="fa fa-tags"></i> Tags:</span>
										<?php 
										$tgs = array();
										foreach($tag_leg as $tag_con) :
											if($tag_con->article_id == $article->id) :
												foreach($tags as $tag) {
													if($tag_con->tag_id == $tag->id) {
														array_push($tgs, $tag->name);
													}
												}
											endif;
										endforeach; 
										for($i=0;$i<count($tgs);$i++) {
											echo('<a href="#">' . $tgs[$i] . '</a>');
											if($i+1 != count($tgs))
												echo(', ');
										}
										?>	
									</div>
									<div class="clear-float"></div>
								</div>
							</div>
						<!-- END .panel -->
						</div>
						
						<!-- BEGIN .panel -->
						<div class="panel">
							<div class="p-title">
								<h2>Articole asemanatoare</h2>
							</div>
							<div class="video-carousel">
								<a href="#" class="carousel-left"><i class="fa fa-chevron-left"></i></a>
								<a href="#" class="carousel-right"><i class="fa fa-chevron-right"></i></a>
								<!-- BEGIN .inner-carousel -->
								<div class="inner-carousel">
									<?php
										date_default_timezone_set('Etc/GMT-3');
       									$actual_year = date("Y");
       									$actual_month = date("m");
										$counter = 0;
										$ids = array(0);
										$is_id = false;
										foreach($random_categ_leg as $result) :
											for($i=0;$i<count($related_articlesId);$i++) :
												if($result->category_id == $related_articlesId[$i]) :
													foreach($articles as $rel_article) :
														if($result->article_id == $rel_article->id) :
															for($j=0;$j<count($ids);$j++) {
																if($ids[$j] == $rel_article->id) {
																	$is_id = true;
																}
															}
															if(($is_id == false) && ($actual_year == substr($rel_article->added_date, 0, 4)) && (($actual_month == substr($rel_article->added_date, 5, -10)) || ($actual_month == substr($rel_article->added_date, 5, -10) - 1))) :
															$counter++;
															array_push($ids, $rel_article->id);
									?>
															<div class="item">
																<a href="<?php echo base_url(); ?>noutati/articol/<?php echo($rel_article->url); ?>"><img src="<?php echo base_url(); ?>resources/uploads/<?php echo($rel_article->image); ?>" class="item-photo" alt="<?php echo($rel_article->title); ?>" title="<?php echo($rel_article->title); ?>" /></a>
																<h3><a href="<?php echo base_url(); ?>noutati/articol/<?php echo $rel_article->url; ?>"><?php echo($rel_article->title); ?></a></h3>
															</div>
									<?php
															endif;
														endif;
													endforeach;
												endif;
											endfor;
											if($counter >= 9) break;
										endforeach;
									?>
								<!-- END .inner-carousel -->
								</div>
							</div>
						<!-- END .panel -->
						</div>
						
						<!-- BEGIN .panel -->
						<div class="panel">
							<div class="p-title">
								<h2>Comments</h2>
							</div>
							<div class="comments-block">
								
								<div style="display: none">
								<?php if(!function_exists('set_reply')) {
									function set_reply($coments, $p_id, $authors, $li_replies, $li_position, $article, $user, $main_comment_id, $likes_rel) {
										foreach($coments as $comment_r) : ?>
										<?php if($comment_r->reply_to_msg_id == $p_id) : ?>
										<li class="reply-for-comm<?php echo($li_position); ?>" style="<?php if(($li_replies > 1) && ($main_comment_id == $comment_r->reply_to_msg_id)) echo('display: none;') ?>">
											<div class="comment-block" style="margin-bottom: 3px;">
												<div class="user-avatar">
													<?php foreach($authors as $author) :
													 		if($author->id == $comment_r->sender_id) : ?>
																<img src="<?php echo base_url(); ?>/resources/images/avatars/thumbnails/<?php echo($author->avatar); ?>" alt="<?php echo($author->name); ?>" title="<?php echo($author->name); ?>" />
													<?php 
															endif;
														endforeach; ?>
												</div>
												<div id="comment<?php echo($comment_r->id); ?>" class="comment-text" style="margin-left: 50px;">
													<strong class="user-nick left">
														<?php foreach($authors as $author) :
													 		if($author->id == $comment_r->sender_id)
													 			echo('<div data-id="'.$author->id.'" class="user-id">' . $author->name. '</div>');
										 				endforeach; ?>
													</strong>
													<span class="time-stamp left"><?php echo(model_data($comment_r->added_date)); ?></span>
													<div class="comment-content">
														<p><?php echo($comment_r->message); ?></p>
													</div>
													<?php if($user) : ?>
													<span data-id="<?php echo($li_replies); echo($li_position); ?>" class="reply-button"><i class="fa fa-reply left"></i><span style="vertical-align: baseline;" class="reply-btn-txt<?php echo($li_replies); echo($li_position); ?>">Raspunde</span></span>
													<?php endif; ?>
													<span class="comment-likes">
													<form data-id="<?php echo($li_replies); echo($li_position); ?>" class="<?php if(!$user) : echo('likes-no-user'); else : echo('set_like_up'); endif; ?>" enctype="multipart/form-data" action="<?php echo base_url();?>noutati/likeUp" method="post">	
														<input type="hidden" name="article_url" value="<?php echo($article->url); ?>" />
														<input type="hidden" name="id" value="<?php echo($comment_r->id); ?>" />
														<input type="hidden" name="current_like_up" class="current-like-up-<?php echo($li_replies); echo($li_position); ?>" value="<?php echo($comment_r->like_up); ?>" />
														<input type="hidden" name="current_like_down" class="current-like-down-<?php echo($li_replies); echo($li_position); ?>" value="<?php echo($comment_r->like_down); ?>" />
														<input type="hidden" name="user_id" value="<?php echo($user['id']); ?>" />
														<?php $like_permission = checkLikedPermission($likes_rel, 'up', $user['id'], $comment_r->id); ?>
														<input type="submit" name="submit-like-up" id="like-up-like<?php echo($li_replies); echo($li_position); ?>" class="<?php echo ($like_permission == true) ? 'like-up' : 'like_no_action_up'; ?>" value="submit_up" /> <span class="counter-like-up<?php echo($li_replies); echo($li_position); ?>"><?php echo($comment_r->like_up); ?></span> 
													</form>
													<form data-id="<?php echo($li_replies); echo($li_position); ?>" class="<?php if(!$user) : echo('likes-no-user'); else : echo('set_like_down'); endif; ?>" enctype="multipart/form-data" action="<?php echo base_url();?>noutati/likeDown" method="post">	
														<input type="hidden" name="article_url" value="<?php echo($article->url); ?>" />
														<input type="hidden" name="id" value="<?php echo($comment_r->id); ?>" />
														<input type="hidden" name="current_like_up" class="current-like-up-<?php echo($li_replies); echo($li_position); ?>" value="<?php echo($comment_r->like_up); ?>" />
														<input type="hidden" name="current_like_down" class="current-like-down-<?php echo($li_replies); echo($li_position); ?>" value="<?php echo($comment_r->like_down); ?>" />
														<input type="hidden" name="user_id" value="<?php echo($user['id']); ?>" />
														<?php $like_permission = checkLikedPermission($likes_rel, 'down', $user['id'], $comment_r->id); ?>
														<input type="submit" name="submit-like-down" id="like-down-like<?php echo($li_replies); echo($li_position); ?>" class="<?php echo ($like_permission == true) ? 'like-down' : 'like_no_action_down'; ?>" value="submit_down" /> <span class="counter-like-down<?php echo($li_replies); echo($li_position); ?>"><?php echo($comment_r->like_down); ?></span>
													</form>
													</span>
													<?php 
													foreach($coments as $rr_com) :
														if($rr_com->reply_to_msg_id == $comment_r->id) : ?>
															<span data-id="<?php echo($li_replies); echo($li_position); ?>" class="comment-show-replies2">
																Afiseaza raspunsurile la comentariu 
															</span>
													<?php break;
														endif; 
													endforeach;
													?>
												</div>
												<div class="clear-float"></div>
											</div>
											<form class="reply-msg-<?php echo($li_replies); echo($li_position); ?>" enctype="multipart/form-data" action="<?php echo base_url();?>noutati/articol" method="post" style="display:none">
												<input type="hidden" name="sender_id" value="<?php echo($user['id']); ?>" />
												<input type="hidden" name="article_id" value="<?php echo($article->id); ?>" />
												<input type="hidden" name="article_url" value="<?php echo($article->url); ?>" />
												<input type="hidden" name="reply_to_msg_id" value="<?php echo($comment_r->id); ?>" />
												<textarea class="reply-textarea2" name="message" placeholder="Your response..." id="c_message"></textarea>
												<input type="submit" class="reply-button-com2" name="add_comment" value="Raspunde" />
											</form>
											<ul class="reply-for-reply<?php echo($li_replies); echo($li_position); ?>" style="display: none;">
											<?php $li_replies++; ?>
											<?php set_reply($coments, $comment_r->id, $authors, $li_replies, $li_position, $article, $user, $main_comment_id); ?>
											</ul>
										</li>
										<?php endif; ?>
									<?php endforeach;
									return $li_replies;
									}
								}
								?>
								</div>
								<!-- BEGIN #comments -->
								<ol id="comments">
								<?php $li_position=0; ?>
									<?php foreach($coments as $comment) : ?>
										<?php if($comment->reply_to_msg_id == 0) : ?>
										<li>	
											<div class="comment-block">
												<div class="user-avatar">
													<?php foreach($authors as $author) :
													 		if($author->id == $comment->sender_id) : ?>
																<img src="<?php echo base_url(); ?>/resources/images/avatars/thumbnails/<?php echo($author->avatar); ?>" alt="<?php echo($author->name); ?>" title="<?php echo($author->name); ?>" />
													<?php 
															endif;
														endforeach; ?>
												</div>
												<div class="comment-text" id="comment<?php echo($comment->id); ?>">
													<strong class="user-nick left">
														<?php foreach($authors as $author) :
													 		if($author->id == $comment->sender_id)
													 			echo('<div data-id="'.$author->id.'" class="user-id">' . $author->name. '</div>');
										 				endforeach; ?>
													</strong>
													<span class="time-stamp left"><?php echo(model_data($comment->added_date)); ?></span>
													<div class="comment-content">
														<p><?php echo($comment->message); ?></p>
													</div>
													<?php if($user) : ?>
														<span data-id="<?php echo($li_position); ?>" class="reply-button"><i class="fa fa-reply left"></i><span style="vertical-align: baseline;" class="reply-btn-txt<?php echo($li_position); ?>">Raspunde</span></span>
													<?php endif; ?>
													<span class="comment-likes">
													<form data-id="<?php echo($li_position); ?>" class="<?php if(!$user) : echo('likes-no-user'); else : echo('set_like_up'); endif; ?>" enctype="multipart/form-data" action="<?php echo base_url();?>noutati/likeUp" method="post">	
														<input type="hidden" name="article_url" value="<?php echo($article->url); ?>" />
														<input type="hidden" name="id" value="<?php echo($comment->id); ?>" />
														<input type="hidden" name="current_like_up" class="current-like-up-<?php echo($li_position); ?>" value="<?php echo($comment->like_up); ?>" />
														<input type="hidden" name="current_like_down" class="current-like-down-<?php echo($li_position); ?>" value="<?php echo($comment->like_down); ?>" />
														<input type="hidden" name="user_id" value="<?php echo($user['id']); ?>" />
														<?php $like_permission = checkLikedPermission($likes_rel, 'up', $user['id'], $comment->id); ?>
														<input type="submit" name="submit-like-up" id="like-up-like<?php echo($li_position); ?>" class="<?php echo ($like_permission == true) ? 'like-up' : 'like_no_action_up'; ?>" value="submit_up" /> <span class="counter-like-up<?php echo($li_position); ?>"><?php echo($comment->like_up); ?></span> 
													</form>
													<form data-id="<?php echo($li_position); ?>" class="<?php if(!$user) : echo('likes-no-user'); else : echo('set_like_down'); endif; ?>" enctype="multipart/form-data" action="<?php echo base_url();?>noutati/likeDown" method="post">	
														<input type="hidden" name="article_url" value="<?php echo($article->url); ?>" />
														<input type="hidden" name="id" value="<?php echo($comment->id); ?>" />
														<input type="hidden" name="current_like_up" class="current-like-up-<?php echo($li_position); ?>" value="<?php echo($comment->like_up); ?>" />
														<input type="hidden" name="current_like_down" class="current-like-down-<?php echo($li_position); ?>" value="<?php echo($comment->like_down); ?>" />
														<input type="hidden" name="user_id" value="<?php echo($user['id']); ?>" />
														<?php $like_permission = checkLikedPermission($likes_rel, 'down', $user['id'], $comment->id); ?>
														<input type="submit" name="submit-like-down" id="like-down-like<?php echo($li_position); ?>" class="<?php echo ($like_permission == true) ? 'like-down' : 'like_no_action_down'; ?>" value="submit_down" /> <span class="counter-like-down<?php echo($li_position); ?>"><?php echo($comment->like_down); ?></span>
													</form>
													</span>
												</div>
												<div class="clear-float"></div>
											</div>
											<?php if($user) : ?>
											<form class="reply-msg-<?php echo($li_position); ?>" enctype="multipart/form-data" action="<?php echo base_url();?>noutati/articol" method="post" style="display:none">
												<input type="hidden" name="sender_id" value="<?php echo($user['id']); ?>" />
												<input type="hidden" name="article_id" value="<?php echo($article->id); ?>" />
												<input type="hidden" name="article_url" value="<?php echo($article->url); ?>" />
												<input type="hidden" name="reply_to_msg_id" value="<?php echo($comment->id); ?>" />
												<textarea class="reply-textarea" name="message" placeholder="Your response..." id="c_message"></textarea>
												<input type="submit" class="reply-button-com" name="add_comment" value="Raspunde" />
											</form>
											<?php endif; ?>
											<ul>
											<?php 
												$li_replies = 0;
												$main_comment_id = $comment->id;
												$li_replies = set_reply($coments, $comment->id, $authors, $li_replies, $li_position, $article, $user, $main_comment_id, $likes_rel); 
											?>
											</ul>
											<?php if($li_replies > 2) : ?>
												<span data-id="<?php echo($li_position); ?>" class="comment-show-replies show-text-pos<?php echo($li_position); ?>">
													Afiseaza toate raspunsurile la comentariu... (<?php echo($li_replies - 2); ?>)
												</span>
											<?php endif; ?>
											<?php $li_position++; ?>
										</li>
										<?php endif; ?>
									<?php endforeach; ?>
									<?php if(!$comments) : ?>
										<li>
											<p>Acest articol nu are comentarii. Scrie unul!</p>
										</li>
									<?php endif; ?>

								<!-- END #comments -->
								</ol>

								<div class="comment-header">Scrie un comentariu</div>


								<!-- BEGIN #writecomment -->
								<div id="writecomment">
									<?php if($user) : ?>
									<form enctype="multipart/form-data" action="<?php echo base_url();?>noutati/articol" method="post">
									<input type="hidden" name="sender_id" value="<?php echo($user['id']); ?>" />
									<input type="hidden" name="article_id" value="<?php echo($article->id); ?>" />
									<input type="hidden" name="article_url" value="<?php echo($article->url); ?>" />
										 <!--<div class="coloralert" style="background: #a12717;">
											<p>Error Occurred!</p>
											<a href="#close-alert"><i class="fa fa-plus"></i></a>
										</div>
										 <div class="coloralert" style="background: #68a117;">
											<p>Success!</p>
											<a href="#close-alert"><i class="fa fa-plus"></i></a>
										</div> -->

										<p class="contact-form-message">
											<!-- <label for="c_message">Comment<span class="required">*</span></label> -->
											<textarea name="message" placeholder="Your message.." id="c_message"></textarea>
										</p>

										<p><input type="submit" class="button" name="add_comment" value="Trimite" /></p>
										
										<p class="contact-info"><span class="required"><i class="fa fa-info"></i></span>Nu sunt permise comentariile cu caracter ofensator sau cele ce nu sunt la tema.</p>
										</form>	
									<?php else : ?>
										<p class="contact-info" style="background-color: #FFE4E4; padding: 10px 5px;"><span class="required"><i class="fa fa-info"></i></span> Pentru a scri un comentariu, este necesar sa fii autentificat.</p>
									<?php endif; ?>

								<!-- END #writecomment -->
								</div>

							</div>
						<!-- END .panel -->
						</div>

					</div>
