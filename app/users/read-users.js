$(document).ready(function () {
  // show list of users on first load
  showUsers();
});

// function to show list of users
function showUsers() {
  // get list of users from the API
  $.getJSON("http://localhost:8080/fitness/api/user/read.php", function (data) {
    // html for listing users
    var read_users_html = `
    <!-- when clicked, it will load the create user form -->
    <div id='create-user-button' class='btn btn-primary pull-left m-b-15px create-user-button'>
        <span class='glyphicon glyphicon-plus'></span> Add User
    </div>
    <div id='create-plan-button' class='btn btn-primary pull-right m-b-15px create-plan-button'>
        <span class='glyphicon glyphicon-plus'></span> Add Plan
    </div>
    <!-- start table -->
    <table class='table table-bordered table-hover'>`;
    // loop through returned list of data
    $.each(data.records, function (key, val) {
      // creating new table row per record
      read_users_html +=
        `
      <tr>
          <td>` + val.first_name + " " + val.last_name + `'s plan</td>
          <!-- 'action' buttons -->
          <td>
              <!-- read user's plan button -->
              <button id='read-one-user-button' class='btn btn-primary m-r-10px read-one-user-button' data-id='` + val.plan_id + `'>
                  <span class='glyphicon glyphicon-eye-open'></span> Load
              </button>
              <!-- edit button -->
              <button id='update-user-button' class='btn btn-info m-r-10px update-user-button' data-id='` + val.id + `'>
                  <span class='glyphicon glyphicon-edit'></span> Edit
              </button>
              <!-- delete button -->
              <button class='btn btn-danger delete-user-button' data-id='` + val.id + `'>
                  <span class='glyphicon glyphicon-remove'></span> Delete
              </button>
          </td>
      </tr>`;
    });

    // end table
    read_users_html += `</table>`;
    // inject to 'page-content' of our app
    $("#page-content").html(read_users_html);
    // chage page title
    changePageTitle("Plan overview");
  });
}

// when a 'read users' button was clicked
$(document).on("click", ".read-users-button", function () {
  showUsers();
});
