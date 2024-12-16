<div>

    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Create Product</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal">&times;</button>
                </div>
                <form wire:submit.prevent="saveProduct">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" wire:model.live="name" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" wire:model.live="img" class="form-control">
                            @error('img')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <input type="text" wire:model.live="description" class="form-control">
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Price</label>
                            <input type="text" wire:model.live="price" class="form-control">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="type">type</label>
                            <select wire:model.live="type" class="form-control" required>
                                <option value="" selected> -حدد النوع-</option>
                                <option value="رجالي">رجالي</option>
                                <option value="حريمي">حريمي</option>
                                <option value="اطفالي">اطفالي</option>
                            </select>
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Section</label>
                            <select wire:model.live="section_id" class="form-control" required>
                                <option value="" selected> -حدد القسم-</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endforeach
                            </select>
                            @error('section_id')
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


    <!-- Update Product Modal -->
    <div wire:ignore.self class="modal fade" id="updateProductModal" tabindex="-1"
        aria-labelledby="updateProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProductModalLabel">Edit Product</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal">&times;</button>
                </div>
                <form wire:submit.prevent="updateProduct">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" wire:model.live="name" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="current_img" class="col-form-label">الصورة الحالية للقسم:</label>
                            <br><br>
                            @if ($this->img && is_object($this->img))
                                <div>
                                    <img src="{{ $this->img->temporaryUrl() }}" style="width: 80px; height: 50px;">
                                </div>
                            @elseif ($this->img)
                                <a id="current_img_link" href="{{ Storage::url($this->img) }}">
                                    <img id="" src="{{ Storage::url($this->img) }}"
                                        style="width: 80px; height: 50px;">
                                </a>
                            @endif
                            <br>
                        </div>

                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" wire:model.live="img" class="form-control">
                            @error('img')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Description</label>
                            <input type="text" wire:model.live="description" class="form-control">
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Price</label>
                            <input type="text" wire:model.live="price" class="form-control">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>type</label>
                            <select wire:model.live="type" class="form-control" required>
                                <option value="" selected disabled> -حدد النوع-</option>
                                <option value="رجالي">رجالي</option>
                                <option value="حريمي">حريمي</option>
                                <option value="اطفالي">اطفالي</option>
                            </select>
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Section</label>
                            <select wire:model.live="section_id" class="form-control" required>
                                <option value="" selected disabled> -حدد القسم-</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endforeach
                            </select>
                            @error('section_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Product Modal -->
    <div wire:ignore.self class="modal fade" id="deleteProductModal" tabindex="-1"
        aria-labelledby="deleteProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProductModalLabel">Delete Product</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal">&times;</button>
                </div>
                <form wire:submit.prevent="destroyProduct">
                    <div class="modal-body">
                        <h4>Are you sure you want to delete this data ?</h4>
                        <label>Name</label>
                        <input type="text" wire:model.lazy="name" class="form-control" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
