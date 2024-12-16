<div>
    <!-- Delete order Modal -->
    <div wire:ignore.self class="modal fade" id="destroyOrderModal" tabindex="-1" aria-labelledby="destroyOrderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="destroyOrderModalLabel">Delete Student</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal">&times;</button>
                </div>
                <form wire:submit.prevent="destroyOrder">
                    <div class="modal-body">
                        <h4>Are you sure you want to delete this data ?</h4>
                        <label>Customer Name</label>
                        <input type="text" wire:model.lazy="customer_name" class="form-control" readonly>
                        @error('customer_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>
                        <label>Product Name</label>
                        <input type="text" wire:model.lazy="product_name" class="form-control" readonly>
                        @error('product_name')
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
