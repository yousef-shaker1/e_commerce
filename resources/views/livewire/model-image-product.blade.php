<div>
    <!-- Insert Modal -->
<div wire:ignore.self class="modal fade" id="addImageModal" tabindex="-1" aria-labelledby="addImageModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addImageModalLabel">Create images</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
            wire:click="closeModal">&times;</button>
            
        </div>
        <form wire:submit.prevent="saveImages">
            <div class="modal-body">
                <div class="mb-3">
                    <label>Images</label>
                    <input type="file" wire:model.live="images" multiple class="form-control">
                    @error('images.*') <span class="text-danger">{{ $message }}</span> @enderror
                </div>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="closeModal"
                    data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
</div>


<!-- Delete Student Modal -->
<div wire:ignore.self class="modal fade" id="deleteImageModal" tabindex="-1" aria-labelledby="deleteImageModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteImageModalLabel">Delete image</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                wire:click="closeModal">&times;</button>
            </div>
            <form wire:submit.prevent="destroyImage">
                <div class="modal-body">
                    <h4>Are you sure you want to delete this data ?</h4>
                    <div class="mb-3">
                        <label for="current_img" class="col-form-label">الصورة الحالية للقسم:</label>
                        <br><br>
                    
                            <a id="current_img_link" href="{{ Storage::url($this->img) }}">
                                <img id="" src="{{ Storage::url($this->img) }}"
                                    style="width: 80px; height: 50px;">
                            </a>
                        <br>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
