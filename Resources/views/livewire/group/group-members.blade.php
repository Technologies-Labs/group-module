<div class="tab-pane fade" id="members-{{$state}}" wire:ignore.self>
    <div class="main-wraper">
        <h4 class="main-title">Members </h4>

        <div class="row merged-10 remove-ext20">
            @foreach ($users as $member)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="friendz">
                    <figure><img src="{{ asset('storage') }}/{{$member->image}}" alt="">
                    </figure>
                    <span><a href="#" title="">{{$member->name}}</a></span>
                    {{-- <ins>Bz University, Pakistan</ins> --}}
                    @if ($state == Modules\GroupModule\Enum\GroupStateEnum::PENDING)
                        <a href="javascript:void(0)" wire:click="approvedMember({{$member->pivot->id}})" title="" data-ripple=""><i class="icofont-star"></i>Approve</a>
                    @endif
                    @if ($state == Modules\GroupModule\Enum\GroupStateEnum::APPROVED)
                        <a href="javascript:void(0)" wire:click="deleteMember({{$member->pivot->id}})" title="" data-ripple=""><i class="icofont-star"></i>Cancel</a>
                    @endif

                </div>
            </div>
            @endforeach

            <div class="col-lg-12">
            {{$users->links()}}
            </div>
        </div>
    </div>
</div>
