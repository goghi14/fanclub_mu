				<div class="wrapper">
					
					<div class="main-content">

						<!-- BEGIN .panel -->
						<div class="panel">
							<div class="p-title">
								<h2>Noutăți</h2>
							</div>
							<?php if($user) : ?>
								<?php if($getUser->class > 60) : ?>
									<a href="<?php echo base_url(); ?>cp/article" class="upper-title">Adauga Articol<i class="fa fa-pencil-square-o"></i></a>
								<?php endif; ?>
							<?php endif; ?>
							<div class="blog-list style-1">

								<?php foreach($articles as $article) : ?>
									<div class="item">
										<div class="item-header">
											<a href="<?php echo base_url(); ?>noutati/articol/<?php echo $article->url; ?>"><img src="<?php echo base_url(); ?>resources/uploads/<?php echo($article->image); ?>" alt="<?php echo($article->title); ?>" width="370px" class="item-photo" /></a>
										</div>
										<div class="item-content">
											<a href="#" class="category-link" style="color: #c32929;">
												<strong>
													<?php foreach($categ_leg as $categ_con) :
														if($categ_con->article_id == $article->id) :
															foreach($categories as $category) {
																	if($categ_con->category_id == $category->id) echo($category->name);
															}
															break;
														endif;
													endforeach; ?>
												</strong>
											</a>
											<h3><a href="<?php echo base_url(); ?>noutati/articol/<?php echo $article->url; ?>"><?php echo($article->title); ?></a></h3>
											<p>
												<?php
							                        $ShortDescr = strip_tags($article->content);
							                        if (strlen($ShortDescr)>=313) {
							                            $ShortDescr = substr($ShortDescr, 0, 310);
							                        } else {
							                            $ShortDescr = substr($ShortDescr, 0, -3);
							                        }
							                        echo ($ShortDescr ."...");
						                        ?>
					                        </p>
										</div>
										<div class="item-footer">
											<span class="right">
												<a href=""><i class="fa fa-clock-o"></i> 20 March, 2015</a>
												<a href=""><i class="fa fa-comment"></i> <?php echo($article->total_comments); ?></a>
											</span>
										</div>
									</div>
							    <?php endforeach; ?>

							</div>
						<!-- END .panel -->
						</div>

						<!-- BEGIN .panel -->
						<div class="panel">
							<div class="pagination">
								<?php echo $links; ?>
							</div>
						</div>

					</div>
