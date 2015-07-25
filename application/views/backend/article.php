				<!-- BEGIN .wrapper -->
				<div class="wrapper">
					
					<div class="main-content">

						<!-- BEGIN .panel -->
						<div class="panel">
						
							<div class="add-article-panel">
								<form enctype="multipart/form-data" id="form_ajax" action="<?php echo base_url();?>cp/article" method="post">
									<input type="hidden" name="id" value="<?php echo(!empty($edit_article->id)) ? $edit_article->id : ''; ?>" />
									<input type="hidden" name="cur_image" value="<?php echo(!empty($edit_article->image)) ? $edit_article->image : ''; ?>" />
									<label>Titlu:</label>
									<input type="text" name="title" value="<?php echo(!empty($edit_article->title)) ? $edit_article->title : ''; ?>" />
									<br /><br />

									<label>Categorie:</label>
									<select name="category">
											<option value="0">Alege Categoria</option>
										<?php foreach($categories as $category) : ?>
											<option value="<?php echo($category->id); ?>"><?php echo($category->name); ?></option>
										<?php endforeach; ?> 
									</select>

									<?php if(!empty($edit_article->id)) : ?>
										<span style="float: right; font-size: 12px; font-style: italic;">
											Categorii atribuite: 
											<?php
											foreach($categ_leg as $categ_con) :
												if($categ_con->article_id == $edit_article->id) :
													foreach($categories as $category) {
														if($categ_con->category_id == $category->id) {
															?>
																<span class="att-categ">
																	<input type="image" src="<?php echo base_url(); ?>resources/images/delete_btn.png" name="submit_delete_categ" value="<?php echo($categ_con->id); ?>" /> <?php echo($category->name); ?>
																</span>
															<?php
														}
													}
												endif;
											endforeach; 
											?>
										</span>
									<?php endif; ?>

									<br /><br />

										<label>Continut:</label>
										<div class="edit-textarea">
										<textarea name="content" id="content_area" cols="50" height="200px"><?php echo(!empty($edit_article->content)) ? $edit_article->content : ''; ?></textarea><br />
										</div>
									
									
									<br />
									<div style="clear:both;"></div>
									<label>Imagine:</label>
									<input type="file" name="imagine" size="20" /><br />

									<label>Taguri:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
									<?php foreach($tags as $key => $tag) : ?>
										<input type="checkbox" name="tag<?php echo($key); ?>" value="<?php echo($tag->id); ?>"> <?php echo($tag->name . '&nbsp;&nbsp;'); ?>
									<?php endforeach; ?>
									<hr color="lightgrey" style="margin: 0 0 12px 0;">

									<input type="checkbox" name="top" value="1" <?php echo(!empty($edit_article->id) && $edit_article->top_article == 1) ? 'checked' : '' ?>> 
									<label>Este un articol ce trebuie plasat in categoria TOP</label><br />

									<input type="checkbox" name="our_author" value="1" <?php echo(!empty($edit_article->id) && $edit_article->our_author == 1) ? 'checked' : '' ?>>
									<label>Eu am scris acest articol</label><br />

									<br /><br />
									<input type="submit" name="submit_article" />

								</form>
							</div>
						</div>

					</div>

				</div>