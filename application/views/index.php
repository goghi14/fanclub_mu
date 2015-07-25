				<!-- BEGIN .wrapper -->
				<div class="wrapper">
					
					<div class="main-content">

						<!-- BEGIN .panel -->
						<div class="panel">
							<div class="slider">
								<div class="slider-image">
									<?php foreach($articles as $key => $article) : ?>
										<a href="<?php echo base_url(); ?>noutati/articol/<?php echo $article->url; ?>" <?php if($key==0) : ?>class="active"<?php endif; ?>>
											<span class="slider-overlay">
												<strong><?php echo($article->title); ?></strong>
												<span>
													<?php
								                        $ShortDescr = strip_tags($article->content);
								                        if (strlen($ShortDescr)>=153) {
								                            $ShortDescr = substr($ShortDescr, 0, 150);
								                        } else {
								                            $ShortDescr = substr($ShortDescr, 0, -3);
								                        }
								                        echo ($ShortDescr."...");
						                        	?>
												</span>
											</span>
											<img src="<?php echo base_url(); ?>resources/uploads/<?php echo($article->image); ?>" class="setborder" width="488px" alt="<?php echo($article->title); ?>" title="<?php echo($article->title); ?>" />
										</a>
										<?php if($key==3) break; ?>
									<?php endforeach; ?>
								</div>
								<ul class="slider-navigation">
									<?php $key=1; ?>
									<?php foreach($articles as $article) : ?>
									<li <?php if($key==1) : ?>class="active"<?php endif; ?>>
										<a href="#" data-target="<?php echo($key); ?>">
											<strong><?php echo($article->title); ?></strong>
											<span>
													<?php
								                        $ShortDescr = strip_tags($article->content);
								                        if (strlen($ShortDescr)>=153) {
								                            $ShortDescr = substr($ShortDescr, 0, 150);
								                        } else {
								                            $ShortDescr = substr($ShortDescr, 0, -3);
								                        }
								                        echo ($ShortDescr."...");
						                        	?>
												</span>
										</a>
										<?php if($key==4) break; ?>
									</li>
									<?php $key++; ?>
									<?php endforeach; ?>
								</ul>
							</div>
						<!-- END .panel -->
						</div>

						<!-- BEGIN .panel-split -->
						<div class="panel-split">
							<div class="left-side">

								<!-- BEGIN .panel -->
								<div class="panel">
									<div class="p-title">
										<h2>Top Articole</h2>
									</div>
									<div class="article-list">

										<?php foreach($top_articles as $key => $top_art) : ?>
											<div class="item main-artice">
												<div class="item-header">
													<a href="<?php echo base_url(); ?>noutati/articol/<?php echo $top_art->url; ?>"><img src="<?php echo base_url(); ?>resources/uploads/<?php echo($top_art->image); ?>" alt="<?php echo($top_art->title); ?>" class="item-photo" /></a>
													<div class="article-slide">
														<h3><a href="<?php echo base_url(); ?>noutati/articol/<?php echo $top_art->url; ?>"><?php echo($top_art->title); ?></a></h3>
														<a href="<?php echo base_url(); ?>noutati/articol/<?php echo $top_art->url; ?>" class="info-line">
															<span><?php echo(model_data($top_art->added_date)); ?></span>
															<span><?php echo($top_art->total_comments); ?> comments</span>
														</a>
													</div>
												</div>
												<div class="item-content">
													<p><?php
								                        $ShortDescr = strip_tags($top_art->content);
								                        if (strlen($ShortDescr)>=103) {
								                            $ShortDescr = substr($ShortDescr, 0, 100);
								                        } else {
								                            $ShortDescr = substr($ShortDescr, 0, -3);
								                        }
								                        echo ($ShortDescr."...");
						                        	?></p>
												</div>
											</div>
											<?php if($key==0) break; ?>
										<?php endforeach; ?>

										<?php foreach($top_articles as $key => $top_art) : ?>
											<div class="item">
												<a href="<?php echo base_url(); ?>noutati/articol/<?php echo $top_art->url; ?>"><img src="<?php echo base_url(); ?>resources/uploads/thumbnails/<?php echo($top_art->image); ?>" alt="<?php echo($top_art->title); ?>" class="item-photo" /></a>
												<div class="item-content">
													<h3><a href="<?php echo base_url(); ?>noutati/articol/<?php echo $top_art->url; ?>"><?php echo($top_art->title); ?></a></h3>
													<span><?php echo(model_data($top_art->added_date)); ?></span>
													<a href="#"><span><?php echo($top_art->total_comments); ?> Comments</span></a>
												</div>
											</div>
											<?php if($key==2) break; ?>
										<?php endforeach; ?>

									</div>
								<!-- END .panel -->
								</div>

							</div>
							<div class="right-side">

								<!-- BEGIN .panel -->
								<div class="panel">
									<div class="p-title">
										<h2>Ultimile articole comentate</h2>
									</div>
									<div class="article-list">
										<?php 
											if($comments) : 
												foreach($comments as $key => $comm) :
												foreach($authors as $author) :
													if($author->id == $comm->sender_id) { 
														$user_avatar = $author->avatar;
														$username = $author->name;
														break;
													}
												endforeach;
												foreach($articles as $article) :
													if($article->id == $comm->article_id) {
														$article_url = $article->url;
														$article_title = $article->title;
														if (strlen($article_title)>=40) {
								                            $article_title = substr($article_title, 0, 37);
								                            $article_title = $article_title . "...";
								                        }
								                        break;
													}
												endforeach;
						                        $ShortComm = strip_tags($comm->message);
						                        if (strlen($ShortComm)>=93) {
						                            $ShortComm = substr($ShortComm, 0, 90);
						                        	$ShortComm = $ShortComm . "...";
						                        } 
											?>
											<div class="item" style="margin-bottom: 13px;">
												<a href="<?php echo base_url(); ?>noutati/articol/<?php echo($article_url); ?>#comment<?php echo($comm->id); ?>"><img src="<?php echo base_url(); ?>resources/images/avatars/thumbnails/<?php echo($user_avatar); ?>" alt="<?php echo($username); ?>" title="<?php echo($username); ?>" class="last-comm-avatar" /></a>
												<div class="item-content" style="min-height: 50px;">
													<h3><a href="<?php echo base_url(); ?>noutati/articol/<?php echo($article_url); ?>#comment<?php echo($comm->id); ?>"><?php echo($ShortComm); ?></a></h3>
													<span><?php echo(model_data($comm->added_date)); ?></span>
													<a href="#"><span><?php echo($article_title); ?></span></a>
												</div>
											</div>
											<?php if($key==7) break; ?>
										<?php endforeach; ?>
										<?php else : ?>
											<div class="item" style="margin-bottom: 13px;">
												Nu exista comentarii la articole
											</div>
										<?php endif; ?>
									</div>
								<!-- END .panel -->
								</div>

							</div>
						<!-- END .panel-split -->
						</div>
						
						<!-- BEGIN .panel -->
						<div class="panel">
							<div class="p-title">
								<h2>Autorii Nostri</h2>
							</div>
							<a href="blog.html" class="upper-title">Citeste mai mult<i class="fa fa-caret-right"></i></a>
							<div>
								<div class="panel-split">
									<div class="left-side">
										<div class="article-list">

											<?php foreach($author_articles as $key => $ath_art) : 
												foreach($authors as $author) :
													if($author->id == $ath_art->author_id) { 
														$user_avatar = $author->avatar;
														$username = $author->name;
														$user_id = $author->id;
														break;
													}
												endforeach;
											?>
												<div class="item">
													<a href="<?php echo base_url(); ?>noutati/articol/<?php echo $ath_art->url; ?>"><img src="<?php echo base_url(); ?>resources/uploads/thumbnails/<?php echo($ath_art->image); ?>" alt="<?php echo($ath_art->title); ?>" class="item-photo" /></a>
													<div class="item-content">
														<h3><a href="<?php echo base_url(); ?>noutati/articol/<?php echo $ath_art->url; ?>"><?php echo($ath_art->title); ?></a></h3>
														<span><?php echo(model_data($ath_art->added_date)); ?></span>
														<span data-id="<?php echo($user_id); ?>" class="user-id"><?php echo('scris de ' . $username); ?></span>
													</div>
												</div>
												<?php if($key==3) break; ?>
											<?php endforeach; ?>


										</div>
									</div>
									<div class="right-side">
										<div class="article-list">

											<?php foreach($author_articles as $key => $ath_art) : 
												foreach($authors as $author) :
													if($author->id == $ath_art->author_id) { 
														$user_avatar = $author->avatar;
														$username = $author->name;
														$user_id = $author->id;
														break;
													}
												endforeach;
											?>
												<?php if($key>3) : ?>
													<div class="item">
														<a href="<?php echo base_url(); ?>noutati/articol/<?php echo $ath_art->url; ?>"><img src="<?php echo base_url(); ?>resources/uploads/thumbnails/<?php echo($ath_art->image); ?>" alt="<?php echo($ath_art->title); ?>" class="item-photo" /></a>
														<div class="item-content">
															<h3><a href="<?php echo base_url(); ?>noutati/articol/<?php echo $ath_art->url; ?>"><?php echo($ath_art->title); ?></a></h3>
															<span><?php echo(model_data($ath_art->added_date)); ?></span>
															<span data-id="<?php echo($user_id); ?>" class="user-id"><?php echo('scris de ' . $username); ?></span>
														</div>
													</div>
												<?php endif; ?>
												<?php if($key==7) break; ?>
											<?php endforeach; ?>

										</div>
									</div>
								</div>
							</div>
						<!-- END .panel -->
						</div>
						
						<!-- BEGIN .panel-split -->
						<div class="panel-split">
							<div class="left-side">

								<!-- BEGIN .panel -->
								<div class="panel" id="noutati-pl">
									<div class="p-title">
										<h2>Noutati din PL</h2>
									</div>
									<?php if($user && $getUser->class > 60) : ?>
										<div class="upper-title add-pl-news"><span class="pl-text">Adauga Noutate</span><i class="fa fa-pencil-square-o"></i></div>
									<?php endif; ?>
									<div class="add-short-news pl-news">
										<form class="short-news-form" enctype="multipart/form-data" action="<?php echo base_url();?>home" method="post">
											<input type="hidden" name="author_id" value="<?php echo($user['id']); ?>" />
											<label>Titlu:</label>
											<input type="text" name="title" style="margin-bottom: 5px;" placeholder="titlul articolului" />
											<label>Link:</label>
											<input type="text" name="link" placeholder="link catre atricolul intreg" />
											<input type="submit" name="submit_news" value="Adauga" />
										</form>
										<div class="clear-float"></div>
									</div>

									<ul>
										<?php foreach($short_news as $pl_news) : ?>
											<?php if($pl_news->type == 'pl') : ?>
												<li><a href="<?php echo($pl_news->link); ?>" target="_blank"><?php echo($pl_news->title); ?></a></li>
											<?php endif; ?>
										<?php endforeach; ?>
									</ul>
								<!-- END .panel -->
								</div>

								<div class="panel" id="noutati-fotbal">
									<div class="p-title">
										<h2>Noutati din fotbal</h2>
									</div>
									<?php if($user && $getUser->class > 60) : ?>
										<div class="upper-title add-football-news"><span class="football-text">Adauga Noutate</span><i class="fa fa-pencil-square-o"></i></div>
									<?php endif; ?>
									<div class="add-short-news football-news">
										<form  class="short-news-form" enctype="multipart/form-data" action="<?php echo base_url();?>home" method="post">
											<input type="hidden" name="author_id" value="<?php echo($user['id']); ?>" />
											<label>Titlu:</label>
											<input type="text" name="title" style="margin-bottom: 5px;" placeholder="titlul articolului" />
											<label>Link:</label>
											<input type="text" name="link" placeholder="link catre atricolul intreg" />
											<input type="submit" name="submit_football" value="Adauga" />
										</form>
										<div class="clear-float"></div>
									</div>

									<ul>
										<?php foreach($short_news as $pl_news) : ?>
											<?php if($pl_news->type == 'football') : ?>
												<li><a href="<?php echo($pl_news->link); ?>" target="_blank"><?php echo($pl_news->title); ?></a></li>
											<?php endif; ?>
										<?php endforeach; ?>
									</ul>
								<!-- END .panel -->
								</div>

							</div>
							<div class="right-side">

								<!-- BEGIN .panel -->
								<div class="panel">
									<div class="p-title">
										<h2>Tabelul BPL 2014/2015</h2>
									</div>
									<div class="bpl-table">
										<table>
											<tr>
												<th>Echipa</th>
												<th>P</th>
												<th>GD</th>
												<th>Pts</th>
											</tr>
											<?php for($i = 1; $i<=10; $i++) { ?>
											<tr>
												<td><?php echo($i); ?>. Manchester United</td>
												<td>22</td>
												<td>+15</td>
												<td>40</td>
											</tr>
											<?php } ?>
										</table>
									</div>
								<!-- END .panel -->
								</div>

							</div>
						<!-- END .panel-split -->
						</div>

					</div>
					
					