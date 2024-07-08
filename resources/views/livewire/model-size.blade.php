<div>
    <!-- Insert Modal -->
<div wire:ignore.self class="modal fade" id="addSizeModal" tabindex="-1" aria-labelledby="addSizeModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addSizeModalLabel">Create Student</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
            wire:click="closeModal">&times;</button>
            
        </div>
        <form wire:submit.prevent="saveSize">
            <div class="modal-body">
                <div class="mb-3">
                    <label>size Name</label>
                    <input type="text" wire:model.live="size" class="form-control">
                    @error('size') <span class="text-danger">{{ $message }}</span> @enderror
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
<div wire:ignore.self class="modal fade" id="deleteSizeModal" tabindex="-1" aria-labelledby="deleteSizeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSizeModalLabel">Delete Student</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                wire:click="closeModal">&times;</button>
            </div>
            <form wire:submit.prevent="destroySize">
                <div class="modal-body">
                    <h4>Are you sure you want to delete this data ?</h4>
                    <input type="text" wire:model.live="size" class="form-control" readonly>
                    @error('size') <span class="text-danger">{{ $message }}</span> @enderror
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
