<div>
    <!-- Insert Modal -->
<div wire:ignore.self class="modal fade" id="addColorModal" tabindex="-1" aria-labelledby="addColorModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addColorModalLabel">Create color</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
            wire:click="closeModal">&times;</button>
            
        </div>
        <form wire:submit.prevent="saveColor">
            <div class="modal-body">
                <div class="mb-3">
                    <label>Color Name</label>
                    <input type="text" wire:model.live="name" class="form-control">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
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
<div wire:ignore.self class="modal fade" id="deleteColorModal" tabindex="-1" aria-labelledby="deleteColorModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteColorModalLabel">Delete color</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                wire:click="closeModal">&times;</button>
            </div>
            <form wire:submit.prevent="destroyColor">
                <div class="modal-body">
                    <h4>Are you sure you want to delete this data ?</h4>
                    <input type="text" wire:model.live="name" class="form-control" readonly>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
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
