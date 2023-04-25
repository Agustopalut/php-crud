$(document).ready(() => {
    $("#keyword").on("keyup",(e) => {
        e.preventDefault();
        $.get(`ajax/mahasiswa.php?keyword=${$("#keyword").val()}`,(result) => {
            if(e.target.value.length > 0 ) {
                $("#pagination").hide();
            } else {
                $("#pagination").show();
            }
            $("#container-table").html(result);
        })
    })
})