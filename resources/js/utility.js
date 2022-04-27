export default class Utility {
    constructor() {}

    get quillModules() {
        return {
            modules: {
                toolbar: [
                    ["bold", "italic", "underline", "strike"], // toggled buttons
                    ["blockquote"],
                    ["link"],
                    [
                        {
                            list: "ordered",
                        },
                        {
                            list: "bullet",
                        },
                    ],
                    [
                        {
                            script: "sub",
                        },
                        {
                            script: "super",
                        },
                    ], // superscript/subscript
                    [
                        {
                            indent: "-1",
                        },
                        {
                            indent: "+1",
                        },
                    ], // outdent/indent
                    [
                        {
                            direction: "rtl",
                        },
                    ], // text direction

                    [
                        {
                            size: ["small", false, "large", "huge"],
                        },
                    ], // custom dropdown
                    [
                        {
                            header: [1, 2, 3, 4, 5, 6, false],
                        },
                    ],

                    [
                        {
                            color: [],
                        },
                        {
                            background: [],
                        },
                    ], // dropdown with defaults from theme
                    [
                        {
                            font: [],
                        },
                    ],
                    [
                        {
                            align: [],
                        },
                    ],

                    ["clean"],
                ],
            },
            theme: "snow", // or 'bubble'
        };
    }

    alert(header, parent, keepAlive = false, buttons = []) {
        let alert = `
        <div class="alert alert-warning alert-dismissible show fade mb-3" role="alert">
            <strong>${this.sentenceCase(header)}</strong>`;

        for (let btn of buttons) {
            alert += btn;
        }
        alert += `<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`;
        alert = $.parseHTML(alert);
        $(parent).append(alert);
        if (!keepAlive) {
            setTimeout(() => {
                $(alert).remove();
            }, 3000);
        }
    }
    sentenceCase(input) {
        input = input === undefined || input === null ? "" : input;
        input = input.trim();
        input = input.toLowerCase();
        return input
            .toString()
            .replace(/(^|\. *)([a-z])/g, function (match, separator, char) {
                return separator + char.toUpperCase();
            });
    }
    textTypeV2(destination, data) {
        var aText = data;
        var iSpeed = 100; // time delay of print out
        var iIndex = 0; // start printing array at this posision
        var iArrLength = aText[0].length; // the length of the text array
        var iScrollAt = 20; // start scrolling up at this many lines

        var iTextPos = 0; // initialise text position
        var sContents = ""; // initialise contents variable
        var iRow; // initialise current row

        function typewriter() {
            sContents = " ";
            iRow = Math.max(0, iIndex - iScrollAt);
            while (iRow < iIndex) {
                sContents += aText[iRow++] + "<br />";
            }
            destination.innerHTML =
                sContents + aText[iIndex].substring(0, iTextPos) + "";
            if (iTextPos++ == iArrLength) {
                iTextPos = 0;
                iIndex++;
                if (iIndex != aText.length) {
                    iArrLength = aText[iIndex].length;
                    setTimeout(typewriter, 500);
                }
            } else {
                setTimeout(typewriter, iSpeed);
            }
        }
        typewriter();
    }
    updateQueryStringParameter(uri, key, value) {
        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = uri.indexOf("?") !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, "$1" + key + "=" + value + "$2");
        } else {
            return uri + separator + key + "=" + value;
        }
    }
    showSuccessModal(header, message) {
        let html = `<div>
        <div class="modal fade  message-box" id="success-modal" tabindex="-1" aria-labelledby="success-modal"
        aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content mx-auto">
                    <div class="modal-header ">
                        <div class="icon-box">
                        <i class="bi bi-check2"></i>

                        </div>
                        <h4 class="modal-title w-100 fw-bold text-center">${header}</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">${message}</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success btn-block w-100" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div></div>
        `;
        return new bootstrap.Modal(
            $($.parseHTML(html)).find(".message-box").clone()
        );
    }
    showReturnMessage(message, success, parentRef) {
        const successHtml = `
        <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
        `;
        const failHtml = `
        <path class="checkmark_check" fill="none" d="M14.1 14.1l23.8 23.8 m0,-23.8 l-23.8,23.8" />
        `;
        const html = `<div>
        <span class="result d-flex align-items-center bg-success px-3 rounded-pill">
            <span class="text-white me-2">
                ${message}
            </span>
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                ${success ? successHtml : failHtml}
            </svg>
        </span>></div>
        `;
        const alert = $($.parseHTML(html)).find(".result").clone();
        setTimeout(() => {
            $(alert).remove();
        }, 3000);
        $(alert).appendTo(parentRef);
    }
    showConfirmModal(header) {
        return new Promise((res, rej) => {
            let html = `<div>
            <div class="modal fade" id="confirm-modal" tabindex="-1" aria-labelledby="confirm-modal"
            aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title w-100">${header}</h5>
                        </div>
                        <form id="confirm-modal-form">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your current password">
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-end">
                                <button class="btn btn-secondary btn-block btn-cancel" type="button">Cancel</button>
                                <button class="btn btn-primary btn-block btn-submit" type="submit">OK</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div></div>
            `;
            let modal = $($.parseHTML(html)).find("#confirm-modal").clone();
            let modalElement = new bootstrap.Modal(modal);
            modalElement.show();
            $(modal)
                .find("#confirm-modal-form")
                .on("submit", function (e) {
                    e.preventDefault();

                    $("#confirm-modal").hide("slow", function () {
                        $(this).remove();
                    });
                    modalElement.dispose();
                    res(e.target.elements.password.value);
                });
            $(modal)
                .find(".btn-cancel")
                .on("click", function (e) {
                    $("#confirm-modal").slideUp("slow", function () {
                        $(this).remove();
                    });
                    modalElement.dispose();
                    rej();
                });
        });
    }
}
