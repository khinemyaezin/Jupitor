<div class="card mb-3">
    <div class="card-header">
        <span class="card-title">Theme</span>
    </div>
    <div class="card-body">
        <div class="row ">
            <div class="col-md-12 mb-3">

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" placeholder=""
                    value="{{ $theme?->title }}"
                        name="title">
                </div>
                <div class="mb-3">
                    <label for="theme_body" class="form-label">HTML</label>
                    <textarea class="form-control mb-2" id="theme_body" rows="5" name="theme_body">{{ $theme?->body }}</textarea>
                    <button class="btn btn-secondary btn-sm" type="button" id="btn-minify" onclick="minifyHtml()">Minify</button>
                    <button class="btn btn-secondary btn-sm" type="button" id="btn-pretty" onclick="prettyHtml()">Pretty</button>
                </div>
                <div class="mb-3">
                    <label for="max_articles" class="form-label">Max subheadings</label>
                    <input type="number" class="form-control w-md-25" id="max_articles"
                    value="{{ $theme?->max_articles }}"
                        placeholder="" name="max_articles">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" role="switch"
                        @if ( $theme?->tree == 1)
                            checked
                        @endif
                        id="is-heading" name="tree">
                    <label class="form-check-label" for="is-heading">Heading</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" role="switch"
                    @if ( $theme?->image_type == 'background-image')
                    checked
                @endif
                        id="is-bg-image" name="image_type_bg">
                    <label class="form-check-label" for="is-bg-image">background
                        image</label>
                </div>

            </div>
            <hr>
            <div class="col-md-12 text-muted ">
                <p><small>Heading</small></p>
                <ul>
                    <li><small>class <strong>header</strong> must be wrapped by upper layer</small></li>
                    <li><small>class <strong>group-title</strong> for title text</small></li>
                    <li><small>class <strong>group-content</strong> for body text</small></li>
                    <li><small>class <strong>group-contents</strong> for subheading themes</small></li>
                </ul>
                <p><small>Subheading</small></p>
                <ul>
                    <li><small>class <strong>col</strong> must be wrapped by upper layer</small></li>
                    <li><small>class <strong>article-title</strong> for title text</small></li>
                    <li><small>class <strong>theme-content</strong> for body text</small></li>
                    <li><small>class <strong>article-image</strong> for image</small></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-end">
        <input type="submit" class="btn btn-primary" value="Submit">
    </div>
   
</div>