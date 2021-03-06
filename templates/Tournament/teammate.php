<?php $image_url = $this->Url->build('/', ['escape' => false,'fullBase' => true,]); ?>
<div class="nk-main">
	<!-- START: Breadcrumbs -->
	<div class="nk-gap-1"></div>
		<?=$this->element('breadcrumbs'); ?>
	<div class="nk-gap-1"></div>
	<!-- END: Breadcrumbs -->
	
	<div class="container">
		<div class="row vertical-gap">
			<div class="col-lg-8">
			<!-- START: Teammate Card -->
				<div class="nk-teammate-card">
					<div class="nk-teammate-card-photo">
						<img src="<?= $image_url.'images/teammate-1.png';?>" alt="Faker">
					</div>
					<div class="nk-teammate-card-info">
						<table>
							<tbody>
							<tr>
								<td>
									<img src="<?= $image_url.'images/teammate-team.png';?>" alt="">
								</td>
								<td>
									<table>
										<tbody>
										<tr>
											<td><strong class="h5">Name:</strong>&nbsp;&nbsp;&nbsp;</td>
											<td><strong class="h5">SANG-HYEOK LEE</strong></td>
										</tr>
										<tr>
											<td><strong class="h5">Nickname:</strong>&nbsp;&nbsp;&nbsp;</td>
											<td><strong class="h5">Faker</strong></td>
										</tr>
										<tr>
											<td><strong class="h5">Position:</strong>&nbsp;&nbsp;&nbsp;</td>
											<td><strong class="h5">Mid</strong></td>
										</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<strong class="h3">7.3</strong>
								</td>
								<td>
									<strong class="h5">KDA Ration</strong>
									<div>#5 in World Championship</div>
								</td>
							</tr>
							<tr>
								<td>
									<strong class="h3">8.3</strong>
								</td>
								<td>
									<strong class="h5">CS PER MIN</strong>
									<div>#23 in World Championship</div>
								</td>
							</tr>
							<tr>
								<td>
									<strong class="h3">64%</strong>
								</td>
								<td>
									<strong class="h5">KILL PARTICIPATION</strong>
									<div>#66 in World Championship</div>
								</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!-- END: Teammate Card -->
				<!-- START: Biography -->
				<div class="nk-gap-3"></div>
				<h3 class="nk-decorated-h-2"><span>Biography</span></h3>
				<p>At first, for some time, I was not able to answer him one word; but as he had taken me in his arms I held fast by him, or I should have fallen to the ground.	I confess this side of the country was much pleasanter than mine; but yet I had not the least inclination to remove</p>
				<p>For as I was fixed in my habitation it became natural to me, and I seemed all the while I was here to be as it were upon a journey, and from home. However, I travelled along the shore of the sea towards the east, I suppose about twelve miles, and then setting up a great pole upon the shore for a mark, I concluded I would go home again, and that the next journey I took should be on the other side of the island east from my dwelling, and so round till I came to my post again.</p>
				<p>Thus much I thought proper to tell you in relation to yourself, and to the trust I reposed in you.	However, many of the most learned and wise adhere to the new scheme of expressing themselves by things; which has only this inconvenience attending it, that if a man's</p>
				<p>I have often beheld two of those sages almost sinking under the weight of their packs, like pedlars among us, who, when they met in the street, would lay down their loads, open their sacks, and hold conversation for an hour together; then put up their implements</p>
				<!-- END: Biography -->
			</div>
			<div class="col-lg-4">
				<!-- START: Left Sidebar -->
					<?=$this->element('home/left_sidebar'); ?>
				<!-- END: Sidebar -->
			</div>
		</div>
	</div>
</div>