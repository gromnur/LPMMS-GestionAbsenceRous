

$('#dept').change(function () {
    $.ajax({
        type: 'POST',
        dataType: "json",
        url: "test.php",
        data: {func: 'selectDept'},
        success: function (data) {
            alert(data[0]);
            alert(data[1]);
        }
    })
});
