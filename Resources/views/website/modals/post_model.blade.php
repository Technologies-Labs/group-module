<div class="add-post-popup" wire:ignore.self>
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


                        {{$modal['title']}}
                </h5>
            </div>
            <div class="post-new">
                <form enctype="multipart/form-data" class="c-form">
                    <input type="text" wire:model.defer="title" required="required" placeholder="Enter Title">
                    @error('title') <span class="error">{{ $message }}</span> @enderror

                    <textarea wire:model.defer="content" rows="5" type="textarea" required="required"
                        placeholder="Enter Content"></textarea>
                    @error('content') <span class="error">{{ $message }}</span> @enderror

                    <div class="uploadimage">
                        <i class="icofont-eye-alt-alt"></i>
                        <label class="fileContainer">
                            <input wire:model.defer="image" type="file">Upload Photo
                            @error('image') <span class="error">{{ $message }}</span> @enderror
                            <div wire:loading wire:target="image" class="sp sp-circle"></div>
                        </label>
                        @error('image') <span class="error">{{ $message }}</span> @enderror

                    </div>
                    <button wire:click.prevent="{{$modal['route']}}"  type="submit" class="main-btn">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

