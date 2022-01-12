<div class="col-lg-12">
    @php
    use Modules\Group\Enum\GroupImagesEnum;
    @endphp
    <div class="group-avatar">
        <img src="{{ asset('storage') }}/{{GroupImagesEnum::COVER_IMAGE.$group->group_cover_image}}" alt="">
        @if ($isOwner)
        @can('group-member-create')
        <a href="#" title="" class="add-member"><i class="icofont-check-circled"></i>إضافة أعضاء</a>
        @endcan

        @endif

    </div>
    <div class="grp-info about">
        <h4>{{$group->group_name}}</h4>

        <ul class="joined-info">
            <li><span>مجموعة خاصة</span><i class="icofont-lock ml-2"></i></li>
            <!-- <li><span>public group</span><i class="icofont-globe ml-2"></i></li> -->
            <li><span>الأعضاء:</span> {{$members->count()}}</li>
            <li></li>
        </ul>

        <ul class="nav nav-tabs about-btn mt-3">
            @if ($isOwner)
            @can('post-list')
            <li class="nav-item"><a class="active" href="#posts" data-toggle="tab" wire:ignore>المنشورات</a></li>
            @endcan

            @can('group-member-list')
            <li class="nav-item" wire:click="$emit('loadApprovedMembers')"><a class=""
                    href="#members-{{Modules\Group\Enum\GroupStateEnum::APPROVED}}" data-toggle="tab"
                    wire:ignore>الأعضاء</a></li>
            <li class="nav-item" wire:click="$emit('loadPendingMembers')"><a class=""
                    href="#members-{{Modules\Group\Enum\GroupStateEnum::PENDING}}" data-toggle="tab"
                    wire:ignore>Group Join</a></li>
            @endcan


            <li class="nav-item"><a class="" href="#setting" data-toggle="tab" wire:ignore>الإعدادات</a></li>
            @endif
        </ul>


        <ul class="more-grp-info mt-3">
            <li>
                <form class="c-form" method="post">
                    <input type="text" placeholder="بحث ..">
                    <i class="icofont-search-1"></i>
                </form>
            </li>
        </ul>
    </div>
    @can('group-member-create')
    @include('group::website.modals.add_member_model')
    @endcan

</div>
