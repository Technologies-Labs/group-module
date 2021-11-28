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
                        <livewire:groupmodule::group.group-details :group="$group" :isOwner="$isOwner" />

                        <div class="col-lg-8">
                            <div class="group-feed">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="tab-content">
                                            <livewire:groupmodule::group.group-posts :group="$group" :isOwner="$isOwner"/>
                                            <livewire:groupmodule::group.group-members :group="$group" :state="Modules\GroupModule\Enum\GroupStateEnum::APPROVED" />
                                            <livewire:groupmodule::group.group-members :group="$group" :state="Modules\GroupModule\Enum\GroupStateEnum::PENDING" />
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
                                                <h4>Description</h4>
                                                <p>{{$group->group_description}}</p>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="share-article mt-5">
                                                    <span>share this Group</span>
                                                    <a href="#" title="" class="facebook"><i
                                                            class="icofont-facebook"></i></a>
                                                    <a href="#" title="" class="pinterest"><i
                                                            class="icofont-pinterest"></i></a>
                                                    <a href="#" title="" class="instagram"><i
                                                            class="icofont-instagram"></i></a>
                                                    <a href="#" title="" class="twitter"><i
                                                            class="icofont-twitter"></i></a>
                                                    <a href="#" title="" class="google"><i
                                                            class="icofont-google-plus"></i></a>
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
