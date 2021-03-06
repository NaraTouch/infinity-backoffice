<?php $image_url = $this->Url->build('/', ['escape' => false,'fullBase' => true,]);?>
<aside class="nk-sidebar nk-sidebar-right nk-sidebar-sticky">
	<div class="nk-widget nk-widget-highlighted">
		<h4 class="nk-widget-title"><span><span class="text-main-1">Next</span> Matches</span></h4>
		<div class="nk-widget-content">
			<div class="nk-widget-match">
				<a href="#">
					<span class="nk-widget-match-left">
						<span class="nk-widget-match-teams">
							<span class="nk-widget-match-team-logo">
								<img src="<?= $image_url.'images/team-1.jpg';?>" alt="">
							</span>
							<span class="nk-widget-match-vs">VS</span>
							<span class="nk-widget-match-team-logo">
								<img src="<?= $image_url.'images/team-2.jpg';?>" alt="">
							</span>
						</span>
						<span class="nk-widget-match-date">CS:GO - Apr 28, 2018 8:00 pm</span>
					</span>
					<span class="nk-widget-match-right">
						<span class="nk-match-score">
							Upcoming
						</span>
					</span>
				</a>
			</div>

			<div class="nk-widget-match">
				<a href="#">
					<span class="nk-widget-match-left">
						<span class="nk-widget-match-teams">
							<span class="nk-widget-match-team-logo">
								<img src="<?= $image_url.'images/team-3.jpg';?>" alt="">
							</span>
							<span class="nk-widget-match-vs">VS</span>
							<span class="nk-widget-match-team-logo">
								<img src="<?= $image_url.'images/team-2.jpg';?>" alt="">
							</span>
						</span>
						<span class="nk-widget-match-date">LoL - Apr 24, 2018 7:20 pm</span>
					</span>
					<span class="nk-widget-match-right">
						<span class="nk-match-score">
							Upcoming
						</span>
					</span>
				</a>
			</div>

			<div class="nk-widget-match">
				<a href="#">
					<span class="nk-widget-match-left">
						<span class="nk-widget-match-teams">
							<span class="nk-widget-match-team-logo">
								<img src="<?= $image_url.'images/team-1.jpg';?>" alt="">
							</span>
							<span class="nk-widget-match-vs">VS</span>
							<span class="nk-widget-match-team-logo">
								<img src="<?= $image_url.'images/team-4.jpg';?>" alt="">
							</span>
						</span>
						<span class="nk-widget-match-date">Dota 2 - Apr 12, 2018 6:40 pm</span>
					</span>
					<span class="nk-widget-match-right">
						<span class="nk-match-score bg-dark-1">
							0 : 0
						</span>
					</span>
				</a>
			</div>
		</div>
	</div>
</aside>