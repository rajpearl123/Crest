@php
$websiteSetting = \App\Models\WebsiteSetting::first()
@endphp
@extends('web-views.layouts.app')
@section('title', $websiteSetting->name . " | Blogs")
@section('content')
<style>
    .page-number {
    padding: 8px 12px;
    margin: 2px;
    border: 1px solid #ddd;
    border-radius: 4px;
    text-decoration: none;
    color: #007bff;
}

.page-number.current {
    background-color: #007bff;
    color: white;
    font-weight: bold;
}

.page-number:hover {
    background-color: #0056b3;
    color: white;
}
.recent_img{
    width: 100%;
    max-width: 100px;
    height: 80px;
    object-fit: cover;
}




</style>
<main>
    <section class="wptb-slider style5 p-0">
        <div class="wptb-page-heading px-0">
            <div class="wptb-item--inner" style="background-image: url('https://img.freepik.com/free-photo/circle-cameras-film_23-2147852399.jpg');">

                <h2 class="wptb-item--title">Blog Details</h2>
            </div>
        </div>
    </section>
    <section class="blog-details">
				<div class="container">
					<div class="row">

                        <div class="col-lg-9 col-md-8 pe-md-5">
                            <div class="blog-details-inner">
                                <div class="post-content">
									<div class="post-header">
										<h2 class="post-title">{{ $blog->title }}</h2>
                                        @if($settings->show_author_date)

                                        <div class="wptb-item--meta d-flex align-items-center gap-4">
                                            <div class="wptb-item wptb-item--author"><a href="#"><i class="bi bi-pencil-square"></i> <span> {{ $blog->author }} <strong></strong></span></a></div>
                                            <div class="wptb-item wptb-item--date"><a href="#"><i class="bi bi-calendar3"></i> <span>{{ \Carbon\Carbon::parse($blog->publish_date)->format('d M Y') }}</span></a></div>
                                            <!-- <div class="wptb-item wptb-item--comments"><a href="#comments"><i class="bi bi-chat-square-text"></i> <span>2k</span></a></div>
                                            <div class="wptb-item wptb-item--hits"><a href="#"><i class="bi bi-eye"></i> <span>1.38k</span></a></div> -->
                                        </div>
                                        @endif
									</div>



									<div class="fulltext">
                                        <div class="_ad_img">
                                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="img-fluid">
                                    </div>
                                        
                                    <p>{!! $blog->content !!}</p>
										
                                   

                                        <!-- Comment List -->
                                        <div class="comments-area">
											<h3 class="comments-title">Comments</h3>
											<!-- <ul class="comment-list">
												<li class="comment even thread-even depth-1">
													<div class="commenter-block">
														<div class="comment-avatar">
															<img alt="img" src="https://media.istockphoto.com/id/1437816897/photo/business-woman-manager-or-human-resources-portrait-for-career-success-company-we-are-hiring.jpg?b=1&s=612x612&w=0&k=20&c=hEPh7-WEAqHTHdQtPrfEN9-yYCiPGKvD32VZ5lcL6SU=" class="avatar">
														</div>
														<div class="comment-content">
															<div class="comment-author-name">Barret Simpson <span class="comment-date">January 29, 2023</span></div>
															<div class="comment-author-comment">
																<p>Lorem ipsum dolor sit amet, consectetur. Ut enim ad minima veniam quis nostrum exercitationem mosequatu autem.</p>
                                                                <span class="comment-reply"><a href="#" class="comment-reply-link">Reply</a></span>
															</div>
														</div>
													</div>
		
													<ul class="children">
														<li class="comment even thread-even depth-2">
															<div class="commenter-block">
																<div class="comment-avatar">
																	<img alt="img" src="https://plus.unsplash.com/premium_photo-1689568126014-06fea9d5d341?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZmlsZXxlbnwwfHwwfHx8MA%3D%3D" class="avatar">
																</div>
																<div class="comment-content">
                                                                    <div class="comment-author-name">Parker Ballinger <span class="comment-date">January 22, 2023</span></div>
                                                                    <div class="comment-author-comment">
                                                                        <p>Lorem ipsum dolor sit amet, consectetur. Ut enim ad minima veniam quis nostrum exercitationem mosequatu autem.</p>
                                                                        <span class="comment-reply"><a href="#" class="comment-reply-link">Reply</a></span>
                                                                    </div>
                                                                </div>
															</div>
														</li>
													</ul> -->
                                                    <ul class="comment-list">
                                                        @foreach($comments as $comment)
                                                            <li class="comment {{ $loop->odd ? 'odd' : 'even' }} thread-{{ $loop->index % 2 == 0 ? 'even' : 'odd' }} depth-1">
                                                                <div class="commenter-block">
                                                                    <div class="comment-avatar">
                                                                        <img alt="avatar" src="{{ asset('default-avatar.avif') }}" class="avatar">
                                                                    </div>
                                                                    <div class="comment-content">
                                                                        <div class="comment-author-name">
                                                                            {{ $comment->name }} 
                                                                            <!-- <span class="comment-date">{{ $comment->created_at->format('F d, Y') }}</span> -->
                                                                        </div>
                                                                        <div class="comment-author-comment">
                                                                            <p>{{ $comment->comment }}</p>
                                                                            <!-- <span class="comment-reply"><a href="#" class="comment-reply-link">Reply</a></span> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>

                                                    <!-- .children -->
												<!-- </li>
												<li class="comment odd thread-odd depth-1">
													<div class="commenter-block">
														<div class="comment-avatar">
															<img alt="img" src="https://media.istockphoto.com/id/1326417862/photo/young-woman-laughing-while-relaxing-at-home.jpg?s=612x612&w=0&k=20&c=cd8e6RBGOe4b8a8vTcKW0Jo9JONv1bKSMTKcxaCra8c=" class="avatar">
														</div>
														<div class="comment-content">
															<div class="comment-author-name">Barret Simpson <span class="comment-date">January 01, 2023</span></div>
															<div class="comment-author-comment">
																<p>Lorem ipsum dolor sit amet, consectetur. Ut enim ad minima veniam quis nostrum exercitationem mosequatu autem.</p>
                                                                <span class="comment-reply"><a href="#" class="comment-reply-link">Reply</a></span>
															</div>
														</div>
													</div>
												</li> -->
											</ul>
											<!-- <div class="wptb-pagination-wrap">
                                                <ul class="pagination mt-0 justify-content-start">
                                                    <li><span class="page-number current">1</span></li>
                                                    <li><a class="page-number" href="#">2</a></li>
                                                    <li>.....</li>
                                                    <li><a class="page-number" href="#">5</a></li>
                                                </ul>
                                            </div> -->
                                            <!-- Custom Pagination -->
                                            <!-- <div class="wptb-pagination-wrap">
                                                    <ul class="pagination mt-0 justify-content-start">
                                                        {{-- Previous Page Link --}}
                                                        @if ($comments->onFirstPage())
                                                            <li><span class="page-number current">1</span></li>
                                                        @else
                                                            <li><a class="page-number" href="{{ $comments->previousPageUrl() }}">&laquo;</a></li>
                                                        @endif

                                                        {{-- Pagination Elements --}}
                                                        @foreach ($comments->getUrlRange(1, $comments->lastPage()) as $page => $url)
                                                            @if ($page == $comments->currentPage())
                                                                <li><span class="page-number current">{{ $page }}</span></li>
                                                            @else
                                                                <li><a class="page-number" href="{{ $url }}">{{ $page }}</a></li>
                                                            @endif
                                                        @endforeach

                                                        {{-- Next Page Link --}}
                                                        @if ($comments->hasMorePages())
                                                            <li><a class="page-number" href="{{ $comments->nextPageUrl() }}">&raquo;</a></li>
                                                        @else
                                                            <li><span class="page-number">Last</span></li>
                                                        @endif
                                                    </ul>
                                            </div> -->
                                            @if($comments->count() > 0)
                                            <div class="wptb-pagination-wrap">
                                                <ul class="pagination mt-0 justify-content-start">
                                                    {{-- Previous Page --}}
                                                    @if ($comments->onFirstPage())
                                                        <li class="disabled"><span class="page-number">&laquo;</span></li>
                                                    @else
                                                        <li><a class="page-number" href="{{ $comments->previousPageUrl() }}">&laquo;</a></li>
                                                    @endif

                                                    {{-- Page Numbers --}}
                                                    @for ($i = 1; $i <= $comments->lastPage(); $i++)
                                                        @if ($i == $comments->currentPage())
                                                            <li><span class="page-number current">{{ $i }}</span></li>
                                                        @else
                                                            <li><a class="page-number" href="{{ $comments->url($i) }}">{{ $i }}</a></li>
                                                        @endif
                                                    @endfor

                                                    {{-- Next Page --}}
                                                    @if ($comments->hasMorePages())
                                                        <li><a class="page-number" href="{{ $comments->nextPageUrl() }}">&raquo;</a></li>
                                                    @else
                                                        <li class="disabled"><span class="page-number">&raquo;</span></li>
                                                    @endif
                                                </ul>
                                            </div>
                                            @else
                                                <p>No comments found.</p>
                                            @endif


										</div>

                                        <div class="comment-respond">
                                        @if(session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif

											<h3 class="comment-reply-title">Make A Comment</h3>
											<!-- <form class="comment-form" action="register.php" method="post">
												<p class="logged-in-as">Your email address will not be published. Required fields are marked *</p>
												<div class="form-container">
													<div class="row">
														<div class="col-md-6 col-lg-6">
															<div class="form-group">
																<input type="text" name="name" class="form-control" placeholder="Name*" required="">
															</div>
														</div>
														<div class="col-md-6 col-lg-6">
															<div class="form-group">
																<input type="email" name="email" class="form-control" placeholder="E-mail*" required="">
															</div>
														</div>
														<div class="col-md-12 col-lg-12">
															<div class="form-group">
																<textarea name="message" class="form-control" placeholder="Text Here*" required=""></textarea>
															</div>
														</div>
														<div class="col-md-12 col-lg-12">
                                                            <div class="wptb-item--button"> 
                                                                <button type="submit" class="btn"> 
                                                                    <span class="btn-wrap">
                                                                        <span class="text-first">Make Comment</span>
                                                                    </span>
                                                                </button>
                                                            </div>
														</div>
													</div>
												</div>
											</form> -->
                                            <form class="comment-form" action="{{ route('comments.store', $blog->id) }}" method="POST">
                                                @csrf
                                                <p class="logged-in-as">Your email address will not be published. Required fields are marked *</p>
                                                <div class="form-container">
                                                    <div class="row">
                                                        <div class="col-md-6 col-lg-6">
                                                            <div class="form-group">
                                                                <input type="text" name="name" class="form-control" placeholder="Name*" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-6">
                                                            <div class="form-group">
                                                                <input type="email" name="email" class="form-control" placeholder="E-mail*" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-lg-12">
                                                            <div class="form-group">
                                                                <textarea name="comment" class="form-control" placeholder="Text Here*" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-lg-12">
                                                            <div class="wptb-item--button"> 
                                                                <button type="submit" class="btn"> 
                                                                    <span class="btn-wrap">
                                                                        <span class="text-first">Make Comment</span>
                                                                    </span>
                                                                </button>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

										</div>
                                    </div>
								</div>
                            </div>

                        </div>

                        <!-- Sidebar  -->
                        <div class="col-lg-3 col-md-4 p-md-0 mt-5 mt-md-0">

                            <div class="sidebar">
								
                                <!-- <div class="widget widget_block widget_search">
                                    <form method="get" class="wp-block-search">
                                        <div class="wp-block-search__inside-wrapper ">
                                            <input type="search" class="wp-block-search__input" name="search" value="" placeholder="Search" required="">
                                            <button type="submit" class="wp-block-search__button"><i class="bi bi-search"></i></button>
                                        </div>
                                    </form>
                                </div> -->
                                <!-- end widget -->

                                <!-- <div class="widget widget_block">
                                    <div class="wp-block-group__inner-container">
                                        <h2 class="widget-title">Categories</h2>
                                        <ul class="wp-block-categories-list wp-block-categories">
                                            <li class="cat-item"><a href="#">Album</a> <i class="bi bi-chevron-right"></i></li>
                                            <li class="cat-item"><a href="#">Nature</a> <i class="bi bi-chevron-right"></i></li>
                                            <li class="cat-item"><a href="#">Decorative</a> <i class="bi bi-chevron-right"></i></li>
                                            <li class="cat-item"><a href="#">Newborn</a> <i class="bi bi-chevron-right"></i></li>
                                            <li class="cat-item"><a href="#">Wildlife</a> <i class="bi bi-chevron-right"></i></li>
                                            <li class="cat-item"><a href="#">Portfolio</a> <i class="bi bi-chevron-right"></i></li>
                                            <li class="cat-item"><a href="#">Abstract</a> <i class="bi bi-chevron-right"></i></li>
                                        </ul>
                                    </div>
                                </div> -->
                                <!-- end widget -->

                                <div class="widget widget_block">
                                    <div class="wp-block-group__inner-container">
                                        <h2 class="widget-title">Recent Posts</h2>
                                        <ul class="wp-block-latest-posts__list wp-block-latest-posts">
                                        @foreach ($recentBlogs as $recent)
                                            <li>
												<div class="latest-posts-content d-flex align-items-center gap-3">
                                                    <img src="{{ asset($recent->image) }}" alt="" srcset="" class="recent_img">
													<h5><a href="{{ route('blogdetail', $recent->slug) }}">{{ $recent->title }}</a></h5>
												</div>
											</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div class="widget widget_categories">
    <div class="wp-block-group__inner-container">
        <h2 class="widget-title">Categories</h2>
        <ul class="wp-block-categories__list wp-block-categories">
            @foreach ($categories as $category)
                <li>
                <a href="{{ route('blogs', $category->name) }}">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

                                <!-- end widget -->

                                <!-- <div class="widget widget_block">
                                    <h2 class="widget-title">
                                        Archive
                                    </h2>
                                    <ul class="wp-block-archive">
                                        <li><a href="blog.html">September 2023</a></li>
                                        <li><a href="blog.html">June 2023</a></li>
                                        <li><a href="blog.html">November 2022</a></li>
                                        <li><a href="blog.html">July 2022</a></li>
                                        <li><a href="blog.html">December 2021</a></li>
                                    </ul>
                                </div> -->
                                <!-- end widget -->

                                <!-- <div class="widget widget_block">
                                    <h2 class="widget-title">
                                        Product Tag
                                    </h2>
                                    <div class="wp-block-tag-list wp-block-tag">
                                        <a href="#" class="tag-cloud-link">Photography</a>
                                        <a href="#" class="tag-cloud-link">Indoor</a>
                                        <a href="#" class="tag-cloud-link">Outdoor</a>
                                        <a href="#" class="tag-cloud-link">Fashion</a>
                                        <a href="#" class="tag-cloud-link">Studio</a>
                                        <a href="#" class="tag-cloud-link">Wedding</a>
                                        <a href="#" class="tag-cloud-link">Newborn</a>
                                    </div>
                                </div> -->
                                <!-- end widget -->
                            </div>
                        </div>

                    </div>
				</div>
			</section>

</main>

@endsection