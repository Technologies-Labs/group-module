@php
    use Modules\GroupModule\Enum\GroupImagesEnum;
@endphp
<div class="tab-pane fade "  id="groups" wire:ignore.self>
    @include('groupmodule::website.components.create_group')

    <div class="main-wraper">
        <h4 class="main-title"><i class=""><svg class="feather feather-users" stroke-linejoin="round"
                    stroke-linecap="round" stroke-width="2" stroke="currentColor" fill="none" viewBox="0 0 24 24"
                    height="18" width="18" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle r="4" cy="7" cx="9"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg></i>
            Groups
        </h4>
        <div class="row col-xs-6">

            @forelse ($groups as $group)
            <div class="col-lg-3 col-md-4 col-sm-4">
                <div class="group-box">
                    <figure><img alt="" src="{{ asset('storage/'.GroupImagesEnum::IMAGE.$group->group_image)}}">
                    </figure>
                    <a title="" href="{{ route('group.details', ['group' => $group]) }}">{{$group->group_name}}
                         @if ($group->is_owner)
                        (Owner)
                        @endif

                    </a>
                    {{-- <span>{{$group->members->count()}} Members</span> --}}
                </div>
            </div>
            @empty

            @endforelse

        </div>
        @include('components.loading')
    </div>

    @include('groupmodule::website.modals.create_group_model')

</div>
