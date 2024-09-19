import "https://code.jquery.com/jquery-3.6.0.min.js";

$(document).ready(function () {

    // Fonction pour mettre à jour un paramètre dans l'URL
    function updateURLParameter(param, paramVal) {
        var url = window.location.href;
        var hash = location.hash;
        url = url.replace(hash, "");
        if (url.indexOf(param + "=") >= 0) {
            var prefix = url.substring(0, url.indexOf(param + "="));
            var suffix = url.substring(url.indexOf(param + "="));
            suffix = suffix.substring(suffix.indexOf("=") + 1);
            suffix =
                suffix.indexOf("&") >= 0
                    ? suffix.substring(suffix.indexOf("&"))
                    : "";
            url = prefix + param + "=" + paramVal + suffix;
        } else {
            if (url.indexOf("?") < 0) url += "?" + param + "=" + paramVal;
            else url += "&" + param + "=" + paramVal;
        }
        window.history.replaceState({ path: url }, "", url + hash);
    }

    // Fonction pour récupérer les données avec AJAX
    function fetchData(page, searchValue) {
        var neededUrl = window.location.pathname;
        console.log(neededUrl);

        if (showLoading()) {
            setTimeout(searchRequest, 300);
        }else{
            searchRequest();
        }

        function searchRequest(){
            $.ajax({
                url: neededUrl + "/?page=" + page + "&searchValue=" + searchValue,
                success: function (data) {
                    var newData = $(data);

                    $("tbody").html(newData.find("tbody").html());
                    $("#card-footer").html(newData.find("#card-footer").html());
                    var paginationHtml = newData.find(".pagination").html();
                    if (paginationHtml) {
                        $(".pagination").html(paginationHtml);
                    } else {
                        $(".pagination").html("");
                    }
                    hideLoading();
                },
            });

            if (page !== null && searchValue !== null) {
                updateURLParameter("page", page);
                updateURLParameter("searchValue", searchValue);
            } else {
                window.history.replaceState(
                    {},
                    document.title,
                    window.location.pathname
                );
            }
        }


 origin/develop-pkg_rh
    }

    function getUrlParameter(name) {
        return new URLSearchParams(window.location.search).get(name) || "";
    }

    var searchValueFromUrl = getUrlParameter("searchValue");
    var competenceIdFromUrl = getUrlParameter("competenceId");
    var pageFromUrl = getUrlParameter("page") || 1;

    if (searchValueFromUrl) {
        $("#table_search").val(searchValueFromUrl);
    }
    if (competenceIdFromUrl) {
        $("#competenceFilter").val(competenceIdFromUrl);
    }
    fetchData(pageFromUrl, searchValueFromUrl, competenceIdFromUrl);

    $(document).on("change", "#competenceFilter", function () {
        var page = 1; // Reset to the first page on filter change
        var competenceId = $(this).val();
        var searchValue = $("#table_search").val();
        fetchData(page, searchValue, competenceId);
    });

    $("body").on("click", ".pagination button", function (event) {
        event.preventDefault();
        var page = $(this).attr("page-number");
        var searchValue = $("#table_search").val();
        var competenceId = $("#competenceFilter").val();
        fetchData(page, searchValue, competenceId);
    });


    $("body").on("keyup", "#table_search", function () {
        var searchValue = $(this).val();
        var competenceId = $("#competenceFilter").val();
        if (searchValue === "") {
            updateURLParameters({ page: undefined, searchValue: undefined });
            fetchData(1, searchValue, competenceId);
        } else {
            fetchData(1, searchValue, competenceId);
        }
    });

    $(document).on("change", "#upload", function () {
        $("#importForm").submit();
    });

    $(".dropdown-toggle").dropdown();
});
