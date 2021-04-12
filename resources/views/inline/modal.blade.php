@push('scripts')
    <script src="/js/bootstrap.bundle.min.js" charset="utf-8"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <div class="modal" id="inlineModal" tabindex="-1" role="dialog" aria-hidden="true"> <div class="modal-dialog modal-dialog-centered" role="document"> <div class="modal-content"> <div class="modal-header"> <h5 class="modal-title">Edytuj</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij"><span aria-hidden="true">&times;</span></button> </div><div class="modal-body"> <div class="inlineform"> <form method="POST" action="" enctype="multipart/form-data" id="inlineForm" name="inlineForm"> @csrf <div class="form-group form-modaltytul"> <label for="modaltytul" class="required">Tytuł</label> <div class="formRight"> <input type="text" name="modaltytul" id="modaltytul" value="" size="83" class="validate[required] form-control"> </div></div><div class="form-group form-modaleditor"> <label for="modaleditor" class="required">Tekst</label> <div class="formRight"> <input type="text" name="modaleditor" id="modaleditor" value="" size="83" class="validate[required] form-control"> </div></div><div class="form-group form-modaleditortext"> <label for="modaleditortext" class="required">Treść</label> <div class="fullformRowtext"> <textarea name="modaleditortext" id="modaleditortext" rows="19" cols="100" class="editor"></textarea> </div></div><div class="form-group form-modallink"> <label for="modallink" class="required">Button link</label> <div class="formRight"> <input type="text" name="modallink" id="modallink" value="" size="83" class="validate[required] form-control"> </div></div><div class="form-group form-modallinkbutton"> <label for="modallinkbutton" class="required">Button tekst</label> <div class="formRight"> <input type="text" name="modallinkbutton" id="modallinkbutton" value="" size="83" class="validate[required] form-control"> </div></div><div class="form-group form-file"> <label for="file" class="optional">Obrazek - szerokość: 1920 px - wysokość: 960 px</label> <div class="formRight"> <input type="hidden" name="MAX_FILE_SIZE" value="16777216" id="MAX_FILE_SIZE"> <input type="file" name="file" id="file" class="validate[checkFileType[jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF]]"> </div></div><div class="form-group form-file_alt"> <label for="file_alt" class="required">Tytuł obrazka</label> <div class="formRight"> <input type="text" name="file_alt" id="file_alt" value="" size="83" class="validate[required] form-control"> </div></div><div class="form-group form-hidden"> <div class="formRight"> <input type="hidden" name="id_element" value="1" id="id_element"> </div></div><div> <input type="submit" name="submit" id="submit" value="Zapisz" class="btn btn-primary"> </div></form> <div class="progress"> <div class="progress-bar progress-bar-striped active progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"></div></div></div></div></div></div></div>

