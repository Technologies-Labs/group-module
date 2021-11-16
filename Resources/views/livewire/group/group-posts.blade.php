<div class="tab-pane active fade show" id="posts"  wire:ignore.self>
    <div class="main-wraper">
        <span class="new-title">Create New Post</span>
        <div class="new-post">
            <form method="post">
                <i class="icofont-pen-alt-1"></i>
                <input type="text" placeholder="Create New Post">
            </form>

        </div>
    </div><!-- create new post -->

    <div class="main-wraper">
        <div class="user-post">
            <div class="friend-info">
                <figure>
                    <em>
                        <svg style="vertical-align: middle;"
                            xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                            viewBox="0 0 24 24">
                            <path fill="#7fba00" stroke="#7fba00"
                                d="M23,12L20.56,9.22L20.9,5.54L17.29,4.72L15.4,1.54L12,3L8.6,1.54L6.71,4.72L3.1,5.53L3.44,9.21L1,12L3.44,14.78L3.1,18.47L6.71,19.29L8.6,22.47L12,21L15.4,22.46L17.29,19.28L20.9,18.46L20.56,14.78L23,12M10,17L6,13L7.41,11.59L10,14.17L16.59,7.58L18,9L10,17Z">
                            </path>
                        </svg></em>
                    <img alt="" src="{{ asset('images/resources/user5.jpg') }}">
                </figure>
                <div class="friend-name">
                    <div class="more">
                        <div class="more-post-optns">
                            <i class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-more-horizontal">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                </svg></i>
                            <ul>
                                <li>
                                    <i class="icofont-pen-alt-1"></i>Edit Post
                                    <span>Edit This Post within a Hour</span>
                                </li>
                                <li>
                                    <i class="icofont-ban"></i>Hide Post
                                    <span>Hide This Post</span>
                                </li>
                                <li>
                                    <i class="icofont-ui-delete"></i>Delete Post
                                    <span>If inappropriate Post By
                                        Mistake</span>
                                </li>
                                <li>
                                    <i class="icofont-flag"></i>Report
                                    <span>Inappropriate content</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <ins><a title="" href="time-line.html">Andrew Jhon</a></ins>
                    <span><i class="icofont-globe"></i> published: Sep,15
                        2020</span>
                </div>
                <div class="post-meta">
                    <figure id="main">
                        <img src="{{ asset('images/resources/laptop.png') }}" alt="">
                    </figure>
                    <a href="https://themeforest.net/item/winku-social-network-toolkit-responsive-template/22363538"
                        class="post-title" target="_blank">Winku Social Network
                        with Company Pages Theme</a>
                    <div>
                        <p class="details">
                            “Winku” is a social community mobile app kit with
                            features. user can use this app for sharing blog,
                            posts, timeline, create Group, Create Pages,
                            chat/Messages, Movies sharing, QA, and Much More.
                        </p>
                    </div>
                    <p class="product-single__price" style="margin-bottom: 9px;">
                        <s class="old-price">
                            <span>$600.00</span>
                        </s>
                        <span class="new-price">
                            <span>$500.00</span>
                        </span>
                        <span class="discount">
                            <span>|</span>&nbsp;
                            <span class="off">(<span>16</span>%)</span>
                        </span>
                    </p>
                    <div class="we-video-info">
                        <div class="stat-tools" style="width: auto;">
                            <a title="" href="#"><i class="icofont-heart"></i></a>
                            <!-- <a title="" href="#"><i class="icofont-shopping-cart mr-2"></i>Add to cart</a> -->
                            <a title="" href="#" class="comment-to"><i
                                    class="icofont-comment"></i> Comment</a>
                            <a title="" href="#" class="share-to"><i
                                    class="icofont-share-alt"></i> Share</a>
                            <div class="new-comment" style="display: none;">
                                <form method="post">
                                    <input type="text" placeholder="write comment">
                                    <button type="submit"><i
                                            class="icofont-paper-plane"></i></button>
                                </form>
                                <div class="comments-area">
                                    <ul>
                                        <li>
                                            <figure><img alt=""
                                                    src="{{ asset('images/resources/user1.jpg') }}">
                                            </figure>
                                            <div class="commenter">
                                                <h5><a title="" href="#">Jack
                                                        Carter</a></h5>
                                                <span>2 hours ago</span>
                                                <p>
                                                    i think that some how, we
                                                    learn who we really are and
                                                    then live with that
                                                    decision, great post!
                                                </p>
                                                <span>you can view the more
                                                    detail via link</span>
                                                <a title=""
                                                    href="#">https://www.youtube.com/watch?v=HpZgwHU1GcI</a>
                                            </div>
                                            <a title="Like" href="#"><i
                                                    class="icofont-heart"></i></a>
                                            <a title="Reply" href="#"
                                                class="reply-coment"><i
                                                    class="icofont-reply"></i></a>
                                        </li>
                                        <li>
                                            <figure><img alt=""
                                                    src="{{ asset('images/resources/user2.jpg') }}">
                                            </figure>
                                            <div class="commenter">
                                                <h5><a title="" href="#">Ching
                                                        xang</a></h5>
                                                <span>2 hours ago</span>
                                                <p>
                                                    i think that some how, we
                                                    learn who we really are and
                                                    then live with that
                                                    decision, great post!
                                                </p>
                                            </div>
                                            <a title="Like" href="#"><i
                                                    class="icofont-heart"></i></a>
                                            <a title="Reply" href="#"
                                                class="reply-coment"><i
                                                    class="icofont-reply"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <a href="product-detail.html" title="" class="reply"
                            style="margin-top: 20px;">Read more <i
                                class="icofont-arrow-right"></i></a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
