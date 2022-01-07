<div class="add-group-popup" wire:ignore.self>
    <div class="popup">
        <span class="popup-closed"><i class="icofont-close"></i></span>
        <div class="popup-meta">
            <div class="popup-head">
                <h5><i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-help-circle">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg></i>

                    إنشاء مجموعة
                </h5>
            </div>
            <div class="post-new">
                <form enctype="multipart/form-data" class="c-form">
                    <input type="text" wire:model.defer="name" required="required" placeholder="اكتب اسم المجموعة">
                    @error('name') <span class="error">{{ $message }}</span> @enderror

                    <textarea wire:model.defer="description" rows="5" type="textarea" required="required"
                        placeholder="اكتب وصف للمجموعة"></textarea>
                    @error('description') <span class="error">{{ $message }}</span> @enderror

                    <div class="uploadimage">
                        <i class="icofont-eye-alt-alt"></i>
                        <label class="fileContainer">
                            <input wire:model.defer="image" type="file">تحميل صورة المجموعة
                            @error('image') <span class="error">{{ $message }}</span> @enderror
                            <div wire:loading wire:target="image" class="sp sp-circle"></div>
                        </label>
                    </div>

                    <div class="uploadimage">
                        <i class="icofont-eye-alt-alt"></i>
                        <label class="fileContainer">
                            <input wire:model.defer="coverImage" type="file">تحميل صورة الغلاف
                            @error('coverImage') <span class="error">{{ $message }}</span> @enderror
                            <div wire:loading wire:target="coverImage" class="sp sp-circle"></div>
                        </label>
                    </div>
                    <button wire:click.prevent="createGroup()"  type="submit" class="main-btn">حفظ</button>
                </form>
            </div>
        </div>
    </div>
</div>
