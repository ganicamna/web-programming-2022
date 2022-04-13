var UserService = {

  add: function(user){
    $.ajax({
      url: 'rest/users',
      type: 'POST',
      data: JSON.stringify(user),
      contentType: "application/json",
      dataType: "json",
      success: function(result) {
        // append to the list
        $("#notes-users").append(`<div class="list-group-item note-user-`+result.id+`">
          <button class="btn btn-danger btn-sm float-end" onclick="UserService.delete(`+result.id+`)">delete</button>
          <p class="list-group-item-text">`+result.description+`</p>
        </div>`);
        toastr.success("Added !");
      }
    });
  },

  list_by_note_id: function(note_id){
    $("#notes-users").html('loading ...');
    $.get("rest/notes/"+note_id+"/users", function(data) {
      var html = "";
      for(let i = 0; i < data.length; i++){
        html += `<div class="list-group-item note-user-`+data[i].id+`">
          <button class="btn btn-danger btn-sm float-end" onclick="UserService.delete(`+data[i].id+`)">delete</button>
          <p class="list-group-item-text">`+data[i].description+`</p>
        </div>`;
      }
      $("#notes-users").html(html);
    });

    // note id populate and form validation
    $('#add-user-form input[name="note_id"]').val(note_id);
    $('#add-user-form input[name="created"]').val(UserService.current_date());

    $('#add-user-form').validate({
      submitHandler: function(form) {
        var entity = Object.fromEntries((new FormData(form)).entries());
        UserService.add(entity);
        $('#add-user-form input[name="description"]').val("");
        toastr.info("Adding ...");
      }
    });
    $("#userModal").modal('show');
  },

  delete: function(id){
    var old_html = $("#notes-users").html();
    $('.note-user-'+id).remove();
    toastr.info("Deleting in background ...");
    $.ajax({
      url: 'rest/users/'+id,
      type: 'DELETE',
      success: function(result) {
        toastr.success("Deleted !");
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        toastr.error(XMLHttpRequest.responseJSON.message);
        $("#notes-users").html(old_html);
        //alert("Status: " + textStatus); alert("Error: " + errorThrown);
      }
    });
  },

  current_date: function(){
    const today = new Date();
    const yyyy = today.getFullYear();
    let mm = today.getMonth() + 1; // Months start at 0!
    let dd = today.getDate();

    if (dd < 10) dd = '0' + dd;
    if (mm < 10) mm = '0' + mm;

    return yyyy+"-"+mm+"-"+dd;
  }

}
