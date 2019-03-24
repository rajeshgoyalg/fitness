$(document).ready(function () {
  // show html form when 'update user' button was clicked
  $(document).on("click", ".update-user-button", function () {
    // get user id
    var id = $(this).attr("data-id");
    // read one record based on given user id
    $.getJSON(
      "http://localhost:8080/fitness/api/user/read_one.php?id=" + id,
      function (data) {
        // values will be used to fill out our form
        var first_name = data.first_name;
        var last_name = data.last_name;
        var email = data.email;
        var plan_id = data.plan_id;

        // load list of categories
        $.getJSON("http://localhost:8080/fitness/api/plan/read.php", function (
          data
        ) {
          // build 'plans option' html
          // loop through returned list of data
          var plans_options_html = `<select name='plan_id' class='form-control'>`;

          $.each(data.records, function (key, val) {
            // pre-select option is plan id is the same
            if (val.id == plan_id) {
              plans_options_html +=
                `<option value='` +
                val.id +
                `' selected>` +
                val.name +
                `</option>`;
            } else {
              plans_options_html +=
                `<option value='` + val.id + `'>` + val.name + `</option>`;
            }
          });
          plans_options_html += `</select>`;

          // store 'update user' html to this variable
          var update_user_html =
            `
            <div id='read-users' class='btn btn-primary pull-right m-b-15px read-users-button'>
                <span class='glyphicon glyphicon-list'></span> Plan overview
            </div>
            <!-- build 'update user' html form -->
            <!-- we used the 'required' html5 property to prevent empty fields -->
            <form id='update-user-form' action='#' method='post' border='0'>
                <table class='table table-hover table-responsive table-bordered'>        
                    <!-- first name field -->
                    <tr>
                        <td>First Name</td>
                        <td><input value=\"` + first_name + `\" type='text' name='first_name' class='form-control' required /></td>
                    </tr>        
                    <!-- last name field -->
                    <tr>
                        <td>Last Name</td>
                        <td><input value=\"` + last_name + `\" type='text' name='last_name' class='form-control' required /></td>
                    </tr>        
                    <!-- email field -->
                    <tr>
                        <td>Email</td>
                        <td><input value=\"` + email + `\" type='text' name='email' class='form-control' required /></td>
                    </tr>        
                    <!-- plans 'select' field -->
                    <tr>
                        <td>Plan</td>
                        <td>` + plans_options_html + `</td>
                    </tr>        
                    <tr>            
                        <!-- hidden 'user id' to identify which record to delete -->
                        <td><input value=\"` + id + `\" name='id' type='hidden' /></td>            
                        <!-- button to submit form -->
                        <td>
                            <button type='submit' class='btn btn-info'>
                                <span class='glyphicon glyphicon-edit'></span> Update User
                            </button>
                            <div id='read-users' class='btn btn-primary pull-right m-b-15px read-users-button'>
                              <span class='glyphicon'></span> Cancel
                            </div>
                        </td>        
                    </tr>        
                </table>
            </form>`;
          // inject to 'page-content' of our app
          $("#page-content").html(update_user_html);

          // chage page title
          changePageTitle("Update User");
        });
      }
    );
  });

  // will run if 'create user' form was submitted
  $(document).on("submit", "#update-user-form", function () {
    // get form data
    var form_data = JSON.stringify($(this).serializeObject());
    // submit form data to api
    $.ajax({
      url: "http://localhost:8080/fitness/api/user/update.php",
      type: "POST",
      contentType: "application/json",
      data: form_data,
      success: function (result) {
        // user was updated, go back to users list
        showUsers();
      },
      error: function (xhr, resp, text) {
        // show error to console
        console.log(xhr, resp, text);
      }
    });
    return false;
  });
});
