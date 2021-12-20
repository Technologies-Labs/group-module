<div class="tab-pane active fade show" id="posts" wire:ignore.self>
    @php
    use Modules\Group\Enum\GroupImagesEnum;
    @endphp
    @include('components.loading')

    @can('post-create')
    @if ($isOwner)
    @include('group::website.components.create_post')
    @endif
    @endcan

    @foreach ($posts as $post)
    <div class="main-wraper" id="group-post-{{$post->id}}">
        <div class="user-post">
            <div class="friend-info">
                <figure>
                    <em>
                        <svg style="vertical-align: middle;" xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                            viewBox="0 0 24 24">
                            <path fill="#7fba00" stroke="#7fba00"
                                d="M23,12L20.56,9.22L20.9,5.54L17.29,4.72L15.4,1.54L12,3L8.6,1.54L6.71,4.72L3.1,5.53L3.44,9.21L1,12L3.44,14.78L3.1,18.47L6.71,19.29L8.6,22.47L12,21L15.4,22.46L17.29,19.28L20.9,18.46L20.56,14.78L23,12M10,17L6,13L7.41,11.59L10,14.17L16.59,7.58L18,9L10,17Z">
                            </path>
                        </svg></em>
                    <img alt="" src="{{ asset('storage') }}/{{$user->image}}">
                </figure>
                <div class="friend-name">
                    @if ($isOwner && (Auth::user()->can('post-edit') || Auth::user()->can('post-delete')) )
                    <div class="more" wire:ignore.self>
                        <div class="more-post-optns">
                            <i class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-more-horizontal">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                </svg></i>

                            <ul>
                                @can('post-edit')
                                <li wire:click='editPost({{$post->id}})' class="add-post">
                                    <i class="icofont-pen-alt-1"></i>Edit Post
                                    <span>Edit This Post within a Hour</span>
                                </li>
                                @endcan

                                @can('post-delete')
                                <li wire:click='deletePost({{$post->id}})'>
                                    <i class="icofont-ui-delete"></i>Delete Post
                                    <span>If inappropriate Post By
                                        Mistake</span>
                                </li>
                                @endcan

                            </ul>
                        </div>
                    </div>
                    @endif

                    <ins><a title="" href="javascript:void(0);">{{$user->full_name}}</a></ins>
                    <span><i class="icofont-globe"></i> published: {{$post->created_at->diffForHumans()}}</span>
                </div>
                <div class="post-meta">
                    <figure id="main">
                        <img src="{{ asset('storage') }}/{{GroupImagesEnum::POSTS_IMAGE_PATH}}{{$post->image}}" alt="">
                    </figure>
                    <a href="javascript:void(0);" class="post-title" target="_blank">{{$post->title}}</a>
                    <div>
                        <p class="details">{{$post->content}}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endforeach

    <div x-data="{
            observe() {
                let observer = new IntersectionObserver((entries) => {
                console.log(entries)
                entries.forEach(entry => {
                    if (entry.isIntersecting)
                    {
                        @this.call('loadMore')
                    }
                   })
                },{
                   root: null
                })
                    observer.observe(this.$el)
            }
        }" x-init="observe">

    </div>

    @if($posts && $posts->hasMorePages())
    @include('components.loading')
    @endif
    @can('post-create')
    @include('group::website.modals.post_model')
    @endcan

</div>
