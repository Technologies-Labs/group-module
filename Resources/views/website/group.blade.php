@extends('layouts.simple.master')


{{-- @push('css_after')
<link rel="stylesheet" href="{{ asset('css/select/dist/css/select2.min.css') }}">
@endpush

@push('scripts_after')
<script src="{{ asset('js/select/dist/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.select2-form').select2();
    });
</script>
@endpush --}}

@section('content')
<section>
    <div class="gap" style="padding: 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div id="page-contents" class="row merged20">
                        <livewire:group::group.group-details :group="$group" :isOwner="$isOwner" />

                        <div class="col-lg-8">
                            <div class="group-feed">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="tab-content">
                                            <livewire:group::group.group-posts :group="$group"
                                                :isOwner="$isOwner" />
                                            <livewire:group::group.group-members :group="$group"
                                                :state="Modules\Group\Enum\GroupStateEnum::APPROVED" />
                                            <livewire:group::group.group-members :group="$group"
                                                :state="Modules\Group\Enum\GroupStateEnum::PENDING" />
                                            <livewire:group::group.group-setting :group="$group" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <aside class="sidebar static left">
                                <div class="widget">
                                    <div class="grp-about">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h4>الوصف</h4>
                                                <p>{{$group->group_description}}</p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="share-article mt-5">
                                                    @php
                                                    $facebook =
                                                    Share::page(url()->current())->facebook()->getRawLinks();
                                                    $whatsapp =
                                                    Share::page(url()->current())->whatsapp()->getRawLinks();

                                                    @endphp
                                                    <span>مشاركة المجموعة</span>
                                                    <a href="{{$facebook}}" target="_blank" title="" class="facebook"><i
                                                            class="icofont-facebook"></i></a>

                                                    <a href="{{$whatsapp}}" target="_blank" title="" class="whatsapp"><i
                                                            class="icofont-whatsapp"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- content -->


@endsection

{{-- @section('popups')
@include('components.popups')
@endsection --}}
