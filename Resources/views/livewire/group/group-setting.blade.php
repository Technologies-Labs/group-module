<div class="tab-pane fade" id="setting" wire:ignore.self>

    <div class="main-wraper">
        <h4 class="main-title">الإعدادات الخاصة بالمجموعة</h4>
        <div class="add-credits">
            <form  enctype="multipart/form-data">
                <fieldset class="row merged-10">
                    <div class="mb-4 col-12">
                        <b>اسم المجموعة:</b>
                        <input  wire:model.defer="name" class="uk-input" type="text" placeholder="الاسم">
                        @error('name') <em class="text-red-500 text-xs">{{ $message }}</em> @enderror
                    </div>
                    <div class="mb-4 col-12">
                        <b>الوصف:</b>
                        <textarea  wire:model.defer='description' class="uk-input" cols="10" rows="5"></textarea>
                        @error('description') <em class="text-red-500 text-xs">{{ $message }}</em> @enderror
                    </div>

                    <div class="mb-4 col-12">
                        <b>صورة المجموعة:</b>
                        <input wire:model.defer='image' class="uk-input" type="file" placeholder="">
                        @error('image') <em class="text-red-500 text-xs">{{ $message }}</em> @enderror
                        <div wire:loading wire:target="image" class="sp sp-circle"></div>
                    </div>

                    <div class="mb-4 col-12">
                        <b>صورة الغلاف:</b>
                        <input wire:model.defer='coverImage' class="uk-input" type="file" placeholder="">
                        @error('coverImage') <em class="text-red-500 text-xs">{{ $message }}</em> @enderror
                        <div wire:loading wire:target="coverImage" class="sp sp-circle"></div>
                    </div>

                    <div class="mt-3 col-lg-12">
                        <button  wire:click.prevent="save"   type="submit" class="button primary circle">حفظ </button>
                    </div>
                </fieldset>
            </form>
            <p>
{{--                <b>Special Note:</b>--}}
{{--                "But I must explain to you how all this mistaken idea of denouncing pleasure and--}}
{{--                praising pain was born and I will give you a complete account of the system,--}}
{{--            </p>--}}
        </div>
    </div>
    <div wire:loading class="sp sp-circle"></div>

</div>
