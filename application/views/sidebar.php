<aside id="sidebar">
						
						<!-- BEGIN .widget -->
						<div class="widget">
							<div class="w-title">
								<h3>Ultimul Meci</h3>
							</div>
							<div class="match-widget">
								<a href="#" class="upper-title">VEZI ORARUL INTREG<i class="fa fa-caret-right"></i></a>
								<div class="match-teams">
									<img style="float:left;" src="<?php echo base_url(); ?>resources/images/teams-logo/manchester-united.png" alt="Manchester United" />
									<span class="side-score"><?php echo $last_score; ?></span>
									<img style="float: right; margin-right: 11px;" src="<?php echo base_url(); ?>resources/images/teams-logo/<?php echo $last_team_logo; ?>" alt="<?php echo $last_team; ?>" />
								</div>
								<div class="match-info">
									<img src="<?php echo base_url(); ?>resources/images/calendar-icon.png" alt="calendar" />
									<span><?php echo $last_game_date; ?></span>
									<img src="<?php echo base_url(); ?>resources/images/clock-icon.png" alt="clock" />
									<span><?php echo $last_game_hr; ?></span>
									<img src="<?php echo base_url(); ?>resources/images/cup-icon.png" alt="cup" />
									<span><?php echo $last_game_cup; ?></span>
								</div>
								<div class="match-buttons">
									<div class="btn">
										Vezi Statisticile
									</div>
									<div class="btn">
										Discuta despre meci
									</div>
								</div>
							</div>
						<!-- END .widget -->
						</div>

						<div class="widget">
							<div class="w-title">
								<h3>Urmatorul Meci</h3>
							</div>

							<div class="banner">
								<a href="#" class="upper-title">VEZI ORARUL INTREG<i class="fa fa-caret-right"></i></a>
								<div class="match-teams">
									<?php if($gn_type == "Home") : ?>
										<img style="float:left;" src="<?php echo base_url(); ?>resources/images/teams-logo/manchester-united.png" alt="Manchester United" />
										<span class="side-score"><?php echo $next_score; ?></span>
										<img style="float: right; margin-right: 11px;" src="<?php echo base_url(); ?>resources/images/teams-logo/<?php echo $next_team_logo; ?>" alt="<?php echo $next_team; ?>" />
									<?php elseif($gn_type == "Away") : ?>
										<img style="float: left;" src="<?php echo base_url(); ?>resources/images/teams-logo/<?php echo $next_team_logo; ?>" alt="<?php echo $next_team; ?>" />
										<span class="side-score"><?php echo $next_score; ?></span>
										<img style="float: right; margin-right: 11px;" src="<?php echo base_url(); ?>resources/images/teams-logo/manchester-united.png" alt="Manchester United" />
									<?php endif; ?>
								</div>
								<div class="match-info">
									<img src="<?php echo base_url(); ?>resources/images/calendar-icon.png" alt="calendar" />
									<span><?php echo $next_game_date; ?></span>
									<img src="<?php echo base_url(); ?>resources/images/clock-icon.png" alt="clock" />
									<span><?php echo $next_game_hr; ?></span>
									<img src="<?php echo base_url(); ?>resources/images/cup-icon.png" alt="cup" />
									<span><?php echo $next_game_cup; ?></span>
								</div>
								<div class="match-buttons">
									<div class="btn-inactive">
										Vezi Statisticile
									</div>
									<div class="btn">
										Discuta despre meci
									</div>
								</div>
							</div>
						<!-- END .widget -->
						</div>

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

						<div class="widget">
							<div class="w-title">
								<h3>Urmareste-ne...</h3>
							</div>
							<div class="banner">
								<a href="#">
									<img src="<?php echo base_url(); ?>resources/images/socials/facebook.jpg" alt="Facebook" />
								</a>
								<a href="#">
									<img src="<?php echo base_url(); ?>resources/images/socials/twitter.jpg" alt="Twitter" />
								</a>
								<a href="#">
									<img src="<?php echo base_url(); ?>resources/images/socials/youtube.jpg" alt="Youtube Channel" />
								</a>
								<a href="#">
									<img src="<?php echo base_url(); ?>resources/images/socials/instagram.jpg" alt="Instagram" />
								</a>
								<a href="#">
									<img src="<?php echo base_url(); ?>resources/images/socials/mail.jpg" alt="Email" />
								</a>
							</div>
						<!-- END .widget -->
						</div>

						<div class="widget">
							<div class="w-title">
								<h3>Reclama</h3>
							</div>
							<div class="banner">
								<a href="#">
									<img class="adv-margin" src="<?php echo base_url(); ?>resources/images/no-banner-125x125.jpg" alt="Banner 125x125" />
								</a>
								<a href="#">
									<img class="adv-margin" src="<?php echo base_url(); ?>resources/images/no-banner-125x125.jpg" alt="Banner 125x125" />
								</a>
								<a href="#">
									<img class="adv-margin" src="<?php echo base_url(); ?>resources/images/no-banner-125x125.jpg" alt="Banner 125x125" />
								</a>
								<a href="#">
									<img class="adv-margin" src="<?php echo base_url(); ?>resources/images/no-banner-125x125.jpg" alt="Banner 125x125" />
								</a>
							</div>
						<!-- END .widget -->
						</div>
						
					</aside>
					
				<!-- END .wrapper -->
				</div>
				
			<!-- BEGIN .content -->
			</section>