import "https://code.jquery.com/jquery-3.6.0.min.js";

$(document).ready(function () {
    function updateURLParameters(params) {
        var url = new URL(window.location.href);
        Object.keys(params).forEach(param => {
            if (params[param] && params[param] !== "") {
                url.searchParams.set(param, params[param]);
            } else {
                url.searchParams.delete(param);
            }
        });
        window.history.replaceState(null, "", url);
    }

    function fetchData(page, searchValue, competenceId = null) {
        var neededUrl = window.location.pathname;

        if (searchValue.trim() !== "") {
            $("tbody").html('<tr><td colspan="100%"><div class="loading-spinner"></div></td></tr>');
        }

        $.ajax({
            url: neededUrl,
            data: { page: page, searchValue: searchValue, competenceId: competenceId },
            success: function (data) {
                setTimeout(function() {
                    var newData = $(data);
                    $("tbody").html(newData.find("tbody").html());
                    $("#card-footer").html(newData.find("#card-footer").html());
                    $(".pagination").html(newData.find(".pagination").html() || "");

                    updateURLParameters({ page: page, searchValue: searchValue, competenceId: competenceId });
                }, 3000);
            }
        });
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
