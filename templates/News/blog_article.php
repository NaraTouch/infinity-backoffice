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
				<!-- START: Post -->
				<div class="nk-blog-post nk-blog-post-single">
					<!-- START: Post Text -->
					<div class="nk-post-text mt-0">
						<div class="nk-post-img">
							<img src="<?= $image_url.'images/post-2.jpg';?>" alt="Grab your sword and fight the Horde">
						</div>
						<div class="nk-gap-1"></div>
						<h1 class="nk-post-title h4">Grab your sword and fight the Horde</h1>
						<div class="nk-post-by">
							<img src="<?= $image_url.'images/avatar-2.jpg';?>" alt="Witch Murder" class="rounded-circle" width="35"> by <a href="#">Witch Murder</a> in Sep 5, 2018
							<div class="nk-post-categories">
								<span class="bg-main-1">Action</span>
								<span class="bg-main-2">Adventure</span>
							</div>
						</div>
						<div class="nk-gap"></div>
						<p>Just then her head struck against the roof of the hall: in fact she was now more than nine feet high, and she at once took up the little golden key and hurried off to the garden door.	The first question of course was, how to get dry again: they had a consultation about this, and after a few minutes it seemed quite natural to Alice to find herself talking familiarly with them, as if she had known them all her life. Indeed, she had quite a long argument with the Lory, who at last turned sulky, and would only say, `I am older than you, and must know better'; and this Alice would not allow without knowing how old it was, and, as the Lory positively refused to tell its age, there was no more to be said.</p>
						<div class="nk-gap"></div>
						<blockquote class="nk-blockquote">
							<div class="nk-blockquote-icon"><span>"</span></div>
							<div class="nk-blockquote-content">
								Just then her head struck against the roof of the hall: in fact she was now more than nine feet high, and she at once took up the little golden key and hurried off to the garden door. As if she had known them all her life. Indeed, she had quite a long argument with the Lory.
							</div>
							<div class="nk-blockquote-author"><span>Samuel Marlow</span></div>
						</blockquote>
						<div class="nk-gap"></div>
						<img class="float-left mt-0" src="<?= $image_url.'images/post-inner-img.jpg';?>" alt="">
						<h3 class="h4">Now the races of these two have been</h3>
						<p>I confess this side of the country was much pleasanter than mine; but yet I had not the least inclination to remove, for as I was fixed in my habitation it became natural to me, and I seemed all the while I was here to be as it were upon a journey, and from home. However, I travelled along the shore she clutched the matron by the arm, and forcing her into a chair by the bedside, was about to speak, wh en looking round, she caught sight of the two old women bending forward in the attitude of eager list eners.They belong to the old gentleman, said Oliver, wringing his hands; "to the good, kind, old gentle man who took me into his house, and had me nursed, when I was near dying of the fever . Oh, pray send them back; send him back the books and money</p>
						<div class="nk-gap"></div>
						<div class="nk-plain-video" data-video="https://www.youtube.com/watch?v=6cXyQg_5uoc"></div>
						<div class="nk-gap-2"></div>
						<p>This sounded nonsense to Alice, so she said nothing, but set off at once toward the Red Queen. To her surprise, she lost sight of her in a moment, and found herself walking in at the front-door again. For some minutes Alice stood without speaking, looking out in all directions over the country - and a most curious country it was.</p>
						<div class="nk-gap"></div>
						<div class="nk-post-share">
							<span class="h5">Share Article:</span>
							<ul class="nk-social-links-2">
								<li><span class="nk-social-facebook" title="Share page on Facebook" data-share="facebook"><span class="fab fa-facebook"></span></span></li>
								<li><span class="nk-social-google-plus" title="Share page on Google+" data-share="google-plus"><span class="fab fa-google-plus"></span></span></li>
								<li><span class="nk-social-twitter" title="Share page on Twitter" data-share="twitter"><span class="fab fa-twitter"></span></span></li>
								<li><span class="nk-social-pinterest" title="Share page on Pinterest" data-share="pinterest"><span class="fab fa-pinterest-p"></span></span></li>
							</ul>
						</div>
					</div>
					<!-- END: Post Text -->
					<!-- START: Similar Articles -->
					<div class="nk-gap-2"></div>
					<h3 class="nk-decorated-h-2"><span><span class="text-main-1">Similar</span> Articles</span></h3>
					<div class="nk-gap"></div>
					<div class="row">
						<div class="col-md-6">
							<!-- START: Post -->
							<div class="nk-blog-post">
								<a href="blog-article.html" class="nk-post-img">
									<img src="<?= $image_url.'images/post-3-mid.jpg';?>" alt="We found a witch! May we burn her?">
									<span class="nk-post-comments-count">7</span>
									<span class="nk-post-categories">
										<span class="bg-main-2">Adventure</span>
									</span>
								</a>
								<div class="nk-gap"></div>
								<h2 class="nk-post-title h4"><a href="blog-article.html">We found a witch! May we burn her?</a></h2>
							</div>
							<!-- END: Post -->
						</div>
						<div class="col-md-6">
							<!-- START: Post -->
							<div class="nk-blog-post">
								<a href="blog-article.html" class="nk-post-img">
									<img src="<?= $image_url.'images/post-4-mid.jpg';?>" alt="For good, too though, in consequence">
									<span class="nk-post-comments-count">23</span>
									<span class="nk-post-categories">
										<span class="bg-main-3">Strategy</span>
									</span>
								</a>
								<div class="nk-gap"></div>
								<h2 class="nk-post-title h4"><a href="blog-article.html">For good, too though, in consequence</a></h2>
							</div>
							<!-- END: Post -->
						</div>
					</div>
					<!-- END: Similar Articles -->
				</div>
			</div>
			<div class="col-lg-4">
				<!-- START: Left Sidebar -->
					<?=$this->element('home/left_sidebar'); ?>
				<!-- END: Sidebar -->
			</div>
		</div>
	</div>
</div>