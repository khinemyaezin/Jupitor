<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="card-title">Type detail</div>
        
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <label for="code" class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control mb-2" id="code" name="code" required value="{{ $type?->code }}">
                <small class="text-muted">Unique code : about,service.</small>
            </div>
        </div>
        <div class="row mb-3">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" name="title" required
                    value="{{ $type?->title }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="body" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="body" name="body" required
                    value="{{ $type?->body }}">
            </div>
        </div>
        <fieldset class="row mb-3">
            <legend class="col-form-label col-sm-2 pt-0">Status</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="allow_body" name="allow_body"
                        @if ($type?->allow_body) checked @endif>
                    <label class="form-check-label" for="allow_body">
                        Has subheading
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="allow_detail" name="allow_detail"
                        @if ($type?->allow_detail) checked @endif>
                    <label class="form-check-label" for="allow_detail">
                        Has subheading detail page
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_unique" name="is_unique"
                        @if ($type?->is_unique) checked @endif>
                    <label class="form-check-label" for="is_unique">
                        Is single post
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="allow_pagination" name="allow_pagination"
                        @if ($type?->allow_pagination) checked @endif>
                    <label class="form-check-label" for="allow_pagination">
                        Redirect to read more
                    </label>
                </div>

            </div>
        </fieldset>
    </div>
    <div class="card-footer d-flex justify-content-end">
        <input type="submit" value="Submit" class="btn btn-primary">
    </div>
</div>
