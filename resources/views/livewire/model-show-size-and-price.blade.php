<div>
    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="addSizeModal" tabindex="-1" aria-labelledby="addSizeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSizeModalLabel">Create size of {{ $color }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal">&times;</button>

                </div>
                <form wire:submit.prevent="saveSize">
                    <div class="modal-body">
                        <label>Size</label>
                        <select wire:model.live="size_id" class="form-control" required>
                            <option value="" selected> -حدد القسم-</option>
                            @foreach ($sizes_all as $size)
                                <option value="{{ $size->id }}">{{ $size->size }}</option>
                            @endforeach
                        </select>
                        @error('size_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>price</label>
                            <input type="number" wire:model.live="price" class="form-control">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Amount</label>
                            <input type="number" wire:model.live="amount" class="form-control">
                            @error('amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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


    <!-- edit Modal -->

    <div wire:ignore.self class="modal fade" id="UpdateSizeModal" tabindex="-1"
        aria-labelledby="UpdateSizeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="UpdateSizeModalLabel">Edit Product</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal">&times;</button>
                </div>
                <form wire:submit.prevent="UpdateSize">
                    <div class="modal-body">
                        <label>Size</label>
                        <select wire:model.live="size_id" class="form-control" required>
                            <option value="" selected> -حدد القسم-</option>
                            @foreach ($sizes_all as $size)
                                <option value="{{ $size->id }}">{{ $size->size }}</option>
                            @endforeach
                        </select>
                        @error('size_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>price</label>
                            <input type="number" wire:model.live="price" class="form-control">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Amount</label>
                            <input type="number" wire:model.live="amount" class="form-control">
                            @error('amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
                        <input type="text" wire:model.lazy="size_name" class="form-control" readonly>
                        @error('size_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
