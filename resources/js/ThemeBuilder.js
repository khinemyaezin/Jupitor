export default class ThemeBuilder {
    htmlConverter = require("quill-delta-to-html").QuillDeltaToHtmlConverter;
    domParser = new DOMParser();

    constructor() {
        
    }

    convert(deltaOps) {
        let converter = new this.htmlConverter(deltaOps.ops, {
            inlineStyles: true,
            paragraphTag: "p",
        });
        return converter.convert();
    }

    export(theme) {
        let parent = this._groupTemplate(theme);
        this._genArticle(parent, theme);

        /*========== IF CAROUSEL =========*/
        $(parent)
            .find(".carousel-item")
            .each(function (index) {
                if (index == 0) {
                    $(this).addClass("active");
                }
            });
        return parent;
    }

    _groupTemplate(theme) {
        let groupContents = this.convert(this.checkJSON(theme._group.highlight));
        let groupTheme = $.parseHTML(theme._groupTheme.body);
        if (!theme._group.has_title) {
            $(groupTheme).find(".group-container").remove();
        }
        $(groupTheme).find(".group-image").attr("src", theme._group.image_url);

        $($(groupTheme).find(".group-content")).html(groupContents);
        let btnDetail = $(groupTheme).find(".btn-detail");
        if ($(btnDetail).is("a")) {
            $(btnDetail).attr("href", `/${theme._type.code}`);
        }
        if (theme._group.show_all) {
            $(btnDetail).closest(".btn-detail-container").remove();
        }
        if (theme._articles.length == theme._group.articlesCount) {
            $(btnDetail).closest(".btn-detail-container").remove();
        }
        return groupTheme;
    }

    _genArticle(parent, theme) {
        try {
            let row = $(parent).find(".group-contents");
            let articleTitle = null;
            for (let article of theme._articles) {
                let shell = $.parseHTML(article.theme.body);
                let body = this.convert(this.checkJSON(article.body));
                const typid = theme._type.code;
                const groupid = theme._group.id;
                const aid = article.id;

                /*===== Article Title =====*/
                $(shell)
                    .find(".article-title")
                    .each(function () {
                        articleTitle = $(this).clone();
                        $(this).html(article.title);
                        if ($(this).is("a")) {
                            $(this).attr(
                                "href",
                                `/${typid}/${groupid}/${aid}`
                            );
                        }
                    });
                /*===== Article Detail Button ===== */
                $($(shell).find("a.btn-detail")).attr(
                    "href",
                    `/${typid}/${groupid}/${aid}`
                );
                if (!article.btn_detail) {
                    $(shell).find("a.btn-detail").remove();
                }
                /*===== Article Content ===== */
                $($(shell).find(".theme-content")).html(body);
                /*===== Article Image ===== */
                if (article.image_url) {
                    if (article.theme.image_type == "background-image") {
                        let card = $(shell).find(".bg-image");
                        if (!article.image_url.startsWith("http")) {
                            $(card).css(
                                "background-image",
                                `url("${article.image_url}")`
                            );
                        } else {
                            let urls = article.image_url.split("\\");
                            $(card).css("background-image", `url("${urls}")`);
                        }
                    } else {
                        if ($(shell).is("img")) {
                            $(shell).attr("src", article.image_url);
                        } else {
                            $(shell).find("img").attr("src", article.image_url);
                        }
                    }
                } else {
                    $($(shell).find("img")).remove();
                }
                $(row).append(shell);
            }
            /*===== Adjust Title Height all equal ===== */
            this._textAdjustHeight(row, articleTitle, theme);

            $(parent).find("section").append(row);
        } catch (e) {
            console.log(e);
        }
    }

    _textAdjustHeight(groupContent, articleTitle, theme) {
        const longestArticle = theme._articles.reduce(function (a, b) {
            return a.title.length > b.title.length ? a : b;
        });
        $(articleTitle).text(longestArticle.title);
        $(articleTitle).addClass("position-relative invisible");
        const c = ".txt-adj-h-container";
        $(groupContent)
            .find(c)
            .each(function () {
                $(this).find(".article-title").addClass("position-absolute ");
                $(articleTitle).clone().appendTo(this);
            });
    }
    checkJSON(obj) {
        if (typeof obj === "object") {
            return obj;
        } else if (typeof obj === "string") {
            return JSON.parse(obj);
        }
    }
}