<script type="text/javascript">
    function process_response(obj) { const f = $("#inlineModal form"); const newObj = Object.keys(obj).filter(e => obj[e] !== null).reduce( (o, e) => { o[e]= obj[e]; return o;}, {}); ['id', 'id_place', 'sort', 'file'].forEach(i => delete newObj[i]); $.each(newObj, function (key, val) {f.find('[name="' + key + '"]').val(val);});}
    function cleanModal(){$("#inlineForm, #inlineForm .form-group, .progress").removeAttr("style");$("#inlineForm")[0].reset();$("#file").val("");$("#id_element").val("");$("label[for='file']").text("Obrazek");$(".modal h5").text("Edytuj");$(".alert").remove()};

    const baseURL = 'http://developro.test/';

    $("#inlineModal").on("shown.bs.modal", function (j)
    {
        cleanModal();
        const form = document.forms.namedItem("inlineForm");
        let f = j.relatedTarget.dataset.inline,
            k = j.relatedTarget.dataset.place,
            a = j.relatedTarget.dataset.method,
            c = j.relatedTarget.dataset.imgwidth,
            g = j.relatedTarget.dataset.imgheight,
            h = j.relatedTarget.dataset.hideinput;

        if (h)
        {
            var b = h.split(",");
            var d;
            for (d = 0; d < b.length; ++d)
            {
                $(".form-" + b[d]).hide()
            }
        }
        if (f !== undefined)
        {
            $.ajax({
                type: "GET",
                url: baseURL + "inline/loadinline/" + f,
                success: function (i) {
                    if (i.error) {
                        alert(i.error);
                        $("#inlineModal").modal("toggle")
                    } else {
                        process_response(i);
                        if (c !== undefined) {
                            $("label[for='file']").append(" - szerokość: " + c + " px")
                        }
                        if (g !== undefined) {
                            $("label[for='file']").append(" - wysokość: " + g + " px")
                        }
                        $("#id_element").val(f);
                    }
                },
                error: function () {
                    alert("Wystąpił błąd połączenia z bazą")
                }
            })
        } else {
            if (c !== undefined)
            {
                $("label[for='file']").append(" - szerokość: " + c + " px")
            }
            if (g !== undefined)
            {
                $("label[for='file']").append(" - wysokość: " + g + " px")
            }
            $(".modal h5").text("Dodaj nowy element")
        }
        console.log('Form shown');

        form.addEventListener( "submit", function (event) {
            console.log('Submit form');
            event.preventDefault();
            event.stopImmediatePropagation();

            let formData = new FormData($(this)[0]);
            for(let pair of formData.entries()) {
                console.log(pair[0]+ ', '+ pair[1]);
            }

            console.log(formData.get("id_element"));

            let n, type, l = formData.get("id_element");
            if (l === "") {
                n = baseURL + "inline/create/" + k;
                type = 'POST';
                console.log("Dodaje nowy element")
                console.log(n)
            } else {
                n = baseURL + "inline/update/" + l;
                type = 'POST';
                console.log("Aktualizuje element")
                console.log(n)
            }
            const i = $("input[type=file]")[0].files[0];
            if (i !== undefined) {
                formData.append("obrazek", i);
                formData.append("obrazek_width", c);
                formData.append("obrazek_height", g)
            }

            console.log(formData.values());

            $.ajaxSetup({headers: {"X-CSRF-TOKEN": $('input[name="_token"]').val()}});
            $.ajax({
                type        : type,
                url         : n,
                data        : formData,
                enctype     : "multipart/form-data",
                cache       : false,
                contentType : false,
                processData : false,
                beforeSend: function () {
                    $(".modal form").hide();
                    $(".modal h5").text("Zapisuje...");
                    $(".modal .progress").css({
                        display: "flex"
                    })
                },
                success: function (p) {
                    if (p.status === "success") {
                        $(".progress").removeAttr("style");
                        console.log(p);

                        if (p.items.modaltytul) {
                            $("[data-modaltytul=" + p.item + "]").text(p.items.modaltytul)
                        }
                        if (p.items.modaleditor) {
                            $("[data-modaleditor=" + p.item + "]").text(p.items.modaleditor)
                        }
                        if (p.items.modaleditortext) {
                            $("[data-modaleditortext=" + p.item + "]").html(p.items.modaleditortext)
                        }
                        if (p.items.modallink) {
                            $("[data-modallink=" + p.item + "]").attr("href", p.items.modallink)
                        }
                        if (p.items.modallinkbutton) {
                            $("[data-modalbutton=" + p.item + "]").text(p.items.modallinkbutton)
                        }
                        if (p.items.file_alt) {
                            $("[data-img=" + p.item + "]").attr("alt", p.items.file_alt)
                        }
                        if (p.items.file) {
                            $("[data-img=" + p.item + "]").attr("src", baseURL + "uploads/inline/" + p.items.file)
                        }
                        if (p.items.id_place) {
                            $("[data-placeholder=" + p.items.id_place + "]").append(p.html)
                        }

                        $(".modal h5").text("Gotowe");

                        $(".inlineform").append('<div class="alert alert-success border-0" role="alert">Edycja zakończona sukcesem!</div>');
                        setTimeout(function () {
                            $("#inlineModal").modal("hide");
                            setTimeout(function () {
                                cleanModal();
                            }, 200)
                        }, 2000)
                    } else {
                        console.log("Coś poszło nie tak :)")
                    }
                },
                error: function () {
                    alert("Wystąpił bład połączenia z bazą");
                    $("#inlineModal").modal("hide");
                }
            });
            return false

        });
    });

    $("#inlineModal").on("hide.bs.modal", function (c)
    {
        console.log('Close modal');
        cleanModal();
    });
</script>
@endpush
