$( document ).ready(function() {
    $(".complete").on( "click", function() {
        let id =  $(this).val();
        let task = $("#task" + id);
        let status = $("#status" + id);
        
        $.ajax({
            url: '/task/edit',
            type: 'POST',             
            data: {id: id, status: 1},
            dataType: 'json',
            success: function(json){   
                if (json['status'] == 1){
                    task.removeClass('list-group-item-warning');
                    task.addClass('list-group-item-success');  
                    
                    status.attr('checked', true);
                }       

                if (json['redirect'])
                    window.location.href = 'task/login'
            }
        });
    });

    $(".edit").on( "click", function() {
        let id =  $(this).val();
        let textarea = $("#taskText" + id);
        let text = textarea.val();
        let edit =  $("#taskEdit" + id);
        
        $.ajax({
            url: '/task/edit',
            type: 'POST',             
            data: {id: id, text: text},
            dataType: 'json',
            success: function(json){   
                if (json['edit'] == 1)
                    edit.removeClass('d-none');
                if (json['redirect'])
                    window.location.href = 'task/login'
            }
        });
    });
});