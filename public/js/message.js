$(function() {
    get_data();
});

function get_data() {
    $.ajax({
        url: "result/ajax",
        dataType: "json",
        success: data => {
            $("#messages")
                .find(".message-visible")
                .remove();

            for (var i = 0; i < data.messages.length; i++) {
                for (var i = 0; i < data.messages.length; i++) {
                    var html = `
                                <div class="mb-2 px-3 py-1 bg-white message-visible">
                                    <img class="rounded-circle float-left mr-2 h-100" src="../storage/${data.messages[i].avatar}" alt="message-user-image" style="width:40px">
                                    <div>
                                        <div class="text-body">${data.messages[i].user_name}</div>
                                        <div class="text-break">${data.messages[i].message}</div>
                                    </div>
                                </div>
                            `;
    
                    $("#messages").append(html);
                }
            }
        },
        error: () => {
            alert("ajax Error");
        }
    });

    setTimeout("get_data()", 500);
}