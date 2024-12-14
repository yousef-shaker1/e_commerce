<div>

    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="addSectionModal" tabindex="-1" aria-labelledby="addSectionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSectionModalLabel">Create Section</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal">&times;</button>
                </div>
                <form wire:submit.prevent="saveSection">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>اسم القسم</label>
                            <input type="text" wire:model.live="name" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>صورة القسم</label>
                            <input type="file" wire:model.live="img" class="form-control">
                            @error('img')
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


    <!-- Update Section Modal -->
    <div wire:ignore.self class="modal fade" id="updateSectionModal" tabindex="-1"
        aria-labelledby="updateSectionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateSectionModalLabel">Edit Section</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal">&times;</button>
                </div>
                <form wire:submit.prevent="updateSection">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>اسم القسم</label>
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
                            <label>صورة القسم</label>
                            <input type="file" wire:model.live="img" class="form-control">
                            @error('img')
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

    <!-- Delete Student Modal -->
    <div wire:ignore.self class="modal fade" id="deleteSectionModal" tabindex="-1"
        aria-labelledby="deleteSectionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSectionModalLabel">Delete Student</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal">&times;</button>
                </div>
                <form wire:submit.prevent="destroyStudent">
                    <div class="modal-body">
                        <h4>Are you sure you want to delete this data ?</h4>
                        <label>اسم القسم</label>
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
