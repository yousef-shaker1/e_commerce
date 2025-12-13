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
                        <label>Color</label>
                        <select wire:model="color_id" class="form-control" required>
                            <option value="" selected> - حدد اللون - </option>
                            @foreach ($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                        @error('color_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" wire:model="image" class="form-control">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-body">
                        <?php $i = 1; ?>
                        @foreach ($sections as $index => $section)
                            <div class="card mb-3 shadow-sm p-3 border-0 rounded">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Add Price and Size #{{ $i++ }}</h5>
                                    <button type="button" class="btn btn-danger btn-sm" wire:click="removeSection({{ $index }})">
                                        <i class="fas fa-trash-alt"></i> Remove
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="sizeSelect{{ $index }}" class="form-label fw-bold">Select Size</label>
                                        <select wire:model.lazy="sections.{{ $index }}.size_id" id="sizeSelect{{ $index }}"
                                            class="form-control" required>
                                            <option value="" selected>-- Select Size --</option>
                                            @foreach ($sizes as $size)
                                                <option value="{{ $size->id }}">{{ $size->size }}</option>
                                            @endforeach
                                        </select>
                                        @error("sections.$index.size_id")
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="priceInput{{ $index }}" class="form-label fw-bold">Price</label>
                                            <input type="number" wire:model="sections.{{ $index }}.price" id="priceInput{{ $index }}"
                                                class="form-control" placeholder="Enter Price" required>
                                            @error("sections.$index.price")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="amountInput{{ $index }}" class="form-label fw-bold">Amount</label>
                                            <input type="number" wire:model="sections.{{ $index }}.amount" id="amountInput{{ $index }}"
                                                class="form-control" placeholder="Enter Amount" required>
                                            @error("sections.$index.amount")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    
                        <div class="text-center mt-4">
                            <button type="button" class="btn btn-primary btn-lg rounded-pill px-4 py-2" wire:click="addSection">
                                <i class="fas fa-plus-circle"></i> Add Sizes
                            </button>
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


        <div wire:ignore.self class="modal fade" id="EditColorModal" tabindex="-1" aria-labelledby="EditColorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditColorModalLabel">edit color</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal">&times;</button>
                </div>
                <form wire:submit.prevent="editColor">
                    <div class="modal-body">
                        <label>Color</label>
                        <select wire:model="color_id" class="form-control" required>
                            @foreach ($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                        @error('color_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="modal-body">
                    <div class="mb-3">
                            <label for="current_img" class="col-form-label">الصورة الحالية للقسم:</label>
                            <br><br>
                            @if ($this->image && is_object($this->image))
                                <div>
                                    <img src="{{ $this->image->temporaryUrl() }}" style="width: 80px; height: 50px;">
                                </div>
                            @elseif ($this->image)
                                <a id="current_img_link" href="{{ Storage::url($this->image) }}">
                                    <img id="" src="{{ Storage::url($this->image) }}"
                                        style="width: 80px; height: 50px;">
                                </a>
                            @endif
                            <br>
                    </div>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" wire:model="image" class="form-control">
                            @error('image')
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
    <div wire:ignore.self class="modal fade" id="deleteColorModal" tabindex="-1" aria-labelledby="deleteColorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteColorModalLabel">Delete Color</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal">&times;</button>
                </div>
                <form wire:submit.prevent="destroyColor">
                    <div class="modal-body">
                        <h4>Are you sure you want to delete this color ?</h4>
                        <input type="text" wire:model.lazy="Color_Product" class="form-control" readonly>
                        @error('Color_Product')
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
