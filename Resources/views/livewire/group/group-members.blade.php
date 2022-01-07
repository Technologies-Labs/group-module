<div class="tab-pane fade" id="members-{{$state}}" wire:ignore.self>
    <div class="main-wraper">
        <h4 class="main-title">الأعضاء </h4>

        <div class="row merged-10 remove-ext20">

            @foreach ($users as $member)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="friendz">
                    <figure><img src="{{ asset('storage') }}/{{$member->image}}" alt="">
                    </figure>
                    <span><a href="#" title="">{{$member->name}}</a></span>
                    @can('group-member-approve')
                    @if ($state == Modules\Group\Enum\GroupStateEnum::PENDING)
                    <a href="javascript:void(0)" wire:click="approvedMember({{$member->pivot->id}})" title=""
                        data-ripple=""><i class="icofont-star"></i>Approve</a>
                    @endif
                    @endcan

                    @can('group-member-delete')
                    @if ($state == Modules\Group\Enum\GroupStateEnum::APPROVED)
                    <a href="javascript:void(0)" wire:click="deleteMember({{$member->pivot->id}})" title=""
                        data-ripple=""><i class="icofont-star"></i>حذف</a>
                    @endif
                    @endcan



                </div>
            </div>
            @endforeach
            <div class="col-lg-12">
                <div wire:loading class="sp sp-circle"></div>
            </div>



            <div class="col-lg-12">
                @if( $users && $users->hasMorePages())
                    {!! $users->links() !!}
                @endif
            </div>
        </div>
    </div>
</div>
