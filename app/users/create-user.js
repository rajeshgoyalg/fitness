$(document).ready(function () {
  // show html form when 'create user' button was clicked
  $(document).on("click", ".create-user-button", function () {
    // load list of workout plan
    $.getJSON("http://localhost:8080/fitness/api/plan/read.php", function (
      data
    ) {
      // build workout plan option html
      // loop through returned list of data
      var plans_options_html = `<select name='plan_id' class='form-control'>`;
      $.each(data.records, function (key, val) {
        plans_options_html +=
          `<option value='` + val.id + `'>` + val.name + `</option>`;
      });
      plans_options_html += `</select>`;
      // we have our html form here where user information will be entered
      // we used the 'required' html5 property to prevent empty fields
      var create_user_html =
        ` 
        <!-- 'read user' button to show list of users -->
        <div id='read-user' class='btn btn-primary pull-right m-b-15px read-users-button'>
            <span class='glyphicon glyphicon-list'></span> Plan overview
        </div>
        <!-- 'create user' html form -->
        <form id='create-user-form' action='#' method='post' border='0'>
            <table class='table table-hover table-responsive table-bordered'>    
                <!-- first name field -->
                <tr>
                    <td>First Name</td>
                    <td><input type='text' name='first_name' class='form-control' required /></td>
                </tr>    
                <!-- last name field -->
                <tr>
                    <td>Last Name</td>
                    <td><input type='text' name='last_name' class='form-control' required /></td>
                </tr>    
                <!-- email field -->
                <tr>
                    <td>Email</td>
                    <td><input type='text' name='email' class='form-control' required /></td>
                </tr>    
                <!-- plan 'select' field -->
                <tr>
                    <td>Plan</td>
                    <td>` + plans_options_html + `</td>
                </tr>    
                <!-- button to submit form -->
                <tr>
                    <td></td>
                    <td>
                        <button type='submit' class='btn btn-primary'>
                            <span class='glyphicon glyphicon-plus'></span> Create User
                        </button>
                    </td>
                </tr>    
            </table>
        </form>`;
      // inject html to 'page-content' of our app
      $("#page-content").html(create_user_html);

      // chage page title
      changePageTitle("Create User");
    });
  });

  // will run if create user form was submitted
  $(document).on("submit", "#create-user-form", function () {
    // get form data
    var form_data = JSON.stringify($(this).serializeObject());
    // submit form data to api
    $.ajax({
      url: "http://localhost:8080/fitness/api/user/create.php",
      type: "POST",
      contentType: "application/json",
      data: form_data,
      success: function (result) {
        // user was created, go back to users list
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
