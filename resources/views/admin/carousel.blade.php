@extends('layouts.admin')
@section('content')

    <div class="container py-3 py-md-0">
        <div class="forhead d-flex flex-wrap flex-sm-nowrap justify-content-between align-items-center forehead-nav">
            <x-framework.forehead-result :title="'Carousel'" />
           
        </div>
    </div>
    <div class="container">
        <x-framework.alert :errors="$errors->all()" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="callout bd-callout-info rounded-0 mb-3">
                    <span class="fs-6">General</span>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <form action="{{ route('admin.forehead.updateParent') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="card-header">
                            <span class="card-title">Header</span>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" id="id" name="id" hidden
                                value="{{ $result->data?->id }}">
                            <div class="mb-3 row">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $result->data?->title }}" placeholder="company name or quote..">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="body" class="col-sm-2 col-form-label">Body</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="body">{{ $result->data?->body }}</textarea>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <input type="submit" value="Submit" class="btn btn-primary">
                        </div>
                    </form>

                </div>
                @if ($result->data)
                    <div class="card">
                        <div class="card-header">
                            <span class="card-title">Carousels</span>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="d-flex mb-2 gap-2 " role="group" aria-label="First group">
                                    <button type="button" class="btn btn-secondary btn-sm"
                                        @if (count($result->data->carousels) == 0) disabled @endif onclick="saveCarouselSorting()">
                                        Save position
                                        <i class="bi bi-arrows-move"></i>
                                    </button>
                                    <a type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                        onclick="showModalCarousel()" data-bs-target="#modal-forehead-carousel">
                                        New
                                        <i class="bi bi-plus-lg"></i>
                                    </a>

                                </div>
                                <div class="sortable d-flex gap-2 flex-column list-group list-group-flush">
                                    @foreach ($result->data->carousels as $item)
                                        <div class="list-group-item rounded d-sm-flex justify-content-between align-items-center p-3 index"
                                            data-id="{{ $item->id }}">
                                            <div class="d-sm-flex align-items-center mb-1 mb-sm-0">
                                                <!-- Avatar -->
                                                <div class="avatar avatar-md flex-shrink-0">
                                                    <img class="avatar-img rounded-circle"
                                                        src="{{ asset('storage/' . $item->image_url) }}" alt="avatar">
                                                </div>
                                                <!-- Info -->
                                                <div class="ms-0 ms-sm-2 mt-2 mt-sm-0">
                                                    <h6 class="mb-1">{{ $item->title }}
                                                    </h6>
                                                    <ul class="list-inline mb-0 small">
                                                        <li class="list-inline-item fw-light me-2 mb-1 mb-sm-0">
                                                            {{ $item->group ? $item->group->title : '-' }}
                                                        </li>
                                                        <li class="list-inline-item fw-light me-2 mb-1 mb-sm-0">
                                                            {{ $item->created_at->diffForHumans() }}
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="btn-group" role="group" aria-label="First group">
                                                <button type="button" class="btn btn-light"
                                                    onclick="deleteCarousel(this, {{ $item->id }} )">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                                <button type="button" class="btn btn-light" onclick="showCarousel(this)"
                                                    data-id="{{ $item->id }}">
                                                    <i class="bi bi-folder2-open"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-forehead-carousel" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.forehead.updateChild') }}" id="forehead-caurosel-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit your carousel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" hidden name="id">
                        <div class="dropzone dropzone-single dz-clickable mb-2">
                            <div class="dz-preview dz-preview-single">

                            </div>
                            <div class="dz-default dz-message d-flex flex-column">
                                <button class="dz-button" type="button"
                                    onclick="document.getElementById('fc-image').click()">
                                    Choose
                                </button>

                            </div>
                            <input type="file" hidden name="image_url" id="fc-image" onchange="readImage(this,insertImage)">
                        </div>
                        <div class="mb-3">
                            <label for="fc-title" class="form-label">Title</label>
                            <input type="text" class="form-control" data-parent-id="-1" name="title" id="fc-title" required>
                        </div>
                        <div class="mb-3">
                            <label for="fc-body" class="form-label">Body</label>
                            <textarea class="form-control" data-parent-id="-1" name="body" id="fc-body" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="fc-groupid" class="form-label">Link to headline</label>
                            <select name="fk_group_id" id="fc-groupid" class="form-select">
                                <option value="-1" disabled selected>select.</option>
                                @foreach ($groups as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        let foreheadBody = null;
        let groups = {!! json_encode($groups, JSON_HEX_TAG) !!};
        let carousels = {!! json_encode($result->data?->carousels, JSON_HEX_TAG) !!};
        document.addEventListener("DOMContentLoaded", function(event) {
            //listener
            Sortable.create(document.querySelector('.sortable'), {
                handle: '.index',
                animation: 150,
            });

        });

        function quillInit() {
            foreheadBody = new Quill(document.querySelector('#forehead-body'), Utility.quillModules);
            let qltoolbar = document.querySelectorAll('.ql-toolbar');
            $('.ql-toolbar').each(function() {
                $(this).addClass('sticky-top margin-70 bg-light shadow-sm rounded border-0');
            })
        }

        function readImage(e, callback) {
            const input = e;
            let base64;
            for (let f of input.files) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    base64 = e.target.result;
                    callback(base64);

                };
                reader.readAsDataURL(f);
            }
        }

        function insertImage(base64) {
            let imageContainer = document.createElement('div');
            imageContainer.classList.add('dz-preview-cover', 'dz-processing', 'dz-image-preview');
            imageContainer.innerHTML = `
                        <img class="dz-preview-img" src="${ base64 }">
                `;
            let preview = document.querySelector('div.dz-preview.dz-preview-single');
            preview.innerHTML = "";
            preview.appendChild(imageContainer);
            document.querySelector('div.dropzone.dropzone-single').classList.add('dz-max-files-reached');
        }


        function showCarousel(e) {

            const id = $(e).attr('data-id');
            const row = $(e).closest('.index');
            let carousel = carousels.find(e => e.id == id);
            carousel.image_url = $(row).find('img').attr('src');
            insertImage($(row).find('img').attr('src'));
            $('#forehead-caurosel-form input[name=id]').val(id);
            $('#forehead-caurosel-form input[name=title]').val(carousel.title);
            $('#forehead-caurosel-form textarea[name=body]').val(carousel.body);
            $("#forehead-caurosel-form select[name=fk_group_id]").val(carousel.fk_group_id ? carousel.fk_group_id : '-1')
                .change();

            let carouselModal = new bootstrap.Modal(document.getElementById('modal-forehead-carousel'));
            carouselModal.show();
        }

        function showModalCarousel() {
            $('#forehead-caurosel-form').trigger('reset');
            $('.dz-preview-cove.dz-processing.dz-image-preview').remove();
            document.querySelector('div.dropzone.dropzone-single').classList.remove('dz-max-files-reached');
        }

        function saveCarouselSorting() {
            let data = {
                list: {}
            }
            $('.index').each(function(e) {
                const index = e + 1;
                const id = $(this).attr('data-id');
                data.list[id] = index;
            });
            Net.post('/api/forehead/carousel', data).then(e => {
                Utility.showReturnMessage(e.message,e.success, document.querySelector('.alert-container'));
            })
        }

        function deleteCarousel(event, id) {
            Net.delete('/api/forehead/carousel/' + id).then(e => {
                console.log(e);
                $(event).closest('.index').remove();

            })

        }
    </script>
@endpush
