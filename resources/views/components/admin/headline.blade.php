<div class="container admin-headline">
    <div class="json-message"></div>
    <div class="row">
        <div class="col-md-4">

            <div class="list-group bd-callout mb-3" id="list-tab">
                <a class="text-decoration-none list-group-item-action p-3 bd-callout-item border-bottom active"
                    id="group-tab" data-bs-toggle="list" href="#list-group" role="tab" aria-controls="list-group">
                    Heading

                </a>
                <a class="text-decoration-none list-group-item-action bd-callout-item border-bottom" id="subheading-tab"
                    data-bs-toggle="list" href="#list-article" role="tab" aria-controls="list-article">
                    <div class="w-100 p-3 btn-toggle" data-bs-toggle="collapse" data-bs-target='#articles-collapse'
                        id="articles-collapse-toggle" aria-expanded="false" aria-controls="articles-collapse">

                        <span>Subheadings</span>
                        @if (request('groupid'))
                            <span class="menu-arrow ms-auto"></span>
                        @endif

                    </div>
                </a>

            </div>
            <div class="collapse" id="articles-collapse" aria-expanded="false">
                <div class="list-group my-3 gap-2 ms-3" role="tablist" id="sortable-articles-list"
                    data-sortable="{{ $sortable ? 1 : 0 }}">
                    @if ($group->data)
                        @foreach ($group->data->articles as $a)
                            <div
                                class="d-flex list-group-item list-group-item-action p-0 border-0 rounded-1 @if (request('articleid') == $a->id) active @endif">
                                <a href="{{ route('admin.article.getById', ['groupid' => request('groupid'), 'articleid' => $a->id]) . '#subheading-tab' }}"
                                    class="d-block p-2 text-decoration-none d-flex w-100">
                                    <img class="bd-placeholder-img flex-shrink-0 me-2 rounded-circle" width="30"
                                        height="30" src="{{ $a->image_url }}"
                                        onerror="this.src = '{{ asset('storage/essential/def-img.jpg') }}' ">
                                    <span class="align-self-center">{{ $a->title }}</span>
                                </a>
                            </div>
                        @endforeach

                    @endif

                </div>
                <div class="mb-3">
                    @if ($group->data)
                        <a class="ms-3 btn btn-secondary btn-sm "
                            href="{{ route('admin.article.index', ['groupid' => request('groupid')]) . '#subheading-tab' }}"
                            id="new-article-btn">
                            Create new
                            <i class="bi bi-plus-lg"></i>
                        </a>
                    @endif
                </div>


            </div>
        </div>
        <div class="col-md-8">

            <div class="tab-content">
                <div class="tab-pane fade show active" id="list-group" role="tabpanel"
                    aria-labelledby="list-group-list">
                    <h5>Heading</h5>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row mb-3 g-3">
                                <div class="col-sm-12 col-md-6">
                                    <div class="row g-3 ">
                                        <div class="col-lg-12 col-sm-12">
                                            <label for="group_title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="group_title"
                                                name="group_title"
                                                @if ($group->data) value="{{ $group->data->title }}" @else value="" @endif
                                                @if ($pageType == 'article_new') readonly @endif
                                                placeholder="Enter group title..">
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <label for="types" class="form-label">Types</label>
                                            <select class="form-select" id="types" name="group_fk_type_id"
                                                @if ($pageType == 'article_new') disabled @endif>
                                                <option value="-1" disabled selected>select..</option>
                                                @foreach ($type->list as $item)
                                                    <option value="{{ $item->id }}" data-qcode="{{ $item->code }}"
                                                        data-isunique="{{ $item->is_unique }}"
                                                        data-allow-detail="{{ $item->allow_detail }}"
                                                        data-allow-body="{{ $item->allow_body }}"
                                                        data-code="{{ $item->code }}"
                                                        data-allow-pagination="{{ $item->allow_pagination }}">
                                                        {{ $item->title }}</option>
                                                @endforeach

                                            </select>

                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <label for="group_theme" class="form-label">Group themes</label>
                                            <select class="form-select" id="group_theme"
                                                name="group_fk_group_theme_id"
                                                @if ($pageType == 'article_new') disabled @endif>
                                                <option value="-1" disabled selected>select..</option>
                                                @foreach ($groupThemes->list as $g)
                                                    <option value="{{ $g->id }}"
                                                        data-maxarticle="{{ $g->max_articles }}"
                                                        @if ($group->data) @if ($g->id == $group->data->fk_group_theme_id) {{ 'selected' }} @endif
                                                        @endif> {{ $g->title }}</option>
                                                @endforeach

                                            </select>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label class="form-label">Photo</label>
                                    <div class="dropzone dropzone-single dz-clickable mb-2 group-profile">
                                        <div class="dz-preview dz-preview-single">

                                        </div>
                                        <div class="dz-default dz-message d-flex flex-column p-5">
                                            <button class="dz-button" type="button"
                                                onclick="document.getElementById('group_image').click()">
                                                Choose
                                            </button>
                                            <input type="file" hidden name="group_image_url" id="group_image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 ">
                                <div class="col-lg-6 col-sm-12">
                                    <fieldset class="row mb-3">
                                        <legend class="col-form-label col-sm-12 pt-0 ">Status</legend>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="has_title"
                                                            name="has_title"
                                                            @if ($group->data && $group->data->has_title) checked @endif
                                                            name="has_title">
                                                        <label class="form-check-label" for="has_title">
                                                            Show title
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </fieldset>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <fieldset class="row mb-3">
                                        <legend class="col-form-label col-sm-12 pt-0 ">This post appear on</legend>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="on-home"
                                                            @if ($pageType == 'article_new') disabled @endif
                                                            name="group_on_home">
                                                        <label class="form-check-label" for="on-home">
                                                            Home page
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="on-navbar"
                                                            @if ($pageType == 'article_new') disabled @endif
                                                            name="group_on_navbar">
                                                        <label class="form-check-label" for="on-navbar">
                                                            Navbar
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="dropdown-on-navbar"
                                                            @if ($pageType == 'article_new') disabled @endif
                                                            name="group_dropdown_on_navbar">
                                                        <label class="form-check-label" for="dropdown-on-navbar">
                                                            Has dropdown
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class=" show-all-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="show-all"
                                                                @if ($pageType == 'article_new') disabled @endif
                                                                name="show_all">
                                                            <label class="form-check-label" for="show-all">
                                                                No pagination
                                                            </label>

                                                        </div>
                                                        <div class=" max-items d-none">
                                                            <div class="ps-3 d-flex gap-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        value="3"
                                                                        @if ($pageType == 'article_new') disabled @endif
                                                                        name="max_items" id="max-items-3" checked>
                                                                    <label class="form-check-label" for="max-items-3">
                                                                        3
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        value="6"
                                                                        @if ($pageType == 'article_new') disabled @endif
                                                                        name="max_items" id="max-items-6">
                                                                    <label class="form-check-label" for="max-items-6">
                                                                        6
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>



                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <label for="" class="form-label">Content</label>
                            <div class="quill-editor @if ($pageType == 'article_new') disabled @endif">
                                <div id="group_highlight" class="rounded border bg-white"></div>
                                <input type="text" name="group_highlight" hidden>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="list-article" role="tabpanel" aria-labelledby="list-article-list">
                    @if ($pageType == 'group_detail')
                        <div class="d-table w-100" style="height: 300px;border: 1px dashed rgba(0, 0, 0, 0.125)">
                            <div class="d-table-cell text-muted text-center align-middle">
                                Select a subheading
                            </div>

                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="mb-3">Subheading</h5>
                                <div class="card mb-3" id="article_container">
                                    <div class="card-header"><span class="card-title">Front Page</span></div>
                                    <div class="card-body">
                                        <div class="row mb-3 g-3">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="article_title" class="form-label">Title</label>
                                                    <input type="text" class="form-control" id="article_title"
                                                        name="article_title"
                                                        @if ($article->data) value="{{ $article->data->title }}" @else value="" @endif
                                                        placeholder="Enter title..">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="theme" class="form-label">Themes</label>
                                                    <select class="form-select" id="theme" name="article_theme_id">
                                                        <option value="-1" disabled selected>select..</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Status</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="btn-detail"
                                                            checked name="btn_detail">
                                                        <label class="form-check-label text-nowrap" for="btn-detail">
                                                            Redirect detail page
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="applyto_all_theme" name="applyto_all_theme">
                                                        <label class="form-check-label text-wrap"
                                                            for="applyto_all_theme">
                                                            Apply theme to all subheadings
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Photo</label>
                                                <div
                                                    class="dropzone dropzone-single dz-clickable mb-2 article-profile">
                                                    <div class="dz-preview dz-preview-single">

                                                    </div>
                                                    <div class="dz-default dz-message d-flex flex-column p-5">
                                                        <button class="dz-button" type="button"
                                                            onclick="document.getElementById('image').click()">
                                                            Choose
                                                        </button>
                                                        <input type="file" hidden name="article_image_url" id="image">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <label for="" class="form-label">Content</label>
                                        <div class="mb-3" id="article_body_container">
                                            <div class="quill-editor">
                                                <div id="article_body" class="rounded border bg-white">

                                                </div>
                                                <input type="text" name="article_body" hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card" id="article_detail_container">
                                    <div class="card-header d-flex p-4">
                                        <span class="card-title flex-grow-1">Detail Page</span>

                                        <a class="btn-toggle w-auto" data-bs-toggle="collapse"
                                            data-bs-target="#detail-pannel-collapse" type="button"
                                            aria-expanded="false"><span class="menu-arrow ms-auto"></span></a>
                                    </div>
                                    <div class="collapse card-body pt-1" id="detail-pannel-collapse">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label for="detail_title" class="form-label">Title</label>
                                                <input type="text" class="form-control" id="detail_title"
                                                    name="detail_title"
                                                    @if ($article->data) value="{{ $article->data->detail_title }}" @else value="" @endif
                                                    placeholder="Enter title..">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Photo</label>
                                                <div
                                                    class="dropzone dropzone-single dz-clickable mb-2 article-detail-profile">
                                                    <div class="dz-preview dz-preview-single">

                                                    </div>
                                                    <div class="dz-default dz-message d-flex flex-column p-5">
                                                        <button class="dz-button" type="button"
                                                            onclick="document.getElementById('detail-image').click()">
                                                            Choose
                                                        </button>
                                                        <input type="file" hidden name="article_detail_image_url"
                                                            id="detail-image">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <label for="" class="form-label">Content</label>
                                        <div class="quill-editor">
                                            <div id="article_detail" class="rounded border bg-white">

                                            </div>
                                            <input type="text" name="article_detail" hidden>
                                        </div>
                                    </div>
                                </div>

                            </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div id="preview" class="p-1 p-lg-5 mt-3">
    <div class="container preview">

        <h5 class="align-self-center">Preview</h5>
        <a id="refresh-btn" role="button" class="text-decoration-none"> Reload theme <i
                class="bi bi-arrow-clockwise"></i></a>
        <hr>
    </div>
    <div class="">
        <div class="container active-theme ">
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(event) {

            let group = {!! json_encode($group, JSON_HEX_TAG) !!}
            let types = {!! json_encode($type, JSON_HEX_TAG) !!};
            let article = {!! json_encode($article, JSON_HEX_TAG) !!};
            let groupThemes = {!! json_encode($groupThemes, JSON_HEX_TAG) !!};
            let themes = {!! json_encode($themes, JSON_HEX_TAG) !!};
            let articleid = {!! json_encode(request('articleid'), JSON_HEX_TAG) !!};
            let pageType = {!! json_encode($pageType, JSON_HEX_TAG) !!};

            //-UI CONTROLS----------------------------------------------------
            let image = document.getElementById('image');
            let groupImage = document.getElementById('group_image');
            let dtlImage = document.getElementById('detail-image');
            let form = document.getElementById('myForm');
            let articleCollapse = new bootstrap.Collapse(document.getElementById('articles-collapse'), {
                toggle: false
            });
            //-UI CONTROLS----------------------------------------------------END

            //-JS CONTROLS----------------------------------------------------
            let quillGroupHighlight, quillArticleDetail, quillArticleBody;
            let _themes = new Map();
            //-JS CONTROLS----------------------------------------------------END


            //-EVENT LISTENER----------------------------------------------------
            try {
                $('#theme').change(changeTheme);
                $('#types').change(changeType);
                $('#myForm').submit(formSubmit);
                $('#types').change(identifyType);
                $('#group_theme').change(function() {
                    getThemes().then(e => {
                        prepareThemes(e);
                    })
                })
                $('input[name=show_all]').change(function() {
                    showAllSubheading();
                })
                $('#refresh-btn').click(e => {
                    applyTheme()
                });
                if (image) {
                    image.addEventListener('change', e => {
                        readImage(e, insertImage, '.article-profile');
                    });
                }
                if (dtlImage) {
                    dtlImage.addEventListener('change', e => {
                        readImage(e, insertImage, '.article-detail-profile');
                    });
                }
                if (groupImage) {
                    groupImage.addEventListener('change', e => {
                        readImage(e, insertImage, '.group-profile');
                    });
                }
                let listTab = document.querySelectorAll('a[data-bs-toggle="list"]');
                listTab.forEach(t => {
                    t.addEventListener('shown.bs.tab', e => {
                        if (e.target.id == 'group-tab') {
                            articleCollapse.hide();
                        } else {
                            articleCollapse.show();
                        }
                    });
                });

            } catch (e) {
                console.log("UNABLE TO ADD LISTENER [" + e + "]");
            }

            //-EVENT LISTENER END----------------------------------------------------

            quillInit();
            initData();
            initSortable();
            //getThemes();

            function identifyType() {
                $('.json-message').empty();
                $('input[name=submit]').removeClass('disabled');
                let d = $("#types option:selected").val();
                Net.get('/api/group/type/identify', {
                    type_id: d,
                    group_id: group.data?.id
                }).then(result => {
                    if (result.success && result.data) {
                        let message = $("#types option:selected").text() + " page is already link.";
                        if (group.data) {
                            Utility.alert(message, document.querySelector('.json-message'), true, [
                                `<a href='/admin/headline/${d}' class="ms-2">Go to ${$("#types option:selected").text()} page</a>`
                            ]);
                            $('input[name=submit]').addClass('disabled');
                            $('.json-message .btn-close').click(() => {
                                alert('hello')
                            })
                        } else {
                            Utility.alert(message + ' your data will be replaced.',
                                document.querySelector('.json-message'), true)
                        }


                    }
                });
                controlNavBarStatus();
                controlPaginationStatus();
            }

            function controlPaginationStatus() {
                if (!$("#types option:selected").attr('data-allow-pagination')) {
                    $('input[name=show_all]').prop('checked', true);
                    $('.show-all-group').addClass('disabled');
                } else {
                    $('.show-all-group').removeClass('disabled');
                    //$('input[name=show_all]').prop('checked', false);
                    //$("input[name=max_items][value=" + 3 + "]").prop('checked', true);
                }
                showAllSubheading();
            }

            function controlNavBarStatus() {
                if ($("#types option:selected").attr('data-isunique')) {
                    $('input[name=group_on_navbar]').prop("checked", true);
                    $('input[name=group_on_navbar]').closest('.form-check').addClass("disabled");
                } else {
                    $('input[name=group_on_navbar]').closest('.form-check').removeClass("disabled");
                }
            }

            function initData() {

                if (window.location.hash) {
                    let activeTab = new bootstrap.Tab(document.querySelector(window.location.hash));
                    activeTab.show();
                }
                if (group.data) {
                    $("#types").val(group.data.fk_type_id);
                    $('input[name=show_all]').prop('checked', group.data.show_all);
                    $("input[name=max_items][value=" + group.data.max_items + "]").prop('checked', true);
                    insertImage(group.data.image_url, '.group-profile');

                    getThemes(group.data.fk_type_id).then(e => {
                        prepareThemes(e, article.data?.fk_theme_id);
                        applyTheme(group.data.fk_theme_id);
                        checkNewArticleButton();
                    });
                    quillGroupHighlight.setContents(JSON.parse(group.data.highlight));

                    if (article.data) {
                        $('input[name=btn_detail]').prop('checked', article.data.btn_detail);
                        if (quillArticleDetail)
                            quillArticleDetail.setContents(JSON.parse(article.data.detail));
                        if (quillArticleBody)
                            quillArticleBody.setContents(JSON.parse(article.data.body));
                        insertImage(article.data.image_url, '.article-profile');
                        insertImage(article.data.detail_image_url, '.article-detail-profile');
                    }
                    decideQuillByType(
                        $("#types option:selected").attr('data-allow-detail') == 1,
                        $("#types option:selected").attr('data-allow-body') == 1
                    );
                    $('input[name=group_on_navbar]').prop('checked', group.data.on_navbar);
                    $('input[name=group_on_home]').prop('checked', group.data.on_home);
                    $('input[name=group_dropdown_on_navbar]').prop('checked', group.data.dropdown_on_navbar);

                    controlNavBarStatus();
                    controlPaginationStatus();

                }
                if (!$('#theme option:selected')) {
                    $('.preview').addClass('d-none');
                }
                showAllSubheading();
            }

            function showAllSubheading() {
                if ($('input[name=show_all]:checked').val()) {
                    $('.max-items').addClass('d-none');
                } else {
                    $('.max-items').removeClass('d-none');
                }
            }

            function quillInit() {
                const groupHighlightDiv = document.querySelector('#group_highlight');
                const articleHighlightDiv = document.querySelector('#article_detail');
                const articleBodyDiv = document.querySelector('#article_body');
                if (groupHighlightDiv)
                    quillGroupHighlight = new Quill(groupHighlightDiv, Utility.quillModules);
                if (articleHighlightDiv)
                    quillArticleDetail = new Quill(articleHighlightDiv, Utility.quillModules);
                if (articleBodyDiv)
                    quillArticleBody = new Quill(articleBodyDiv, Utility.quillModules);
                let qltoolbar = document.querySelectorAll('.ql-toolbar');
                $('.ql-toolbar').each(function() {
                    $(this).addClass('bg-white shadow-sm rounded border-0');
                })
            }

            function initSortable() {
                if ($('#sortable-articles-list').attr('data-sortable') == 0) {
                    return;
                }
                Sortable.create(document.querySelector('#sortable-articles-list'), {
                    handle: '.list-group-item',
                    animation: 150,
                    onEnd: function( /**Event*/ evt) {},
                });
            }

            function changeTheme(event) {
                showThemeDetail({
                    title: $("#theme option:selected").text(),
                    max_articles: $("#theme option:selected").attr('data-maxarticle')
                });
                applyTheme();
                checkNewArticleButton();
            }

            function changeType(event) {
                const allowHighlight = $("#types option:selected").attr('data-allow-detail') == 1;
                const allowBody = $("#types option:selected").attr('data-allow-body') == 1;
                decideQuillByType(allowHighlight, allowBody);
            }

            function showThemeDetail(theme) {
                let detail =
                    `
                <div class="card bg-light">
                    <div class="card-body">
                        <dl>
                            <dt>Title</dt>
                            <dd>${theme.title}.</dd>
                            <dt>Max blocks</dt>
                            <dd>${theme.max_articles}.</dd>
                        </dl>
                    </div>
                </div>
                `;
                $('#theme-detail').html(detail);

            }

            function applyTheme() {

                let myGroup = {
                    title: $('#group_title').val(),
                    highlight: quillGroupHighlight.getContents(),
                    image_url: $('.group-profile img.dz-preview-img').attr('src'),
                }
                let myType = types.list.find(e => e.id == $("#types option:selected").val());
                let myGroupTheme = groupThemes.list.find(e => e.id == $("#group_theme option:selected").val());
                let myTheme = themes.list.find(e => e.id == $("#theme option:selected").val());

                let article = {
                    title: $('input[name=article_title]').val(),
                    theme: themes.list.find(e => e.id == $("#theme option:selected").val()),
                    image_url: $('.article-profile img.dz-preview-img').attr('src'),
                    body: quillArticleBody?.getContents()
                }
                let myArticles;
                if (articleid && group.data) {
                    const index = group.data.articles.findIndex(e => e.id == articleid);
                    if (index != -1) {
                        article.id = parseInt(articleid);
                        group.data.articles[index] = article;
                    }
                    myArticles = group.data.articles;
                } else if (window.location.href.indexOf("article") > -1) {
                    myArticles = [article];
                } else {
                    myArticles = group.data ? group.data.articles : [article];
                }
                let builder = ThemeBuilder.export(new Theme(myGroup, myType, myGroupTheme, myArticles));
                $('.active-theme').empty();
                //console.log($(builder.export()).html());
                $('.active-theme').append(builder);
                //document.getElementById('preview').scrollIntoView();

                /* Flickity Carousel */

                const flickity = document.querySelector('.flickity-container');
                if (flickity) new Flickity(flickity, JSON.parse($('.flickity-container').attr('data-flickity')));
            }

            function checkNewArticleButton() {
                const articlesLen = group.data ? group.data.articles.length : 0;
                const max = parseInt($("#group_theme option:selected").attr('data-maxarticle'));
                if (articlesLen < max) {
                    $('#new-article-btn').removeClass('d-none');
                } else {
                    $('#new-article-btn').addClass('d-none');
                }
            }

            function decideQuillByType(allowHighlight, allowBody) {
                if (allowHighlight) {
                    $('#article_detail_container').removeClass('d-none');
                } else {
                    $('#article_detail_container').addClass('d-none');
                }
                if (allowBody) {
                    $('#article_body_container').removeClass('d-none');
                } else {
                    $('#article_body_container').addClass('d-none');
                }
            }

            function getThemes() {
                return new Promise((res, rej) => {
                    Net.get(`/api/theme/parent/${$('#group_theme option:selected').val()}/children`).then(
                        e => {
                            if (e.success) {
                                res(e.list);
                            } else {
                                rej();
                            }
                        })
                });
            }

            function prepareThemes(list, id = null) {
                $("#theme").empty();
                $('#theme').append(` <option value="-1" selected>select..</option>`)
                for (let theme of list) {
                    $('#theme').append(
                        ` <option value="${theme.id}" data-maxarticle="${theme.max_articles}" ${theme.id==id?'selected':''}>${theme.title}</option>`
                    )
                };
            }

            function insertImage(base64, className) {
                let imageContainer = document.createElement('div');
                imageContainer.classList.add('dz-preview-cover', 'dz-processing', 'dz-image-preview');
                imageContainer.innerHTML = `
                        <img class="dz-preview-img" src="${ base64 }" onerror="errorOnloadImage(this,'${className}')">
                `;
                let preview = document.querySelector(`${className} .dz-preview`);
                preview.innerHTML = "";
                preview.appendChild(imageContainer);
                document.querySelector(`${className}`).classList.add('dz-max-files-reached');
            }

            function readImage(e, output, className) {
                const input = e.srcElement;
                let base64;
                for (let f of input.files) {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        base64 = e.target.result;
                        //input.value = null;
                        output(base64, className);
                    };
                    reader.readAsDataURL(f);
                }
            }

            function formSubmit(event) {
                document.querySelector('input[name=group_highlight]').value = JSON.stringify(
                    quillGroupHighlight
                    .getContents());
                document.querySelector('input[name=article_detail]').value = JSON.stringify(
                    quillArticleDetail
                    .getContents());
                document.querySelector('input[name=article_body]').value = JSON.stringify(quillArticleBody
                    .getContents());
            }

            function redirect(event) {
                if (event.target.id == 'group-tab') {
                    //window.location.replace("http://stackoverflow.com");
                    articleCollapse.hide();

                }
            }

        });

        function errorOnloadImage(e, className) {
            $(className).removeClass('dz-max-files-reached');
            $($(className).find('.dz-preview-cover')).remove();
        }
    </script>
@endpush
