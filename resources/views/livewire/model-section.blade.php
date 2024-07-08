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
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>صورة القسم</label>
                        <input type="file" wire:model.live="img" class="form-control">
                        @error('img') <span class="text-danger">{{ $message }}</span> @enderror
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


<!-- Update Student Modal -->
<div wire:ignore.self class="modal fade" id="updateSectionModal" tabindex="-1" aria-labelledby="updateSectionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateSectionModalLabel">Edit Student</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                wire:click="closeModal">&times;</button>
            </div>
            <form wire:submit.prevent="updateStudent">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>اسم القسم</label>
                        <input type="text" wire:model.live="name" class="form-control">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="current_img" class="col-form-label">الصورة الحالية للقسم:</label>
                        <br>
                        <a id="current_img_link" href="{{ Storage::url($img) }}"><img id="" src="{{ Storage::url($img) }}"
                                style="width: 80px; height: 50px;"></a>
                        <br>
                    </div>
                    <div class="mb-3">
                        <label>صورة القسم</label>
                        <input type="file" wire:model.live="img" class="form-control">
                        @error('img') <span class="text-danger">{{ $message }}</span> @enderror
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
<div wire:ignore.self class="modal fade" id="deleteSectionModal" tabindex="-1" aria-labelledby="deleteSectionModalLabel"
    aria-hidden="true">
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






























{{-- 

    <!-- edit -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('section.update', $i) }}" method="post" autocomplete="off"
                        enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="section_name" class="col-form-label">اسم القسم:</label>
                            <input class="form-control" name="name" id="section_name" type="text">
                            <div class="form-group">
                                <label for="current_img" class="col-form-label">الصورة الحالية للقسم:</label>
                                <br>
                                <a id="current_img_link" href="#"><img id="current_img" src="#"
                                        style="width: 80px; height: 50px;"></a>
                                <br>
                                <label for="img">صورة القسم</label>
                                <input type="file" class="form-control" id="img" name="img">
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">تاكيد</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- delete -->
    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('section.destroy', $i) }}" method="post">
                    @method('delete')
                    @csrf
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="section_name" id="section_name" type="text" vlaue=""
                            readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
 --}}

</div>
